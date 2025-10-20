<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'date',
        'party_id',
        'scope_of_work',
        'terms_and_conditions',
        'location',
        'TRN',
    ];


    protected function formattedDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date ? date('d-m-Y', strtotime($this->date)) : null,
        );
    }
    

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id','PartyID');
    }

}
