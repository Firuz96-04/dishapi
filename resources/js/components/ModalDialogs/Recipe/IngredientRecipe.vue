<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="delelete_title">
                    <span>Добавить ингредиент</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div >
                <h5>Добавить ингредиент в рецепт {{ title }}</h5>
                <div class="">
                    <label for="exampleFormControlInput2"  class="form-label">Количество</label>
                    <input type="number" class="form-control" v-model="ingredient_count" id="exampleFormControlInput2"  placeholder="Количество">
                </div>
                <div class="">
                    <label for="exampleFormControlInput1" class="form-label">Список ингредиентов</label>
                <select class="form-control" v-model="ingredient_id" id="exampleFormControlInput1" aria-label="Default select example">
                    <option v-for="item in getIngredient" :value="item.id">{{ item.name }}</option>
                </select>
                </div>
            </div>
            <div class="delete_footer mt-2">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-success" @click="addRecipeIng">Добавить</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex"

export default {
    props: {
        title: {
            type: String
        },
        recipeId: {
            type: Number
        },
        getIngredient:{
            type:Object
        }
    },
    data() {
        return {
            ingredient_id: null,
            ingredient_count:0
        }
    },
    methods: {

        ...mapActions('recipe',['addRecipeToIngredient']),
        close() {
            this.$emit('close')
            this.ingredient_id = ''
            this.ingredient_count = 0;
        },
        addRecipeIng() {
            const payload = {
                "ingredient_id": this.ingredient_id,
                "recipe_id": this.recipeId,
                "count" :this.ingredient_count
            }
            this.addRecipeToIngredient(payload)
           // this.ActIngredient()
        }
    },
    computed: {

        ...mapGetters('recipe',['statusloading4'])
    },
    watch:{
        statusloading4(val){
            if (!val) {
               this.close()
            }
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.modal__wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    transition: opacity .2s ease;
    right: 0;
    z-index: 998;
    background-color: rgba(00, 00, 00, .48);
}

.modal_content {
    position: relative;
    max-width: 600px;
    padding: 10px 15px;
    background-color: #fff;
    border: 1px solid #dcdfe6;
    transition: all .2s ease;
    border-radius: 8px;
    z-index: 999;
    overflow: hidden;
    width: 600px;
}

.modal_header {
    display: flex;
    justify-content: space-between;
}

.delelete_title span {
    font-weight: bold;
}

.btn_close span {
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
}

.delete_footer {
    display: flex;
    justify-content: flex-end;
}

.delete_footer button {
    margin-right: 5px;
}

.btn_close span {
    font-size: 16px;
    font-weight: bold;
}
</style>
