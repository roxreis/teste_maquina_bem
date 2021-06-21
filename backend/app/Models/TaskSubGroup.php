<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'create_at',
        'estimated_time',
        'important',
        'task_id'
    ];


    public function task()
    {
        return $this->hasMany(Task::class);
        
    }
}
