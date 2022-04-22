@extends('template::app')

@section('body')

    @include('template::navbar')

    <div class="container mx-auto flex justify-center my-5">
        <div class="flex flex-col w-full md:w-1/2 px-5 py-3">
            <h1 class="font-bold text-2xl my-3">{{ $post->title }}</h1>

            <div class="py-3">
                {{ $post->user->name }}
                
                <span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>

                <div>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tags.posts.show', ['tag' => $tag]) }}" class="inline-block py-1 px-2 border-2 rounded-md text-xs">{{ $tag->name }}</a>
                    @endforeach
                </div>

                @can('update', $post)
                    <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="underline text-blue-600 hover:text-blue-800">Edit</a>
                @endcan

                @can('delete', $post)    
                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="underline text-red-600 hover:text-red-800">Delete</button>
                    </form>
                @endcan
            </div>

            <article class="prose">
                {!! $post->content !!}
            </article>

            @auth    
                <form action="{{ route('posts.comments.store', ['post' => $post]) }}" method="POST" class="w-full py-3" @error('comment') id="validation-comment-fails" @enderror>
                    @csrf

                    <div class="flex py-2">
                        <label for="content" class="mr-3">
                            <span class="flex items-center justify-center text-center inline-block w-10 h-10 rounded-full border-2">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </label>

                        <div class="flex flex-col w-full">
                            <textarea name="comment" id="comment" placeholder="Tambah komenter ..." class="w-full shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 @error('comment') border-red-500 @enderror rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="text-xs text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    

                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-2 mt-2 px-4 rounded">Komentar</button>
                </form>
            @endauth

            {{-- @commentsIndex(['commentable' => $post]) --}}

            @include('comment::comment-list', ['commentable' => $post])
        </div>
    </div>
@endsection
