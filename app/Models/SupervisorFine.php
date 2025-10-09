<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorFine extends Model
{
    use HasFactory;

     protected $table = 'supervisor_fines';
    
    
    protected $fillable = [
      'JobID',
      'PartyID',
       'EmployeeID',
      'MonthName',
      'Date',
      'Amount',
      'Reason',
      'SupervisorEmployeeID',
      'Percentage',
      'ComissionAmount',
         
      ];
    
    public $timestamps = false;
     
    // public function branch()
    //   {
    //     return $this->belongsTo('App\Models\Branch', 'BranchID');
    //   }
      
      
      public function party()
      {
        return $this->belongsTo('App\Models\Party', 'PartyID');
      }
      
      public function supervisor()
      {
        return $this->belongsTo('App\Models\Employee', 'SupervisorEmployeeID','EmployeeID');
      }
      
      
      public function job()
      {
        return $this->belongsTo('App\Models\Job', 'JobID');
      }

      public function employee()
      {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
      }

      
}
