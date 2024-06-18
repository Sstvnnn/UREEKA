<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $primaryKey = 'id';
    protected $table = 'book_list';
    protected $fillable = ['id', 'title', 'isbn', 'author', 'publication_year'];
}
