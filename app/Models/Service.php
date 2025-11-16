<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'portal_url',
        'sla',
        'results_expected',
    ];

    protected $casts = [
        'results_expected' => 'array',
    ];

    // opcional: relacionar metas/objetivos ao serviço (se quiser)
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
