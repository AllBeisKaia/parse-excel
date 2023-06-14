@extends('app')

@section('content')
    <div class="flex flex-col items-center shadow-lg shadow-cyan-500/50 dark:bg-gray-500 mb:items-center mb:content-center mb:items-center p-12 mb:text-center max-w-[480px] mx-auto rounded-[20px]">
        <h1 class="mb-5">Parser</h1>
        <form enctype="multipart/form-data" class="flex flex-col items-center w-5/6 rounded-[20px]" method="POST" action="{{ route('parser.parseExcel') }}">
            @csrf

            @if ($message = Session::get('failed'))
                <p class="text-red-500 text-xs italic pb-2">{{ $message }}</p>
            @endif

            <x-forms.input type="file" name="file"/>

            @if ($message = Session::get('parserStarted'))
                <p class="text-white text-xs italic pb-2">{{ $message }}</p>
                <parser-status :user="{{ auth()->user() }}"></parser-status>
            @endif

            <x-forms.gray_button text="Parse"/>
        </form>
    </div>
@endsection
