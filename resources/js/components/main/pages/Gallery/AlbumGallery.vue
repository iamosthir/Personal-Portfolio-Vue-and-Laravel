<template>
  <div>
      <!-- start banner Area -->
    <section class="about-banner">
        <div class="container">				
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-8">
                    <custom-skeleton v-if="loading"
                    width="40%"
                    height="50px"
                    />
                    <h1 class="text-white" v-if="!loading">{{ albumInfo.name }}</h1>	
                    <p class="text-white link-nav" v-if="!loading">{{ albumInfo.desc }}</p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->



    <!-- Start Image Gallery Area -->

    <section class="portfolio-area section-gap" id="portfolio">
        <div class="container">
            <div class="row" v-if="loading">
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
                <div class="col-md-4 col-sm-12 p-2 div1">
                    <custom-skeleton
                        width="100%"
                        height="250px"
                    />
                </div>
            </div>
            <div class="row gallery-item" v-if="!loading">

                <div class="col-md-4 mb-4" v-for="(image,i) in images" :key="i">
                    <a @click.prevent="imageIndex = i" href="#" class="img-gal">
                        <!-- <div class="single-gallery-image" :style="{background: 'url('+image.src+')'}"></div> -->
                        <img class="single-gallery-img" :src="image.src" alt="">
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- End Image Gallery Area -->
    <CoolLightBox
        :items="images"
        :index="imageIndex"
        @close="hideGallery"
        :useZoomBar="true"
    />
  </div>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox';
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
export default {
    components:{
        CoolLightBox,
    },
    data(){
        return{
            loading: true,
            albumInfo : null,
            images:[],
            imageIndex: null,
        }
    },
    created(){
        this.getAlbumData();
    },
    methods:{
        getAlbumData(){
            axios.get("/api/album-with-image",{
                params:{
                    albumid: this.$route.params.id
                }
            }).then(resp =>{
                return resp.data;
            }).then(data =>{
                this.albumInfo = data.albumInfo;
                this.images = data.images;
                this.loading = false;
            }).catch(err=>{
                console.error(err.response.data);
            })
        },
        hideGallery(){
            this.imageIndex = null;
            $('.cool-lightbox').hide();
        }
    }
}
</script>

<style>
.single-gallery-img{
    width: 100%;
    height: 250px;
    object-fit: cover;
    box-shadow: 0 3px 13px 4px rgba(0, 0, 0, 0.14);
    transition: 0.4s;
}
.single-gallery-img:hover{
    opacity: 50%;
}
.cool-lightbox-caption h6{
    color: white !important;
}
</style>