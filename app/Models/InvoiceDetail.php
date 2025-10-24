<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "InvoiceDetailID";
    protected $table = "invoice_detail";

    public $timestamps = false;

    protected $fillable = [
        'InvoiceMasterID',
        'InvoiceNo',
        'Date',
        'ItemID',
        'service_type_id',
        'Description',
        'UnitName',
        'Previous',
        'Current',
        'Cumulative',
        'Rate',
        'Total',
    ];


    public function item()
    {
        return $this->belongsTo(Item::class,'ItemID');
    }
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class,'service_type_id');
    }
}
