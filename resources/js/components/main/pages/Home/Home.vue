<template>
  <section>
        <ProfileSection :profile="profile"></ProfileSection>

        
        <SkillSection></SkillSection>
    
    
        <ProjectSection :limit="6"></ProjectSection>

        <ImageGallerySection></ImageGallerySection>

        <BlogSection/>
        
    
  </section>
</template>
<script>

// Import sub components
import ProfileSection from "../Home/HomepageSubComponents/Profile.vue";
import SkillSection from "../Home/HomepageSubComponents/Skills.vue";
import ProjectSection from "../Home/HomepageSubComponents/Projects.vue";
import ImageGallerySection from "../Home/HomepageSubComponents/ImageGallery.vue";
import BlogSection from "../Home/HomepageSubComponents/Blog.vue";
// 
export default {
    components:{
        ProfileSection,
        SkillSection,
        ProjectSection,
        ImageGallerySection,
        BlogSection,
    },
    data(){
        return{
            profile : {},
        }
    },
    created(){
        this.getProfileData();
    },
    methods:{
        getProfileData(){
            axios.get('/api/get-profile-data').then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.profile = data;
            }).catch((err)=>{
                console.error(err.response.data);
            });
        }
    }
}
</script>

<style>

</style>