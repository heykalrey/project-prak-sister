<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagsModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'tags';
    protected $fillable = [
        'name',
        'color',
        'description',
        'category',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function taskTags()
    {
        return $this->hasMany(TaskTagsModel::class);
    }
}
