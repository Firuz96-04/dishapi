<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Добавить Шаг</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="edit_body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Шаг</label>
                        <input type="number" v-model="recipeStepData.step_number" class="form-control" id="exampleFormControlInput1" placeholder="Шаг">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Ингредиент</label>
                        <select class="form-control" v-model="recipeStepData.ingredient_id" id="exampleFormControlSelect1">
                            <option v-for="item in getIngredient" :value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Сколько минут</label>
                        <input type="text" class="form-control" v-model="recipeStepData.time_step" id="exampleFormControlInput2" placeholder="Сколько минут">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание</label>
                        <textarea class="form-control" v-model="recipeStepData.description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="edit_footer">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-success" @click="addStep">Добавить </button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters,mapActions} from "vuex"
export default {
    props:{
      recipeId:{
          type:[Number,String]
      },
        getIngredient:{
          type:Object
        }
    },
    data() {
        return {
            recipeStepData:{
                recipe_id:null,
                ingredient_id:null,
                step_number:null,
                time_step:null,
                description:null
            }
        }
    },
    methods: {
        close() {
            this.$emit('close')
            this.recipeStepData.recipe_id = null
            this.recipeStepData.ingredient_id = null
            this.recipeStepData.step_number = null
            this.recipeStepData.time_step = null
            this.recipeStepData.description = null
        },
        ...mapActions('recipe',['addRecipStep']),

        addStep() {
            this.recipeStepData.recipe_id = this.recipeId
            this.addRecipStep(this.recipeStepData)
        },
    },
    computed:{
        ...mapGetters('recipe',['closeModelStep']),
    },
    watch:{
        closeModelStep(val) {
                if (!val){
                    this.close()

                }
        }
    },
    mounted() {}
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
    width: 400px;
}

.modal_header {
    display: flex;
    justify-content: space-between;
}

.btn_close span {
    cursor: pointer;
}

.edit_title span {
    font-weight: bold;
    font-size: 16px;
}

.btn_close span {
    font-weight: bold;
    font-size: 16px;
}

.edit_footer button {
    margin-right: 5px;
}

.edit_footer {
    display: flex;
    justify-content: flex-end;
    margin-right: 5px;
    margin-top: 5px;
}

.image_block {
    display: flex;
    justify-content: center;
}
</style>
