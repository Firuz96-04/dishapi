<template>
    <div>
            <edit-model v-show="editModel" @close="closeEdit" :editIng="editIngData"></edit-model>
        <delete-model v-show="deleteModal" @close="closeDelete" :deleteId="ingredientId"
                      :deleteIng="ingredientName"></delete-model>
        <add-model @close="closeAdd" v-show="addModel"></add-model>
        <button class="btn btn-success m-1" style=" position: fixed;bottom: 20px;right: 20px;" @click="addModel=true">Создать</button>
        <div class="container">

            <table class=" table table-bordered mt-1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Ед. изм</th>
                    <th>Картинка</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in getIngredient">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.unit }}</td>
                    <td>
                        <img v-if="item.icon !=null"  alt="..."
                             :src="'/storage/' + item.icon" width="70" height="70">
                        <img v-else :src="'/storage/default.png'" alt="..."  width="70"
                             height="70">
                    </td>
                    <td>
                        <button class="btn btn-dark" @click="editModelShow(item)">Редактировать</button>
                        <button @click="IngDelete(item.id,item.name)" class="btn btn-danger ml-1">Удалить</button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import addModel from "./ModalDialogs/Ingredient/Add"
import deleteModel from "./ModalDialogs/Ingredient/Delete"
import {mapActions, mapGetters, mapMutations} from "vuex"
import editModel from "./ModalDialogs/Ingredient/Edit"

export default {
    components: {
        "delete-model": deleteModel,
        "add-model" : addModel,
        "edit-model":editModel
    },
    data() {
        return {
            editModel:false,
            addModel:false,
            deleteModal: false,

            ingredientId: null,
            ingredientName: null,
            editIngData:{

            },
        }
    },
    methods: {
        ...mapActions('ingredient', ['ActIngredient', 'ActDelete']),
        closeEdit(){
            this.editModel =false
        },
        editModelShow(elem) {
            console.log(elem)
            this.editIngData =elem
            this.editModel =true
        },
        IngDelete(id, name) {
            this.ingredientId = id
            this.ingredientName = name
            this.deleteModal = true
        },
        closeDelete() {
            this.deleteModal = false
        },
        closeAdd(){
            this.addModel = false
        }
    },
    computed: {
        ...mapGetters('ingredient', ['getIngredient'])
    },

    mounted() {
        this.ActIngredient()
    }
}
</script>
<style scoped>
.fixed_header {
    width: auto;
    table-layout: fixed;
    border-collapse: collapse;
}

.fixed_header tbody {
    display: block;
    width: 100%;
    overflow: auto;
    height: 200vh;
}

.fixed_header thead tr {
    display: block;
}

</style>
