<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';
    protected $primaryKey = 'JobID';
    
    protected $fillable = [

      'BranchID',
      'JobNo',
      'ShiftType',
      'JobLocation',
      'JobDetail',
      'JobDate',
      'JobDueDate',
      'PartyID',
      'UserID',
      'Status',
         
      ];
    
    public $timestamps = false;
     
    public function party()
      {
        return $this->belongsTo('App\Models\Party', 'PartyID');
      }

         // Accessor: Display Yes or No instead of 1/0
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }

    // Mutator: Save as 1 or 0 when inserting/updating
    public function setStatusAttribute($value)
    {
        $this->attributes['Status'] = strtolower($value) === 'yes' || $value == 1 ? 1 : 0;
    }

    
}
