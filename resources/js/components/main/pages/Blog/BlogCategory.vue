<template>
  <section>
      <!-- start banner Area -->
        <section class="about-banner">
            <div class="container">				
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-12">
                        <h1 class="text-white">
                            Blog Category
                        </h1>	
                        <p class="text-white link-nav"><router-link :to="{name:'home'}">Home </router-link>  <span class="lnr lnr-arrow-right"></span>  <a href="#"> Blog</a></p>
                    </div>	
                </div>
            </div>
        </section>
        <!-- End banner Area -->


        <!--  -->
        <section class="post-content-area">
            <div class="container">
                <div class="row mt-4" v-if="loading">
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

                <template v-if="!loading">
                    <div class="row top-category-widget-area pt-90 pb-90" v-if="ctgs.length > 0">
                        <div class="col-lg-6 pb-2" v-for="(ctg,i) in ctgs" :key="i">
                            <div class="single-cat-widget">
                                <div class="content relative hidden" style="opacity: 1;">
                                    <div class="overlay overlay-bg"></div>
                                    <router-link :to="{name: 'blog-ctg', params: {slug : ctg.slug}}">
                                        <div class="thumb">
                                            <img class="content-image img-fluid d-block mx-auto" src="img/blog/cat-widget1.jpg" alt="">
                                        </div>
                                        <div class="content-details">
                                            <h4 class="content-title mx-auto text-uppercase">{{ ctg.name }}</h4>
                                            <span></span>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    <!-- End top-category-widget Area -->
                    </div>
                    <div v-else class="row justify-content-center pt-90 pb-90">
                        <div class="col-md-6">
                            <div class="alert alert-danger text-center" role="alert">
                                No categories found !
                            </div>
                        </div>
                    </div>
                </template>


            </div>
        </section>
        <!--  -->
  </section>
</template>

<script>
export default {
    data(){
        return{
            ctgs: [],
            loading: true,
        }
    },
    created(){
        this.getBlogCategories();
    },
    methods:{
        getBlogCategories(){
            axios.get("/api/get-blog-category").then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.ctgs = data;
                this.loading = false;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
    }
}
</script>

<style>

</style>