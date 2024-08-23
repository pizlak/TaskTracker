<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'id',
        'title',
        'status',
        'type',
        'priority',
        'description',
        'user_id',
        'parent_id',
        'updated_at',
        'due_date'
    ];
    public function subtasks(): HasMany
    {
       return $this->hasMany(Task::class, 'parent_id');
    }
}
