<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="delelete_title">
                    <span>Добавить Рецепт</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="add_body">
                <form  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Рецепт</label>
                        <input type="text" class="form-control" v-model="recipedata.name" id="exampleFormControlInput1" placeholder="Рецепт">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Категория</label>
                        <select class="form-control" v-model="recipedata.category_id"  id="exampleFormControlSelect1">
                            <option v-for="item in categoryList" :value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2" class="form-label">Ккал</label>
                        <input type="text" class="form-control" v-model="recipedata.kkal" id="exampleFormControlInput2"  placeholder="Ккал">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput3" class="form-label">Описание</label>
                        <input type="text" class="form-control" v-model="recipedata.description" id="exampleFormControlInput3"  placeholder="Описание">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput4" class="form-label">Количество человек</label>
                        <input type="number" class="form-control" v-model="recipedata.count_people" id="exampleFormControlInput4"  placeholder="Количество человек">
                    </div>
                    <div class="form-group">
                        <label for="formFileLg" class="form-label">Выберите картинку</label>
                        <input class="form-control" type="file" ref="my_image"  id="formFileLg" @change="imageRecipe" >
                    </div>
                </form>
            </div>
            <div class="add_footer">
                <button class="btn btn-success" @click="addRecipes">Добавить</button>
                <button class="btn btn-dark" @click="close">Отмена</button>
            </div>

        </div>
    </div>
</template>

<script>
import {mapActions,mapGetters} from "vuex"
export default {
    props:{
      categoryList:{
          type:Object
      }
    },
    data() {
        return {
                recipedata:{
                    name:null,
                    kkal:null,
                    description:null,
                    count_people:null,
                    recipe_image:null,
                    category_id:null
                }
        }
    },
    methods:{
        ...mapActions('recipe',['addRecipe']),
        close() {
            this.$emit('close')
            this.recipedata.name = ''
            this.recipedata.kkal = ''
            this.recipedata.description = ''
            this.recipedata.count_people = ''
        },
        imageRecipe(e){
           let image =  e.target.files[0]
            this.recipedata.recipe_image = image

        },
        addRecipes(){
           const data = new FormData()
            data.append('name',this.recipedata.name)
            data.append('kkal',this.recipedata.kkal)
            data.append('description',this.recipedata.description)
            data.append('count_people',this.recipedata.count_people)
            data.append('recipe_image',this.recipedata.recipe_image)
            data.append('category_id',this.recipedata.category_id)
            this.addRecipe(data)
            console.log(data)
        }
    },
    computed:{
        ...mapGetters('recipe',['statusloading2']),
    },
    watch:{
        statusloading2(val) {
            if (!val){
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
