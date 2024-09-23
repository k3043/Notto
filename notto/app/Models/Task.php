<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'deadline', 'description', 'uid','status']; // Các trường có thể gán hàng loạt

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
    public function isFinished(){
        return $this->status == 'completed';
    }

    public function markAsDone(){
        $this->status = 'completed';
        return $this->save();
    }

    public function markAsUnfinished(){
        $this->status = $this->status == 'completed'? 'pending':$this->status;
        return $this->save();
    }
}
