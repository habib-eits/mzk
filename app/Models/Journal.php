<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journal';
    protected $primaryKey = 'JournalID';
    
    protected $fillable = [
      'VHNO',
      'JournalType',
      'ChartOfAccountID',
      'JobID',
      'PartyID',
      'SupplierID',
      'EmployeeID',
      'VoucherMasterID',
      'Narration',
      'Date',
      'Dr',
      'Cr',
      'Trace',
         
      ];
    
    public $timestamps = false;
     
    public function employee()
      {
        return $this->belongsTo('App\Models\Employee', 'EmployeeID');
      }
}
