<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;

    protected $table = 'over_time';
    
    
    protected $fillable = [
      'JobID',
      'EmployeeID',
      'MonthName',
      'Date',
      'extra_hours',
      'FixRate',
      'Total',
         
      ];
    
    public $timestamps = false;
     
 
      
      
      
      public function job()
      {
        return $this->belongsTo('App\Models\Job', 'JobID');
      }

      public function employee()
      {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
      }

}
