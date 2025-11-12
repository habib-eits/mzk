@extends('template.tmp')

@section('title', $pagetitle)


@section('content')

    <style>
        div.scroll {
            height: auto;
            /*height:500px;*/
            overflow-x: scroll;
            white-space: nowrap;
        }
    </style>



    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Payroll</h4>

                            <div class="page-title-right">
                                <div class="page-title-right  ">
                                    <h5> {{ Request::get('MonthName') }}</h5>
                                    <!-- button will appear here -->
                                    <?php
                                    
                                    [$month, $year] = explode('-', Request::get('MonthName'));
                                    
                                    $nmonth = date('m', strtotime($month));
                                    
                                    $noofdays = date('t', strtotime($month));
                                    //  $noofdays =  30;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form action="{{ URL('/SaveSalary') }}" method="post">

                    <input type="text" name="MonthName" value="{{ request()->MonthName }}">

                    @csrf

                    <input type="hidden" name="BranchID" value="{{ request()->get('BranchID') }}">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body border-success border-top border-3 rounded-top">


                                    <div class="scroll">

                                        <table class="table table-bordered table-sm align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr class="bg-light ">
                                                    <th style="width: 4% !important;">S.No</th>
                                                    <th style="width: 10% !important;">Employee Name</th>
                                                    <th style="width: 10% !important;">Job Title </th>
                                                    <th style="width: 2% !important;">Month Salary</th>
                                                    <th style="width: 2% !important;">Days</th>
                                                    <th style="width: 2% !important;">Per Day</th>
                                                    <th style="width: 2% !important;">Salary</th>


                                                    <th style="width: 2% !important;">Over Time</th>
                                                    <th style="width: 2% !important;">Commission</th>

                                                    <th style="width: 2% !important; color: red;">Advance</th>
                                                    <th style="width: 2% !important; color: red;">Visa Deduction</th>
                                                    <th style="width: 2% !important; color: red;">Supervisor Fine</th>
                                                    <th style="width: 2% !important; color: red;">Salary Deduction</th>
                                                    <th style="width: 2% !important;">Secuirty Deposite</th>

                                                    <th style="width: 2% !important;">Net Salary</th>
                                                    <th style="width: 25% !important;">Notes</th>

                                                </tr>
                                            </thead>
                                            @foreach ($employee as $key => $value)
                                                @php
                                                    $no = $key + 1;

                                                    $emp_salary = DB::table('emp_salary')
                                                        // ->select(DB::raw('sum(Amount) as TotalSalary'))
                                                        ->where('EmployeeID', $value->EmployeeID)
                                                        ->where('Active', 'Yes')
                                                        ->first();

                                                    $total_present = \App\Models\Attendance::selectRaw(
                                                        'EmployeeID, MonthName, 
                    SUM(COALESCE(Day1, 0) + COALESCE(Day2, 0) + COALESCE(Day3, 0) + COALESCE(Day4, 0) + 
                        COALESCE(Day5, 0) + COALESCE(Day6, 0) + COALESCE(Day7, 0) + COALESCE(Day8, 0) + 
                        COALESCE(Day9, 0) + COALESCE(Day10, 0) + COALESCE(Day11, 0) + COALESCE(Day12, 0) + 
                        COALESCE(Day13, 0) + COALESCE(Day14, 0) + COALESCE(Day15, 0) + COALESCE(Day16, 0) + 
                        COALESCE(Day17, 0) + COALESCE(Day18, 0) + COALESCE(Day19, 0) + COALESCE(Day20, 0) + 
                        COALESCE(Day21, 0) + COALESCE(Day22, 0) + COALESCE(Day23, 0) + COALESCE(Day24, 0) + 
                        COALESCE(Day25, 0) + COALESCE(Day26, 0) + COALESCE(Day27, 0) + COALESCE(Day28, 0) + 
                        COALESCE(Day29, 0) + COALESCE(Day30, 0) + COALESCE(Day31, 0)) as TotalAttendance',
                                                    )
                                                        ->where('EmployeeID', $value->EmployeeID)
                                                        ->where('MonthName', request()->MonthName)
                                                        ->groupBy('EmployeeID', 'MonthName')
                                                        ->first();

                                                    $monthly_salary = $emp_salary->Amount ?? 0;

                                                    $perDay = $monthly_salary / $noofdays ?? 0;

                                                    $perDay = round($perDay, 2);

                                                    $daysPresent = $total_present->TotalAttendance ?? 0;

                                                    $salary = $daysPresent * $perDay;

                                                    $overtime = \App\Models\OverTime::where(
                                                        'MonthName',
                                                        request()->MonthName,
                                                    )
                                                        ->where('EmployeeID', $value->EmployeeID)
                                                        ->get();

                                                    // $advance = \App\Models\Journal::whereRaw("DATE_FORMAT(`Date`, '%b-%Y') = ?",[request()->MonthName])->where('EmployeeID',$value->EmployeeID)->where('ChartOfAccountID',112311)->sum('Dr');

                                                    $advance = \App\Models\Journal::whereRaw(
                                                        "DATE_FORMAT(`Date`, '%b-%Y') = ?",
                                                        [request()->MonthName],
                                                    )
                                                        ->where('EmployeeID', $value->EmployeeID)
                                                        ->where('ChartOfAccountID', 112311) //Advance Salary – Staff
                                                        ->selectRaw(
                                                            'COALESCE(SUM(Dr), 0) - COALESCE(SUM(Cr), 0) AS AdvanceSalary',
                                                        )
                                                        ->value('AdvanceSalary');

                                                    $sf = \App\Models\SupervisorFine::where(
                                                        'MonthName',
                                                        request()->MonthName,
                                                    )
                                                        ->where('EmployeeID', $value->EmployeeID)
                                                        ->get();

                                                    $SD = $sf->sum('Amount');

                                                    $commission = \App\Models\SupervisorFine::where(
                                                        'MonthName',
                                                        request()->MonthName,
                                                    )
                                                        ->where('SupervisorEmployeeID', $value->EmployeeID)
                                                        ->get();

                                                    $visa_deduction = \App\Models\Journal::where(
                                                        'EmployeeID',
                                                        $value->EmployeeID,
                                                    )
                                                        ->where('ChartOfAccountID', 210101) // Visa Charges Recoverable from Staff
                                                        ->selectRaw(
                                                            'COALESCE(SUM(Dr), 0) - COALESCE(SUM(Cr), 0) AS visa_deduction',
                                                        )
                                                        ->value('visa_deduction');

                                                    // ::whereRaw(
                                                    //         "DATE_FORMAT(`Date`, '%b-%Y') = ?",
                                                    //         [request()->MonthName]
                                                    //     )

                                                    $salary_deduction = \App\Models\Journal::where(
                                                        'EmployeeID',
                                                        $value->EmployeeID,
                                                    )
                                                        ->where('ChartOfAccountID', 112309) // Staff Salary Security Deposit
                                                        ->selectRaw(
                                                            'COALESCE(SUM(Cr), 0) - COALESCE(SUM(Dr), 0) AS salary_deduction',
                                                        )
                                                        ->value('salary_deduction');

                                                    $training_deduction = \App\Models\Journal::where(
                                                        'EmployeeID',
                                                        $value->EmployeeID,
                                                    )
                                                        ->where('ChartOfAccountID', 570101) // 570101 => staff training expenses
                                                        ->selectRaw(
                                                            'COALESCE(SUM(Dr), 0) - COALESCE(SUM(Cr), 0) AS salary_deduction',
                                                        )
                                                        ->value('salary_deduction');

                                                    // Base Salary = Per Day * Days Present
                                                    $salary = $daysPresent * $perDay;

                                                    // Grand Salary = Salary + Overtime + Commission
                                                    $ot_total = $overtime->sum('Amount') ?? 0; // Assuming Amount column for OT
                                                    $commission_total = $commission->sum('Amount') ?? 0;

                                                    $grandSalary = $salary + $ot_total + $commission_total;

                                                    // Total Deductions = Advance + Visa Deduction + SD + Training Deduction + Salary Deduction
                                                    $totalDeduction =
                                                        ($advance ?? 0) +
                                                        ($visa_deduction ?? 0) +
                                                        ($SD ?? 0) +
                                                        ($training_deduction ?? 0) +
                                                        ($salary_deduction ?? 0);

                                                    $salary_deduction = $monthly_salary - $salary_deduction;

                                                    // Net Salary
                                                    $netSalary = $salary_deduction;
                                                    // $netSalary = $grandSalary - $totalDeduction;

                                                    // Round to nearest whole number
                                                    $netSalary = round($netSalary);
                                                @endphp

                                                <input type="hidden" name="EmployeeID[]" value="{{ $value->EmployeeID }}">
                                                <input type="hidden" name="EmployeeName[]" value="{{ $value->FullName }}">
                                                <input type="hidden" name="JobTitleName[]"
                                                    value="{{ $value->JobTitleName }}">

                                                <input type="hidden" name="StaffType" value=" ">


                                                <tr>
                                                    <td>{{ $key + 1 }} </td>

                                                    <td>{{ $value->FullName }} ({{ $value->EmployeeID }}) </td>
                                                    <td>{{ $value->JobTitleName }}</td>
                                                    <td>{{ $monthly_salary }}</td>

                                                    <td><input type="text" size="2" name="DaysPresent[]"
                                                            id="DaysPresent_{{ $no }}"
                                                            value="{{ $total_present->TotalAttendance ?? 0 }}"
                                                            class="changesNo"></td>

                                                    <td><input type="number" step="0.01" size="2" name="PerDay[]"
                                                            id="PerDay_{{ $no }}" value="{{ $perDay }}"
                                                            class="changesNo" style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2" name="Salary[]"
                                                            id="Salary_{{ $no }}" value="{{ $salary }}"
                                                            class="changesNo" style="width: 80px;" readonly=""></td>


                                                    <td><input type="number" step="0.01" size="2" name="OT[]"
                                                            id="OT_{{ $no }}"
                                                            value="{{ $overtime->sum('Total') }}" class="changesNo"
                                                            style="width: 80px;"></td>


                                                    <td><input type="number" step="0.01" size="2"
                                                            name="Commission[]" id="Commission_{{ $no }}"
                                                            value="{{ $commission->sum('ComissionAmount') }}"
                                                            class="changesNo" style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2" name="Advance[]"
                                                            id="Advance_{{ $no }}" value="{{ $advance }}"
                                                            class="changesNo" style="width: 80px;"></td>
                                                    <td><input type="number" step="0.01" size="2"
                                                            name="Visa_deduction[]"
                                                            id="VisaDeduction_{{ $no }}"
                                                            value="{{ $visa_deduction }}" class="changesNo"
                                                            style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2"
                                                            name="SD[]" id="SD_{{ $no }}"
                                                            value="{{ $SD }}" class="changesNo"
                                                            style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2"
                                                            name="training_deduction[]"
                                                            id="trainingDeduction_{{ $no }}"
                                                            value="{{ $training_deduction }}" class="changesNo"
                                                            style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2"
                                                            name="salary_deduction[]"
                                                            id="salaryDeduction_{{ $no }}"
                                                            value="{{ $salary_deduction }}" class="changesNo"
                                                            style="width: 80px;"></td>

                                                    <td><input type="number" step="0.01" size="2"
                                                            name="NetSalary[]" id="NetSalary_{{ $no }}"
                                                            value="{{ $netSalary }}" style="width: 80px;"
                                                            readonly=""></td>

                                                    <td><input type="text" name="Notes[]"
                                                            id="Notes_{{ $no }}" style="width: 100%;"></td>

                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->


                    </div>

                    <div><button type="submit" class="btn btn-success w-md float-right">Save Salary</button>
                        <a href="{{ URL('/Salary') }}" class="btn btn-secondary w-md float-right">Cancel</a>
                    </div>

                </form>
                <!-- end row -->


                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

                <script>
                    $(document).on('keyup ', '.changesNo', function() {


                        singlerowcalculation($(this).attr('id'));

                    });



                    function singlerowcalculation(idd) {
                        let id_arr = idd.split("_");
                        let index = id_arr[1];

                        let DaysPresent = $('#DaysPresent_' + index).val() || 0;
                        let PerDay = $('#PerDay_' + index).val() || 0;
                        let Salary = $('#Salary_' + index).val() || 0;
                        let OT = $('#OT_' + index).val() || 0;
                        let Comission = $('#Commission_' + index).val() || 0;
                        let Advance = $('#Advance_' + index).val() || 0;
                        let Visa_deduction = $('#VisaDeduction_' + index).val() || 0;
                        let SD = $('#SD_' + index).val() || 0;
                        let training_ded = $('#trainingDeduction_' + index).val() || 0;
                        let salary_deduction = $('#salaryDeduction_' + index).val() || 0;

                        Salary = parseFloat(PerDay) * parseFloat(DaysPresent);
                        $('#Salary_' + index).val(Salary.toFixed(0));

                        let GrandSalary = parseFloat(Salary) + parseFloat(OT) + parseFloat(Comission);

                        let TotalDeduction =
                            parseFloat(Advance) +
                            parseFloat(Visa_deduction) +
                            parseFloat(SD) +
                            parseFloat(training_ded) +
                            parseFloat(salary_deduction);

                        $('#NetSalary_' + index).val(
                            (GrandSalary - TotalDeduction).toFixed(0)
                        );

                    }




                    function TotalCalculation() {

                        TotalAdvanceLoan = 0;
                        $('.AdvanceLoan').each(function() {
                            if ($(this).val() != '') TotalAdvanceLoan += parseFloat($(this).val());
                        });

                        $('#TotalAdvanceLoan').val(TotalAdvanceLoan);


                        TotalLeaveDeduction = 0;
                        $('.LeaveDeduction').each(function() {
                            if ($(this).val() != '') TotalLeaveDeduction += parseFloat($(this).val());
                        });

                        $('#TotalLeaveDeduction').val(TotalLeaveDeduction);


                        TotalTotalDeduction = 0;
                        $('.TotalDeduction').each(function() {
                            if ($(this).val() != '') TotalTotalDeduction += parseFloat($(this).val());
                        });

                        $('#TotalTotalDeduction').val(TotalTotalDeduction);

                        TotalGrandSalary = 0;
                        $('.GrandSalary').each(function() {
                            if ($(this).val() != '') TotalGrandSalary += parseFloat($(this).val());
                        });

                        $('#TotalGrandSalary').val(TotalGrandSalary);

                        TotalNetSalary = 0;
                        $('.NetSalary').each(function() {
                            if ($(this).val() != '') TotalNetSalary += parseFloat($(this).val());
                        });

                        $('#TotalNetSalary').val(TotalNetSalary);
                    }



                    $(document).ready(function() {
                        TotalCalculation();
                    });
                </script>



            </div> <!-- container-fluid -->
        </div>


        <script>
            $(document).ready(function() {
                $('body').addClass('sidebar-enable vertical-collpsed')
            });
        </script>

    @endsection
