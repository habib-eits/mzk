<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';
    protected $primaryKey = 'PartyID';
    
    protected $fillable = [
      'PartyName',
      'Phone',
         
      ];
    
    public $timestamps = false;
     
    public function party()
      {
        return $this->belongsTo('App\Models\Party', 'PartyID');
      }
}
