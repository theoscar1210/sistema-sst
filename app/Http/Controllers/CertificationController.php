<?php

namespace App\Http\Controllers;


use App\Models\Certification;
use App\Models\Course;
use App\Models\Employee;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certifications = Certification::with(['employee', 'course'])
            ->orderBy('expiry_date')
            ->paginate(15);

        return view('certifications.index', compact('certifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('is_active', true)->orderBY('last_name')->get();
        $courses = Course::orderBy('name')->get();
        return view('certifications.create', compact('employees', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'course_id' => 'required|exists:courses,id',
            'institute' => 'required|max:150',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            'certificate_file' => 'nullable|max255',
            'notes' => 'nullable|max:500',
        ]);

        Certification::create($request->all());
        return redirect()->route('certifications.index')->with('success', 'Certificación creada exitosamente.');
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
    public function edit(Certification $certification)
    {
        $employees = Employee::where('is_active', true)->orderBy('last_name')->get();
        $courses = Course::orderBy('name')->get();
        return view('certifications.edit', compact('certification', 'employees', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'course_id' => 'required|exists:courses,id',
            'institute' => 'required|max:150',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            'certificate_file' => 'nullable|max255',
            'notes' => 'nullable|max:500',
        ]);

        $certification->update($request->all());
        return redirect()->route('certifications.index')->with('success', 'Certificación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();
        return redirect()->route('certifications.index')->with('success', 'Certificación eliminada exitosamente.');
    }
}
