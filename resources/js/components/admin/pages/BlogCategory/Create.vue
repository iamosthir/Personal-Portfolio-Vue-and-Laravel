<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>Create Blog Categories</h4>
                      <router-link :to="{name:'admin-blog-ctg'}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Go back</router-link>
                  </div>
                  <div class="card-body">
                      <form action="#" @submit.prevent="createProjectCategory" id="myForm">
                          <div class="row">
                              <div class="col-md-6 form-group">
                                  <label for="">Category Name</label>
                                  <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                   placeholder="Category name" name="name" v-model="form.name">
                                  <has-error :form="form" field="name"></has-error>
                              </div>
                              <div class="col-12 form-group">
                                  <button :disabled="form.busy" class="btn btn-success" type="submit">
                                      <span v-if="form.busy" class="spinner-border spinner-border-sm"></span>
                                      Create
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
            form: new Form({
                name: "",
            })
        }
    },
    methods:{
        createProjectCategory(){
            this.form.post("/admin/create-blog-category").then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status=="OK")
                {
                    $('#myForm').trigger("reset");
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