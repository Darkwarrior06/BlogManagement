<template>
<div>

    <div class=" container card card-block mt-4" style="width: 40rem;">

        <h3 class="card-title">{{post.title}}</h3>
            <p class="card-text">{{post.text}}</p>
            <h6>Category: {{post.categories[0].type}} blog</h6>
            <h6>Posted by: {{post.writer.first_name}}</h6><br>

            <h5>Comments</h5>
            <!-- Looping The Comments -->
                <div class="mt-4" v-for="comment in comments" :key="comment.id">

                    <h6>{{comment.writer.first_name}}</h6>
                    <p class="card-text">{{comment.text}}</p>
                    <p class="card-text">Time: {{comment.time}}</p>

                    <div class="btn-group" role="group">
                        <router-link :to="{name:'edit_comment', params: { id: comment.id }}" class="btn text-primary">Edit</router-link>
                        <button class="btn text-primary ms-4 " @click="delete_comment(comment.id)">Delete</button>
                    </div>
                </div>
            <!-- End For Comment -->
              <button class="btn btn-danger mt-4" @click="$router.push('./')">Return</button>
    </div>
</div>
</template>

<script>

export default {

    data(){
        return{

            comments: [],
            post:{}
        }
    },
    mounted(){
        this.created();
    },
    

    methods:{
        created(){
            
            this.axios
                .get(`/api/post/show/${this.$route.params.id}`)
                .then(response => {
                    this.post = response.data;
                });

            this.axios
                .get(`/api/comment/show_comments_on_post/${this.$route.params.id}`)
                .then(response => {
                    this.comments = response.data;
                });
        },

        delete_comment(id) { 
            this.axios
                    .delete(`api/comment/delete/${id}`)
                    .then(response => {
                        let i = this.comments.map(data => data.id).indexOf(id);
                        this.comments.splice(i, 1);
                });
        },
    }
}
</script>

<style>
h1{
    color: white;
}
</style>