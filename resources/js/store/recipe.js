import axios from "axios";

export default {
    namespaced: true,
    state() {
        return {
            statusloading: false,
            statusloading2: false,
            statusloading3: false,
            statusloading4: false,
            recipeIngredModel:false,
            recipes: [],
            closeModelStep: false,
            deleteModelStep:false,
            closeModelUpdate:false
        }
    },
    mutations: {
        statusloading(state, newLoading) {
            return state.statusloading = newLoading
        },
        closeModelStep(state, loading) {
            return state.closeModelStep = loading
        },
        statusloading2(state, newLoading) {
            return state.statusloading2 = newLoading
        },
        statusloading3(state, newLoading) {
            return state.statusloading3 = newLoading
        },
        statusloading4(state,newLoading) {
            return state.statusloading4 = newLoading
        },
        recipeIngredModel(state,newloading){
            return state.recipeIngredModel = newloading
        },
        deleteModelStep(state,newloading) {
            return state.deleteModelStep =newloading
        },
        recipes(state, payload) {
            return state.recipes = payload
        },
        closeModelUpdate(state,newloading) {
            return state.closeModelUpdate = newloading
        }
    },
    actions: {
        async allRecipe(ctx) {
            try {
                const res = await fetch("api/recipe")
                const data = await res.json()
                console.log(data.recipe)
                ctx.commit("recipes", data.recipe)
            } catch (error) {
                console.log(error)
            }
        },
        addRecipe(ctx, payload) {
            ctx.commit('statusloading2', true)
            axios.post(`api/recipe`, payload)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('allRecipe')
                    ctx.commit('statusloading2', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        addRecipeToIngredient(ctx, payload) {
            ctx.commit('statusloading4',true)
            console.log(payload)
            axios.post("api/recipe_to_ingredient", payload)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('allRecipe')
                    ctx.commit('statusloading4',false)
                })
                .catch(error => {

                    console.log(error)
                })
        },
        addRecipStep(ctx, payload) {
            console.log(payload)
            ctx.commit('closeModelStep',true)
            axios.post(`api/recipe_step`, payload)
                .then(response => {
                    ctx.commit('closeModelStep',false)
                    ctx.dispatch('allRecipe')
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deleteStep(ctx,id) {
            ctx.commit('deleteModelStep',true)
            axios.delete(`api/recipe_step/${id}`)
                .then(response=> {
                    console.log(response)
                    ctx.dispatch('allRecipe')
                    ctx.commit('deleteModelStep',false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        updateRecipeStep(ctx, payload) {
            ctx.commit('closeModelUpdate',true)
            axios.patch(`api/recipe_step/${payload.id}`,{
                "step_number" : payload.step_number,
                "recipe_id" : payload.recipe_id,
                "time_step" : payload.time_step,
                "description" : payload.description,
                "ingredient_id" : payload.ingredient_id
            })
                .then(response => {
                    ctx.dispatch('allRecipe')
                    ctx.commit('closeModelUpdate',false)
                    console.log(response)
                })
        },
        deleteRecipe(ctx, id) {
            ctx.commit('statusloading', true)
            axios.delete(`api/recipe/${id}`)
                .then(response => {
                    console.log(response.recipe)
                    ctx.dispatch("allRecipe")
                    ctx.commit('statusloading', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        updateRecipe(ctx, payload) {
            ctx.commit('statusloading3', true)
            axios.post('api/recipe_update/' + payload.id, payload.data)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('allRecipe')
                    ctx.commit('statusloading3', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deleteRecipeIng(ctx,id) {
            ctx.commit('recipeIngredModel',true)
            axios.delete(`api/recipe_ingredient_delete/${id}`)
                .then(response => {
                    console.log(response)
                    ctx.dispatch('allRecipe')
                    ctx.commit('recipeIngredModel',false)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    getters: {
        statusloading(state) {
            return state.statusloading
        },
        statusloading2(state) {
            return state.statusloading2
        },
        statusloading3(state) {
            return state.statusloading3
        },
        statusloading4(state) {
            return state.statusloading4
        },
        getRecipes(state) {
            return state.recipes
        },
        recipeIngredModel(state) {
            return state.recipeIngredModel
        },
        closeModelStep(state) {
            return state.closeModelStep
        },
        deleteModelStep(state) {
            return state.deleteModelStep
        },
        closeModelUpdate(state) {
            return state.closeModelUpdate
        }
    },
}
