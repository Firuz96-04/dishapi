<template>
    <div class="modal__wrapper">
        <div class="modal_content">
            <div class="modal_header">
                <div class="delelete_title">
                    <span>Удалить Категорию</span>
                </div>
                <div class="btn_close" @click="close">
                    <span>X</span>
                </div>
            </div>
            <div class="delete_warning">
                <h5>Вы уверены что хотите удалить {{ deleteName }}</h5>
            </div>
            <div class="delete_footer">
                <button class="btn btn-dark" @click="close">Отмена</button>
                <button class="btn btn-danger" @click="deleteCat">Удалить</button>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters, mapActions} from "vuex"

export default {
    data() {
        return {

        }
    },
    props: {
        deleteName: {
            type: String
        },
        deleteId: {
            type: [Number,String]
        }
    },
    methods: {
        ...mapActions('category', ['deleteCategory']),
        close() {
            this.$emit('close')
        },
        deleteCat() {
            console.log(this.deleteId)
            this.deleteCategory(this.deleteId)
        }
    },
    computed: {
        ...mapGetters('category',['loadingStatus2'])
    },
    watch:{
        loadingStatus2(val){
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
    width: 600px;
}

.modal_header {
    display: flex;
    justify-content: space-between;
}

.delelete_title span {
    font-weight: bold;
}

.btn_close span {
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
}

.delete_footer {
    display: flex;
    justify-content: flex-end;
}

.delete_footer button {
    margin-right: 5px;
}

.btn_close span {
    font-size: 16px;
    font-weight: bold;
}
</style>
