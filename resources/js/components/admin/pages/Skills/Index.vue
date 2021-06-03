<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>My Skills</h4>
                      <router-link  :to="{name: 'admin-skill-create'}" class="btn btn-sm btn-primary">Create new  &nbsp;<i class="fas fa-plus"></i></router-link>
                  </div>
                  <div class="card-body">
                      <div v-if="skills.length > 0" class="table-responsive">
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Skill Name</th>
                                    <th>Descripttion</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(skill,i) in skills" :key="i">
                                    <td><img alt="image" :src="'/upload/skill/icon/'+skill.icon" width="35"></td>
                                    <td>{{ skill.name }}</td>
                                    <td>{{ skill.desc }}</td>
                                    <td>
                                        <router-link :to="{ name: 'admin-edit-skill',params:{id:skill.id} }" class="btn btn-sm btn-primary" type="Edit"><i class="fas fa-edit"></i></router-link>
                                        <button @click="removeSkill(skill.id,i)" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center">
                        <h6 class="text-muted">You have no skills</h6>
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
            skills : []
        }
    },
    created(){
        this.geSkills();
    },
    methods:{
        geSkills(){
            axios.get('/admin/get-skills')
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.skills = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        removeSkill(skillId,index){

            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, can't be restored!!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#73e375',
                confirmButtonText: 'Delete'
            }).then((data)=>{
                if(data.isConfirmed){
                    axios.post(`/admin/delete-skill`,{
                        id: skillId
                    })
                    .then((resp)=>{
                        return resp.data;
                    }).then((data)=>{
                        if(data.status == "OK")
                        {
                            this.skills.splice(index,1);
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