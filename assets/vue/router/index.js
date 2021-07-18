import Vue from "vue"
import VueRouter from "vue-router"
import BookList from "../views/BookList";
import AddBook from "../views/AddBook";
import UserList from "../views/UserList";
import AddUser from "../views/AddUser";
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
            path: "/users",
            component: UserList
        },
        {
            path: "/add-user",
            component: AddUser
        }
        // {
        //     path: "*",
        //     redirect: "/books"
        // },
    ]
})