<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Редактировать Категорию</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="edit_body">
                <form  enctype="multipart/form-data">
                    <div class="">
                        <label for="exampleFormControlInput1" class="form-label">Категория</label>
                        <input type="text" class="form-control nameCat" :value="EditObj.name"  id="exampleFormControlInput1"
                               placeholder="Ингредиент">
                    </div>
                    <div class="">
                        <label for="exampleFormControlInput2" class="form-label">Ед. изм</label>
                        <input type="text" class="form-control unitCat" :value="EditObj.unit"  id="exampleFormControlInput2"
                               placeholder="Ед. изм">
                    </div>
                    <div class="image_block m-1">
                        <img v-if="EditObj.icon !=null"  alt="..."
                             :src="'/storage/' + EditObj.icon" width="90" height="90">
                        <img v-else :src="'/storage/default.png'" alt="..."  width="90"
                             height="90">
                    </div>
                    <div>
                        <label for="formFileLg" class="form-label">Выберите картинку</label>
                        <input class="form-control" id="formFileLg" @change="getImage" type="file">
                    </div>
                </form>
            </div>
            <div class="edit_footer">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-warning" @click="EditCat">Редактировать</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex"

export default {
    props:{
        EditObj:{
            type:Object
        }
    },
    data() {
        return {
            editId:this.EditObj.id,
            editImage:null,
        }
    },
    methods:{
        ...mapActions('category',['editCategory']),

        EditCat() {
            let name = document.querySelector(".nameCat")
            let unit = document.querySelector(".unitCat")
            let data = new FormData()
            data.append('name',name.value)
            data.append('unit',unit.value)
            data.append('icon',this.editImage)
            let payload = {
                data:data,
                id:this.EditObj.id
            }
            this.editCategory(payload)
        },
        close(){
            this.$emit('close')
        },
        getImage(e){
            this.editImage = e.target.files[0]
            console.log(this.editImage)
        }
    },
    computed:{
        ...mapGetters('category',['loadingStatus3'])
    },
    watch:{
        loadingStatus3(val){
            if (!val) {
                this.$emit('close')
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
