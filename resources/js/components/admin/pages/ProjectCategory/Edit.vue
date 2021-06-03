<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>Edit Category</h4>
                      <router-link :to="{name:'admin-project-ctg'}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Go back</router-link>
                  </div>
                  <div class="card-body">
                      <alert-errors :form="form">There were some problems with your input.</alert-errors>
                      <form action="#" @submit.prevent="updateData" id="myForm">
                          <div class="row">
                              <div class="col-md-6 form-group">
                                  <label for="">Category Name</label>
                                  <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                   placeholder="Skill name" name="name" v-model="form.name">
                                  <has-error :form="form" field="name"></has-error>
                              </div>
                              <div class="col-12 form-group">
                                  <button :disabled="form.busy" class="btn btn-success" type="submit">
                                      <span v-if="form.busy" class="spinner-border spinner-border-sm"></span>
                                      Update
                                    </button>
                              </div>
                          </div>
                      </form>
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
            form : new Form({
                name: '',
                id: this.$route.params.id
            })
        }
    },
    created(){
        this.fetchData(this.$route.params.id);
    },
    methods:{

        fetchData(id){
            axios.get('/admin/get-project-category-data',{
                params: {
                    id: id,
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.form.name = data.name;
            }).catch((err)=>{
                console.error(err.response.data);
                this.$router.push({name: 'admin-project-ctg'});
            });
        },
        updateData(){
            this.form.post("/admin/project-ctg-update")
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status=="OK")
                {
                    Swal.fire({
                        title: "Success",
                        icon: "success",
                        text: data.msg
                    });
                }
                else
                {
                    Swal.fire({
                        title: "Failed",
                        icon: "error",
                        text: "Server responed with some error. See log for details",
                    });
                }
            }).catch((err)=>{
                console.error(err.response.data);
            });
        }
        
    }
}
</script>

<style>

</style>