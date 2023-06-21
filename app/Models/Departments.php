<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Departments extends Model
{
    use HasFactory;
    protected $table = "Departments";
    public $timestamps = false;
}
