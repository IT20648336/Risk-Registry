<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_Template extends Model
{
    use HasFactory;
    protected $table = "Mail_Templates";
    public $timestamps = false;
}