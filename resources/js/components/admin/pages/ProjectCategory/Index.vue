<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>Project Categories</h4>
                      <router-link  :to="{name: 'admin-project-ctg-create'}" class="btn btn-sm btn-primary">Create new category <i class="fas fa-plus"></i></router-link>
                  </div>
                  <div class="card-body">
                      <div v-if="ctgs.length > 0" class="table-responsive">
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Total Posts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ctg,i) in ctgs" :key="i">
                                    <td>{{ i+1 }}</td>
                                    <td>{{ ctg.name }}</td>
                                    <td>{{ ctg.projects.length }}</td>
                                    <td>
                                        <router-link :to="{name:'admin-project-ctg-edit',params:{id:ctg.id}}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></router-link>
                                        <button @click="deleteCtg(ctg.id,i)" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center">
                        <h6 class="text-muted">No categories</h6>
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
        return{
            ctgs: []
        }
    },
    created(){
        this.getProjectCategories();
    },
    methods:{
        getProjectCategories(){
            axios.get("/api/get-project-category").then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.ctgs = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        deleteCtg(ctgId,index){
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, can't be restored!!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: 'forestgreen',
                confirmButtonText: 'Delete'
            }).then((data)=>{
                if(data.isConfirmed){
                    axios.post(`/admin/project-ctg-delete`,{
                        id: ctgId
                    })
                    .then((resp)=>{
                        return resp.data;
                    }).then((data)=>{
                        if(data.status == "OK")
                        {
                            this.ctgs.splice(index,1);
                            Swal.fire({
                                title: "Success",
                                text: data.msg,
                                icon: 'success'
                            });
                        }
                        else
                        {
                            Swal.fire({
                                title: "Failed",
                                text: "Server responded with some error",
                                icon: 'error'
                            });
                        }
                    }).catch((err)=>{
                        console.error(err.response.data);
                    });
                }
            });
        }
    }
}
</script>

<style>

</style>