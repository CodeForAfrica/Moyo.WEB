<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PriceChecksExport implements FromArray, Responsable, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $price_checks;
    private $fileName = 'price_checks.xlsx';

    function __construct($price_checks)
    {
        $this->price_checks = $price_checks;
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
        return $this->price_checks;
    }
}
