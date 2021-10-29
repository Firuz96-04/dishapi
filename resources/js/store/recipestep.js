import axios from "axios";
import recipe from "./recipe";
export default {
    namespaced: true,
    state() {
        return {
            recipeStepList: {},
            closeModelStep: false,
            closeModelUpdate:false
        }
    },
    mutations: {
        recipeStep(state, payload) {
            state.recipeStepList = payload
        },
        closeModelStep(state, loading) {
            return state.closeModelStep = loading
        },
        closeModelUpdate(state,loading) {
            return state.closeModelUpdate = loading
        }
    },
    actions: {
        async recipeStepAll(ctx, id) {
            try {
                const res = await fetch(`api/recipe_step/${id}`)
                const data = await res.json()
                console.log(data.recipe_step)
                ctx.commit('recipeStep', data.recipe_step)
            } catch (error) {
                console.log(error)
            }
        },
    },
    getters: {
        recipeStepList(state) {
            return state.recipeStepList
        },
        closeModelStep(state) {
            return state.closeModelStep
        },
        closeModelUpdate(state) {
            return state.closeModelUpdate
        }
    }
}
