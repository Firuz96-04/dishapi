import {createStore} from "vuex";
import ingredient from "./ingredient";
import category from "./category";
import recipe from "./recipe";
import recipeStep from "./recipestep";
export default createStore({
    modules:{
        ingredient,
        category,
        recipe,
        recipeStep
    }
})
