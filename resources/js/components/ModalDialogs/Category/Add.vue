<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="delelete_title">
                    <span>Добавить Категорию</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="add_body">
                <form >
                    <div class="">
                        <label for="exampleFormControlInput1" class="form-label">Категория</label>
                        <input type="text" class="form-control" v-model="categoryDate.name" id="exampleFormControlInput1"  placeholder="Категория">
                    </div>
                    <div class="">
                        <label for="exampleFormControlInput2" class="form-label">Ед. изм</label>
                        <input type="text" class="form-control" v-model="categoryDate.unit"  id="exampleFormControlInput2"  placeholder="Ед. изм">
                    </div>
                    <div>
                        <label for="formFileLg" class="form-label">Выберите картинку</label>
                        <input class="form-control" @change="getImageCat" id="formFileLg" type="file">
                    </div>
                </form>
            </div>
            <div class="add_footer">
                <button  @click="addCategoryForm" class="btn btn-success">Добавить</button>
                <button class="btn btn-dark" @click="close">Отмена</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions,mapGetters} from "vuex"
export default {
    data() {
        return{
            categoryDate:{
                name:'',
                unit:'',
                icon:null
            }
        }
    },
    methods :{
        close() {
            this.$emit('close')
            this.categoryDate.name = ''
            this.categoryDate.unit = ''
        },
        getImageCat(e) {
            console.log(e)
            this.categoryDate.icon = e.target.files[0]
            console.log(this.categoryDate.icon)
        },
        ...mapActions('category',['addCategory']),

        addCategoryForm() {
            let date = new FormData()
                date.append('name',this.categoryDate.name)
                date.append('unit',this.categoryDate.unit)
                date.append('icon',this.categoryDate.icon)
            this.addCategory(date)
            console.log(date)
        },
    },
    computed:{
        ...mapGetters('category',['loadingStatus'])
    },
    watch:{
        loadingStatus(val) {
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
    width: 500px;
}
.modal_header{
    display: flex;
    justify-content: space-between;
}
.btn_close span{
    cursor: pointer;
    font-weight: bold;
}
.add_footer{
    display: flex;
    margin-top: 5px;
    justify-content: flex-end;
}
.add_footer button{
    margin-right: 5px;
}
.delelete_title span{
    font-weight: bold;
    font-size: 18px;
}
</style>
