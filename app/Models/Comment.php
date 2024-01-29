<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded=[
        'id',
        'created_at',
        'updated_at'
    ];

     //Relation of one or one invers(comment-user)
     public function User(){
        return $this->belongsTo(User::class);
    }

    //Relation of one or muchs invers(comment-article)
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
