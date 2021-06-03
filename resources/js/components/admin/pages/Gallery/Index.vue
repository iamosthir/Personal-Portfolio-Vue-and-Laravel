<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4>Photo Albums</h4>
                      <router-link  :to="{name: 'admin-photo-album-create'}" class="btn btn-sm btn-primary">Create new  &nbsp;<i class="fas fa-plus"></i></router-link>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive" v-if="albums.length > 0">
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Album Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(album,i) in albums" :key="i">
                                    <td>
                                        <img alt="image" :src="album.thumb==null?'/img/album-placeholder.jpg':'/upload/album/'+album.name+'/'+album.thumb" width="35">
                                    </td>
                                    <td>{{ album.name }}</td>
                                    <td>{{ album.desc }}</td>
                                    <td>
                                        <router-link :to="{name:'admin-edit-album', params:{id: album.id}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
                                        <router-link :to="{name: 'admin-view-album' , params:{id: album.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <button @click="deleteAlbum(album.id,i)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center">
                        <h6 class="text-muted">No photo albums found</h6>
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
            albums: []
        }
    },
    created(){
        this.getAlbums();
    },
    methods:{
        getAlbums(){
            axios.get("/api/get-albums")
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.albums = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        deleteAlbum(albumId,index){
            Swal.fire({
                title: `Are you sure you want to delete this album`,
                text: "Once deleted, can't be restored!!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#73e375',
                confirmButtonText: 'Delete'
            }).then((data)=>{
                if(data.isConfirmed){
                    axios.post("/admin/delete-album",{
                        albumId: albumId,
                    }).then(resp =>{
                        return resp.data;
                    }).then(data =>{
                        if(data.status == "OK")
                        {
                            this.albums.splice(index,1);
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

</style>