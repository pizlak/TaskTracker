<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
