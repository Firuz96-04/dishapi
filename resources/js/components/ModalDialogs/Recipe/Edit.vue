<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Редактировать Рецепт</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="edit_body">
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-label">Рецепт</label>
                        <input type="text" class="form-control namerecipe" :value="recipeObj.name"
                               id="exampleFormControlInput1"
                               placeholder="Рецепт">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Категория</label>
                        <select class="form-control" @change="onselect($event)"  id="exampleFormControlSelect1">
                            <option v-for="item in categoryObj" :value="item.id" :selected="item.id === recipeObj.category_id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2" class="form-label">Ккал</label>
                        <input type="text" class="form-control kkalrecipe" :value="recipeObj.kkal"
                               id="exampleFormControlInput2"
                               placeholder="Ккал">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3" class="form-label">Описание</label>
                        <input type="text" class="form-control descrecipe" :value="recipeObj.description"
                               id="exampleFormControlInput3"
                               placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput4" class="form-label">Количество человек</label>
                        <input type="number" class="form-control countrecipe" :value="recipeObj.count_people"
                               id="exampleFormControlInput4"
                               placeholder="Количество человек">
                    </div>
                    <div class="image_block m-1">
                        <img v-if="recipeObj.recipe_image !=null" alt="..."
                             :src="'/storage/' + recipeObj.recipe_image" width="90" height="90">
                        <img v-else :src="'/storage/default.png'" alt="..." width="90"
                             height="90">
                    </div>
                    <div>
                        <label for="formFileLg" class="form-label">Выберите картинку</label>
                        <input class="form-control" id="formFileLg" @change="recipeImage" type="file">
                    </div>
                </form>
            </div>
            <div class="edit_footer">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-warning" @click="editMethod(recipeObj.category_id)">Редактировать</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex"

export default {
    props: {
        recipeObj: {
            type: Object
        },
        categoryObj: {
            type: Object
        },

    },
    data() {
        return {
            recipeGetImage: null,
            categoty_inc: 3,
            selectF:null
        }
    },
    methods: {
        ...mapActions('recipe', ['updateRecipe']),
        close() {
            this.$emit('close')
            this.selectF =null
        },
        recipeImage(e) {
            this.recipeGetImage = e.target.files[0]
            const image = e.target.files[0]
            console.log(image)
        },
        onselect(e) {
            this.selectF = e.target.value
        },
        editMethod(id) {
            let elem =""
            if (this.selectF == null) {
                elem = id
            }
            else {
                elem = this.selectF

            }
         //   console.log(elem)
            const data = new FormData()
            let name_recipe = document.querySelector('.namerecipe').value
            let kkal_recipe = document.querySelector('.kkalrecipe').value
            let desc_recipe = document.querySelector('.descrecipe').value
            let count_recipe = document.querySelector('.countrecipe').value
            data.append('name', name_recipe)
            data.append('kkal', kkal_recipe)
            data.append('description', desc_recipe)
            data.append('count_people', count_recipe)
            data.append('recipe_image', this.recipeGetImage)
            data.append('category_id',elem)
            let payload = {
                data: data,
                id: this.recipeObj.id
            }
            this.updateRecipe(payload)
        }
    },
    computed: {
        ...mapGetters('recipe', ['statusloading3'])
    },
    watch: {
        statusloading3(val) {
            if (!val) {
                this.$emit('close')
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

.image_block {
    display: flex;
    justify-content: center;
}
</style>
