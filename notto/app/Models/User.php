<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar'
    ];
    // lấy tất cả task
    public function tasks()
    {
        return $this->hasMany(Task::class, 'uid');
    }
    public function incompletedTasks()
    {
        return $this->tasks()
                    ->whereIn('status', ['pending', 'overdue'])
                    ->get();
    }

    // Tasks đã hoàn thành (trạng thái completed)
    public function completedTasks()
    {
        return $this->tasks()
                    ->whereIn('status', ['completed','late'])
                    ->get();
    }

    // Tasks quá hạn
    public function overDueTasks()
    {
        return $this->tasks()
                    ->whereIn('status', ['overdue'])
                    ->get();
    }
    // lấy task trong tuần
    public function tasksInWeek($startOfWeek)
    {
        return $this->tasks()->whereBetween('deadline', [
            $startOfWeek->format('Y-m-d 00:00:00'),
            $startOfWeek->copy()->endOfWeek()->format('Y-m-d 23:59:59')
        ])->get();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
