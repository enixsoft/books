<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'api_id',
        'title', 
        'isbn', 
        'genre', 
        'author_name',
        'abstract',
        'length',
        'published_at'
    ];    
    
    protected $dates = ['published_at'];
}
