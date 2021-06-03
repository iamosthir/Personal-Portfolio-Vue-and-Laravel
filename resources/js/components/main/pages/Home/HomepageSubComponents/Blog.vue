<template>
  <!-- Start recent-blog Area -->
        <section class="recent-blog-area section-gap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 pb-30 header-text">
                        <h1>Latest posts from our blog</h1>
                        <p>
                            You may be a skillful, effective employer but if you don’t trust your personnel and the
                            opposite, then the chances of improving and expanding the business
                        </p>
                    </div>
                </div>

                <div class="row justify-content-center" v-if="blogs.length > 0">

                    <div class="single-recent-blog col-lg-4 col-md-4" v-for="(blog,i) in blogs" :key="i">
                        <div class="thumb">
                            <img class="f-img img-fluid mx-auto" style="height: 250px; obejct-fit:cover;" :src="'/upload/blog/thumbnails/'+blog.thumb" alt="">
                        </div>
                        <div class="bottom d-flex justify-content-between align-items-center flex-wrap">
                            <div class="meta">
                               <i class="fas fa-clock"></i> {{ moment(blog.created_at).format("DD MMMM YYYY") }}
                            </div>
                        </div>
                        <router-link :to="{
                            name: 'blog-details',
                            params:{
                                postid : blog.id
                            }
                        }">
                            <h4>{{ blog.title }}</h4>
                        </router-link>
                    </div>

                </div>

                <div class="row justify-content-center" v-else>

                    <div class="col-md-6">
                        <div class="alert alert-danger text-center" role="alert">
                            No post found !
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- end recent-blog Area -->
</template>

<script>
export default {
    data(){
        return{
            blogs: [],
            moment : moment,
        }
    },
    created(){
        this.getBlogs();
    },
    methods:{
        getBlogs(){
            axios.get("/api/get-latest-blogs",{
                params:{
                    limit: 3,
                }
            }).then(resp =>{
                return resp.data;
            }).then(data =>{
                this.blogs = data;
            }).catch(err => {
                console.error(err.response.data);
            });
        }
    }
}
</script>

<style>

</style>