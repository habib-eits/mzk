<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public $primaryKey = "UnitID";
    public $timestamps = false;
    
    protected $table = "unit";
    protected $fillable = [
        'UnitName'
    ];
}
