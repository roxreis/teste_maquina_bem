<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'create_at',
    ];


    public function taskSubGroup()
    {
        return $this->belongsTo(TaskSubGroup::class);
    }

}
