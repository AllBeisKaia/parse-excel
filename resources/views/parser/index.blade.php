@extends('app')

@section('content')
    <div class="flex flex-col items-center w-full m-auto">
        <h1 class="mb-5">Test data</h1>
        <table class="table-auto">
            <thead>
            <tr>
                <th colspan="1">Name</th>
                <th colspan="1">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>
                        {{ $row->name }}
                    </td>
                    <td>
                        {{ $row->date }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                {{ $rows->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
