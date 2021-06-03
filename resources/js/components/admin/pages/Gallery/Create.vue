<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-12 col-lg-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4 id="ss">Create Photo Album</h4>
                      <router-link :to="{name:'admin-photo-album'}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go back</router-link>
                    </div>
                    <div class="card-body">
                        <alert-error :form="form" message="Failed to create new album"></alert-error>
                        <form id="form" action="#" @submit.prevent="createAlbum" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label for="">Choose Album Thumbnail</label>
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Change Image</label>
                                        <input type="file" name="image" id="image-upload" @change="selectIcon">
                                    </div>
                                    <has-error :form="form" field="image"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="">Album Name</label>
                                    <input type="text" class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 form-group">
                                    <label for="">Samll Description</label>
                                    <textarea rows="5" class="form-control" maxlength="300" v-model="form.desc" :class="{ 'is-invalid': form.errors.has('desc') }"></textarea>
                                    <has-error :form="form" field="desc"></has-error>
                                    <div class="text-right">
                                        <small>{{ form.desc.length }}/300</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
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
import { serialize } from 'object-to-formdata';
export default {
    data(){
        return{
            form: new Form({
                name: "",
                desc : '',
                thumb: null,
            }),
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
    },
    methods:{
        selectIcon(e){
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
        createAlbum(){
            this.form.submit("post","/admin/create-album",{
                transformRequest: [function(data,header){
                    return serialize(data);
                }]
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status=="OK")
                {
                    this.resetForm();
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
            })
        },
        resetForm(){
            this.form.name = "";
            this.form.desc = "";
            this.form.thumb = null;
            $('#image-upload').val("");
            $('#image-upload').trigger("change");
        }
    }
}
</script>

<style>

</style>