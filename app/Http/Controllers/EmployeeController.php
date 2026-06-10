<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->filled('area')) {
            $query->where('area', 'like', "%{$request->area}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        $employees = $query->orderBy('last_name')->paginate(10)->withQueryString();

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

        $employee = Employee::create($request->only([
            'document_number',
            'name',
            'last_name',
            'area',
            'position',
            'company',
            'phone',
            'email',
        ]));

        ActivityLogService::log(        // ← agregar esto
            'created',
            $employee,
            "Registró el empleado: {$employee->full_name}"
        );

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
            'name'            => 'required|max:100',
            'last_name'       => 'required|max:100',
            'area'            => 'required|max:100',
            'position'        => 'required|max:100',
            'company'         => 'required|max:100',
            'phone'           => 'nullable|max:20',
            'email'           => 'nullable|email|max:100',
        ]);

        $before = $employee->only([
            'document_number',
            'name',
            'last_name',
            'area',
            'position',
            'company',
            'phone',
            'email',
            'is_active'
        ]);

        $employee->update($request->only([
            'document_number',
            'name',
            'last_name',
            'area',
            'position',
            'company',
            'phone',
            'email',
            'is_active',
        ]));

        $after = $employee->only([
            'document_number',
            'name',
            'last_name',
            'area',
            'position',
            'company',
            'phone',
            'email',
            'is_active'
        ]);

        ActivityLogService::log(
            'updated',
            $employee,
            "Actualizó el empleado: {$employee->full_name}",
            ['before' => $before, 'after' => $after]
        );

        return redirect()->route('employees.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        ActivityLogService::log(
            'deleted',
            $employee,
            "Eliminó el empleado: {$employee->full_name}"
        );


        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Empleado eliminado correctamente');
    }
}
