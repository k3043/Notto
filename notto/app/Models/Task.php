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
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee', 'email');
    }
    public function isFinished() {
        return in_array($this->status, ['completed', 'late']);
    }
    

    public function markAsDone(){
        if($this->status == 'pending') $this->status = 'completed';
        if($this->status == 'overdue') $this->status ='late';
        return $this->save();
    }

    public function markAsUnfinished(){
        if ($this->submissions()->exists()) {
            $this->submissions()->delete();
        }
        if($this->status == 'completed') $this->status = 'pending';
        if($this->status == 'late') $this->status ='overdue';
        return $this->save();
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class,'taskid');
    }
}
