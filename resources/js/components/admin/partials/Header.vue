<template>
  <nav class="navbar navbar-expand-lg main-navbar" :class="sticky" id="topNav">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                                collapse-btn"> <i data-feather="align-justify"></i></a></li>
        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
            <i data-feather="maximize"></i>
            </a></li>
        <li>
            <form class="form-inline mr-auto">
            <div class="search-element">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                <button class="btn" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </div>
            </form>
        </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown show"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" aria-expanded="true"> 
            <img alt="image" src="/img/thumb.jpg" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <a href="/admin/show" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Admins
              </a> 
              <a href="/admin/roles" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Roles
              </a> 
              <a href="/admin/password/change" class="dropdown-item has-icon"> <i class="fas fa-key"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
              <form id="logout-form" action="/admin/logout" method="POST"
               style="display: none;">
               <input type="hidden" name="_token" :value="csrfdata">
            </form>
            </div>
        </li>
    </ul>
</nav>
</template>

<script>
export default {
    props:{
        sticky:{
            default: null,
            type: String
        },
        csrfdata:{
            default: null,
            type: String
        },
    }
}
</script>

<style>

</style>