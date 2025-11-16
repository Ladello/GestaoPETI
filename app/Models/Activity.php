<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'acceptance_criteria',
        'due_date',
        'assignee_id',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // atividade pertence a um projeto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // usuário atribuído à atividade
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    // helper: verifica se está atrasada
    public function isOverdue(): bool
    {
        if (! $this->due_date) {
            return false;
        }
        return $this->due_date->isPast() && $this->status !== 'concluido';
    }
}
