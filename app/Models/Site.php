<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'site';
    
    
    protected $fillable = [
      'name',
      'PartyID',
      'Description',
      'StartDate',
      'StartDate',
      'BranchID',
         
      ];
    
    public $timestamps = false;
     
    public function party()
      {
        return $this->belongsTo('App\Models\Party', 'PartyID');
      }

}
