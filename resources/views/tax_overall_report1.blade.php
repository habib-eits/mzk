@extends('template.tmp')

@section('title', $pagetitle)


@section('content')



    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->

                @if (session('error'))
                    <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">

                        {{ Session::get('error') }}
                    </div>
                @endif

                @if (count($errors) > 0)

                    <div>
                        <div class="alert alert-danger p-1   border-3">
                            <p class="font-weight-bold"> There were some problems with your input.</p>
                            <ul>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                @endif


                <?php
                $SubTotal = 0;
                $Tax = 0;
                $GrandTotal = 0;
                ?>
                <div class="card">
                    <div class="card-body">
                       
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td colspan="2">
                                    <div align="center" class="style1">{{ $company[0]->Name }} </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="center"><strong>VAT Return </strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">From <strong>{{ dateformatman2(request()->StartDate) }}</strong> To
                                    <strong>{{ dateformatman2(request()->EndDate) }}</strong>
                                </td>
                                <td width="50%">
                                    <div align="right">DATED: {{ date('d-m-Y') }}</div>
                                </td>

                            </tr>
                        </table>
                        <br>
                        <h5>VAT on Sales</h5>
                         <table  class="table table-bordered table-sm">
                            <thead>
                                <tr style="background-color:#CCCCCC">
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Ref#</th>
                                    <th>Customer</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">Tax</th>
                                    <th class="text-end">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $value)
                                <tr>
                                    <td>{{ dateformatman($value->Date) }}</td>
                                    <td>{{ $value->InvoiceNo }}</td>
                                    <td>{{ $value->ReferenceNo }}</td>
                                    <td>{{ $value->PartyName }}</td>
                                    <td class="text-end">{{ $value->Total }}</td>
                                    <td class="text-end">{{ $value->Tax }}</td>
                                    <td class="text-end">{{ $value->GrandTotal }}</td>
                                    
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th class="text-end">{{ $data['invoice']['Total'] }}</th>
                                    <th class="text-end">{{ $data['invoice']['Tax'] }}</th>
                                    <th class="text-end">{{ $data['invoice']['GrandTotal'] }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5>VAT on Purchases</h5>
                         <table  class="table table-bordered table-sm">
                            <thead>
                                <tr style="background-color:#CCCCCC">
                                    <th>Date</th>
                                    <th>Purchase</th>
                                    <th>Ref#</th>
                                    <th>Supplier</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">Tax</th>
                                    <th class="text-end">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $value)
                                <tr>
                                    <td>{{ dateformatman($value->Date) }}</td>
                                    <td>{{ $value->InvoiceNo }}</td>
                                    <td>{{ $value->ReferenceNo }}</td>
                                    <td>{{ $value->PartyName }}</td>
                                    <td class="text-end">{{ $value->Total }}</td>
                                    <td class="text-end">{{ $value->Tax }}</td>
                                    <td class="text-end">{{ $value->GrandTotal }}</td>
                                    
                                </tr>
                                @endforeach
                                 <tr>
                                    <th colspan="4">Total</th>
                                    <th class="text-end">{{ $data['purchase']['Total'] }}</th>
                                    <th class="text-end">{{ $data['purchase']['Tax'] }}</th>
                                    <th class="text-end">{{ $data['purchase']['GrandTotal'] }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h5>VAT on Expenses</h5>
                         <table  class="table table-bordered table-sm">
                            <thead>
                                <tr style="background-color:#CCCCCC">
                                    <th>Date</th>
                                    <th>Expense</th>
                                    <th>Account</th>
                                    <th>Supplier</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">Tax</th>
                                    <th class="text-end">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $value)
                                <tr>
                                    <td>{{ dateformatman($value->Date) }}</td>
                                    <td>{{ $value->ExpenseNo }}</td>
                                    <td>{{ $value->ChartOfAccountName }}</td>
                                    <td>{{ $value->SupplierName }}</td>
                                    <td class="text-end">{{ $value->Amount - $value->Tax }}</td>
                                    <td class="text-end">{{ $value->Tax }}</td>
                                    <td class="text-end">{{ $value->Amount }}</td>
                                    
                                </tr>
                                @endforeach
                                 <tr>
                                    <th colspan="4">Total</th>
                                    <th class="text-end">{{ $data['expense']['Total'] }}</th>
                                    <th class="text-end">{{ $data['expense']['Tax'] }}</th>
                                    <th class="text-end">{{ $data['expense']['GrandTotal'] }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">

                        <br>
                        <h5>Net VAT due</h5>


                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="bg-light">
                                    <th>S.No</th>
                                    <th>Description</th>
                                    <th>VAT Amount</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>1.</td>
                                <td>Total value of due tax for the period <span class="badge bg-info  "> A1 </span></td>
                                <td>{{ number_format($summary['output'], 2) }}</td>
                            </tr>

                            <tr>
                                <td>2.</td>
                                <td>Total value of recoverable tax for the period <span class="badge bg-info  "> A2 </span>
                                </td>
                                <td>{{ number_format($summary['input'], 2) }}</td>
                            </tr>


                            <tr style="font-weight: bolder;">
                                <td></td>
                                <td>Net VAT payable (or reclaimable) for the period <span class="badge bg-info  "> A3
                                    </span> = <span class="badge bg-info  "> A1 </span> - <span class="badge bg-info  ">
                                        A2 </span></td>
                                <td>{{ number_format($summary['payable'], 2) }}</td>
                            </tr>
                        </table>

                        <br>
                        <br>
                        **Amount is displayed in your base currency <strong>AED</strong>
                    </div>
                </div>





            </div>
        </div>

    </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
