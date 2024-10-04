<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'link'];

    public function task()
    {
        return $this->belongsTo(Task::class,'taskid');
    }
}
