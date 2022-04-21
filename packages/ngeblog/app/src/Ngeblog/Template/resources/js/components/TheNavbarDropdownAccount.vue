<template>
    <div class="flex justify-center">
        <div class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="block px-5 py-2 mr-2 rounded-lg bg-blue-500 hover:bg-blue-700 text-white">
                Account
            </button>

            <div v-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10">
            </div>

            <div v-show="dropdownOpen" class="absolute left-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                <a :href=updateProfile class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                    Update Profile
                </a>

                <a :href=changePassword class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                    Change Password
                </a>

                <form method="POST" :action=logout>
                    <input type="hidden" name="_token" :value="csrf">
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">Logout</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TheNavbarDropdownAccount',

        data() {
            return {
                dropdownOpen: false,
                csrf: document.querySelector('meta[name="csrf"]').getAttribute('content'),
            }
        },

        props: [
            'updateProfile',
            'changePassword',
            'logout',
        ],
    }
</script>
