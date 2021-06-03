<template>
  <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="https://www.totoprayogo.com/#" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div> -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-between">
                <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <router-link :to="{name:'home'}" class="btn btn-primary" style="color: white !important;">Back to Home</router-link>
            </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>

<style>

</style>