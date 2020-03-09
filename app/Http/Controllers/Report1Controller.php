<?php

namespace App\Http\Controllers;

use App\Exports\TestReport;
use Illuminate\Http\Request;
use LastExcel;

class Report1Controller extends Controller
{
    public function getExport()
    {
        $type = 'xls';
        return $this->export( TestReport::class, 'developer_team_2', $type );
    }

    private function export($class, $filename, $type)
    {
        if (!in_array($type, ['xls', 'csv'])) {
            $type = 'csv';
        }

        $fn = $filename . '-' . date('Y-m-d_H-i-s');

        return LastExcel::download(new $class, $fn . '.' . $type);
    }

}
