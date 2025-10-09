<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $primaryKey = 'EmployeeID';
    
    protected $fillable = [
      
      'BranchID',
      'Title',
      'IsSupervisor',
      'FirstName',
      'Middle',
      'LastName',
      'JobTitleID',
         
      ];
    
    public $timestamps = false;
     
    
    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('StaffType', '<>', 'Inactive');
        });
    }


    // public function party()
    //   {
    //     return $this->belongsTo('App\Models\Party', 'PartyID');
    //   }

    public function getFullNameAttribute()
    {
        return trim("{$this->FirstName} {$this->Middle} {$this->LastName}");
    }

    // Local scope for active staff
    public function scopeActive($query)
    {
        return $query->where('StaffType', '<>', 'Inactive');
    }

    public function jobtitle()
      {
        return $this->belongsTo('App\Models\JobTitle', 'JobTitleID');
      }
    



}
