<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FileRequest;
use App\Actions\ExcelParserAction;
use Illuminate\View\View;
use App\Models\Row;

class ParserController extends Controller
{
    public function index()
    {
        $rows = Row::forIndex();

        return view('parser.index', compact('rows'));
    }

    public function parserForm(): View
    {
        return view('parser.parser');
    }

    public function parserStatus(): View
    {
        return view('parser.parser');
    }

    public function parseExcel(FileRequest $request, ExcelParserAction $action): RedirectResponse
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');

            $fileName = $file->store();

            if ($fileName !== false) {
                $action(storage_path('app') . '/' . $fileName);

                return redirect(route('parser.parserForm'))->with('parserStarted', 'File parser is started');
            }
        }

        return redirect(route('parser.parserForm'))->with('failed', 'File not uploaded');
    }
}
