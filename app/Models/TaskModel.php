<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaskModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tasks';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function taskTags()
    {
        return $this->hasMany(TaskTagsModel::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
