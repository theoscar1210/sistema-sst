<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'validity_months',
        'description',
    ];

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }
}
