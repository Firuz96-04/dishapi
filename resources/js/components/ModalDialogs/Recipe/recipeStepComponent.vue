<template>
    <div class="edit_body">
        <div class="steps" v-for="item in stepRecipeObj">
            <h3 style="text-align: center">Шаг 22</h3>
            <input type="number" class="stepNumber" v-model="item.step_number">
            <span>Ингредиент</span>
            <select class="dll"  @change="onselectChange($event)">
                <option v-for="elem in ingredientObj" :value="elem.id" :key="elem.id"
                        :selected="elem.id === item.ingredient_id "> {{ elem.name}}
                </option>
            </select>
            <span>Время</span>
            <input type="number" class="stepTime" v-model="item.time_step">
            <span>Описание</span>
            <textarea>

            </textarea>
            <button class="btn btn-warning mt-1 stepsBtn" @click="editStepModal(item)">Изменить</button>
            <button class="btn btn-dark mt-1" @click="deleteStepMod(item.id)">Удалить</button>
        </div>

    </div>
</template>

<script>
export default {
    props:{

    },
    data() {
        return{

        }
    },
    methods:{

    },
}
</script>
