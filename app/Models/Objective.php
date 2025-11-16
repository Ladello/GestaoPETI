<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'requirements',
    ];

    protected $casts = [
        'requirements' => 'array',
    ];

    // metas (goals) vinculadas ao objetivo
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
