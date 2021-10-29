<template>
    <div>
        <h1>Login</h1>
        <button @click="redirectIng">ing</button>
    </div>
</template>

<script>
export default  {
    data() {
        return {

        }
    },
    methods:{
        redirectIng() {
            this.$router.push('ingredient')
        }
    }
}
</script>
