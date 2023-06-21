<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Risks extends Model
{
    use HasFactory;
    protected $table = "Risks";
    public $timestamps = false;
    
}
