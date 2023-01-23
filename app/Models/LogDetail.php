<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogDetail extends Model
{
    use HasFactory;
    protected $fillable = [
       'data','causer','activity', 'created_at','updated_at'
    ];
}
