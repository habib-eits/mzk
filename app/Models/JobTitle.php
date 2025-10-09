<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'jobtitle';
    protected $primaryKey = 'JobTitleID';
    
    protected $fillable = [
      'JobTitleName',
      
         
      ];
    
    public $timestamps = false;
     
    
}
