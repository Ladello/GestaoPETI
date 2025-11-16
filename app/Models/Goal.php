<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'objective_id',
        'metric',
        'target_value',
        'target_label',
        'target_date',
        'notes',
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_value' => 'decimal:4',
    ];

    // objetivo pai
    public function objective()
    {
        return $this->belongsTo(Objective::class, 'objective_id');
    }
}
