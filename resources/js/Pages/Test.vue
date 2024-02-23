<template>
    <div>
        <p @click="link">hsdbhfdhdb</p>
    </div>
</template>
<script>
import FooterComponent from "../components/Footer.vue";
import NavLink from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/NavLink.vue";
import DangerButton from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/DangerButton.vue";
export default {
    name: "test",
    components: {
        DangerButton,
        NavLink,
        FooterComponent
    },
    methods:{
        link(){
            console.log('test');
        }
    }
}
</script>
