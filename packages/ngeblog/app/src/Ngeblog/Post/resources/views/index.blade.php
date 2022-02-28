@extends('template::app')

@section('body')
    @include('template::navbar')

    <div class="container mx-auto pb-5 px-2 md:px-0">
        <div class="flex flex-col md:flex-row justify-center">
            <div class="w-full lg:w-1/2">
                @if ($posts->isEmpty())    
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 mt-3" role="alert">
                        <p class="text-sm">The post you are looking for is not available.</p>
                    </div>
                @endif

                @if (Session::has('status'))
                    <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3 mt-3" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                        <p>{{ Session::get('status') }}</p>
                    </div>
                @endif

                @foreach ($posts as $post)
                    <div class="my-5 py-2 px-3 shadow">
                        <div>
                            <span class="text-xs">{{ $post->user->name }}</span>

                            @can('update', $post)
                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="underline text-blue-600 hover:text-blue-800">Edit</a>
                            @endcan

                            @can('delete', $post)    
                                <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="underline text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            @endcan
                        </div>

                        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="font-bold text-2xl hover:underline">{{ $post->title }}</a>

                        <p>
                            {!! \Illuminate\Support\Str::limit($post->content, 50) !!}
                        </p>

                        <div>
                            @foreach ($post->tags as $tag)
                                <span class="py-1 px-2 my-1 inline-block border-2 rounded-lg text-xs">{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        <div>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col md:items-center md:px-3 my-5 w-full lg:w-1/3">
                @tag(['tags' => \Ngeblog\Post\Models\Post::mostUsedTags()])
            </div>
        </div>

        <div class="flex justify-center">
            {{ $posts->links('template::pagination') }}
        </div>
    </div>
@endsection
