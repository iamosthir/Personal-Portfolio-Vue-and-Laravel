<template>
  <!-- start footer Area -->
    
<footer class="footer-area footer-section-gap">
    <div class="container">
        <div class="row">
            
            <div class="col-12 social-widget text-center">
                <div class="single-footer-widget ">
                    <h4 class="">Follow Me</h4>

                    <div class="footer-social ">

                        <a v-if="profile.fb != null" :href="profile.fb" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a v-if="profile.twitter != null" :href="profile.twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a v-if="profile.github != null" :href="profile.github" target="_blank"><i class="fab fa-github"></i></a>
                        <a v-if="profile.insta != null" :href="profile.insta" target="_blank"><i class="fab fa-instagram"></i></a>

                    </div>

                </div>
            </div>


        </div>

        <div class="row justify-content-center mt-4">

            <div class=" col-md-4 col-sm-6" v-if="profile.skype != null">
                <div class="single-footer-widget text-center">
                    <h5 class="h3 text-primary">Skype</h5>
                    <p class="text-light  mt-2">{{ profile.skype }}</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" v-if="profile.email != null">
                <div class="single-footer-widget text-center">
                    <h5 class="h3 text-primary">Email</h5>
                    <p class="text-light  mt-2" >{{ profile.email }}</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6" v-if="profile.phone != null">
                <div class="single-footer-widget text-center">
                    <h5 class="h3 text-primary">Phone</h5>
                    <p class="text-light  mt-2"> {{ profile.phone }} </p>
                </div>
            </div>


        </div>

        <div class="row text-center mt-5">
            <div class="col">
                <p> be a skillful, effective employer but if you don’t trust you</p>
            </div>
        </div>
    </div>
</footer>

<!-- End footer Area -->
</template>

<script>
export default {
    props:{
        profile : Object
    }
}
</script>

<style>

</style>