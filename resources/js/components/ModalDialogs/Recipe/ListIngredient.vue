<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="edit_title">
                    <span>Список Ингредиентов {{recipe_name}}</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>

            </div>
            <div class="edit_body">
                <div v-for="item in listdata" class="card m-1" style="width: 7rem;">
                    <img v-if="item.icon !=null" class="card-img-top" alt="..." width="70" height="70"
                         :src="'/storage/' + item.icon">
                    <img v-else :src="'/storage/default.png'" class="card-img-top" alt="..." width="70" height="70">
                    <label style="text-align: center;font-weight: bold">Имя</label>
                    <span style="text-align: center">{{ item.name }}</span>
                    <label style="text-align: center;font-weight: bold">Количество</label>
                    <span style="text-align: center">{{ item.pivot.count }}</span>
                    <button class="btn btn-dark m-1" @click="deleteIngList(item.pivot.id)">Удалить</button>

                </div>
            </div>
            <div class="edit_footer">

            </div>
        </div>
    </div>
</template>

<script>
import {mapActions,mapGetters} from "vuex"
export default {
    props: {
        listdata: {
            type: Object
        },
        recipe_name:{
            type:String
        }
    },
    data() {
        return {}
    },
    methods: {
        close() {
            this.$emit('close')
        },
        ...mapActions('recipe',['deleteRecipeIng']),
        deleteIngList(id) {
            this.deleteRecipeIng(id)
            console.log(id)
        }
    },
    computed:{
        ...mapGetters('recipe',['recipeIngredModel'])
    },
    watch:{
        recipeIngredModel(val) {
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
    max-width: 800px;
    padding: 10px 15px;
    background-color: #fff;
    border: 1px solid #dcdfe6;
    transition: all .2s ease;
    border-radius: 8px;
    z-index: 999;
    overflow: hidden;
    width: 600px;
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

.edit_body {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}
</style>
