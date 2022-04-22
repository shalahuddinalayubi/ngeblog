<template>
    <div class="flex justify-center">
        <div class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">
                Post
            </button>

            <div v-show=dropdownOpen @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
            </div>

            <div v-show=dropdownOpen class="absolute left-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                <a :href=postsIndex class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                    All Post
                </a>

                <a :href=postsAuthIndex class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                    My Post
                </a>

                <a :href=postsCreate class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                    Create Post
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TheNavbarDropdownPost',

        data() {
            return {
                dropdownOpen: false,
            }
        },

        props: [
            'postsIndex',
            'postsAuthIndex',
            'postsCreate',
        ],
    }
</script>