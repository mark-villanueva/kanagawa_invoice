<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Units extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'fee_name',
        'scheduled_amount',
        'actual_amount',
        'welfare_hospital',
        'welfare_hospital_id',
        'difference',
        'billing_status',   
        'billing_date',
    ];

    protected $casts = [
        'welfare_hospital_id' => 'array',
    ];

    public function welfareHospital()
    {
        return $this->belongsTo(Hospitals::class);
    }
}
