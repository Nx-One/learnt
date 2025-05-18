<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Unit;
use App\Models\Question;
use App\Models\Option;
use App\Models\SubUnit;
use App\Models\UserProgress;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::with('unit')->with('user')->get();
        $unit_id = UserProgress::where('user_id', auth()->user()->id)->first();
        if ($unit_id) {
            $unit_id = $unit_id->subUnit->unit_id;
        }
        $unit = Unit::where('id', $unit_id)->with('course')->first();
        $progress = $unit ? round($unit->count_progress()) : 0;
        return view('courses.index', compact('courses', 'unit', 'progress'));
    }

    public function unit($course_id)
    {
        $units = Unit::where('course_id', $course_id)->with('course')->get();
        $unit_length = count($units);

        if($unit_length > 1){
            return view('courses.unit', compact('units'));
        }else{
            return redirect()->route('courses.corridor', ['course_id' => $course_id, 'unit_id' => $units[0]->id]);
        }
    }

    public function subUnit($course_id, $unit_id)
    {
        // $questions = Question::where('sub_unit_id', $unit_id)->with('subUnit')->get();
        // $options = Option::where('sub_unit_id', $unit_id)->get();
        $subUnits = SubUnit::where('unit_id', $unit_id)->with('unit')->with('userProgress')->get();
        return view('courses.subUnit', compact('subUnits', 'course_id', 'unit_id'));
    }

    public function showQuestion($subUnitId, $questionNumber) {
        $questions = Question::where('sub_unit_id', $subUnitId)->get();
        $totalQuestions = $questions->count();

        if ($questionNumber > $totalQuestions || $questionNumber < 1) {
            return redirect()->route('quiz', ['subUnitId' => $subUnitId, 'questionNumber' => 1]);
        }

        $question = $questions[$questionNumber - 1];

        return view('courses.quiz', compact('question', 'totalQuestions', 'questionNumber'));
    }

    public function submitAnswer(Request $request, $subUnitId, $questionNumber) {
        $user = auth()->user();
        $question = Question::find($request->input('question_id'));
        $selectedOption = $request->input('option_id');

        // Check if the answer is correct
        $isCorrect = Option::where('id', $selectedOption)->value('is_correct');

        // Save user progress with is_correct field
        $userProgress = UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'sub_unit_id' => $subUnitId,
                'question_id' => $question->id,
                'unit_id' => $question->subUnit->unit_id
            ],
            [
                'progress' => $questionNumber,
                'is_completed' => $questionNumber == $this->getTotalQuestions($subUnitId),
                'is_correct' => $isCorrect
            ]
        );

        // Calculate score only if the user has completed all questions
        if ($userProgress->is_completed) {
            $this->calculateScore($user, $subUnitId);
            return redirect()->route('courses.subUnit', ['course_id' => $question->subUnit->unit->course_id, 'unit_id' => $question->subUnit->unit_id]);
        }

        return redirect()->route('quiz', ['subUnitId' => $subUnitId, 'questionNumber' => $questionNumber + 1]);
    }

    private function getTotalQuestions($subUnitId) {
        return Question::where('sub_unit_id', $subUnitId)->count();
    }


    private function calculateScore($user, $subUnitId) {
        $totalQuestions = Question::where('sub_unit_id', $subUnitId)->count();
        $correctAnswers = UserProgress::where('user_id', $user->id)
                                      ->where('sub_unit_id', $subUnitId)
                                      ->where('is_correct', true)
                                      ->count();

        $score = ($correctAnswers / $totalQuestions) * 100;

        UserProgress::where('user_id', $user->id)
                    ->where('sub_unit_id', $subUnitId)
                    ->update(['score' => $score]);
    }

    public function corridor($course_id, $unit_id)
    {
        $course = Course::find($course_id);
        $unit = Unit::find($unit_id);
        return view('courses.corridor', compact('course', 'unit'));
    }
}
