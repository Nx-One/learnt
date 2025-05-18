<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Unit;
use App\Models\SubUnit;
use App\Models\ForumThread;
use App\Models\Score;
use App\Models\User;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($course_id, $unit_id)
    {
        // Fetch assessments related to the course and unit
        $assessments = Assessment::where('unit_id', $unit_id)->with('unit.course')->with(['score' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->with('user')
        ->paginate(5);
        $course = Course::findOrFail($course_id);
        return view('assessment.index', compact('assessments', 'course', 'unit_id'));
    }

    public function create()
    {
        // Show the form to create a new assessment
        return view('assessment.create');
    }

    public function store(Request $request, $course_id, $unit_id)
    {
        // Validate and store the new assessment
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        // $file = $request->file('image');
        // $fileName = $file->hashName();

        $assessment = new Assessment();
        $assessment->title = $request->title;
        $assessment->description = $request->description;
        $assessment->due_date = $request->due_date;
        $assessment->link = $request->link;
        $assessment->user_id = auth()->id();
        $assessment->unit_id = $unit_id;
        // $assessment->image = $fileName;

        // Save the assessment
        $assessment->save();

        // Store the image
        // $path = $file->store('images', 'public');

        return redirect()->route('assessment.index', ['course_id' => $course_id, 'unit_id' => $unit_id])->with('success', 'Assessment created successfully.');
    }

    public function show($id)
    {
        // Show a specific assessment
        $assessment = Assessment::with('user')->with('unit.course')->findOrFail($id);
        $course = Course::findOrFail($assessment->unit->course_id);
        return view('assessment.show', compact('assessment', 'course'));
    }

    public function score($id)
    {
        // Show a specific assessment
        $assessment = Assessment::with('user')->with('unit.course')->with('score')->findOrFail($id);
        $course = Course::findOrFail($assessment->unit->course_id);
        $unit_id = $assessment->unit_id;

        // get user with role user
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        // add score to user
        foreach ($users as $user) {
            $score = Score::where('user_id', $user->id)->where('assessment_id', $id)->first();
            if ($score) {
                // convert score to varchar
                $user->score = (string)$score->score;
            } else {
                $user->score = null;
            }
        }
        return view('assessment.score', compact('assessment', 'course', 'users', 'unit_id'));
    }

    public function saveScore(Request $request, $assessment_id)
    {
        // Validate and save the score

        for($index = 0; $index < count($request->user_id); $index++) {
            $score = Score::updateOrCreate(
                ['assessment_id' => $assessment_id, 'user_id' => $request->user_id[$index]],
                ['score' => $request->score[$index]]
            );
            $score->save();
        }

        return redirect()->route('assessment.score', $assessment_id)->with('success', 'Score saved successfully.');
    }

    public function edit($id)
    {
        // Show the form to edit an existing assessment
        $assessment = Assessment::findOrFail($id);
        return view('assessment.edit', compact('assessment'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the assessment
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $assessment = Assessment::findOrFail($id);
        $assessment->title = $request->title;
        $assessment->description = $request->description;
        $assessment->due_date = $request->due_date;
        $assessment->link = $request->link;

        // Check if a new image is uploaded
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = $file->hashName();
        //     // Delete the old image if it exists
        //     if ($assessment->getOriginal('image')) {
        //         $oldImagePath = public_path('storage/images/' . $assessment->getOriginal('image'));
        //         if (file_exists($oldImagePath)) {
        //             unlink($oldImagePath);
        //         }
        //     }
        //     $assessment->image = $fileName;
        //     // Store the new image
        //     $path = $file->store('images', 'public');
        // }

        // Save the updated assessment
        $assessment->save();

        $resAss = Assessment::where('unit_id', $assessment->unit_id)->get();
        $unit = Unit::findOrFail($assessment->unit_id);
        $course = Course::findOrFail($unit->course_id);

        return redirect()->route('assessment.index', ['course_id' => $course->id, 'unit_id' => $assessment->unit_id])->with('success', 'Assessment updated successfully.');
    }

    public function destroy($id)
    {
        // Find the assessment to get the unit_id and course_id
        $assessment = Assessment::findOrFail($id);
        $unit_id = $assessment->unit_id;
        $course_id = $assessment->unit->course_id;
        // Delete the assessment
        Assessment::destroy($id);
        return redirect()->route('assessment.index', ['course_id' => $course_id, 'unit_id' => $unit_id])->with('success', 'Assessment deleted successfully.');
    }
}
