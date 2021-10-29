<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="delelete_title">
                    <span>Добавить Ингредиент</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="add_body">
            <form  enctype="multipart/form-data">
                <div class="">
                    <label for="exampleFormControlInput1" class="form-label">Ингредиент</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" v-model="ingredient.name" placeholder="Ингредиент">
                </div>
                <div class="">
                    <label for="exampleFormControlInput2" class="form-label">Ед. изм</label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" v-model="ingredient.unit" placeholder="Ед. изм">
                </div>
                <div>
                    <label for="formFileLg" class="form-label">Выберите картинку</label>
                    <input class="form-control" ref="my_image" @change="changeImage" id="formFileLg" type="file">
                </div>
            </form>
            </div>
            <div class="add_footer">
                <button  @click="addIngredient" class="btn btn-success">Добавить</button>
                <button class="btn btn-dark" @click="close">Отмена</button>
            </div>

        </div>
    </div>
</template>

<script>
import {mapActions,mapGetters} from "vuex"
export default {
    data() {
        return {
            ingredient:{
                name:"",
                unit:"",
                image:""
            }
        }
    },
    methods:{
        ...mapActions('ingredient',['getData']),
        close() {

            this.$emit('close')
            this.ingredient.name = ''
            this.ingredient.unit = ''
            this.$refs.my_image.type='text';
            this.$refs.my_image.type='file';
        },
        changeImage(e) {
               this.ingredient.image =  e.target.files[0]
        },
        addIngredient() {
            let data = new FormData()
            data.append('name',this.ingredient.name)
            data.append('unit',this.ingredient.unit)
            data.append('icon',this.ingredient.image)
            console.log(data)
            console.log(this.image)
             this.getData(data)
        }
    },
    computed:{
        ...mapGetters('ingredient',['loadingStatus']),
    },
    watch:{
        loadingStatus(val) {
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
