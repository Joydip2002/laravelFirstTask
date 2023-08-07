<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabulardata extends Model
{
    use HasFactory;
   protected $table = 'tabulardata';
   protected $primaryKey = 'id';
   protected $fillable = ['name', 'email', 'mobile', 'address', 'created_at','updated_at'];
}
