<template>

    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Список Шагов</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="edit_body">
                <div class="steps" v-for="item in stepRecipeObj">
                    <h3 style="text-align: center">Шаг </h3>
                    <input type="number" class="stepNumber" v-model="item.step_number">
                    <span>Ингредиент</span>
                    <select class="dll" @change="onselectChange($event)">
                        <option v-for="elem in ingredientObj" :value="elem.id" :key="elem.id"
                                :selected="elem.id === item.ingredient_id "> {{ elem.name }}
                        </option>
                    </select>
                    <span>Время</span>
                    <input type="number" class="stepTime" v-model="item.time_step">
                    <span>Описание</span>
                    <textarea v-model="item.description">

                    </textarea>
                    <button class="btn btn-warning mt-1 stepsBtn" @click="editStepModal(item)">Изменить</button>
                    <button class="btn btn-dark mt-1" @click="deleteStepMod(item.id)">Удалить</button>
                </div>
            </div>
        </div>
        <div class="edit_footer">

        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex"

export default {
    components: {},
    props: {
        StepId: {
            type: [Number, String]
        },
        stepRecipeObj: {
            type: Object
        },
        ingredientObj: {
            type: Object
        }
    },
    data() {
        return {
            stepTime: null,
            stepNumber: null,
            selectForm: null,
            sel: null
        }
    },
    methods: {

        ...mapActions('recipeStep', ['recipeStepAll']),
        ...mapActions('recipe', ['deleteStep', 'updateRecipeStep']),
        close() {
            this.$emit('close')
        },
        getStepData() {
            this.recipeStepAll(17)
        },
        editStepModal(obj) {
            let elem = ""
            if (this.selectForm == null) {
                elem = obj.ingredient_id
            } else {
                elem = this.selectForm
                this.selectForm = null
            }
            const data = {
                id: obj.id,
                recipe_id: obj.recipe_id,
                step_number: obj.step_number,
                time_step: obj.time_step,
                description: obj.description,
                ingredient_id: elem
            }
            console.log(data)
            this.updateRecipeStep(data)
        },
        deleteStepMod(id) {
            this.deleteStep(id)
        },
        onselectChange(event) {
            this.selectForm = event.target.value
            console.log(this.selectForm)
        }
    },
    computed: {
        ...mapGetters('recipeStep', ['recipeStepList']),
        ...mapGetters('recipe', ['deleteModelStep', 'closeModelUpdate'])
    },
    watch: {
        closeModelUpdate(val) {
            if (!val) {
                this.close()
            }
        },
        deleteModelStep(val) {
            if (!val) {
                this.close()
            }
        }
    },
    mounted() {
        console.log("mounted")

    },
    created() {
        console.log("created")
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
    max-width: 800px;
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

.edit_body {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.steps {
    padding: 5px;
    margin: 5px;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0, 0, 0, .3);

}

.steps span {
    font-weight: bold;
    text-align: center;
}
</style>
