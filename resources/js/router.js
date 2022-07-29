import Vue from "vue";
import VueRouter from "vue-router";

import Dashboard from "./layouts/Writer/WriterDashboard.vue";
import AdminDashboard from "./layouts/Admin/AdminDashboard.vue";

import AddWriter from "./layouts/Writer/AddWriter.vue";
import EditWriter from "./layouts/Writer/WriterEdit.vue";

import ShowComments from "./layouts/Comment/ShowComment.vue";
import AddCommentOnPost from "./layouts/Comment/AddCommentOnPost.vue";
import EditComment from "./layouts/Comment/EditComment.vue";

import CreatePost from "./layouts/Post/CreatePost.vue";
import EditPost from "./layouts/Post/EditPost.vue";
import MyPost from "./layouts/Post/MyPost.vue";



Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        
        {
            name: 'dashboard',
            path: '',
            component: Dashboard
        },

        {
            name: 'admin_dashboard',
            path: '/admin_dashboard',
            component: AdminDashboard
        },

        {
            name: 'add_writer',
            path: '/add_writer',
            component: AddWriter
        },

        {
            name: 'edit',
            path: '/edit',
            component: EditWriter
        },

        {
            name: 'show_comments',
            path: '/show_comments',
            component: ShowComments
        },

        {
            name: 'create_post',
            path: '/create_post',
            component: CreatePost
        },

        {
            name: 'edit_post',
            path: '/edit_post',
            component: EditPost
        },    
        
        {
            name: 'add_comment_on_post',
            path: '/add_comment_on_post',
            component: AddCommentOnPost
        },

        {
            name: 'edit_comment',
            path: '/edit_comment',
            component: EditComment
        },


        {
            name: 'my_post',
            path: '/my_post',
            component: MyPost
        },
    ],

    mode: 'history'
});