import axios from "axios";

export default {
    namespaced: true,
    state() {
        return {
            category: [],
            loadingStatus:false,
            loadingStatus2:false,
            loadingStatus3:false
        }
    },
    mutations: {
        category(state, payload) {
            return state.category = payload
        },
        loadingStatus(state,newLoading) {
            return state.loadingStatus = newLoading
        },
        loadingStatus2(state,newLoading){
            return state.loadingStatus2 = newLoading
        },
        loadingStatus3(state,newLoading) {
            return state.loadingStatus3 = newLoading
        }

    },
    actions: {
        async categoryAll(ctx) {
            try {
                const res = await fetch("/api/category")
                const data = await res.json()

                ctx.commit('category', data.category)
            } catch (error) {
                console.log(error)
            }
        },
        async deleteCategory(ctx, id) {
            ctx.commit('loadingStatus2',true)
            axios.delete(`api/category/${id}`,)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('categoryAll')
                    ctx.commit('loadingStatus2',false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async addCategory(ctx, payload) {
            ctx.commit('loadingStatus',true)
            axios.post(`api/category/`, payload)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('categoryAll')
                    ctx.commit('loadingStatus',false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async editCategory(ctx, payload) {
            ctx.commit('loadingStatus3',true)
            axios.post(`api/category_update/${payload.id}`,payload.data)
                .then(response=> {
                    console.log(response)
                    ctx.dispatch('categoryAll')
                    ctx.commit('loadingStatus3',false)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    getters: {
        categoryGet(state) {
            return state.category
        },
        loadingStatus(state) {
            return state.loadingStatus
        },
        loadingStatus2(state){
            return state.loadingStatus2
        },
        loadingStatus3(state){
            return state.loadingStatus3
        }
    }
}
