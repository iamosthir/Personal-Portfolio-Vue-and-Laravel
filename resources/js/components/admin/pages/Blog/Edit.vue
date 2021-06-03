<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>Make new project</h4>
                      <router-link :to="{name:'admin-projects'}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Go back</router-link>
                  </div>
                  <div class="card-body">
                      <form action="#" @submit.prevent="updateProject" id="projectForm">
                          <alert-errors :form="form">There were some problems with your input.</alert-errors>
                          <div class="row">
                              <div class="col-md-6 form-group">
                                  <label for="">Project Title</label>
                                  <input type="text" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" name="title" placeholder="Project title" v-model="form.title">
                                  <has-error :form="form" field="title"></has-error>
                              </div>

                              <div class="col-md-5 form-group">
                                  <label for="">Category</label>
                                  <select name="ctg" class="form-control" :class="{ 'is-invalid': form.errors.has('ctg') }" v-model="form.ctg">
                                      <option value="" hidden>Choose category</option>
                                      <option v-for="(ctg,i) in ctgs" :key="i" :value="ctg.id">{{ ctg.name }}</option>
                                  </select>
                                  <has-error :form="form" field="ctg"></has-error>
                              </div>

                              <div class="col-12 form-group">
                                 <label for="">Write your project description</label>
                                 <textarea class="summernote-simple" v-model="form.content"></textarea>
                                 <has-error :form="form" field="content"></has-error>
                             </div>

                              <div class="col-sm-12 form-group">
                                  <label for="">Set Thumbnail image</label> 
                                  <div id="image-preview" class="image-preview" :class="{ 'invalid': form.errors.has('thumb') }"
                                    :style="thumb_file">
                                      <label for="image-upload" id="image-label">Choose Thumbnail Image</label>
                                      <input type="file" name="image" id="image-upload" @change="selectFile">
                                    </div>
                                    <has-error :form="form" field="thumb"></has-error>
                             </div>
                             
                             <div class="form-group col-12">
                                 <button :disabled="form.busy" class="btn btn-success" type="submit">
                                      <span v-if="form.busy" class="spinner-border spinner-border-sm"></span>
                                      Publish
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
import { serialize } from 'object-to-formdata';
import Multiselect from 'vue-multiselect';
export default {
    components:{
        Multiselect,
    },
    data(){
        return{
            form: new Form({
                projectId: this.$route.params.id,
                title : "",
                startDate: "",
                endDate: "",
                skills: null,
                skill_v2:null,
                thumb: null,
                ctg: "",
                content: "",
                moment: moment,
            }),
            ctgs: [],
            options: [],
            thumb_file: null,
        }
    },
    mounted(){
        $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });

        $(".summernote-simple").summernote({
            dialogsInBody: true,
            minHeight: 400,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["font", ["strikethrough","fontname","fontsize","fontsizeunit","color","backcolor","forecolor","superscript","subscript"]],
                ["para", ["paragraph","style","ol","ul","height"]],
                ['insert', ['link', 'picture', 'video']],
            ],
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
            placeholder: "Write here",
        });
    },
    created(){
        this.fetchProjectData();
        this.getProjectCategories();
        this.geSkills();
    },
    methods:{
        ff(content){
            $(".summernote-simple").summernote('code',content);
        },
        fetchProjectData(){
            axios.get("/api/get-blog-details",{
                params:{
                    id: this.$route.params.id
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.ff(data.content);
                this.form.title = data.title;
                this.form.ctg = data.ctg_id;
                this.form.content = data.content
                this.thumb_file = `background-image : url("${window.location.origin+"/upload/blog/thumbnails/"+data.thumb}");`;
            }).catch((err)=>{
                console.error(err.response.data);
                this.$router.push({name: 'admin-blogs'});
            });
        },
        getProjectCategories(){
            axios.get("/api/get-blog-category").then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.ctgs = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        updateProject(){
            
            if(this.form.skills != null)
            {
                this.form.skill_v2 = JSON.stringify(this.form.skills);
            }
            this.form.content = $('.summernote-simple').val();
            this.form.submit("post","/admin/update-blog",{
                transformRequest :[function(data,headers){
                    return serialize(data);
                }]
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status == "OK")
                {
                    Swal.fire({
                        title : "Success",
                        icon: "success",
                        text: data.msg,
                    });
                }
                else
                {
                    Swal.fire({
                        title : "Failed",
                        icon: "error",
                        text: data.msg,
                    });
                }
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        selectFile(e){
            const file = e.target.files[0];
            if(file)
            {
                this.form.thumb = file;
            }
            else
            {
                this.form.thumb = "";
            }
        }
    }
}
</script>
<style>
#image-preview{
    width: 100% !important;
    height: 400px !important;
}
.invalid{
    border: 1px solid red;
}
</style>