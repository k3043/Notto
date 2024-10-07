<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at'];

    // Tự động tạo UUID trước khi lưu vào cơ sở dữ liệu
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid(); // Tạo UUID mới
        });
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
}
