<?php

namespace App\Http\Controllers;


use App\Models\Certification;
use App\Models\Course;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\CertificationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ActivityLogService;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Certification::with(['employee', 'course']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('status')) {
            if ($request->status === 'expired') {
                $query->whereDate('expiry_date', '<', now());
            } elseif ($request->status === 'expiring') {
                $query->whereDate('expiry_date', '>=', now())
                    ->whereDate('expiry_date', '<=', now()->addDays(30));
            } elseif ($request->status === 'active') {
                $query->whereDate('expiry_date', '>', now()->addDays(30));
            }
        }
        $courses = Course::orderBy('name')->get();
        $certifications = $query->orderBy('expiry_date')->paginate(15)->withQueryString();

        return view('certifications.index', compact('certifications', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('is_active', true)->orderBy('last_name')->get();
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
            'certificate_file' => 'nullable|max:255',
            'notes' => 'nullable|max:500',
        ]);

        $certification = Certification::create($request->all());

        ActivityLogService::log(
            'created',
            $certification,
            "Registró certificación: {$certification->employee->full_name} — {$certification->course->name}"
        );
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
        ActivityLogService::log(
            'updated',
            $certification,
            "Actualizó certificación: {$certification->employee->full_name} — {$certification->course->name}"
        );
        return redirect()->route('certifications.index')->with('success', 'Certificación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        ActivityLogService::log(
            'deleted',
            $certification,
            "Eliminó certificación: {$certification->employee->full_name} — {$certification->course->name}"
        );
        $certification->delete();
        return redirect()->route('certifications.index')->with('success', 'Certificación eliminada exitosamente.');
    }

    public function exportExcel()
    {
        return Excel::download(new CertificationsExport(), 'certificaciones_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function exportPdf()
    {
        $certifications = Certification::with(['employee', 'course'])
            ->orderBy('expiry_date')
            ->get();

        $pdf = Pdf::loadView('certifications.pdf', compact('certifications'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('certificaciones_' . now()->format('Y-m-d') . '.pdf');
    }
}
