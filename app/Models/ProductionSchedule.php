<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['production_plan_id', 'day', 'planned_production', 'adjusted_production'];

    public function productionPlan()
    {
        return $this->belongsTo(ProductionPlan::class);
    }
}
