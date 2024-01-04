<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'status', 'author', 'library_id'];

    public function library() {
        return $this->belongsTo(Library::class);
    }

}
