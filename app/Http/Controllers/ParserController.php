<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Jobs\StartParserJob;
use App\Models\Row;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

    public function parseExcel(FileRequest $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');

            if ($fileName = $file->store()) {
                StartParserJob::dispatch(storage_path('app') . '/' . $fileName, Auth::id());

                return redirect(route('parser.parserForm'))->with('parserStarted', 'File parser is started');
            }
        }

        return redirect(route('parser.parserForm'))->with('failed', 'File not uploaded');
    }
}
