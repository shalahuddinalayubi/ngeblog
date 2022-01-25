@extends('template::app')

@section('body')
<div class="w-full h-screen flex items-center justify-center">
    <form action="{{ route('password.update') }}" method="POST" class="px-4 py-7 border border-gray-300 shadow rounded-lg">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="flex justify-center mb-5">
            <h3 class="font-bold text-lg">Pengaturan ulang password</h3>
        </div>
        
        <div class="flex flex-col py-2">
            <div class="flex items-center justify-between">
                <label for="email" class="mr-3">E-Mail</label>
                <input type="text" name="email" id="email" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('email') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $email ?? old('email') }}">
            </div>

            @error('email')
                <div class="text-xs mt-2 text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex flex-col py-2">
            <div class="flex items-center justify-between">
                <label for="password" class="mr-3">Password</label>
                <input type="password" name="password" id="password" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('password') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            @error('password')
                <div class="text-xs mt-2 text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex items-center justify-between py-2">
            <label for="password-confirm" class="mr-3">Password konfirmasi</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex justify-between items-center my-2">
            <div class="flex items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atur ulang</button>
            </div>
            <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">Masuk</a>
        </div>
    </form>
</div>
@endsection
