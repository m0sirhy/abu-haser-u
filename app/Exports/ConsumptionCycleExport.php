<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use App\ConsumptionCycle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ConsumptionCycleExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ConsumptionCycle::all();
    }


    public function map($ConsumptionCycle): array
    {


        return [
            $ConsumptionCycle->full_name,
            $ConsumptionCycle->previous,
            $ConsumptionCycle->curent,
            $ConsumptionCycle->consume,
            $ConsumptionCycle->user->name,
            $ConsumptionCycle->address,


            $ConsumptionCycle->updated_at,


        ];
    }



    public function headings(): array
    {
        return [
            'الاسم',
            'القراءة السابقة',
            'القراءة الحالية',
            'الاستهلاك',
            'مدخل البيانات',
            'العنوان',

            'التاريخ',
            'ملاحظات'

        ];
    }
}
