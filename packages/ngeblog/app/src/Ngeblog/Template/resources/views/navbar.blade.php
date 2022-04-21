<nav class="py-4 border-b-2 px-2 md:px-0">
    <div class="container mx-auto flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <div class="flex">
            @guest
                <a href="{{ route('login') }}" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">Login</a>
                <a href="{{ route('register') }}" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">Register</a>
            @endguest

            @auth
                <the-navbar-dropdown-account
                    update-profile="{{ route('profile.edit') }}"
                    change-password="{{ route('password.edit') }}"
                    logout="{{ route('logout') }}"
                >
                </the-navbar-dropdown-account>
            @endauth

            @auth
                <the-navbar-dropdown-post
                    posts-index={{ route('posts.index') }}
                    posts-auth-index={{ route('posts.index', ['filter[user_id]' => Auth::id()]) }}
                    posts-create={{ route('posts.create') }}
                >
                </the-navbar-dropdown-post>
            @endauth
        </div>

        <div class="mt-2 lg:mt-0">
            <form action="{{ route('posts.index') }}" method="GET" class="group relative">
                {{-- @csrf --}}

                <button type="submit" class="absolute left-3 top-1/2 -mt-2.5 text-slate-400 group-focus-within:text-blue-500">
                    <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                    </svg>
                </button>

                <input name="filter[title]" class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-500 shadow-sm" type="text" aria-label="Filter projects" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>