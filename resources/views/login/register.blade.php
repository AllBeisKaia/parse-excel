@extends('app')

@section('content')
    <div class="flex flex-col items-center shadow-lg shadow-cyan-500/50 dark:bg-gray-500 mb:items-center mb:content-center mb:items-center p-12 mb:text-center max-w-[480px] mx-auto rounded-[20px]">
        <h1 class="mb-5">Registration</h1>
        <form class="flex flex-col items-center w-5/6 rounded-[20px]" method="POST" action="{{ route('register') }}">
            @csrf

            <x-forms.input name="name" placeholder="Name"/>

            <x-forms.input name="email" placeholder="Email"/>

            <x-forms.input name="password" placeholder="Password" type="password"/>

            <x-forms.input name="password_confirmation" placeholder="Confirm password" type="password"/>

            <x-forms.gray_button text="SignUp"/>
        </form>
    </div>
@endsection
