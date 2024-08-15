<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ImportController extends Controller
{
    public function showImportPage()
    {
        return view('import');
    }

    public function importData(Request $request)
    {
        Artisan::call('import:documents', [
            'file' => '2023-03-28.json'
        ]);

        return redirect()->route('import.show')->with('success', 'Importação iniciada com sucesso!');
    }
}
