<template>
    <div class="head">
        <div>
            <router-link :to="{path:'ingredient'}">Ингредиенты</router-link>
            <router-link :to="{path:'category'}">Категории</router-link>
            <router-link :to="{path: 'product'}">Рецепты</router-link>
        </div>
        <div class="buttons">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </div>
</template>
<script>
export default {
    methods: {}
}
</script>
<style scoped>
.head {
    width: 100%;
    height: auto;
    background: #464d52;
    display: flex;
    align-items: center;
    padding: 10px;
    justify-content: space-between;
}

a {
    color: #fff;
    padding: 10px 15px;
    text-decoration: none;
}

.router-link-exact-active {
    color: #3f9ae5;
}

.buttons {
    margin-right: 80px;
}

.buttons button {
    margin-left: 5px;
}
</style>
