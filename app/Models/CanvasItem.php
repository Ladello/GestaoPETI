<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvasItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'content',
        'order',
    ];

    // scope para facilitar ordenação por bloco
    public function scopeSection($query, $section)
    {
        return $query->where('section', $section)->orderBy('order', 'asc');
    }
}
