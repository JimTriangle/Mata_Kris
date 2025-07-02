<?php

namespace App\Models;
// ...
class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'legende'];
}
