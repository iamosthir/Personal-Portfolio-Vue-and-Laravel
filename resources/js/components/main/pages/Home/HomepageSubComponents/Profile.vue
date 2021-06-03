<template>
<!-- start banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-between">

                <div class="col-lg-6 col-md-6 banner-right d-flex align-self-end">
                <skeleton style="cursor: pointer;" v-if="profile.image_file == null"
                    type="rect"
                    :width="483"
                    :height="613"
                    animation="wave"
                    />
                    <img class="img-fluid" :src="profile.image_url" :alt="profile.first_name">
                </div>


                <div class="col-lg-6 col-md-6 banner-left">
                    <skeleton v-if="profile.first_name == null" style="cursor: pointer;"
                    type="rect"
                    :width="300"
                    :height="300"
                    animation="wave"
                    />
                    <h1>{{ profile.first_name }} {{ profile.last_name }}</h1>
                    <b>{{ profile.job_title }}</b>
                    <p>
                        {{ profile.bio }}
                    </p>
                    <a :href="profile.cv_url==null?'#':profile.cv_url" class="primary-btn text-uppercase">Download my CV</a>
                </div>

            </div>
        </div>
    </section>
<!-- End banner Area -->
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