<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        h1 {
            color: #1d4ed8;
            font-size: 16px;
            margin-bottom: 4px;
        }

        p {
            color: #6b7280;
            font-size: 10px;
            margin: 0 0 12px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1d4ed8;
            color: white;
            padding: 6px 8px;
            text-align: left;
            font-size: 10px;
        }

        td {
            padding: 5px 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .vencido {
            color: #dc2626;
            font-weight: bold;
        }

        .por-vencer {
            color: #d97706;
            font-weight: bold;
        }

        .vigente {
            color: #16a34a;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Reporte de Certificaciones — Sistema SST</h1>
    <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Documento</th>
                <th>Curso</th>
                <th>Instituto</th>
                <th>Emisión</th>
                <th>Vencimiento</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($certifications as $cert)
            @php
            $daysLeft = (int) now()->diffInDays($cert->expiry_date, false);
            if ($daysLeft < 0) {
                $statusClass='vencido' ;
                $statusText='Vencido' ;
                } elseif ($daysLeft <=30) {
                $statusClass='por-vencer' ;
                $statusText='Por vencer (' . $daysLeft . ' días)' ;
                } else {
                $statusClass='vigente' ;
                $statusText='Vigente' ;
                }
                @endphp
                <tr>
                <td>{{ $cert->employee->full_name }}</td>
                <td>{{ $cert->employee->document_number }}</td>
                <td>{{ $cert->course->name }}</td>
                <td>{{ $cert->institute }}</td>
                <td>{{ $cert->issue_date->format('d/m/Y') }}</td>
                <td>{{ $cert->expiry_date->format('d/m/Y') }}</td>
                <td class="{{ $statusClass }}">{{ $statusText }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
</body>

</html>