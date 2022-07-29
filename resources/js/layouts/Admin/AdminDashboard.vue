<template>

<div>

<h1 class="text-dark">Writer List</h1>
<button class="btn btn-danger mb-4" @click="$router.push('./')">Quit</button>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Writer Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">Writer Access</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody v-for="writer in writers" :key="writer.id">
    <tr>
      <td>{{writer.id}}</td>
      <td>{{writer.first_name}}</td>
      <td>{{writer.last_name}}</td>
      <td>{{writer.email}}</td>
      <td>{{writer.gender}}</td>
      <td>{{writer.writer_access}}</td>
      <td>
        <button class="btn btn-danger ms-4" @click="delete_writer(writer.id)">Remove Account</button>
        <button class="btn btn-info ms-4" @click="give_access(writer.id)" v-if="writer.writer_access == 1">Give Access to all Category</button>
        <button class="btn btn-warning ms-4" @click="give_access(writer.id)" v-else>Remove Access to all Category</button>
      </td>
    </tr>
  </tbody>
</table>
</div>

</template>

<script>

export default{
    data(){
        return{

            writers:[],
            writer_for_giving_access: {},
            temp:{}
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

        delete_writer(id) { 
            
            this.axios
                .delete(`api/writer/delete/${id}`)
                .then(response => {
                    let i = this.writers.map(data => data.id).indexOf(id);
                    this.writers.splice(i, 1)
                });
        },

        give_access(id){

            this.axios
            .get(`api/writer/show/${id}`)
            .then(response => {
                this.writer_for_giving_access = response.data;

                    if(this.writer_for_giving_access.writer_access == "1")
                    {
                      this.writer_for_giving_access.writer_access = "0";
                    }
                    else{
                      this.writer_for_giving_access.writer_access = "1";
                    }

                this.axios
                .put(`api/writer/edit/${id}`, this.writer_for_giving_access)

                this.$router.go();
            })
            .catch(err => console.log(err))
            .finally(() => this.loading = true)
        }
    }
}

</script>