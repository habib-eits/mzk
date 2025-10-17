<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use App\Models\DefaultContent;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;


class WorkOrderController extends Controller
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
                $data = WorkOrder::all();
    
                return Datatables::of($data)
                    ->addIndexColumn()
                    // Status toggle column
                    ->addColumn('party_name', function($row){
                        return $row->party ? $row->party->PartyName : 'N/A';
                    })
                    ->addColumn('date', function($row){
                        return $row->formatted_date;
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
                                            <a href="' . route('work-order.show', $row->id) . '" class="dropdown-item">
                                                <i class="bx bx-show font-size-16 text-primary me-1"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a href="' . route('work-order.edit', $row->id) . '" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-primary me-1"></i> Edit
                                            </a>
                                        </li>
                                      
                                        <li>
                                            <form action="' . route('work-order.destroy', $row->id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this work order?\');">
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
    
            return view('work_orders.index');

        }catch (\Exception $e){

            return back()->with('flash-danger', $e->getMessage());
        }
        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('work_orders.create', [

            'defaultScopeOfWork' => DefaultContent::getContent('work_order','scope_of_work'),
            'defaultTermsAndConditions' => DefaultContent::getContent('work_order', 'terms_and_conditions'),
            'scopeOfWork' => DefaultContent::getContent('work_order','scope_of_work'),// setting for create
            'termsAndConditions' => DefaultContent::getContent('work_order','terms_and_conditions'),
            'parties' => DB::table('party')->get(),
            'workOrder' => new WorkOrder(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkOrderRequest $request)
    {
        
        $data = $request->validated();

        DB::beginTransaction();

        try{
            WorkOrder::updateOrCreate([
            'id' => $request->id
        ],
        [
            'date' => $data['date'],
            'party_id' => $data['party_id'],
            'project_name' => $data['project_name'],
            'scope_of_work' => $data['scope_of_work'],
            'terms_and_conditions' => $data['terms_and_conditions'],
            'location' => $data['location'],
        ]);


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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        $company = DB::table('company')->first();

        $pdf = Pdf::loadView('work_orders.show', compact('workOrder', 'company'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
        // return view('work_orders.show', compact('workOrder', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        return view('work_orders.create', [

            'defaultScopeOfWork' => DefaultContent::getContent('work_order','scope_of_work'),
            'defaultTermsAndConditions' => DefaultContent::getContent('work_order', 'terms_and_conditions'),
            'scopeOfWork' => $workOrder->scope_of_work,
            'termsAndConditions' => $workOrder->terms_and_conditions,
            'parties' => DB::table('party')->get(),
            'workOrder' => $workOrder,

        ]);    
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
       return redirect()->route('work-order.index')->with('success', 'Work Order deleted successfully.');
    }
}
