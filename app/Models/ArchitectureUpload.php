<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitectureUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'mime',
        'uploaded_by',
        'description',
    ];

    // usuário que fez o upload
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
