<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function imageable(){
    	return $this->morphMany(Imageable::class, 'imageable');
    }

    public function comment(){
    	return $this->hasMany(Comment::class);
    }

    public function tags(){
    	return $this->morphToMany(Tag::class, 'taggable');
    }

	public function reactions(){
    	return $this->morphToMany(Reaction::class, 'reactable');
    }    
}
