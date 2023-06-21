<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Users extends Model
{
    use HasFactory;
    protected $table = "Users";
    public $timestamps = false;
}
