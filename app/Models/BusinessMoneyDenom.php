<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessMoneyDenom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id',
        'money_denomination_name',
        'ten_thousand_yen',
        'five_thousand_yen',
        'thousand_yen',
        'five_hundred_yen',
        'hundred_yen',
        'fifty_yen',
        'ten_yen',
        'five_yen',
        'one_yen',
        'total',
    ];

    public function business()
    {
        return $this->belongsTo(Businesses::class, 'business_id');
    }
}
