<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MulImageUpload extends Model
{
    use HasFactory;
    protected $table = 'mulitimageupload';

    protected $fillable =[
        'image'
    ];
}
