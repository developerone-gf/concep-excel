<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ReportController extends Controller
{
    
    public function getExport()
    {
        $data = [
            [ 1, 'Luis', 'Briceño', 22 ],
            [ 2, 'Angela', 'Muñoz', 27 ],
            [ 3, 'Fernimore', 'Baena', 32 ],
            [ 4, 'Juan', 'Osorio', 24 ],
        ];

        $type = 'xls';

        $captions = ['id', 'Nombre', 'Apellido', 'Edad'];

        $this->export($data, 'developer_team', $captions, $type);
    }

    private function export($data, $filename, $captions, $type)
    {
        if (! in_array($type, ['xls', 'csv'])) {
            $type = 'csv';
        }
        
        $fn = $filename.'-'.date('Y-m-d_H-i-s');
        
        Excel::create($fn, function ($excel) use ($data, $captions) {

            $excel->sheet('SHEET NAME', function ($sheet) use ($data, $captions) {
                        
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->prependRow(1, $captions);
                $sheet->freezeFirstRow();

            });

        })->export($type);
    }

}
