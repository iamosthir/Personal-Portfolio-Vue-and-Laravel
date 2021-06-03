<template>
  <!-- Start Skils Area -->
    <section class="services-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content  col-lg-7">
                    <div class="title text-center">
                        <h1 class="mb-10">My Skils</h1>
                        <p>At about this time of year, some months after New Year’s resolutions have been made and kept,
                            or made and neglected.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <custom-sekeleton v-if="skills.length == 0" :count="3"/>
                <div class="col-lg-4 col-md-6" v-for="(skill,i) in skills" :key="i">
                    <div class="single-services">
                        <span>
                            <img class="skill-icon" :src="'/upload/skill/icon/'+skill.icon" :alt="skill.name">
                        </span>
                        <a href="#">
                            <h4>{{ skill.name }}</h4>
                        </a>
                        <p>
                            “{{ skill.desc }}”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Skils Area -->
</template>

<script>
import CustomSekeleton from "../../../partials/Skeleton.vue";
export default {
    components:{
        CustomSekeleton
    },
    data(){
        return{
            skills:[],
        }
    },
    created(){
        this.getSkills();
    },
    methods:{
        getSkills(){
            axios.get('/api/get-all-skills')
            .then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.skills = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        }
    }
}
</script>

<style>

</style>