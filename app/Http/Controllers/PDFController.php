<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function voucher()
    {

        $pdf = Pdf::loadView('pdf.voucher');
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
        // return $pdf->download('receipt-voucher.pdf');

//        return view('pdf.voucher');
    }
    public function invoice()
    {
        $pdf = Pdf::loadView('pdf.invoice');
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();

//        return view('pdf.invoice');
    }
    public function quotation()
    {
         $pdf = Pdf::loadView('pdf.quotation');
        $pdf->setPaper('a4', 'portrait');
       return $pdf->stream();
        //  return view('pdf.quotation');
    }
    public function workOrder()
    {
         $pdf = Pdf::loadView('pdf.workOrder');
        $pdf->setPaper('a4', 'portrait');
       return $pdf->stream();
        //  return view('pdf.workOrder');
    }
}
