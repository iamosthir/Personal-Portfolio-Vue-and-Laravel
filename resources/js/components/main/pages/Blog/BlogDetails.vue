<template>
  <!-- Start post-content Area -->
    <section class="post-content-area single-post-area mt-100">
        <div class="container">
            <div class="row">


                <div class="col-lg-12 posts-list">

                
                    <!-- Skeleton Loader -->
                    <div class="row" v-if="loading_post">
                        <div class="col-8">
                            <custom-skeleton
                            width="100%"
                            height="40px"
                            />
                        </div>
                        <div class="col-12 mt-4">
                            <custom-skeleton
                            width="100%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="80%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="60%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="40%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="100%"
                            height="400px"
                            />
                            <custom-skeleton
                            width="70%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="60%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="50%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="100%"
                            height="20px"
                            />
                            <custom-skeleton
                            width="100%"
                            height="20px"
                            />
                        </div>
                    </div>
                    <!-- End -->


                    <!-- portfolio detials area start -->
                    <div class="single-post row" v-if="!loading_post && post_data != null">
                        <div class="col-lg-12 col-md-12">
                            <h1 class="mt-20 mb-20">{{ post_data.title }}</h1>
                        </div>

                        <div class="col-lg-12 mt-3" v-html="post_data.content">

                        </div>
                    </div>
                    <!-- portfolio detials area end -->

                    
                </div>

            </div>
        </div>
    </section>
    <!-- End post-content Area -->
</template>

<script>
export default {
    data(){
        return{
            loading_post : true,
            post_data : null,
        }
    },
    created(){
        this.getPostdata();
    },
    methods:{
        getPostdata(){
            axios.get("/api/get-blog-data",{
                params:{
                    id: this.$route.params.postid
                }
            }).then(resp =>{
                return resp.data;
            }).then(data=>{
                document.title = data.title
                this.post_data = data;
                this.loading_post = false;
            }).catch(err=>{
                console.error(err.response.data);
                this.$router.push({name: "blog"});
            });
        }
    }
}
</script>

<style>

</style>