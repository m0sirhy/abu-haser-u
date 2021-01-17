<?php

namespace App\Exports;

use App\Outlay;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;


class OutlaysExport  implements  FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{


    
    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;

    }

    public function query()
    {
        return Outlay::query()->whereYear('created_at', $this->year);
    }
   
    
    public function map($Outlay): array
    {


        return [
            $Outlay->id,
            $Outlay->user->name,
            $Outlay->OutlayCategory->name,

            $Outlay->amount,
            $Outlay->payee,
            $Outlay->statment,
            $Outlay->created_at,

            $Outlay->updated_at,


        ];
    }



    public function headings(): array
    {
        return [
            '#',
            'بواسطة',
            'التصنيف',
            'المبلغ',
            'المستفيد',
            'البيان',

            'تاريخ الانشاء',
            'ملاحظات'

        ];
    }
}
