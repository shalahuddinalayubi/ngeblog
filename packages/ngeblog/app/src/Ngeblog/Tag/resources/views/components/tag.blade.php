<h1 class="font-bold text-3xl ml-2 md:ml-0">Popular Tag</h1>

<div class="flex flex-wrap mt-5 text-xs">
    @foreach ($tags as $tag)
        <span class="py-1 px-4 mx-2 my-1 border-2 hover:border-gray-300 hover:cursor-pointer">{{ $tag->name }}</span>
    @endforeach
</div>
