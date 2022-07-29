<template>

<div>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">

            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
              class="fas fa-user-secret me-2"></i> <p>Writer id: {{active_writer.id}}</p>
            </div>

               <router-link :to="{name:'add_writer'}" class="btn btn-success ms-1 mb-2" v-if="!is_active">
               <i class="fas fa-project-diagram me-3"></i>Add Writer</router-link>

               <router-link :to="{name:'admin_dashboard'}" class="btn btn-danger ms-1 mb-2" v-if="!is_active">
               <i class="fas fa-project-diagram me-1"></i>Enter Admin</router-link>
              
                <div class="list-group list-group-flush my-3" v-if="is_active">

                  <button class="btn btn-danger ms-1 mb-2" @click="delete_writer(active_writer.id)">Delete your account</button>

                  <router-link :to="{name:'edit', params: { id: active_writer.id }}" class="btn btn-primary ms-1 mb-2">
                  <i class="fas fa-project-diagram me-2"></i>Edit Profile</router-link>

                  <router-link :to="{name:'create_post', params: { id: active_writer.id }}" class="btn btn-primary ms-1 mb-2">
                  <i class="fas fa-project-diagram me-2"></i>create post</router-link>

                  <router-link :to="{name:'my_post', params: { id: active_writer.id }}" class="btn btn-primary ms-1">
                  <i class="fas fa-project-diagram me-2"></i>My Post</router-link>

                  <button class="btn btn-warning ms-1 mt-2" @click="toggle_profile_button">Show Profile</button>

                  <div class="mt-2 ms-2 mb-0" v-if="is_showing_profile">
                    <h6>First name: {{active_writer.first_name}}</h6>
                    <h6>Last name: {{active_writer.last_name}}</h6>
                    <h6>Email: {{active_writer.email}}</h6>
                    <h6>Gender: {{active_writer.gender}}</h6>
                    <h6 v-if="active_writer.writer_access == 1">Category Access: 2 only</h6>
                    <h6 v-else>Category Access: all</h6>
                  </div>

                  <a href="" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                      class="fas fa-power-off me-2"></i>Logout</a>
                </div>
         </div>

        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->

        <div id="page-content-wrapper">
    
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center" v-if="is_active">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold text-dark" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>{{active_writer.first_name}}
                            </a>

                            <div class="dropdown">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div v-for="writer in writers" :key="writer.id">
                                    <button @click="switch_account(writer.id)">{{writer.first_name}}</button>
                                    </div>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Looping Post Data -->

            <div v-for="post in posts" :key="post.id" v-if="is_active">

                <div class=" container card card-block mb-4" style="width: 40rem;">
                    <h3 class="card-title">{{post.title}}</h3>
                      <p class="card-text">{{post.text}}</p>
                        <h6>Category: {{post.categories[0].type}} blog</h6>
                        <h6>Posted by: {{post.writer.first_name}}</h6>

                            <router-link :to="{name:'add_comment_on_post', params: { id: post.id, writer_id: active_writer.id }}" class="btn btn-success ms-4 mb-2">Add Comment</router-link>
                            <router-link :to="{name:'show_comments', params: { id: post.id}}" class="btn btn-info ms-4 mb-2">Show Comment</router-link>
                </div>
          <div>
            <!-- End For Post -->
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>

export default {

    data(){

        return{

            writers: [],
            active_writer: [],
            posts:[],
            comments: [],
            is_active: false,
            is_showing_profile: false
        }
    },

    created(){
        this.axios
            .get('api/writer/index')
            .then(response => {
                this.writers = response.data;
            });
    },
    
    methods:{

        delete_writer(id){
            this.axios
                .delete(`api/writer/delete/${id}`)
                this.$router.go();
        },
        
        switch_account(id) {
            this.axios
            .get(`api/writer/show/${id}`)
            .then(response => {
                this.active_writer = response.data;

                  this.axios
                    .get('api/post/index')
                    .then(response => {
                        this.posts = response.data;
                    });
            });
            
             this.is_active = true;
        },

        toggle_profile_button()
        {
            this.is_showing_profile = !this.is_showing_profile;
        }
    }
}

</script>

<style scoped>
@import '../../assets/css/DashboardStyle.css';
</style>