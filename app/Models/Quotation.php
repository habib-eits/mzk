<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public $primaryKey = "InvoiceMasterID";
    protected $table = "invoice_master";

    public $timestamps  = false;

    protected $fillable = [
        'PartyID',
        'Date',
        'DueDate',
        'TenderNo',
        'ReferenceNo',
        'ProjectName',
        'Attension',
        'Subject',
        'scope_of_work',
        'terms_and_conditions',
    ];


    public function party()
    {
        return $this->belongsTo(Party::class, 'PartyID');
    }


    public function details()
    {
        return $this->hasMany(QuotationDetail::class, 'InvoiceMasterID');
    }

    protected  function formattedDate(): Attribute
    {
        return Attribute::make(
            get: fn () => date('d-m-Y', strtotime($this->Date))
        );     
    }
    protected  function formattedDueDate(): Attribute
    {
        return Attribute::make(
            get: fn () => date('d-m-Y', strtotime($this->DueDate))
        );     
    }
}
