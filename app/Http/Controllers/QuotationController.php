<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\DefaultContent;
use App\Models\QuotationDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Http\Requests\StoreQuotationDetailRequest;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
         try{
            if ($request->ajax()) {
                $data = Quotation::all();
    
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
                                            <a href="' . route('quotation.show', $row->InvoiceMasterID) . '" class="dropdown-item">
                                                <i class="bx bx-show font-size-16 text-primary me-1"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="' . route('quotation.edit', $row->InvoiceMasterID) . '" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-primary me-1"></i> Edit
                                            </a>
                                        </li>
                                      
                                        <li>
                                            <form action="' . route('quotation.destroy', $row->InvoiceMasterID) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this work order?\');">
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
    
            return view('quotations.index');

        }catch (\Exception $e){

            // Log the exception and return a friendly message instead of dumping

            return back()->with('flash-danger', 'Something went wrong while loading quotations.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('quotations.create',[
            'parties' => DB::table('party')->get(),
            'items' => DB::table('item')->get(),
            'units' => DB::table('unit')->get(),
            'quotation' => new Quotation,
            'defaultScopeOfWork' => DefaultContent::getContent('quotation','scope_of_work'),
            'defaultTermsAndConditions' => DefaultContent::getContent('quotation','terms_and_conditions'),
            'scopeOfWork' => DefaultContent::getContent('quotation','scope_of_work'),// setting for create
            'termsAndConditions' => DefaultContent::getContent('quotation','terms_and_conditions'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotationRequest $request)
    {   
       
        DB::beginTransaction();
        
        try{
            
            $data = $request->validated();
            
            $quotation = Quotation::updateOrCreate(
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
                    'Attension' => $data['Attension'],
                    'Subject' => $data['Subject'],
                    'scope_of_work' => $data['scope_of_work'],
                    'terms_and_conditions' => $data['terms_and_conditions'],
                    ]
                );
                
            if(!empty($data['InvoiceMasterID'])){
                $this->deleteQuotationDetails($quotation);
            }
                

            $this->createQuotationDetails($quotation, $data);

            

            
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

    public function deleteQuotationDetails($quotation)
    {
        if($quotation){
            $quotation->details()->delete();            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        $quotation->load('details');

        $groupedDetails = $quotation->details->groupBy('ItemID');

        return view('quotations.show',[
            'quotation' => $quotation,
            'groupedDetails' => $groupedDetails,
            'company' => DB::table('company')->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $quotation->load('details'); // eager load 'details' on the existing model

        return view('quotations.create',[
            'parties' => DB::table('party')->get(),
            'items' => DB::table('item')->get(),
            'units' => DB::table('unit')->get(),
            'quotation' => $quotation,
            'defaultScopeOfWork' => DefaultContent::getContent('quotation','scope_of_work'),
            'defaultTermsAndConditions' => DefaultContent::getContent('quotation','terms_and_conditions'),
            'scopeOfWork' => $quotation->scope_of_work,
            'termsAndConditions' => $quotation->terms_and_conditions,
        ]);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        
       return redirect()->route('quotation.index')->with('success', 'Work Order deleted successfully.');
    }


    protected function createQuotationDetails(Quotation $quotation,array $data)
    {
        foreach($data['ItemID'] as $index => $itemID)
        {
            QuotationDetail::create([
                'InvoiceMasterID' => $quotation->InvoiceMasterID,
                'Date' => $quotation->Date,
                'ItemID' => $itemID,
                'Description' => $data['Description'][$index],
                'UnitName' => $data['UnitName'][$index],
                'Rate' => $data['Rate'][$index],
            ]);

        }
    }
}
