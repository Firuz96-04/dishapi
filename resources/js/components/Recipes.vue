<template>
    <div>
        <step-list v-show="listStepModelShow" @close="closeStepList" :StepId="recipeStepId"
                   :stepRecipeObj="stepdata" :ingredientObj="getIngredient"></step-list>
        <ingredient-step v-show="ingredientModelShow" @close="closeingredient" :recipeId="recipeStepId"
                         :getIngredient="getIngredient"></ingredient-step>
        <list v-show="listModelShow" @close="closeList" :listdata="listdata" :recipe_name="sendRecipeName"></list>
        <ingredient-recipe v-show="ingredientRecipe" @close="closeIngRecipe" :title="sendRecipeName"
                           :recipeId="sendRecipeId" :getIngredient="getIngredient"></ingredient-recipe>
        <edit-model v-show="EditModelShow" @close="closeEdit" :recipeObj="editObj" :categoryObj="categoryGet"></edit-model>
        <delete-model v-show="DeleteModelShow" @close="closeDelete" :deleteRecipeName="deleteRecipeName"
                      :deleteId="deleteRecipeId">

        </delete-model>
        <add-model v-show="AddModelShow" @close="close" :categoryList="categoryGet"></add-model>
        <button class="btn btn-success m-1" style=" position: fixed;bottom: 20px;right: 20px;"
                @click="AddModelShow=true">Создать
        </button>

        <div class="container">
            <table class="table table-bordered mt-2">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>ккал</th>
                    <th>Категория</th>
                    <th>Icon</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in getRecipes">
                    <td> {{ item.id }}</td>
                    <td> {{ item.name }}</td>
                    <td> {{ item.kkal }}</td>
                    <td> {{ item.category.name }}</td>
                    <td>
                        <img v-if="item.recipe_image !=null" alt="..."
                             :src="'/storage/' + item.recipe_image" width="70" height="70">
                        <img v-else :src="'/storage/default.png'" alt="..." width="70"
                             height="70">
                    </td>
                    <td>
                        <div>
                            <button class="btn btn-dark m-1" @click="editMethod(item)">Изменить</button>
                            <button class="btn btn-danger m-1" @click="recipeDel(item.id,item.name)">Удалить</button>
                            <button class="btn btn-dark m-1" @click="ingredientRecipeModel(item.id,item.name)">
                                Ингредиенты
                            </button>
                            <button class="btn btn-dark m-1 position-relative"
                                    @click="listModel(item.ingredient,item.name)">
                                Список
                                <span
                                    class="position-absolute top-15 start-100 translate-middle badge rounded-pill bg-success">{{
                                        item.ingredient.length
                                    }}</span>
                            </button>
                            <button class="btn btn-dark m-1" @click="ingredientModelStep(item.id)">Шаги</button>
                            <button class="btn btn-dark m-1 position-relative"
                                    @click="listStepModel(item.recipe_step,item.id)">
                                Список Шагов
                                <span
                                    class="position-absolute top-15 start-100 translate-middle badge rounded-pill bg-success">{{
                                        item.recipe_step.length
                                    }}</span>
                            </button>


                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import AddModel from "./ModalDialogs/Recipe/Add"
import {mapGetters, mapActions} from "vuex"
import DeleteModel from "./ModalDialogs/Recipe/Delete"
import EditModel from "./ModalDialogs/Recipe/Edit"
import IngredientRecipe from "./ModalDialogs/Recipe/IngredientRecipe";
import List from "./ModalDialogs/Recipe/ListIngredient"
import IngredientStep from "./ModalDialogs/Recipe/IngredienStep";
import StepList from "./ModalDialogs/Recipe/StepList";

export default {
    components: {
        "step-list": StepList,
        "ingredient-step": IngredientStep,
        "list": List,
        "add-model": AddModel,
        "delete-model": DeleteModel,
        "edit-model": EditModel,
        "ingredient-recipe": IngredientRecipe,
    },
    data() {
        return {
            ingredientModelShow: false,
            listModelShow: false,
            ingredientRecipe: false,
            EditModelShow: false,
            DeleteModelShow: false,
            AddModelShow: false,
            deleteRecipeId: null,
            deleteRecipeName: null,
            editObj: {},
            sendRecipeName: null,
            sendRecipeId: null,
            listdata: {},
            stepdata: {},
            listStepModelShow: false,
            recipeStepId: null,
            sortArr: []

        }
    },
    methods: {
        ...mapActions('recipe', ['allRecipe']),
        ...mapActions('ingredient', ['ActIngredient']),
        ...mapActions('category', ['categoryAll']),
        editMethod(obj) {
            console.log(obj)
            this.EditModelShow = true
            this.editObj = obj
            console.log(this.editObj)
        },
        nextPage(){
        //  this.$router.push({name:'step',params:{id:'123'}})
           this.$router.push({ name: 'step', params: { userId: 17 } })
        },
        close() {
            this.AddModelShow = false
        },
        closeDelete() {
            this.DeleteModelShow = false
        },
        closeEdit() {
            this.EditModelShow = false
        },
        closeIngRecipe() {
            this.ingredientRecipe = false
        },
        closeList() {
            this.listModelShow = false
        },
        closeingredient() {
            this.ingredientModelShow = false
        },
        closeStepList() {
            this.listStepModelShow = false
        },
        recipeDel(id, name) {
            this.DeleteModelShow = true
            this.deleteRecipeName = name
            this.deleteRecipeId = id
            console.log(id)
        },
        ingredientRecipeModel(id, name) {
            this.ingredientRecipe = true
            this.sendRecipeName = name
            this.sendRecipeId = id
        },
        listModel(obj, name) {
            this.listModelShow = true
            this.listdata = obj
            this.sendRecipeName = name
        },
        listStepModel(obj, id) {
            this.listStepModelShow = true
            this.recipeStepId = id
            obj.sort(function (a, b) {
                return a.step_number - b.step_number
            })
            this.stepdata = obj

        },
        ingredientModelStep(id) {
            console.log(id)
            this.ingredientModelShow = true
            this.recipeStepId = id
        }
    },
    computed: {
        ...mapGetters('recipe', ['getRecipes']),
        ...mapGetters('ingredient', ['getIngredient']),
        ...mapGetters('category', ['categoryGet'])
    },
    mounted() {
        this.allRecipe()
        this.ActIngredient()
        this.categoryAll()
    }
}
</script>
