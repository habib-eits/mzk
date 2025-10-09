<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceMaster extends Model
{
    use HasFactory;

    protected $table = 'attendance_master';
    protected $primaryKey = 'AttendanceMasterID';
    
    protected $fillable = [
      'UserID',
      'JobID',
      'Date',
         
      ];
    
    public $timestamps = false;
     
    public function user()
      {
        return $this->belongsTo('App\Models\User', 'UserID');
      }
      
      public function job()
      {
        return $this->belongsTo('App\Models\Job', 'JobID');
      }
}
