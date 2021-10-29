<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Редактировать Ингредиент</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="edit_body">
                <form  enctype="multipart/form-data">
                    <div class="">
                        <label for="exampleFormControlInput1" class="form-label">Ингредиент</label>
                        <input type="text" class="form-control nameIngredient" id="exampleFormControlInput1"
                               placeholder="Ингредиент" :value="editIng.name"  >
                    </div>
                    <div class="">
                        <label for="exampleFormControlInput2" class="form-label">Ед. изм</label>
                        <input type="text" class="form-control unitIngredient" id="exampleFormControlInput2"
                               placeholder="Ед. изм" :value="editIng.unit" >
                    </div>
                    <div class="image_block m-1">
                        <img v-if="editIng.icon !=null"  alt="..."
                             :src="'/storage/' + editIng.icon" width="90" height="90">
                        <img v-else :src="'/storage/default.png'" alt="..."  width="90"
                             height="90">
                    </div>
                    <div>
                        <label for="formFileLg" class="form-label">Выберите картинку</label>
                        <input class="form-control" id="formFileLg" @change="changeImage" type="file">
                    </div>
                </form>
            </div>
            <div class="edit_footer">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-warning" @click="editMethod">Редактировать</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex"

export default {

    props:{
        editIng:{
            type:Object
        }
    },
    data() {
        return {
            getObj:{
                name:this.editIng.name,
                unit:this.editIng.unit
            },
            IngImage:null
        }
    },
    methods: {

        ...mapActions('ingredient',['updateIngredient']),

        editMethod() {
            let date = new FormData()
            let name_ing = document.querySelector(".nameIngredient")
            let unit_ing  = document.querySelector(".unitIngredient")
            date.append('name',name_ing.value)
            date.append('unit',unit_ing.value)
            date.append('icon',this.IngImage)
            let payload= {
                id:this.editIng.id,
                date:date
            }

            this.updateIngredient(payload)
        },
        changeImage(e) {
            console.log(e.target.files[0])
            this.IngImage = e.target.files[0]
        },
        close() {
            this.$emit('close')
        }
    },
    computed:{
      ...mapGetters('ingredient',['loadingStatus2'])
    },
    watch:{
        loadingStatus2(val) {
            if (!val) {
               this.close()
            }
        }
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
.image_block{
    display: flex;
    justify-content: center;
}
</style>
