<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fujimien;
use App\Models\Businesses;

class UserMoneyDenom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fujimien_user_id',
        'business_id',
        'money_denomination_name',
        'start_date',
        'end_date',
        'maximum_money_denomination',
    ];

    public function fujimien()
    {
        return $this->belongsTo(Fujimien::class);
    }

    public function business()
    {
        return $this->belongsTo(Businesses::class);
    }
}
