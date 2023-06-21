<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error_Logs extends Model
{
    use HasFactory;
    protected $table = "Error_Logs";
    public $timestamps = false;
}
