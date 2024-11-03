<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function productionSchedules()
    {
        return $this->hasMany(ProductionSchedule::class);
    }
}
