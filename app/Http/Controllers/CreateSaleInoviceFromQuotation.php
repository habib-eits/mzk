<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Quotation;
use Illuminate\Http\Request;

class CreateSaleInoviceFromQuotation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($quotation_id)
    {
        $quotation = Quotation::with('details')->find($quotation_id);

        if(!$quotation){
            return response()->json([
                'success' => false,
                'message' => 'Quotation Not Found',
            ],422);
        }

        if($quotation->Status !== 'approved')
        {
            return response()->json([
                'success' => false,
                'message' => 'Quotation Status is Not Approved',
            ],422);
        }

        // Use replicate() to copy attributes 


        $invoiceData = [

            'PartyID' => $quotation->PartyID,
            'Date' => $quotation->Date,
            'DueDate' => $quotation->DueDate,
            'Status' => null,
            'TenderNo' => $quotation->TenderNo,
            'ReferenceNo' => $quotation->ReferenceNo,
            'ProjectName' => $quotation->ProjectName,
            'ProjectEngg' => $quotation->ProjectEngg,
            'Attension' => $quotation->Attension,
            'Subject' => $quotation->Subject,
            'scope_of_work' => null,
            'terms_and_conditions' => null,
            'reference_quotation_id' => $quotation->InvoiceMasterID,
        ];

        $invoice = Invoice::create($invoiceData);

        $invoiceDetailData = [];

        foreach($quotation->details as $row)
        {
            $invoiceDetailData[] = [
                'InvoiceMasterID' => $invoice->InvoiceMasterID,
                'InvoiceNo' => $invoice->InvoiceNo,
                'Date' => $invoice->Date,
                'ItemID' => $row->ItemID,
                'service_type_id' => $row->service_type_id,
                'Description' => $row->Description,
                'UnitName' => $row->UnitName,
                'Rate' => $row->Rate,
            ];
        }

        InvoiceDetail::insert($invoiceDetailData);



        $this->updateQuotationStatus($quotation);


    }


    public function updateQuotationStatus(Quotation $quotation)
    {
        $quotation->update([
            'Status' => 'invoice-created',
            'is_locked' => 1,
        ]);    
    }

    public function createInvoice(Quotation $quotation)
    {
        $invoice = $quotation->replicate();
        $invoice['InvoiceType'] = 'invoice';
        $invoice['Status'] = '';
        $invoice['reference_quotation_id'] = $quotation->InvoiceMasterID;

        $invoice->save();

        return $invoice;
    }



    
}
