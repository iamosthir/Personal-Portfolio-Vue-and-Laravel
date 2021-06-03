<template>
  <div>
      <!-- start banner Area -->
     
      <section class="relative about-banner">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Photo Albums</h1>
                    <p class="text-white link-nav"><router-link :to="{name:'home'}">Home </router-link>  <span class="lnr lnr-arrow-right"></span>  <a href="#"> Albums</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->




    <!-- Start album Area -->
    <section class="services-area section-gap">
        <div class="container">

            <div class="row d-flex justify-content-center">
                <div class="menu-content  col-lg-7">
                    <div class="title text-center">
                        <h1 class="mb-10">All Album</h1>
                        <p>At about this time of year, some months after New Year’s resolutions have been made and kept,
                            or made and neglected.</p>
                    </div>
                </div>
            </div>

            <div class="row" v-if="is_loading">
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="380px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="380px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="380px"
                    />
                </div>
            </div>


            <div class="row" v-if="albums.length > 0">
                <!-- albume Item -->
                <div class="col-md-4 col-sm-12 p-2 div1"
                 style="cursor: pointer;" v-for="(album,i) in albums" :key="i">
                    <div class="card" @click="albumView(album.id)">
                        <img class="card-img-top" :src="album.thumb==null?'/img/album-placeholder.jpg':'/upload/album/'+album.name+'/'+album.thumb"
                         :alt="album.name" style="height:230px; object-fit:cover;">

                        <div class="card-body text-center">
                            <h2 class="card-title">{{ album.name }}</h2>
                            <p class="card-text">{{ album.desc }}</p>
                        </div>               
                    </div>
                </div>

            </div>
            <div class="row justify-content-center" v-else>
                <div class="col-md-8">
                    <div class="alert alert-danger text-center" role="alert">
                        No albums found!
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- End album Area -->
  </div>
</template>

<script>
export default {
    data(){
        return{
            is_loading: true,
            albums: [],

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
                this.is_loading = false;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        albumView(id){
            this.$router.push({
                name: "album-view",
                params: {
                    id: id
                }
            });
        }
    }
}
</script>
<style>

</style>