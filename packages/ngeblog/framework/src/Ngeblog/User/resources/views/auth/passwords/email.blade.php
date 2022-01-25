@extends('template::app')

@section('body')
<div class="w-full h-screen flex items-center justify-center">
    <div class="flex flex-col items-center">
        @if (session('status'))
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 mb-5 mx-5">
                <p class="text-sm">
                    {{ session('status') }}
                </p>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="px-4 py-7 border border-gray-300 shadow rounded-lg">
            <div class="flex justify-center mb-5">
                <h3 class="font-bold text-lg">Lupa password</h3>
            </div>

            @csrf
            
            <div class="flex flex-col py-2">
                <div class="flex items-center justify-between">
                    <label for="email" class="mr-3">E-Mail</label>
                    <input type="text" name="email" id="email" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('email') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                @error('email')
                    <div class="text-xs mt-2 text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="flex mt-7">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kirim link reset password</button>
            </div>

            <div class="mt-5">
                <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">Masuk</a>
            </div>
        </form>
    </div>
</div>
@endsection
