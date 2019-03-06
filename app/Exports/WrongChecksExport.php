<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WrongChecksExport implements FromArray, Responsable, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $wrong_checks;
    private $fileName = 'wrong_checks.xlsx';

    function __construct($wrong_checks)
    {
        $this->wrong_checks = $wrong_checks;
    }

    public function headings():array
    {
        return [
            'Drug Name',
            'Price',
            'Buying Price',
        	'Status',
        	'Extra Amount',
        	'Phone Number',
        	'Date Checked'
        ];
    }
    public function array():array
    {
        return $this->wrong_checks;
    }
}
