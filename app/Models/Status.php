<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    # 以一对多的形式关联 User 模型
    public function user() {
        $this->belongsTo(User::class);
    }
}
