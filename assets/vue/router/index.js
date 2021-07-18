import Vue from "vue"
import VueRouter from "vue-router"
import BookList from "../views/BookList";
import AddBook from "../views/AddBook";
Vue.use(VueRouter)
export default new VueRouter({
    mode: "history",
    routes: [{
            path: "/books",
            component: BookList
        },
        {
            path: "/add-book",
            component: AddBook
        },
        {
            path: "*",
            redirect: "/books"
        },
    ]
})