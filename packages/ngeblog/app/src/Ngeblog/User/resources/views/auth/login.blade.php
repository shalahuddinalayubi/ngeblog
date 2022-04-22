@extends('template::app')

@section('body')
<div class="w-full h-screen flex items-center justify-center w-full">
    <form action="{{ route('login') }}" method="POST" class="px-4 py-7 border border-gray-300 shadow rounded-lg mx-4 md:mx-0 w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        @csrf

        <div class="flex justify-center mb-3">
            <a href="{{ url('/') }}" class="font-bold text-xl hover:underline">
                Ngeblog
            </a>
        </div>
        
        <div class="flex flex-col py-2">
            <label for="email" class="mr-3">E-Mail</label>
            <input type="text" name="email" id="email" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('email') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}">
            @error('email')
                <div class="text-xs mt-2 text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex flex-col py-2">
            <label for="password" class="mr-3">Password</label>
            <input type="password" name="password" id="password" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('password') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('password')
                <div class="text-xs mt-2 text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="flex justify-between items-center my-2">
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 text-sm text-gray-900">
                    Ingat
                </label>
            </div>
            <a href="{{ route('password.request') }}" class="underline text-blue-600 hover:text-blue-800">Lupa password?</a>
        </div>

        <div class="mt-7">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Masuk</button>
        </div>
    </form>
</div>
@endsection
