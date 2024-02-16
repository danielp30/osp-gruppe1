<template>
    <nav
        class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 "
    >
        <div
            class="container px-4 mx-auto flex flex-wrap items-center justify-between"
        >

            <div
                class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none"
                v-bind:class="{'hidden': !showMenu, 'block': showMenu}"
            >
                <ul class="flex flex-col lg:flex-row list-none lg:ml-auto mt-3">
                    <li class="flex items-center">
                        <button
                            class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                            type="button"
                            style="transition: all 0.15s ease 0s;"
                        >
                            <a href="/dashboard" class="font-semibold">Login</a>
                        </button>
                        <button
                            class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                            type="button"
                            style="transition: all 0.15s ease 0s;"
                        >
                            <a href="/register" class="font-semibold">Register</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            showMenu: false
        }
    },
    methods: {
        toggleNavbar: function(){
            this.showMenu = !this.showMenu;
        }
    }
}
</script>
