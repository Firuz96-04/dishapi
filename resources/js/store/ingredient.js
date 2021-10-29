import axios from "axios"

export default {
    namespaced: true,
    state() {
        return {
            ingredients: [],
            loadingStatus: false,
            loadingStatus2: false
        }
    },
    mutations: {
        mutIngredient(state, payload) {
            state.ingredients = payload
        },
        loadingStatus(state, newLoading) {
            state.loadingStatus = newLoading
        },
        loadingStatus2(state, newLoading) {
            state.loadingStatus2 = newLoading
        }

    },
    actions: {
        async ActIngredient(ctx) {
            const response = await fetch("/api/ingredient");
            const data = await response.json()
            console.log(data.ingredient)
            ctx.commit('mutIngredient', data.ingredient)

        },
        async ActDelete(ctx, id) {
            axios.delete(`/api/ingredient/${id}`)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('ActIngredient')
                })
        },
        async getData(ctx, obj) {
            ctx.commit('loadingStatus', true)
            console.log(obj)
            axios.post("/api/ingredient", obj)
                .then(response => {
                    console.log(response)

                    ctx.dispatch('ActIngredient')
                    ctx.commit('loadingStatus', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },

        async updateIngredient(ctx, payload) {
            ctx.commit('loadingStatus2', true)
            console.log(payload.date)
            axios.post(`/api/ingredient_update/${payload.id}/`, payload.date)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('ActIngredient')
                    ctx.commit('loadingStatus2', false)
                })
        }
    },
    getters: {

        getIngredient(state) {
            return state.ingredients
        },
        loadingStatus(state) {
            return state.loadingStatus
        },
        loadingStatus2(state) {
            return state.loadingStatus2
        }
    }
}
