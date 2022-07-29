<template>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Update</h2>
              <p class="text-white-50 mb-5">Update Account</p>

               <form @submit.prevent="edit_writer()">
                  <div class="form-outline form-white mb-4">
                    <input type="text" v-model="writer.first_name" class="form-control form-control-lg" required/>
                    <label class="form-label" for="typeEmailX">First Name</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="text" v-model="writer.last_name" class="form-control form-control-lg" required/>
                    <label class="form-label" for="typeEmailX">Last Name</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="text" v-model="writer.gender" class="form-control form-control-lg" required/>
                    <label class="form-label" for="typeEmailX">Gender</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="email" v-model="writer.email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="typeEmailX">Email</label>
                  </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Update Profile</button>

               </form>

                 <button class="btn btn-danger mt-4" @click="$router.push('./')">Cancel</button>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</template>

<script>

export default{

    data(){
        return{

            writer: {}
        }
    },

    created(){
        this.axios
            .get(`api/writer/show/${this.$route.params.id}`)
            .then(response => {
                this.writer = response.data;
            });
    },

    methods:{
        edit_writer(){
            this.axios
                .put(`api/writer/edit/${this.$route.params.id}`, this.writer)
                .then(response => {
                        this.$router.push({ path: './' });
                    })
                .catch(err => console.log(err))
                .finally(() => this.loading = true)
        }
    }
}

</script>
