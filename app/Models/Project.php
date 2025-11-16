<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // campos que podem ser preenchidos em massa
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'start_date',
        'end_date',
        'owner_id',
        'meta',
    ];

    // casts para tipos apropriados
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'meta' => 'array',
    ];

    // atividades vinculadas ao projeto
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // usuário responsável (owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // contador rápido de atividades concluídas (exemplo de helper)
    public function completedActivitiesCount()
    {
        return $this->activities()->where('status', 'concluido')->count();
    }
}
