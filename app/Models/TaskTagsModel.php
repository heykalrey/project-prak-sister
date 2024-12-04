<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaskTagsModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'task_tags';
    protected $fillable = [
        'task_id',
        'tag_id',
        'assigned_by',
        'assigned_at',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function task()
    {
        return $this->belongsTo(TaskModel::class);
    }

    public function tag()
    {
        return $this->belongsTo(TagsModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
