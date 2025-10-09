<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $primaryKey = 'AttendanceID';
    
    protected $fillable = [
            'EmployeeID',
            'MonthName',
            'Date',
            'JobID',
            'Day1',
            'Day2',
            'Day3',
            'Day4',
            'Day5',
            'Day6',
            'Day7',
            'Day8',
            'Day9',
            'Day10',
            'Day11',
            'Day12',
            'Day13',
            'Day14',
            'Day15',
            'Day16',
            'Day17',
            'Day18',
            'Day19',
            'Day20',
            'Day21',
            'Day22',
            'Day23',
            'Day24',
            'Day25',
            'Day26',
            'Day27',
            'Day28',
            'Day29',
            'Day30',
            'Day31'
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
