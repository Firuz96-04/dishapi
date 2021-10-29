<template>
    {{ $route.params.userId}}
    <ul>
        <li v-for="item in getRecipes"> {{item.id}}</li>
    </ul>
</template>


<script>
import {mapGetters,mapActions} from "vuex"
export default {
    data() {
        return {
            id:this.$route.params.userId
        }
    },
    methods:{
        ...mapActions('recipe',['allRecipe'])
    },
    computed:{
        ...mapGetters('recipe',['getRecipes'])
    },
    mounted() {
        console.log(this.id)
        console.log(333)
        this.allRecipe()
    }
}
</script>
