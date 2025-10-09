<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Session;
use App\Models\Job;
use App\Models\Party;
use Illuminate\Http\Request;
use App\Models\SupervisorFine;
use Yajra\DataTables\DataTables;


class SupervisorFineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

 
                
     
        $title = 'Supervisor Fine';
          
         try{
            if ($request->ajax()) {
                $data = SupervisorFine::with(['party','supervisor','job','employee'])->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    // Status toggle column
                   
                    ->addColumn('employee_full_name', function ($row) {
                        if ($row->employee) {
                            return trim("{$row->employee->FirstName} {$row->employee->Middle} {$row->employee->LastName}");
                        }
                        return '';
                        })
                        
                        
                        ->addColumn('supervisor_full_name', function ($row) {
                        if ($row->supervisor) {
                            return trim("{$row->supervisor->FirstName} {$row->supervisor->Middle} {$row->supervisor->LastName}");
                        }
                        return '';
                        })


                    ->addColumn('action', function ($row) {
                        $btn = '
                            <div class="d-flex align-items-center col-actions">
                                <div class="dropdown">
                                    <a class="action-set show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="javascript:void(0)" onclick="editRecord(' . $row->id . ')" class="dropdown-item">
                                                <i class="bx bx-pencil font-size-16 text-secondary me-1"></i> Edit
                                            </a>
                                        </li>
                                         <li>
                                            <a href="javascript:void(0)" onclick="deleteRecord(' . $row->id . ')" class="dropdown-item">
                                                <i class="bx bx-trash font-size-16 text-danger me-1"></i> Delete
                                            </a>
                                        </li>
                                       
                                       
                                    </ul>
                                </div>
                            </div>';
    
                   
                    return $btn;
                   
                    })
                    
                    
                    ->rawColumns(['action']) // Mark these columns as raw HTML
                    ->make(true);
            }
                $data = SupervisorFine::with(['party','supervisor','job','employee'])->get();

                $party = Party::all();
                $job = Job::all();
                $employee = Employee::all();
     
             return view('supervisor_fine.index',compact('title','data','party','job','employee'));
         }catch (\Exception $e){

            dd($e->getMessage());
             return back()->with('flash-danger', $e->getMessage());
        }
        
        
    }


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
 
        $rules = [
            'JobID'              => 'required|integer',
            'PartyID'              => 'required|integer',
            'EmployeeID'           => 'required|integer',
            'MonthName'            => 'required|string|max:20',
            'Date'                 => 'required|date',
            'Amount'               => 'required|numeric|min:0',
            'Reason'               => 'nullable|string|max:1000',
            'SupervisorEmployeeID' => 'required|integer',
            'Percentage'           => 'required|numeric|min:0|max:100',
            'ComissionAmount'      => 'required|numeric|min:0', // ✅ fixed "requireds" to "required"
            'Reason'              => 'required|string|max:255', // ✅ fixed "requireds" to "required"
        ];



 

        

        $validated = $request->validate($rules);

       try {
        
        $data = $request->only([
    'JobID',
    
    'PartyID',
     'EmployeeID',
    'MonthName',
    'Date',
    'Amount',
    'Reason',
    'SupervisorEmployeeID',
    'Percentage',
    'ComissionAmount',
    ]);


    //    $data['BranchID'] = Session::get('BranchID'); 
    //    $data['UserID'] = Session::get('UserID'); 

 
        $news = SupervisorFine::updateOrCreate(
            ['ID' => $request->id],
            $data
        );

        

 
        return response()->json([
            'success' => true,
            'message' => 'Record added successfully.',
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'error'   => $e->getMessage(),
        ], 500);
    }
}






  
    /**
     * Show the form for editing the specified resource.
     */
 


public function edit(string $id)
{
    try {
    $data = SupervisorFine::findOrFail($id);
    return response()->json([
        'success' => true,
        'data'    => $data
    ], 200);

} catch (\Exception $e) {
    return response()->json([
        'success' => false,
        'message' => 'An error occurred.',
        'error'   => $e->getMessage(),
    ], 500);
}

}    

   
public function destroy(string $id)
{
    try {
        $faculty = SupervisorFine::find($id);

        if (!$faculty) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found.',
            ], 404);
        }

        $faculty->delete();

        return response()->json([
            'success' => true,
            'message' => 'Record deleted successfully.',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while deleting the record.',
            'error'   => $e->getMessage(),
        ], 500);
    }
}

}