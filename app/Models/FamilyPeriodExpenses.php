<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FamilyGuardians;

class FamilyPeriodExpenses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'm_family_guardian_id',
        'start_date',
        'end_date',
        'one_month_amount',
    ];

    public function familyGuardian()
    {
        return $this->belongsTo(FamilyGuardians::class);
    }

    public function fujimien()
    {
        return $this->belongsTo(Fujimien::class);
    }
}

