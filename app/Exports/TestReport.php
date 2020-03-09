<?php

namespace App\Exports;

use Developergf\Excel\Concerns\FromCollection;
use Developergf\Excel\Concerns\WithHeadings;
use Developergf\Excel\Concerns\WithEvents;
use Developergf\Excel\Events\AfterSheet;

class TestReport implements FromCollection, WithHeadings, WithEvents
{

    // set the headings
    public function headings(): array
    {
        return [
            'id', 'Nombre', 'Apellido', 'Edad'
        ];
    }

    // freeze the first row with headings
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->freezePane('A2', 'A2');
            },
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $data = [
            [1, 'Luis', 'Briceño', 22],
            [2, 'Angela', 'Muñoz', 27],
            [3, 'Fenimore', 'Baena', 28],
            [4, 'Juan', 'Osorio', 24],
        ];
        
        return collect($data);
    }
}
