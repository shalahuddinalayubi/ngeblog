@extends('template::app')

@section('body')

@include('template::navbar')

<div class="container mx-auto pb-5">
    <div class="flex flex-col lg:flex-row justify-center">
        <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST" class="w-full lg:w-1/3 px-3 py-3">
            @csrf
            @method('PUT')

            <div class="flex flex-col py-2">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('title') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $post->title }}">
                @error('title')
                    <div class="text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div id="editor"></div>

            <div class="flex flex-col py-2 hidden">
                <label for="content">Isi</label>
                <textarea name="content" id="content" cols="30" rows="10" class="shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('content') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $post->content }}</textarea>
                @error('content')
                    <div class="text-xs text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded">Perbarui</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/plugin/quill.js') }}"></script>
@endpush
