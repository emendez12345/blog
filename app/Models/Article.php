<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded=[
        'id',
        'created_at',
        'updated_at'
    ];

    //Relation of one or one invers(profile-user)
    public function User(){
        return $this->belongsTo(User::class);
    } 
    
    //Relation of one or muchs(article-comment)

    public function Comment(){
        return $this->hasMany(Comment::class);
    }

     //Relation of one or muchs invers(category-article)
     public function category(){
        return $this->belongsTo(Category::class);
    }
 
}
