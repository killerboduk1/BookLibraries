<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = ['name'];

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
