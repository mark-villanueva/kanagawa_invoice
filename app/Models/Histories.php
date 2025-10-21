<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fujimien;
use App\Models\Hospitals;

class Histories extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fujimien_id',
        'hospital_id',
        'status',
        'admission_date',
        'leaving_date',
        'hospitalization_date',
        'discharge_date',
        'hospitalization_recognition_date',
        'discharge_recognition_date',
        'day_care_start_date',
        'day_care_end_date',
        'home_training_start_date',
        'home_training_end_date',
        'welfare_benefits_suspension_start_date',
        'welfare_benefits_resumption_date',
    ];

    public function fujimien()
    {
        return $this->belongsTo(Fujimien::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospitals::class);
    }
}
