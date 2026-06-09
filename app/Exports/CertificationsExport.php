<?php

namespace App\Exports;

use App\Models\Certification;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Override;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CertificationsExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    #[Override]
    public function query()
    {
        return Certification::with(['employee', 'course'])
            ->orderBy('expiry_date');
    }


    public function headings(): array
    {
        return [
            'Empleado',
            'Documento',
            'Curso',
            'Instituto',
            'Fecha Emisión',
            'Fecha Vencimiento',
            'Estado',
        ];
    }



    public function map($certification): array
    {
        $daysLeft = now()->diffInDays($certification->expiry_date, false);

        if ($daysLeft < 0) {
            $status = 'Vencido';
        } elseif ($daysLeft <= 30) {
            $status = 'Por vencer (' . $daysLeft . ' días)';
        } else {
            $status = 'Vigente';
        }

        return [
            $certification->employee->full_name,
            $certification->employee->document_number,
            $certification->course->name,
            $certification->institute,
            $certification->issue_date->format('d/m/Y'),
            $certification->expiry_date->format('d/m/Y'),
            $status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1d4ed8']],
            ],
        ];
    }
}
