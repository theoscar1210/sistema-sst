<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('last_name')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_number' => 'required|unique:employees|max:20',
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'area' => 'required|max:100',
            'position' => 'required|max:100',
            'company' => 'required|max:100',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Empleado registrado correctamente.');
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
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'document_number' => 'required|max:20|unique:employees,document_number,' . $employee->id,
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'area' => 'required|max:100',
            'position' => 'required|max:100',
            'company' => 'required|max:100',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {

        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Empleado eliminado correctamente');
    }
}
