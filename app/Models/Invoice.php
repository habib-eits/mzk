<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
        'Location',
        'SCARef',
        'scope_of_work',
        'terms_and_conditions',
        'reference_quotation_id',
        'is_locked',

        'TotalInvoiceAmount',
        'PrevInvExclRet',
        'RetentionMonthYear',
        'RetentionAmount',
        'SubTotal',
        'CurrentRetention',
        'NetInvoiceAmount',
        'SubtotalVat',
        'CurrentRetentionVat',
        'NetInvoiceAmountVat',
        'NetAmount',
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
    // Payment terms (difference in days)
    protected function paymentTerms(): Attribute
    {
        return Attribute::make(
            get: function () {
                $date = Carbon::parse($this->Date);
                $dueDate = Carbon::parse($this->DueDate);
                return $date->diffInDays($dueDate);
            }
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

    public static function convertAmountToWords($amount)
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

        // Ensure two decimal places and split into Dirham / Fils parts
        $amountParts = explode('.', number_format($amount, 2, '.', ''));

        $dirhams = (int)$amountParts[0];
        $fils = (int)$amountParts[1];

        $dirhamsInWords = $formatter->format($dirhams);
        $filsInWords = $formatter->format($fils);

        // Handle singular/plural properly
        $dirhamWord = $dirhams == 1 ? 'dirham' : 'dirhams';
        $filsWord = $fils == 1 ? 'fil' : 'fils';

        // Build final string
        $amountInWords = ucfirst("{$dirhamsInWords} {$dirhamWord}");
        if ($fils > 0) {
            $amountInWords .= " and {$filsWord} {$filsInWords}";
        }
        $amountInWords .= " only";

        return $amountInWords;
    }
}
