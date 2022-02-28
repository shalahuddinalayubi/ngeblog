@extends('template::app')

@section('body')
<div class="w-full h-screen flex items-center justify-center">
    <form action="{{ route('register') }}" method="POST" class="px-4 py-7 mx-2 md:mx-0 border border-gray-300 shadow rounded-lg w-full md:w-1/2 lg:w-1/3">
        @csrf

        <div class="flex justify-center mb-3">
            <h3 class="font-bold text-xl">Mendaftar</h3>
        </div>

        <div class="flex flex-col py-2">
            <div class="flex items-start justify-between">
                <label for="name" class="mr-3">Nama</label>

                <div class="flex flex-col w-3/5">
                    <input type="text" name="name" id="name" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('name') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="flex flex-col py-2">
            <div class="flex items-start justify-between">
                <label for="email" class="mr-3">E-Mail</label>

                <div class="flex flex-col w-3/5">
                    <input type="text" name="email" id="email" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('email') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="flex flex-col py-2">
            <div class="flex items-start justify-between">
                <label for="password" class="mr-3">Password</label>

                <div class="flex flex-col w-3/5">
                    <input type="password" name="password" id="password" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('password') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('password') }}">
                    @error('password')
                        <div class="text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-col py-2">
            <div class="flex items-start justify-between">
                <label for="password_confirmation" class="mr-3">Password Konfirmasi</label>

                <div class="flex flex-col w-3/5">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('password_confirmation') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password_confirmation')
                        <div class="text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center my-2">
            <div class="flex items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mendaftar</button>
            </div>
    
            <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">Sudah punya akun</a>
        </div>
</div>
@endsection
