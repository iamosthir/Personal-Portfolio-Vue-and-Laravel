<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="container-fluid">
              <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 v-cloak>{{ album_data.name }}</h4>
                        <div class="text-right">
                            <router-link :to="{name:'admin-upload-album-photo', params:{id: this.$route.params.id}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Image</router-link>
                            <button v-if="checked_images > 0"
                                 class="btn btn-sm btn-danger" 
                                 @click="removeSelectedImage"
                                 title="Delete Selected"><i class="fas fa-trash"></i> {{ checked_images }} Items</button>
                            <button v-if="images.length>0" class="btn btn-sm btn-danger" @click="emptyAlbum">Empty Album</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" v-if="images.length>0">

                            <div class="col-md-2 col-sm-3 col-6" v-for="(image,i) in images" :key="i">
                                <div class="album-box">
                                    <img :src="`/upload/album/${image.album.name}/${image.image}`" :alt="image.title">
                                    <div>
                                        <label class="select-box">
                                            <input type="checkbox" name="img" @change="multiSelect" :value="image.id">
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center" v-else>
                            <div class="col-12 col-md-6">
                                <div class="alert alert-secondary text-center" role="alert">
                                    0 Photos Found
                                </div>
                            </div>
                        </div>
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
            album_data: [],
            images: [],
            checked_images : 0,
            selected_image : [],
        }
    },
    created(){
        this.getAlbumData();
        this.getAllImages();
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
        getAllImages(){
            axios.get("/admin/album-images",{
                params:{
                    albumId:this.$route.params.id
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.images = data;
            }).catch((err)=>{
                console.error(err.response.data);
            })
        },
        multiSelect(){
            this.checked_images = $("input[type='checkbox'][name='img']:checked").length;
            var arr = [];
            let i = 0;
            $("input[type='checkbox'][name='img']:checked").each(function(){
                arr[i++] = $(this).val();
            });
            this.selected_image = arr;
        },
        removeSelectedImage(){
        
            Swal.fire({
                title: `Are you sure you want to delete this ${this.checked_images} items`,
                text: "Once deleted, can't be restored!!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#73e375',
                confirmButtonText: 'Delete'
            }).then((data)=>{
                if(data.isConfirmed){
                    
                    axios.post("/admin/delete-album-images",{
                        imgs: this.selected_image
                    }).then((resp)=>{
                        return resp.data;
                    }).then((data)=>{
                        if(data.status == "OK")
                        {
                            $("input[type='checkbox'][name='img']:checked").parent().parent().parent().parent().remove();
                            this.checked_images = 0;
                            this.selected_image = [];
                        }
                    }).catch((err)=>{
                        console.error(err.response.data);
                    });


                }
            });
        },
        emptyAlbum(){
            
            Swal.fire({
                title: `Are you sure you want to empty this album`,
                text: "Once deleted, can't be restored!!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#73e375',
                confirmButtonText: 'Delete'
            }).then((data)=>{
                if(data.isConfirmed){
                    axios.post("/admin/clear-album",{
                        albumId: this.$route.params.id,
                    }).then(resp =>{
                        return resp.data;
                    }).then(data =>{
                        if(data.status == "OK"){
                            window.location.reload();
                        }
                    }).catch(err =>{
                        console.error(err.response.data);
                    });
                }
            });
        }
    }
}
</script>

<style>
.album-box img{
    width: 100%;
    height: 200px;
    object-fit: cover;
    cursor: pointer;
}
.select-box{
    width: 100%;
    padding: 15px 0;
    cursor: pointer;
}
</style>