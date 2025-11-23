<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fujimien;

class SelfExpenses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'm_fujimien_user_id',
        'fiscal_year',
        'april_amount',
        'may_amount',
        'june_amount',
        'july_amount',  
        'august_amount',
        'september_amount',
        'october_amount',
        'november_amount',
        'december_amount',
        'january_amount',
        'february_amount',
        'march_amount',
        'pension',
        'certificate_of_employment',
        'total_expenses',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fujimien()
    {
        return $this->belongsTo(Fujimien::class);
    }

    protected $casts = [
        'pension' => 'array',
        'certificate_of_employment' => 'array',
    ];
}
