<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "InvoiceDetailID";
    protected $table = "invoice_detail";

    public $timestamps = false;

    protected $fillable = [
        'InvoiceMasterID',
        'Date',
        'ItemID',
        'Description',
        'UnitName',
        'Rate',
    ];
}
