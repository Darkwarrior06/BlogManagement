<template>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">
                  
                  <h2 class="fw-bold mb-2 text-uppercase">Edit Comment</h2>

                    <form @submit.prevent="edit_comment">

                      <div class="form-outline form-white mb-4">
                          <input type="text" v-model="comment.text" class="form-control form-control-lg" required/>
                          <label class="form-label">Text</label>
                      </div>

                      <div class="form-outline form-white mb-4">
                          <input type="time" v-model="comment.time" class="form-control form-control-lg" required/>
                          <label class="form-label">Time</label>
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Update Comment</button>

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

  export default {

    data(){
      return {

        comment:{}
      }
    },

    created(){
        this.axios
            .get(`api/comment/show/${this.$route.params.id}`)
            .then(response => {
                this.comment = response.data;
            });
    },

    methods: {
      edit_comment(){
            this.axios
                .put(`api/comment/edit/${this.comment.id}`, this.comment)
                .then(response => {
                        this.$router.push({ path: './' });
                    })
                .catch(err => console.log(err))
                .finally(() => this.loading = true)
        }
    }
  }

</script>

