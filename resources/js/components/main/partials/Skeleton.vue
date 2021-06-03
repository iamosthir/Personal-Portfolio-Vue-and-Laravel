<style>
.loader{
    margin: 20px auto !important;
}
</style>
<template>
  <div class="row">
      <div class="col-md-4 justify-content-center" v-for="n in count" :key="n">
          <skeleton style="cursor: pointer;"
            type="rect"
            :width="350"
            :height="200"
            animation="wave"
            />
      </div>
  </div>
</template>

<script>
export default {
    props:['count'],
}
</script>

<style>

</style>