<template>
  <div>
    <!-- start banner Area -->
    <section class="about-banner">
        <div class="container">				
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <custom-skeleton v-if="loading_ctg"
                    width="40%"
                    height="50px"
                    />
                    <h1 v-if="loading_ctg==false && ctg_data != null" class="text-white">
                        {{ ctg_data.name }}
                    </h1>	
                    <p class="text-white link-nav"><router-link :to="{name:'home'}">Home </router-link>  <span class="lnr lnr-arrow-right"></span>
                      <router-link :to="{name: 'blog'}"> Blog</router-link> <span class="lnr lnr-arrow-right"></span>
                        <a href="#"> {{ ctg_data.name }}</a>
                    </p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start post-content Area -->
	<section class="post-content-area pt-4 pb-4">
        <div class="container" v-if="loading_post">
            <div class="row">
                <div class="col-md-6">
                    <custom-skeleton
                        width="100%"
                        height="380px"
                    />
                </div>
                <div class="col-md-6">
                    <custom-skeleton
                        width="100%"
                        height="380px"
                    />
                </div>
            </div>
        </div>

        <template v-if="!loading_post">
            <div class="container" v-if="posts.length > 0">
                <div class="row">

                    <div class="col-lg-6 col-md-6 posts-list" v-for="(post,i) in posts" :key="i">
                        <div class="single-post row">
                            <div class="col-12">
                                <div class="feature-img">
                                    <img class="img-fluid" :src="'/upload/blog/thumbnails/'+post.thumb" alt="">
                                </div>
                                <router-link :to="{name: 'blog-details', params: { postid: post.id }}" class="posts-title">
                                    <h3>{{ post.title }}</h3>
                                </router-link>
                                <router-link :to="{name: 'blog-details', params: { postid: post.id }}" class="primary-btn">View More</router-link>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row justify-content-center">
                        <!-- pagination area start -->
                        <nav class="blog-pagination justify-content-center d-flex">
                            <pagination :data="paginateData" @pagination-change-page="getBlogPost"></pagination>
                        </nav>
                        <!-- pagination area end -->
                        
                </div>
            </div>


            <div v-else class="container">
                <div class="row justify-content-center pt-100 pb-100">
                    <div class="col-md-8">
                        <div class="alert alert-danger text-center" role="alert">
                            No post found for this category !
                        </div>
                    </div>
                </div>
            </div>
        </template>


	</section>
	<!-- End post-content Area -->
  </div>
</template>

<script>
export default {
    data(){
        return{
            ctg_data: [],
            loading_ctg: true,
            loading_post: true,
            posts: [],
            paginateData: {},

        }
    },
    created(){
        this.getBlogCtgData();
        this.getBlogPost();
    },
    methods:{
        getBlogCtgData(){
            axios.get("/api/get-blog-ctg-data",{
                params:{
                    slug : this.$route.params.slug,
                }
            }).then(resp =>{
                return resp.data;
            }).then(data =>{
                this.ctg_data = data;
                document.title = "Blog - "+data.name
                this.loading_ctg = false;
            }).catch(err =>{
                console.error(err.response.data);
            })
        },
        getBlogPost(page = 1){
            this.loading_post = true;
            axios.get("/api/get-blog-posts-by-category?page="+page,{
                params:{
                    category_slug: this.$route.params.slug,
                }
            }).then(resp =>{
                return resp.data;
            }).then(data =>{
                this.paginateData = data;
                this.posts = data.data;
                this.loading_post = false;
            }).catch(err => {
                console.error(err.response.data);
            })
        }
    }
}
</script>

<style>

</style>