<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\Material;
use App\Models\Course;
use App\Models\Unit;
use App\Models\SubUnit;
use App\Models\ForumThread;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($course_id, $unit_id)
    {
        // Fetch materials related to the course and unit
        $materials = Material::with('user')->with('unit.course')->where('unit_id', $unit_id)->paginate(5);
        $course = Course::findOrFail($course_id);
        return view('material.index', compact('materials', 'course', 'unit_id'));
    }
    public function store(Request $request, $course_id, $unit_id)
    {
        // Validate and store the new material
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $file = $request->file('image');
        $fileName = $file->hashName();

        $material = new Material();
        $material->title = $request->title;
        $material->description = $request->description;
        $material->type = $request->type;
        $material->link = $request->link;
        $material->user_id = auth()->id();
        $material->unit_id = $unit_id;
        $material->image = $fileName;

        // Save the material
        $material->save();

        // Store the file
        $path = $file->store('images', 'public');

        return redirect()->route('material.index', ['course_id' => $course_id, 'unit_id' => $unit_id])->with('success', 'Material created successfully.');
    }
    public function show($id)
    {
        // Show a specific material
        $material = Material::with('user')->with('unit.course')->findOrFail($id);
        $course = Course::findOrFail($material->unit->course_id);
        return view('material.show', compact('material', 'course'));
    }
    public function edit($id)
    {
        // Show the form to edit a specific material
        $material = Material::findOrFail($id);
        return view('material.edit', compact('material'));
    }
    public function update(Request $request, $id)
    {
        // Validate and update the material
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);


        $material = Material::findOrFail($id);
        $material->title = $request->title;
        $material->description = $request->description;
        $material->type = $request->type;
        $material->link = $request->link;
        $material->user_id = auth()->id();

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->hashName();
            // Delete the old image if necessary
            if ($material->getOriginal('image')) {
                $oldImagePath = public_path('storage/images/' . $material->getOriginal('image'));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $material->image = $fileName;
            // Store the new file
            $path = $file->store('images', 'public');
        }

        // Save the updated material
        $material->save();

        $matRes = Material::where('unit_id', $material->unit_id)->get();
        $unit = Unit::findOrFail($material->unit_id);
        $course = Course::findOrFail($unit->course_id);

        return redirect()->route('material.index', ['course_id' => $course->id, 'unit_id' => $material->unit_id])->with('success', 'Material updated successfully.');
    }
    public function destroy($id)
    {
        // Find the material to get the unit_id and course_id
        $material = Material::findOrFail($id);
        $unit_id = $material->unit_id;
        $course_id = $material->unit->course_id;
        // Delete the material
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('material.index', ['course_id' => $course_id, 'unit_id' => $unit_id])->with('success', 'Material deleted successfully.');
    }
}
