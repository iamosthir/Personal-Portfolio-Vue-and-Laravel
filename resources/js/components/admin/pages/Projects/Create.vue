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
                      <form action="#" @submit.prevent="publishProject" id="projectForm">
                          <alert-errors :form="form">There were some problems with your input.</alert-errors>
                          <div class="row">
                              <div class="col-md-6 form-group">
                                  <label for="">Project Title</label>
                                  <input type="text" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" name="title" placeholder="Project title" v-model="form.title">
                                  <has-error :form="form" field="title"></has-error>
                              </div>
                              <div class="col-md-3">
                                  <label for="">Project Start Date</label>
                                  <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('startDate') }" name="startDate" v-model="form.startDate">
                                  <has-error :form="form" field="startDate"></has-error>
                              </div>
                              <div class="col-md-3">
                                  <label for="">Project End Date (Leave empty if not finished yet)</label>
                                  <input type="date" class="form-control" name="endDate" v-model="form.endDate">
                              </div>
                              <div class="col-md-5 form-group">
                                  <label for="">Category</label>
                                  <select name="ctg" class="form-control" :class="{ 'is-invalid': form.errors.has('ctg') }" v-model="form.ctg">
                                      <option value="" hidden>Choose category</option>
                                      <option v-for="(ctg,i) in ctgs" :key="i" :value="ctg.id">{{ ctg.name }}</option>
                                  </select>
                                  <has-error :form="form" field="ctg"></has-error>
                              </div>
                              <div class="col-md-7 form-group">
                                  <label for="">Choose 1 or more skills related to this project</label>
                                  <multiselect
                                    :class="{ 'invalid': form.errors.has('skill_v2') }"
                                    v-model="form.skills"
                                    :options="options"
                                    :taggable="true"
                                    :multiple="true"
                                    :close-on-select="false"
                                    @tag="addTag"
                                    track-by="id"
                                    label="name"
                                    placeholder="Add some skills"
                                    :hideSelected="true"
                                    ></multiselect>
                                    <has-error :form="form" field="skill_v2"></has-error>
                              </div>

                              <div class="col-12 form-group">
                                 <label for="">Write your project description</label>
                                 <textarea class="summernote-simple"></textarea>
                                 <has-error :form="form" field="content"></has-error>
                             </div>

                              <div class="col-sm-12 form-group">
                                  <label for="">Set Thumbnail image</label> 
                                  <div id="image-preview" class="image-preview" :class="{ 'invalid': form.errors.has('thumb') }">
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
                title : "",
                startDate: "",
                endDate: "",
                skills: null,
                skill_v2:null,
                thumb: null,
                ctg: "",
                content: "",
            }),
            ctgs: [],
            options: [],
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
        this.getProjectCategories();
        this.geSkills();
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
        geSkills(){
            axios.get('/admin/get-skills')
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.options = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        addTag (newTag) {
            const tag = {
                name: newTag,
                id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.form.skills.push(tag)
        },
        publishProject(){
            
            if(this.form.skills != null)
            {
                this.form.skill_v2 = JSON.stringify(this.form.skills);
            }
            this.form.content = $('.summernote-simple').val();
            this.form.submit("post","/admin/create-project",{
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
                    this.resetForm();
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
        },
        resetForm(){
            $('#projectForm').trigger("reset");
            this.form.skills = null;
            $('#image-preview').css({
                'background-image' : '',
            });
            $(".summernote-simple").summernote('reset');
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
#image-preview{
    width: 100% !important;
    height: 400px !important;
}
.invalid{
    border: 1px solid red;
}
</style>