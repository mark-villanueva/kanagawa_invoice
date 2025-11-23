<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FamilyGuardians;

class GuardianPeriodIncomes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'm_family_guardian_id',
        'income_name',
        'start_date',
        'end_date',
        'yearly_amount',
        'two_months_amount',
        'one_month_amount',
        'created_at',
        'updated_at',
        'deleted_at',
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
