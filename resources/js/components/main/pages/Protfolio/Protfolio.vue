<template>
  <section>
      <!-- start banner Area -->
			<section class="about-banner">
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Portfolio				
							</h1>	
							<p class="text-white link-nav"><router-link :to="{name:'home'}">Home </router-link>  <span class="lnr lnr-arrow-right"></span>  <a href="#"> Portfolio</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<ProjectSection :limit="0"></ProjectSection>

  </section>
</template>

<script>
import ProjectSection from "../Home/HomepageSubComponents/Projects";
export default {
	components:{
		ProjectSection
	}
}
</script>

<style>

</style>