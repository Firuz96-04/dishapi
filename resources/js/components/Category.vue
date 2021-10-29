<template>
    <div>
        <edit-model v-show="EditModelShow" :EditObj="testObj" @close="closeEdit"></edit-model>
        <add-model v-show="AddModelShow" @close="closeAdd"></add-model>
        <delete-model v-show="deleteModelShow" @close="closeDelete" :deleteId="deleteId"
                      :deleteName="deleteName"></delete-model>
        <button class="btn btn-success m-1" style=" position: fixed;bottom: 20px;right: 20px;"
                @click="AddModelShow=true">Создать
        </button>
        <div class="container">
            <table class="table table-bordered mt-2">
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
                <tr v-for="item in categoryGet">
                    <td>{{ item.id }}</td>
                    <td> {{ item.name }}</td>
                    <td> {{ item.unit }}</td>
                    <td>
                        <img v-if="item.icon !=null" alt="..."
                             :src="'/storage/' + item.icon" width="140" height="70">
                        <img v-else :src="'/storage/default.png'" alt="..." width="140"
                             height="70">
                    </td>
                    <td>
                        <button class="btn btn-dark mr-1" @click="editMethod(item)">Редактировать</button>
                        <button class="btn btn-danger" @click="deleteShow(item.id,item.name)">Удалить</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
<script>
import editModel from "./ModalDialogs/Category/Edit"
import deleteModel from "./ModalDialogs/Category/Delete"
import addModel from "./ModalDialogs/Category/Add"
import {mapGetters, mapActions} from "vuex"

export default {
    components: {
        "delete-model": deleteModel,
        "add-model": addModel,
        "edit-model": editModel
    },
    data() {
        return {
            AddModelShow: false,
            deleteModelShow: false,
            EditModelShow:false,
            deleteName: null,
            deleteId: null,
            testObj:{
            }
        }
    },
    methods: {
        ...mapActions('category', ['categoryAll']),
        deleteShow(id, name) {
            this.deleteModelShow = true
            this.deleteName = name
            this.deleteId = id
        },
        editMethod(elem) {
            this.testObj =elem
          this.EditModelShow = true
        },
        closeDelete() {
            this.deleteModelShow = false
        },
        closeAdd() {
            this.AddModelShow = false
        },
        closeEdit(){
            this.EditModelShow = false
        }
    },

    computed: {
        ...mapGetters('category', ['categoryGet'])
    },
    mounted() {
        this.categoryAll()
    }
}
</script>
