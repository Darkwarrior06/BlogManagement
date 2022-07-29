<template>

    <div>
          <button class="btn btn-danger mt-4 ms-4" @click="$router.push('./')">return</button>
        <div v-for="post in posts" :key="post.id">
            <div class=" container card card-block mt-4" style="width: 40rem;">

                <h3 class="card-title">{{post.title}}</h3>
                <p class="card-text">{{post.text}}</p>
                <h6>Category: {{post.categories[0].type}} blog</h6>
                <h6>Posted by: {{post.writer.first_name}}</h6><br>

                <router-link :to="{name:'edit_post', params: { id: post.id }}" class="btn btn-success ms-4 mb-2">Edit</router-link>
                <button class="btn btn-danger ms-4 mb-2" @click="delete_post(post.id)">Delete</button>
        </div>
        </div>
    </div>

</template>

<script>

export default {

        data(){
            return{

                posts:[]
            }
        },

        created(){
            this.axios
                .get(`api/writer/show_posts/${this.$route.params.id}`)
                .then(response => {
                    this.posts = response.data;
                });
        },

        methods:{
            delete_post(id) { 
                this.axios
                    .delete(`api/post/delete/${id}`)
                    .then(response => {
                        let i = this.posts.map(data => data.id).indexOf(id);
                        this.posts.splice(i, 1)
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