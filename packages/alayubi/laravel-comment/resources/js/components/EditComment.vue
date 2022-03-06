<template>
    <div>
        <div class="text-xs mb-1 hover:cursor-pointer hover:underline" @click="show = !show">Edit</div>

        <form :action="action" method="POST" class="w-full py-3" v-show="show">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="PUT">

            <div class="flex py-2">
                <label for="content" class="mr-3">
                    <span class="flex items-center justify-center text-center inline-block w-10 h-10 rounded-full border-2">
                        {{ authUserName.substring(0, 1) }}
                    </span>
                </label>

                <div class="flex flex-col w-full">
                    <textarea
                        name="comment"
                        id="comment"
                        placeholder=""
                        class="w-full shadow focus:ring-2 focus:ring-blue-500 appearance-none text-sm border border-gray-300 rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        v-model="comment"
                    ></textarea>
                    <!-- @error('comment')
                        <div class="text-xs text-red-500">
                            {{ $message }}
                        </div>
                    @enderror -->
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-2 mt-2 px-4 rounded">Update</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'EditComment',

    data() {
        return {
            show: false
        }
    },

    props: [
        'route',
        'authUserName',
        'action',
        'csrf',
        'comment'
    ]
}
</script>

<style scoped>

</style>
