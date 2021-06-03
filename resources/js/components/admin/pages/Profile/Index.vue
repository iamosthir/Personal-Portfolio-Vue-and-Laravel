
<template>
<section class="section">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card author-box">
                <div class="card-header text-center">
                    <h4 class="text-center">My Profile</h4>
                </div>
                <div class="card-body">
                <div class="text-center">
                    <img alt="image" :src="profile.image_url==null?'/img/thumb.jpg':profile.image_url" class="profile-user-img img-fluid img-circle">
                    <div class="clearfix"></div>
                    <div class="author-box-name">
                        <h3><a href="#">{{ profile.first_name }} {{ profile.last_name }}</a></h3>
                    </div>
                    <div class="author-box-job"><strong>{{ profile.job_title }}</strong></div>
                </div>
                <div class="text-center">
                    <div class="author-box-description">
                    <p>
                        {{ profile.bio }}
                    </p>
                    </div>
                    <div class="mb-2 mt-3">
                    <div class="text-small font-weight-bold">Follow {{ profile.first_name }} on</div>
                    </div>

                    <a v-if="profile.fb" :href="profile.fb" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a v-if="profile.twitter" :href="profile.twitter" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a v-if="profile.github" :href="profile.github" class="btn btn-social-icon mr-1 btn-github">
                        <i class="fab fa-github"></i>
                    </a>
                    <a v-if="profile.insta" :href="profile.insta" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a v-if="profile.phone" :href="'tel:'+profile.phone" class="btn btn-social-icon mr-1 btn-success">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a v-if="profile.email" :href="'mailto:'+profile.email" class="btn btn-social-icon mr-1 btn-danger">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a v-if="profile.linkedin" :href="'mailto:'+profile.linkedin" class="btn btn-social-icon mr-1 btn-linkedin">
                        <i class="fab fa-linkedin"></i>
                    </a>

                    <div class="w-100 d-sm-none"></div>
                    <div class="mt-3 mb-3" id="ss">
                        <div class="text-small font-weight-bold">Your CV</div>
                        <div class="mt-2"></div>
                            <a v-if="profile.cv_file" :href="profile.cv_url" target="_blank" class="btn btn-secondary"><i class="fas fa-download"></i> Download Your CV</a>
                        <div v-else class="mt-2">
                        <p class="text-warning">You haven't uploaded any cv yet</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="card-footer bg-light text-center">
                    <router-link :to="{name:'edit-profile'}" class="btn btn-primary text-white-all"><i class="fas fa-edit"></i> Edit Profile</router-link>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    data(){
        return {
            profile: {}
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
.img-circle{
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
}
</style>