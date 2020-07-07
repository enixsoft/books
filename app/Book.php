<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'isbn', 'genre', 'abstract', 'publicationdate', 'email', 'length',
    ];    

    protected $dates = ['publicationdate'];
}
