<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }
        $courses = $query->orderBy('name')->paginate(10)->withQueryString();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:courses|max:150',
            'validity_months' => 'required|integer|min:1|max:120',
            'description' => 'nullable|max:500',
        ]);
        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|max:150|unique:courses,name,' . $course->id,
            'validity_months' => 'required|integer|min:1|max:120',
            'description' => 'nullable|max:500',
        ]);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado exitosamente.');
    }
}
