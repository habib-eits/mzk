<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Job;
use App\Models\Party;
use App\Models\Journal;
use App\Models\Employee;
use App\Models\OverTime;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class OverTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $title = 'Over Time';
          
         try{
            if ($request->ajax()) {
                $data = OverTime::with(['job','employee'])->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    // Status toggle column
                   
                    ->addColumn('employee_full_name', function ($row) {
                        if ($row->employee) {
                            return trim("{$row->employee->FirstName} {$row->employee->Middle} {$row->employee->LastName}");
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
                $data = OverTime::with(['job','employee'])->get();

                $party = Party::all();
                $job = Job::all();
                $employee = Employee::all();
     
             return view('over_time.index',compact('title','data','party','job','employee'));
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
             'EmployeeID'           => 'required|integer',
            'MonthName'            => 'required|string|max:20',
            'Date'                 => 'required|date',
            'extra_hours'               => 'required|numeric|min:0',
            'FixRate'           => 'required|numeric|min:0|min:0',
            'Total'      => 'required|numeric|min:0', // ✅ fixed "requireds" to "required"
            
        ];


        $validated = $request->validate($rules);

       try {
        
        $data = $request->only([
    'JobID',
    
      'EmployeeID',
    'MonthName',
    'Date',
    'extra_hours',
    'FixRate',
    'Total',
    
    ]);


    //    $data['BranchID'] = Session::get('BranchID'); 
    //    $data['UserID'] = Session::get('UserID'); 

 
        $news = OverTime::updateOrCreate(
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


public function edit(string $id)
{
    try {
    $data = OverTime::findOrFail($id);
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
        $faculty = OverTime::find($id);

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

/*
public function habib()
{
    
     $chartofaccounte = DB::table('chartofaccount')->where('CODE','A')->where('Level',3)->get();

     $data = [];

    foreach($chartofaccounte as $account)
    {

        $journal = Journal::where('ChartOfAccountID', $account->ChartOfAccountID)
                    ->selectRaw('COALESCE(SUM(Dr), 0) as total_debit, COALESCE(SUM(Cr), 0) as total_credit')
                    ->first();
        $balance = $journal->total_debit - $journal->total_credit;

        if($balance != 0)
        {
            $data[] = [
                'ChartOfAccountID' => $account->ChartOfAccountID,
                'AccountName' => $account->ChartOfAccountName,
                'Dr' => $journal->total_debit,
                'Cr' => $journal->total_credit,
            ];
        }
       
    }

    return response()->json($data);
}
*/

public function habib()
{

//--------------------Revenue----------------------------------------------------------------

    // chart of accounts asset level 2
    $chartofaccountsA2 = DB::table('chartofaccount')
        ->where('CODE', 'R')
        ->where('Level', 2)
        ->get();
//  dd($chartofaccountsA2) ;   

    //loop through each leavel 2 child
    foreach($chartofaccountsA2 as $accountL2)
    {
        $chartofaccounts = DB::table('chartofaccount')
        ->where('L2', $accountL2->ChartOfAccountID)
        ->where('CODE', 'R')
        ->where('Level', 3)
        
        ->get();



        $children = [];

        foreach ($chartofaccounts as $account) {
            $journal = Journal::where('ChartOfAccountID', $account->ChartOfAccountID)
                ->selectRaw('COALESCE(SUM(Dr), 0) as total_debit, COALESCE(SUM(Cr), 0) as total_credit')
                ->first();

            $balance = $journal->total_debit - $journal->total_credit;

            // if ($balance != 0) {
                $children[] = [
                    'ChartOfAccountID' => $account->ChartOfAccountID,
                    'AccountName' => $account->ChartOfAccountName,
                    'Dr' => $journal->total_debit,
                    'Cr' => $journal->total_credit,
                    'Bal' => $journal->total_credit - $journal->total_debit,
                ];
            // }
        }

        $revenue[] = [
            'parent_name' => $accountL2->ChartOfAccountName,
            'children' => $children,
        ];

    }    



//--------------------EXPENSE----------------------------------------------------------------





    // chart of accounts asset level 2
    $chartofaccountsA2 = DB::table('chartofaccount')
        ->where('CODE', 'E')
        ->where('Level', 2)
        ->get();
//  dd($chartofaccountsA2) ;   

    //loop through each leavel 2 child
    foreach($chartofaccountsA2 as $accountL2)
    {
        $chartofaccounts = DB::table('chartofaccount')
        ->where('L2', $accountL2->ChartOfAccountID)
        ->where('CODE', 'E')
        ->where('Level', 3)
        ->get();



        $children = [];
        $parentTotal = 0;

        foreach ($chartofaccounts as $account) {
            $journal = Journal::where('ChartOfAccountID', $account->ChartOfAccountID)
                ->selectRaw('COALESCE(SUM(Dr), 0) as total_debit, COALESCE(SUM(Cr), 0) as total_credit')
                ->first();

            $balance = $journal->total_debit - $journal->total_credit;
            
            $parentTotal += $balance;

            // if ($balance != 0) {
                $children[] = [
                    'ChartOfAccountID' => $account->ChartOfAccountID,
                    'AccountName' => $account->ChartOfAccountName,
                    'Dr' => $journal->total_debit,
                    'Cr' => $journal->total_credit,
                    'Bal' => $journal->total_debit - $journal->total_credit,
                ];
            // }
        }

        $expense[] = [
            'parent_name' => $accountL2->ChartOfAccountName,
            'parent_total' =>  $parentTotal,
            'children' => $children,
        ];

    }    


    // return response()->json($data);

    return view ('habib',compact('expense','revenue'));
}


}