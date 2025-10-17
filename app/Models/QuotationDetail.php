<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'service_type_id',
        'Description',
        'UnitName',
        'Rate',
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
