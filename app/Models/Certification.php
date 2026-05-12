<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'employee_id',
        'course_id',
        'institute',
        'issue_date',
        'expiry_date',
        'certificate_file',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
