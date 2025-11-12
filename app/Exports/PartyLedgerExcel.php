<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

//export
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PartyLedgerExcel implements FromView, WithTitle, WithColumnWidths, WithStyles
{

    protected $PartyID;
    protected $PartyName;

    public function __construct($PartyID, $PartyName)
    {

        $this->PartyID = $PartyID;
        $this->PartyName = $PartyName;
    }



    public function styles(Worksheet $sheet)
    {
        // Make header row bold
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // Make column B bold
        $sheet->getStyle('B')->getFont()->setBold(true);

        // Make row 5 bold
        $sheet->getStyle('5')->getFont()->setBold(true);

        // Wrap text in column D
        $sheet->getStyle('D')->getAlignment()->setWrapText(true);

        // Add a border to A65
        $sheet->getStyle('A65')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
    }



    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,
            'C' => 10,
            'D' => 60,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
        ];
    }

    public function title(): string
    {
        return $this->PartyName;
    }

   /** @var \Illuminate\Support\Collection $sql */

    public function view(): View
    {

        $pagetitle = $this->PartyID;

        $sql = DB::table('journal')
            ->select(DB::raw('sum(if(ISNULL(Dr),0,Dr)-if(ISNULL(Cr),0,Cr)) as Balance'))
            ->where('PartyID', $this->PartyID)
            ->where('ChartOfAccountID', 110400)
            ->where('Date', '<', '2022-11-01')
            // ->whereBetween('date',array($request->StartDate,$request->EndDate))
            ->get();


        $journal = DB::table('v_journal')
            ->where('PartyID', $this->PartyID)
            ->whereBetween('Date', array('2022-11-01', date('Y-m-d')))
            ->where('ChartOfAccountID', 110400)
            ->get();




        $sql[0]->Balance = ($sql[0]->Balance == null) ? '0' :  $sql[0]->Balance;

        return view('export.party_sales_ledger', compact('journal', 'pagetitle', 'sql',));
    }
}
