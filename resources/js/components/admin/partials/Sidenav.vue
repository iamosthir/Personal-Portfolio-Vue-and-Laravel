<template>
  <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Otika</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <router-link :to="{name:'admin-home'}" class="nav-link"><i data-feather="user"></i><span>My Profile</span></router-link>
            </li>
            <li class="dropdown">
              <router-link :to="{name:'admin-skill'}" class="nav-link"><i data-feather="zap"></i><span>Skills</span></router-link>
            </li>

            <li class="menu-header">Projects</li>
            <li class="dropdown">
              <router-link :to="{name:'admin-projects'}" class="nav-link"><i data-feather="box"></i><span>My Projects</span></router-link>
            </li>

            <li class="dropdown">
              <router-link :to="{name:'admin-project-ctg'}" class="nav-link"><i data-feather="map"></i><span>Project Categories</span></router-link>
            </li>


            <li class="menu-header">Blog</li>
            <li class="dropdown">
              <router-link :to="{name:'admin-blog-ctg'}" class="nav-link"><i data-feather="map"></i><span>Blog Category</span></router-link>
            </li>
            <li class="dropdown">
              <router-link :to="{name:'admin-blogs'}" class="nav-link"><i data-feather="box"></i><span>My Blogs</span></router-link>
            </li>


            <li class="menu-header">Gallery</li>
            <li class="dropdown">
              <router-link :to="{name:'admin-photo-album'}" class="nav-link"><i data-feather="image"></i><span>Photo Albums</span></router-link>
            </li>

            <!-- <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Widgets</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="widget-chart.html">Chart Widgets</a></li>
                <li><a class="nav-link" href="widget-data.html">Data Widgets</a></li>
              </ul>
            </li> -->

          </ul>
        </aside>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>