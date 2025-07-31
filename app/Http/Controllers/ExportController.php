<?php

namespace App\Http\Controllers;

use App\Exports\RekrutmenExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $filters = [
            'from' => $request->query('from'),
            'to' => $request->query('to'),
            'status' => $request->query('status'), // bisa null
        ];

        return Excel::download(new RekrutmenExport($filters), 'data_rekrutmen-' . now()->format('Ymd-His') . '.xlsx');
    }
}
