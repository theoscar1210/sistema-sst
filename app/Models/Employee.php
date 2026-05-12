<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'document_number',
        'name',
        'last_name',
        'area',
        'position',
        'company',
        'phone',
        'email',
        'is_active',
    ];

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }
}
