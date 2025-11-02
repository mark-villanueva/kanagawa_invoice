<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Hospitals extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'hospital_name',   
        'abbreviation',   
        'phone',
        'fax',
        'postal_code',
        'address',
        'special_notes',
        'hospital_category',
        'supporting_medical_departments',
        'medical_institution_code',
    ];

    protected $casts = [
        'supporting_medical_departments' => 'array',
    ];
}
