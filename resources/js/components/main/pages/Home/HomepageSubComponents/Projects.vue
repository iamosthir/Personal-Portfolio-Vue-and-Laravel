<template>
  <!-- Start portfolio-area Area -->
        <section class="portfolio-area section-gap" id="portfolio">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-70 col-lg-8">
                        <div class="title text-center">
                            <h1 class="mb-10">My Latest Projects</h1>
                            <p>Who are in extremely love with eco friendly system.</p>
                        </div>
                    </div>
                </div>
    
                <div class="filters">
                    <ul>
                        <li class="active" data-project-filter @click="filterProjects('all',$event)">All</li>
                        <li v-for="(ctg,i) in ctgs" :key="i" @click="filterProjects(ctg.id, $event)" data-project-filter>{{ ctg.name }}</li>
                    </ul>
                </div>
    
                <div class="filters-content">
                    <div class="row justify-content-center" v-if="!loadingProjects&&projects.length==0">
                        <div class="col-6">
                            <div class="alert alert-danger text-center" role="alert">
                                No projects !
                            </div>
                        </div>
                    </div>
                    <div class="row grid">
                        <custom-sekeleton v-if="loadingProjects" :count="3"/>

                        <div class="single-portfolio col-sm-4 all vector" v-for="(project,i) in projects" :key="i">
                            <div class="relative">
                                <div class="thumb">
                                    <div class="overlay overlay-bg"></div>
                                    <img class="image img-fluid" :src="'/upload/project/thumbnails/'+project.thumb" alt="">
                                </div>
                                <router-link :to="{name:'project-details',params:{project_id:project.id}}" class="img-pop-up">
                                    <div class="middle">
                                        <div class="text align-self-center d-flex"><img src="img/preview.png" alt=""></div>
                                    </div>
                                </router-link>
                            </div>
                            <div class="p-inner">
                                <h4>{{ project.prject_name }}</h4>
                                <div class="cat">{{ project.ctg.name }}</div>
                            </div>
                        </div>

                    </div>
                    
                </div>
    
            </div>
        </section>
     <!-- End portfolio-area Area -->
</template>

<script>
import CustomSekeleton from "../../../partials/Skeleton.vue";
export default {
    props:{
        limit:{
            type: Number,
            default: 6
        }
    },
    components: { 
        CustomSekeleton
    },
    data(){
        return{
            ctgs : [],
            projects: [],
            loadingProjects: true,
        }
    },
    created(){
        this.getProjectCategory();
        this.fetchProjects("all",this.limit);
    },
    methods:{
        getProjectCategory(){
            axios.get("/api/get-project-category")
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.ctgs = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },

        fetchProjects(category,limit){
            axios.get("/api/get-projects",{
                params:{
                    category: category,
                    limit: limit,
                }
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.loadingProjects = false;
                this.projects = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        filterProjects(ctg,e){
            this.loadingProjects = true;
            this.projects = [];
            let btn = $(e.target);
            $('li[data-project-filter]').removeClass("active");
            btn.addClass("active");
            this.fetchProjects(ctg,6);
        }
    }
}
</script>

<style>
.image{
    height: 350px !important;
    object-fit: cover;
}
</style>