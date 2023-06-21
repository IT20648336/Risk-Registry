<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Login_Registry extends Model
{
    use HasFactory;
    protected $table = "User_Login_Registry";
    public $timestamps = false;
}
