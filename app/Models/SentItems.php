<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentItems extends Model
{
   use HasFactory;
    protected $table = "SentItems";
    public $timestamps = false;
}
