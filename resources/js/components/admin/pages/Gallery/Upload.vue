<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-12 col-lg-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4 id="ss">Upload Photos to {{ album_data.name }}</h4>
                      <button @click="goback" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go back</button>
                   </div>
                   <div class="card-body">
                       <form @submit.prevent="uploadPhotos">
                           <alert-errors :form="form">There were some problems with your input.</alert-errors>
                           <div class="row">
                               <div class="col-md-6 form-group">
                                   <label>Image Title</label>
                                   <input type="text" class="form-control" placeholder="Title"
                                   :class="{ 'is-invalid': form.errors.has('title') }" v-model="form.title">
                                   <has-error :form="form" field="title"></has-error>
                               </div>
                               <div class="col-md-6 form-group">
                                   <label>Small Description</label>
                                   <input type="text" class="form-control" placeholder="Small Description"
                                   :class="{ 'is-invalid': form.errors.has('desc') }" v-model="form.desc">
                                   <has-error :form="form" field="desc"></has-error>
                               </div>
                               <div class="col-md-12 form-group">
                                   <label for=""><strong>Choose 1 or More Images</strong></label>
                                   <input type="file" multiple class="form-control-file" required @change="selectFile" id="fileS">
                                   <has-error :form="form" field="file"></has-error>
                               </div>
                               <div class="col-md-12 form-group">
                                   <button :disabled="form.busy" class="btn btn-success" type="submit">
                                      <span v-if="form.busy" class="spinner-border spinner-border-sm"></span>
                                      Upload
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
        return{
            form: new Form({
                albumId: this.$route.params.id,
                files: null,
                title: "",
                desc: "",
            }),
            album_data: [],
        }
    },
    created(){
        this.getAlbumData();
    },
    methods:{
        getAlbumData(){
            axios.get("/admin/get-album-data",{
                params:{
                    albumId : this.$route.params.id
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.album_data = data;
            }).catch((err)=>{
                this.$router.push({name: 'admin-photo-album'});
                console.error(err.response.data);
            })
        },
        goback(){
            this.$router.back();
        },
        selectFile(e){
            const files = e.target.files;
            if(files){
                this.form.files = files;
            }
            else{
                this.form.files = null
            }
        },
        uploadPhotos(){
            this.form.submit("post","/admin/upload-photos",{
                transformRequest: [function(data,headers){
                    return serialize(data)
                }]
            },{
                onUploadProgress: progressEvent => console.log(progressEvent.loaded)
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
            this.form.title = "";
            this.form.desc = "";
            this.form.files = null;
            $('#fileS').val("");
        }
    }
}
</script>

<style>

</style>