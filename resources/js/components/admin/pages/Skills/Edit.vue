<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <router-link :to="{name:'admin-skill'}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Go back</router-link>
                  </div>
                  <div class="card-body">
                      <alert-errors :form="form">There were some problems with your input.</alert-errors>
                      <form action="#" @submit.prevent="updateSkill" id="skillForm">
                          <div class="row">
                              <div class="col-md-6 form-group">
                                  <label for="">Skill Name</label>
                                  <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                   placeholder="Skill name" name="name" v-model="form.name">
                                  <has-error :form="form" field="name"></has-error>
                              </div>
                              <div class="col-12 form-group">
                                  <label for="">Small Description about this skill</label>
                                  <textarea name="desc" class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('desc') }"
                                   placeholder="Describe your skill..." v-model="form.desc"></textarea>
                                  <has-error :form="form" field="desc"></has-error>
                              </div>
                              <div class="col-12 form-group">
                                  <img :src="'/upload/skill/icon/'+skill_icon" alt="" class="img-fulid" style="width:150px;height:150px;object-fit:cover;">
                              </div>
                              <div class="col-md-6 form-group">
                                  <label for="">Change the icon file (150x150 Recomended)</label>
                                  <input type="file" class="form-control-file" name="icon" @change="selectIcon" accept="image/*">
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
            form: new Form({
                name : "",
                icon : null,
                desc: "",
                id: this.$route.params.id,
            }),
            skill_icon: '',
        }
    },
    created(){
        this.fetchSkillData(this.$route.params.id);
    },
    methods:{
        selectIcon(e){
            const file = e.target.files[0];
            if(file)
            {
                this.form.icon = file;
            }
            else
            {
                this.form.icon = "";
            }
        },
        fetchSkillData(id){
            axios.get('/admin/get-skill-data',{
                params: {
                    id: id,
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.form.name = data.name;
                this.form.desc = data.desc;
                this.skill_icon = data.icon;
            }).catch((err)=>{
                console.error(err.response.data);
                this.$router.push({name: 'admin-skill'});
            });
        },
        updateSkill(){
            this.form.submit('post','/admin/update-skill',{
                transformRequest: [function(data,headers){
                    return serialize(data)
                }]
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status=="OK")
                {
                    this.skill_icon = data.new_icon;
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