<template>
  <!-- Start Image Gallery Area -->
    
        <section class="portfolio-area section-gap" id="portfolio">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-20 col-lg-8">
                        <div class="title text-center">
                            <h1 class="mb-1">Image Gallery</h1>
                            <p>Who are in extremely love with eco friendly system.</p>
                        </div>
                    </div>
                </div>
    
    
                <div class="">
                    <CoolLightBox
                    :items="images"
                    :index="imageIndex"
                    @close="hideGallery"
                    :useZoomBar="true"
                    />
                    <div class="row gallery-item">

                        <div class="col-md-4 mb-4" v-for="(image,i) in images" :key="i">
                            <a href="#" @click.prevent="imageIndex = i" class="img-gal">
                                <img class="single-gallery-img" :src="image.src" alt="">
                            </a>
                        </div>

                    </div>
                </div>
    
    
    
    
            </div>
        </section>
        <!-- End Image Gallery Area -->
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
            images: [],
            imageIndex: null,
        }
    },
    created(){
        this.getFirst6Image();
    },
    methods:{
        hideGallery(){
            this.imageIndex = null;
            $('.cool-lightbox').hide();
        },
        getFirst6Image(){
            axios.get("/api/image-6").then(resp =>{
                return resp.data;
            }).then(data =>{
                this.images = data;
            }).catch(err =>{
                console.error(err.response.data);
            })
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