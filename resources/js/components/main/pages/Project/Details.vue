<template>
  <div>
       <!-- start banner Area -->
    <section class="relative about-banner">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <custom-skeleton v-if="is_loading_data"
                    width="40%"
                    height="50px"
                    />
                    <h1 class="text-white">{{ project_details.prject_name }}</h1>
                    <p class="text-white link-nav">
                        <router-link :to="{name:'home'}">Home </router-link>
                        <span class="lnr lnr-arrow-right"></span>
                        <router-link :to="{name:'protfolio'}"> Portfolio</router-link>
                        <span class="lnr lnr-arrow-right"></span>
                        <a href="#">{{ project_details.prject_name }}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->


    <!-- Start post-content Area -->
    <section class="post-content-area single-post-area">
        <div class="container">
            <div class="row">


                <div class="col-lg-12 posts-list">

                    <!-- portfolio detials area start -->
                    <div class="single-post row">

                        <!-- video area start -->
                        <div class="col-12" v-if="is_loading_data">
                            <custom-skeleton
                            width="100%"
                            height="300px"
                            />
                        </div>
                        <div class="col-lg-12" v-cloak>
                            <img :src="'/upload/project/thumbnails/'+project_details.thumb" style="width:100%;height:300px;object-fit:cover;" alt="">
                        </div>
                        <!-- video area end -->



                        <!-- content area start -->
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                            <custom-skeleton v-if="is_loading_data"
                            width="70%"
                            height="40px"
                            />
                            <h1 class="mt-20 mb-20 h2">{{ project_details.prject_name }}</h1>

                            <div class="mt-2">
                                <template v-if="is_loading_data">
                                    <custom-skeleton
                                    width="100%"
                                    height="10px"
                                    />
                                    <custom-skeleton
                                    width="70%"
                                    height="10px"
                                    />
                                    <custom-skeleton
                                    width="40%"
                                    height="10px"
                                    />
                                    <div class="mt-4"></div>
                                    <custom-skeleton
                                    width="100%"
                                    height="10px"
                                    />
                                    <custom-skeleton
                                    width="70%"
                                    height="10px"
                                    />
                                    <custom-skeleton
                                    width="40%"
                                    height="10px"
                                    />
                                </template>

                                <div v-html="project_details.content">
                                </div>
                            </div>
                        </div>
                        <!-- content area end -->
                    </div>
                    <!-- portfolio detials area end -->
                    <div class="row">
                        <div class="col-lg-4  col-md-4 meta-details text-left align-self-center">
                            <template v-if="is_loading_data">
                                <div class="pt-4">
                                    <custom-skeleton
                                    width="100%"
                                    height="20px"
                                    />
                                    <custom-skeleton
                                    width="70%"
                                    height="20px"
                                    />
                                    <custom-skeleton
                                    width="50%"
                                    height="20px"
                                    />
                                    <custom-skeleton
                                    width="80%"
                                    height="20px"
                                    />
                                    <custom-skeleton
                                    width="100%"
                                    height="20px"
                                    />
                                </div>
                            </template>

                            <div class="card">
                                <div class="card-body">
                                    <div class="user-details pt-4">
                                        <p class="user-name  mb-2"><a ><i class="fas fa-user-tag" style="font-size: 20px;"></i> Programmer</a></p>
                                        <p class="user-name mb-2"><a href="#CompanyURL"><i class="fa fa-building" style="font-size: 20px;"></i> Battery Low Interactive</a> </p>
                                        <p class="user-name mb-2"><i class="fas fa-clock" style="font-size: 20px;"> </i>
                                        <span> {{ moment(project_details.started_at).format("D MMMM YY") }}
                                            - {{ project_details.ended_at?moment(project_details.ended_at).format("D MMMM YY"):'Present' }}</span>
                                        </p>
                                    </div>

                                    <ul class="tags mt-3">
                                        <p class="text-primary mt-3 mb-0 pb-0"><i class="fas fa-tools" style="font-size: 20px;"></i> Skills</p>
                                        <li v-for="(skill,i) in project_details.skills" :key="i">
                                            <a class="btn btn-sm btn-light my-1"># {{ skill.name }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Prev and Next post Area  -->
                    <div class="navigation-area mt-5">
                        <div class="row justify-content-between">
                            <div v-if="prevNext.prev != null"
                                class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a @click.prevent="pushNextPost(prevNext.prev.id)" href="#"><img style="width:60px;height:60px;object-fit:cover;" :src="'/upload/project/thumbnails/'+prevNext.prev.thumb" alt=""></a>
                                </div>
                                <div class="arrow">
                                    <a @click.prevent="pushNextPost(prevNext.prev.id)" href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                                </div>
                                <div class="detials">
                                    <p>Prev Project</p>
                                    <a @click.prevent="pushNextPost(prevNext.prev.id)" href="#">
                                        <h4>{{ prevNext.prev.prject_name }}</h4>
                                    </a>
                                </div>
                            </div>

                            
                            <div v-if="prevNext.next != null"
                            class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Project</p>
                                    <a @click.prevent="pushNextPost(prevNext.next.id)" href="#">
                                        <h4>{{ prevNext.next.prject_name }}</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a @click.prevent="pushNextPost(prevNext.next.id)" href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                                </div>
                                <div class="thumb">
                                    <a @click.prevent="pushNextPost(prevNext.next.id)" href="#"><img style="width:60px;height:60px;object-fit:cover;" :src="'/upload/project/thumbnails/'+prevNext.next.thumb" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post-content Area -->
  </div>
</template>

<script>
export default {
    data(){
        return{
            is_loading_data: true,
            project_details:{},
            moment: moment,
            prevNext: [],
        }
    },
    created(){
        this.getProjectDetails();
        this.getPrevNextProject();
    },
    methods:{
        getProjectDetails(){
            axios.get("/api/get-project-details",{
                params:{
                    id: this.$route.params.project_id
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.project_details = data;
                document.title = "Project - "+data.prject_name;
                // If data loaded
                this.is_loading_data = false;
            }).catch((err)=>{
                console.error(err.response.data);
                this.$router.push({name: '404'});
            })
        },
        getPrevNextProject(){
            axios.get("/api/prev-next-project",{
                params:{
                    projectId : this.$route.params.project_id
                }
            }).
            then((resp)=>{
                return resp.data;
            }).then((data)=>{
                console.log(data);
                this.prevNext = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        }
        ,
        pushNextPost(post_id){
            this.$router.push({
                name: 'project-details',
                params:{
                    project_id: post_id,
                }
            });
        }
    }
}
</script>

<style>

</style>