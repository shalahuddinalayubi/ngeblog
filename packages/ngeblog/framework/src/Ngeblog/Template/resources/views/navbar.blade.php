<nav class="py-4 border-b-2 px-2 md:px-0">
    <div class="container mx-auto flex flex-col lg:flex-row lg:justify-between lg:items-center">
        <div class="flex">
            @guest
                <a href="{{ route('login') }}" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">Login</a>
                <a href="{{ route('register') }}" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">Register</a>
            @endguest

            @auth    
                <div class="flex justify-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">
                            Account
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                        </div>

                        <div x-show="dropdownOpen" class="absolute left-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Update Profile
                            </a>

                            <a href="{{ route('password.edit') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Change Password
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            @auth    
                <div class="flex justify-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">
                            Post
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
                        </div>

                        <div x-show="dropdownOpen" class="absolute left-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="{{ url('/') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                All Post
                            </a>

                            <a href="{{ route('posts.index', ['filter[user_id]' => Auth::id()]) }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                My Post
                            </a>

                            <a href="{{ route('posts.create') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Create Post
                            </a>
                        </div>
                    </div>
                </div>
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