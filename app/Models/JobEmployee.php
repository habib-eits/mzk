<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobEmployee extends Model
{
    use HasFactory;

    protected $table = 'job_employee';
    protected $primaryKey = 'JobDetailID';
    
    protected $fillable = [
      'JobID',
      'EmployeeID',
      'IsActive',
         
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


    public function scopeActive($query)
    {
        return $query->where('IsActive', 'Yes');
    }


}
