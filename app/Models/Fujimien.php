<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Histories;
use App\Models\Businesses;
use App\Models\Hospitals;

class Fujimien extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'jurisdictional_id',
        'name',
        'gender',
        'name_kana',
        'date_of_birth',
        'town',
        'current_age',
        'specified_date',
        'age_from_specified_date',
        'special_notes',
        'payment_refund_method',
        'bank_name',
        'bank_type',
        'branch_name',
        'account_type',
        'account_number',
        'account_name',
        'disability_allowances_grade',
        'disability_allowances_payment_method',
        'disability_allowances_amount',
        'benefit_payment_method',
        'care_worker',
    ];

    public function jurisdictional()
    {
        return $this->belongsTo(Jurisdictionals::class);
    }

    public function histories()
    {
        return $this->hasMany(Histories::class);
    }
}
