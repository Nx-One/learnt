<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\SubUnit;
use App\Models\Unit;
use App\Models\Question;
use App\Models\Option;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CUROS = [
            [
                'name' => 'Course 1',
                'description' => 'Description for Course 1',
                'user_id' => 1,
            ]
        ];

        $units = [
            [
                'name' => 'Unit 1',
                'description' => 'Description for Unit 1',
                'course_id' => 1,
            ],
        ];

        $subUnits = [
            [
                'name' => 'Sub Unit 1',
                'description' => 'Description for Sub Unit 1',
                'unit_id' => 1,
                'video_url' => 'https://youtu.be/RUTV_5m4VeI',
            ],
            [
                'name' => 'Sub Unit 2',
                'description' => 'Description for Sub Unit 2',
                'unit_id' => 1,
            ],
            [
                'name' => 'Sub Unit 3',
                'description' => 'Description for Sub Unit 3',
                'unit_id' => 1,
            ],
            [
                'name' => 'Sub Unit 4',
                'description' => 'Description for Sub Unit 4',
                'unit_id' => 2,
                'video_url' => 'https://youtu.be/oPlEq7fewIg?list=PLFIM0718LjIWXagluzROrA-iBY9eeUt4w',
            ],
            [
                'name' => 'Sub Unit 5',
                'description' => 'Description for Sub Unit 5',
                'unit_id' => 2,
            ],
            [
                'name' => 'Sub Unit 6',
                'description' => 'Description for Sub Unit 6',
                'unit_id' => 3,
            ],
            [
                'name' => 'Sub Unit 7',
                'description' => 'Description for Sub Unit 7',
                'unit_id' => 3,
            ],
        ];

        $questions =[
            [
                'question' => 'Question 1',
                'sub_unit_id' => 2,
            ],
            [
                'question' => 'Question 2',
                'sub_unit_id' => 2,
            ],
            [
                'question' => 'Question 1',
                'sub_unit_id' => 3,
            ],
            [
                'question' => 'Question 2',
                'sub_unit_id' => 3,
            ],
            [
                'question' => 'Question 3',
                'sub_unit_id' => 3,
            ],
            [
                'question' => 'Question 3',
                'sub_unit_id' => 3,
            ],
            [
                'question' => 'Question 4',
                'sub_unit_id' => 5,
            ],
            [
                'question' => 'Question 5',
                'sub_unit_id' => 5,
            ],
            [
                'question' => 'Question 6',
                'sub_unit_id' => 5,
            ],
            [
                'question' => 'Question 7',
                'sub_unit_id' => 6,
            ],
            [
                'question' => 'Question 8',
                'sub_unit_id' => 6,
            ],
            [
                'question' => 'Question 9',
                'sub_unit_id' => 7,
            ],
        ];

        $options =[
            [
                'option' => 'Answer A',
                'is_correct' => true,
                'question_id' => 1,
            ],
            [
                'option' => 'Answer B',
                'is_correct' => false,
                'question_id' => 1,
            ],
            [
                'option' => 'Answer C',
                'is_correct' => false,
                'question_id' => 1,
            ],
            [
                'option' => 'Answer D',
                'is_correct' => false,
                'question_id' => 1,
            ],
            [
                'option' => 'Answer A',
                'is_correct' => false,
                'question_id' => 2,
            ],
            [
                'option' => 'Answer B',
                'is_correct' => false,
                'question_id' => 2,
            ],
            [
                'option' => 'Answer C',
                'is_correct' => true,
                'question_id' => 2,
            ],
            [
                'option' => 'Answer D',
                'is_correct' => false,
                'question_id' => 2,
            ],
        ];

        foreach ($CUROS as $course) {
            Course::create($course);
        }

        foreach ($units as $unit) {
            Unit::create($unit);
        }

        // foreach ($subUnits as $subUnit) {
        //     SubUnit::create($subUnit);
        // }

        // foreach ($questions as $question) {
        //     Question::create($question);
        // }

        // foreach ($options as $option) {
        //     Option::create($option);
        // }
    }
}
