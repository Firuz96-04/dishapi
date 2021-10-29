<template>
    <div>
        <vue-header/>
        <router-view/>
    </div>
</template>

<script>
import VueHeader from "./components/Pages/VueHeader.vue"
//import Login from "./components/Login.vue"
export  default {
    components:{
        "vue-header":VueHeader,
  //      "vue-login":Login
    },
  }
</script>
