<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Invoice extends Model
{
    use HasFactory;

    
    /*
    |--------------------------------------------------------------------------
    | Basic Model Configuration
    |--------------------------------------------------------------------------
    */

    public $primaryKey = "InvoiceMasterID";
    protected $table = "invoice_master";
    public $timestamps  = false;

    protected $fillable = [
        'InvoiceNo',
        'PartyID',
        'Date',
        'DueDate',
        'TenderNo',
        'ReferenceNo',
        'ProjectName',
        'ProjectEngg',
        'Attension',
        'Subject',
        'scope_of_work',
        'terms_and_conditions',
        'reference_quotation_id',
        'is_locked',
    ];

    // default value automatically applied
    protected $attributes = [
        'InvoiceType' => 'invoice'
    ];

    /*
    |--------------------------------------------------------------------------
    | Booted / Global Scopes
    |--------------------------------------------------------------------------
    */

     /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('type-inovice', function (Builder $builder) {
            $builder->where('InvoiceType', 'invoice');
        });
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->InvoiceNo)) {
                $invoice->InvoiceNo = self::generateInvoiceNumber();
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function party()
    {
        return $this->belongsTo(Party::class, 'PartyID');
    }


    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'InvoiceMasterID');
    }

    public function referenceQuotationNo()
    {
        return $this->belongsTo(Quotation::class, 'reference_quotation_id','InvoiceMasterID')->where('InvoiceType', 'quotation');
    }


    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */

    protected static function generateInvoiceNumber(): string
    {
        do {
            // Get the current max number
            $max = self::selectRaw("MAX(CAST(SUBSTRING_INDEX(InvoiceNo, '-', -1) AS UNSIGNED)) as max_number")
                        ->value('max_number');

            $next = $max ? $max + 1 : 1;

            $invoiceNo = "INV-{$next}";

        } while (self::where('InvoiceNo', $invoiceNo)->exists());

        return $invoiceNo;
    }
}
