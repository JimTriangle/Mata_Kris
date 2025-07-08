<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ...
class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'legende'];

    /**
     * Provide backwards compatibility for the deprecated image_data_base64
     * attribute used in some views.
     */
    public function getImageDataBase64Attribute(): string
    {
        return $this->image;
    }
}
