@extends('template::app')

@section('body')

    @include('template::navbar')

    <div class="container mx-auto flex justify-center my-5">
        <div class="flex flex-col w-1/2 px-5 py-3">
            <h1 class="font-bold text-2xl my-3">{{ $post->title }}</h1>

            <div class="py-3">
                {{ $post->user->name }}
                
                <span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>

                <div>
                    @foreach ($post->tags as $tag)
                        <span class="inline-block py-1 px-2 border-2 rounded-md text-xs">{{ $tag->name }}</span>
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

            <p class="text-justify content">
                {!! $post->content !!}
            </p>
        </div>
    </div>
@endsection
