<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\DefaultContent;
use App\Models\QuotationDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\InvoiceDetail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $invoice = Invoice::find(6);
        // dd($invoice->NetAmount);
        
         try{
            if ($request->ajax()) {
                //we have two seprate invoice section and this logc fit to distrbute invoice only
                $data = Invoice::whereNotNull('reference_quotation_id')->get();
    
                return Datatables::of($data)
                    ->addIndexColumn()
                    // Status toggle column
                    ->addColumn('party_name', function($row){
                        return $row->party ? $row->party->PartyName : 'N/A';
                    })
                    ->addColumn('date', function($row){
                        return $row->formatted_date;
                    })
                    ->addColumn('due_date', function($row){
                        return $row->formatted_due_date;
                    })
                    ->addColumn('reference_quotation_no', function($row){
                        return $row->referenceQuotationNo->InvoiceNo ?? '';
                    })
                   

                    ->addColumn('action', function ($row) {
                        $csrf = csrf_field();
                        $method = method_field('DELETE');

                        $btn = '
                            <div class="d-flex align-items-center col-actions">
                                <div class="dropdown">
                                    <a class="action-set show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="' . route('invoice.show', $row->InvoiceMasterID) . '" class="dropdown-item">
                                                <i class="bx bx-show font-size-16 text-primary me-1"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="' . route('invoice.edit', $row->InvoiceMasterID) . '" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-primary me-1"></i> Edit
                                            </a>
                                        </li>
                                      
                                        <li>
                                            <form action="' . route('invoice.destroy', $row->InvoiceMasterID) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this work order?\');">
                                                ' . $csrf . $method . '
                                                <button type="submit" class="dropdown-item text-danger" >
                                                    <i class="bx bx-trash font-size-16 text-danger me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>';

                        return $btn;
                    })

                    
                    ->rawColumns(['action']) // Mark these columns as raw HTML
                    ->make(true);
            }
    
            return view('invoices.index');

        }catch (\Exception $e){

            // Log the exception and return a friendly message instead of dumping

            return back()->with('flash-danger', 'Something went wrong while loading invoices.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('invoices.create',[
            'parties' => DB::table('party')->get(),
            'items' => DB::table('item')->get(),
            'serviceTypes' => ServiceType::all(),
            'units' => DB::table('unit')->get(),
            'invoice' => new Invoice,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {   
       
       
        DB::beginTransaction();
        
        try{
            
            $data = $request->validated();

            

            $invoice = Invoice::updateOrCreate(
                [
                    'InvoiceMasterID' => $data['InvoiceMasterID']
                ],
                [
                    'PartyID' => $data['PartyID'],
                    'Date' => $data['Date'],
                    'DueDate' => $data['DueDate'],
                    'TenderNo' => $data['TenderNo'],
                    'ReferenceNo' => $data['ReferenceNo'],
                    'ProjectName' => $data['ProjectName'],
                    'ProjectEngg' => $data['ProjectEngg'],
                    'Attension' => $data['Attension'],
                    'Subject' => $data['Subject'],
                    'Location' => $data['Location'],
                    'SCARef' => $data['SCARef'],
                    'TotalInvoiceAmount'    => $data['TotalInvoiceAmount'],
                    'PrevInvExclRet'        => $data['PrevInvExclRet'],
                    'RetentionMonthYear'    => $data['RetentionMonthYear'],
                    'RetentionAmount'       => $data['RetentionAmount'],
                    'SubTotal'              => $data['SubTotal'],
                    'CurrentRetention'      => $data['CurrentRetention'],
                    'NetInvoiceAmount'      => $data['NetInvoiceAmount'],
                    'SubtotalVat'           => $data['SubtotalVat'],
                    'CurrentRetentionVat'   => $data['CurrentRetentionVat'],
                    'NetInvoiceAmountVat'   => $data['NetInvoiceAmountVat'],
                    'NetAmount'             => $data['NetAmount'],

                    'TaxType' => 'TaxExclusive',
                    'SubTotal'=>  $data['NetInvoiceAmount'],
                    'Total' => $data['NetInvoiceAmount'],
                    'TaxPer' => 5,
                    'Tax' => $data['NetInvoiceAmountVat'],
                    'GrandTotal' => $data['NetAmount'],
                    ]
                );
                
            if(!empty($data['InvoiceMasterID'])){
                $this->deleteInvoiceDetails($invoice);
                $this->deleteJournalEntries($invoice);
            }
                

            $this->createInvoiceDetails($invoice, $data);
            $this->createJournalEntries($invoice);

            

            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Record added successfully.',
            ],200);



        }catch(\Exception $e){


            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],422);

        }
    }

    public function deleteInvoiceDetails($invoice)
    {
        if($invoice){
            $invoice->details()->delete();            
        }

    }
    public function deleteJournalEntries($invoice)
    {
        if($invoice){
            DB::table('journal')->where('InvoiceMasterID', $invoice->InvoiceMasterID)->delete();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('details');

        $detailsGroupedByServiceType = $invoice->details->groupBy('service_type_id');

        $amountInWords = Invoice::convertAmountToWords($invoice->NetAmount);


       
        $pdf = PDF::loadView('invoices.show',[
            'invoice' => $invoice,
            'detailsGroupedByServiceType' => $detailsGroupedByServiceType,
            'company' => DB::table('company')->first(),
            'amountInWords' => $amountInWords,
        ]);

        return $pdf->stream($invoice->ReferenceNo.'.pdf');

        // return view('invoices.show',[
        //     'invoice' => $invoice,
        //     'detailsGroupedByServiceType' => $detailsGroupedByServiceType,
        //     'company' => DB::table('company')->first(),
        // ]);
    }

    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $invoice->load('details'); // eager load 'details' on the existing model

        return view('invoices.create',[
            'parties' => DB::table('party')->get(),
            'items' => DB::table('item')->get(),
            'units' => DB::table('unit')->get(),
            'serviceTypes' => ServiceType::all(),
            'invoice' => $invoice,
        ]);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $linkedQuotationID = $invoice->reference_quotation_id;
        $linkedQuotation = Quotation::find($linkedQuotationID);

        
        if($linkedQuotation)
        {
            $linkedQuotation->update([
                'Status' => 'pending'
            ]);
        }
        $this->deleteJournalEntries($invoice);
        $this->deleteInvoiceDetails($invoice);
        $invoice->delete();
        
       return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully.');
    }


    protected function createInvoiceDetails(Invoice $invoice,array $data)
    {
        foreach($data['ItemID'] as $index => $itemID)
        {
            InvoiceDetail::create([
                'InvoiceMasterID' => $invoice->InvoiceMasterID,
                'InvoiceNo' => $invoice->InvoiceNo,
                'Date' => $invoice->Date,
                'ItemID' => $itemID,
                'service_type_id' => $data['service_type_id'][$index],
                'Description' => $data['Description'][$index],
                'UnitName' => $data['UnitName'][$index],
                'Previous' => $data['Previous'][$index],
                'Current' => $data['Current'][$index],
                'Cumulative' => $data['Cumulative'][$index],
                'Rate' => $data['Rate'][$index],
                'Total' => $data['Total'][$index],
            ]);

        }
    }

    protected function createJournalEntries(Invoice $invoice)
    {

        $data = [
            'VHNO' => $invoice->InvoiceNo,
            'JournalType' => 'JV',
            'PartyID' => $invoice->PartyID,
            'InvoiceMasterID' => $invoice->InvoiceMasterID,
            'Date' => $invoice->Date,
            'Narration' => 'Invoice #' . $invoice->InvoiceNo,
        ];

        $ar_debit = array_merge($data, [
            'ChartOfAccountID' => '110400',  // A/R
            'Dr' => $invoice->NetAmount,
        ]);
        DB::table('journal')->insert($ar_debit);

        $vat_output_cr = array_merge($data, [
            'ChartOfAccountID' => '210300',  // VAT  Output
            'Cr' => $invoice->NetInvoiceAmountVat,
        ]);
        DB::table('journal')->insert($vat_output_cr);
        



        $sales_credit = array_merge($data, [
            'ChartOfAccountID' => '410100',  // Sales Revenue
            'Cr' => $invoice->NetInvoiceAmount,
        ]);
        DB::table('journal')->insert($sales_credit);

       


        

       
    }

}

