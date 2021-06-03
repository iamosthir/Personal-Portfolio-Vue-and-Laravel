<template>
<header id="header">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                    <router-link :to="{name:'home'}" class="h2" style="font-family: 'Great Vibes', cursive; color:black !important;">{{ name }}</router-link>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><router-link :to="{name:'home'}">Home</router-link></li>

                    <li><router-link :to="{name:'protfolio'}">Portfolio</router-link></li>

                    <li><router-link :to="{name:'album'}" >Photo Album</router-link></li>
                    <li><router-link :to="{name:'blog'}" >Blogs</router-link></li>
                </ul>
                <ul class="mobile-menu">
                    <li><a href="#" @click.prevent="openMenu"><i class="fas fa-bars"></i></a></li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->

            <nav id="mobile-nav" style="display: block !important;">
                <div class="text-right pr-3">
                    <a @click.prevent="closeMenu" class="close-mobile-menu" title="Close menu" href="#"><i class="fas fa-times"></i></a>
                </div>
                <ul class="" id="">
                    <li><router-link data-mobile-menu-item :to="{name:'home'}">Home</router-link></li>

                    <li><router-link data-mobile-menu-item :to="{name:'protfolio'}">Portfolio</router-link></li>

                    <li><router-link data-mobile-menu-item :to="{name:'album'}" >Photo Album</router-link></li>
                    <li><router-link data-mobile-menu-item :to="{name:'blog'}" >Blogs</router-link></li>
                </ul>
            </nav>
            <div id="mobile-body-overly"></div>
        </div>
    </div>
</header>
<!-- #header -->
</template>

<script>
export default {
    props:{
        name : String,
    },
    mounted(){
        $('a[data-mobile-menu-item]').each(function(){
            $(this).click(function(){
                $('#mobile-nav').css({
                    left: -260,
                });
                $('#mobile-body-overly').css({
                    display: "none"
                });
            });
        });
    },
    methods:{
        openMenu(){
            $('#mobile-nav').css({
                left: 0,
            });
            $('#mobile-body-overly').css({
                display: "block"
            });
        },
        closeMenu(){
            $('#mobile-nav').css({
                left: -260,
            });
            $('#mobile-body-overly').css({
                display: "none"
            });
        }
    }
}
</script>

<style>
.close-mobile-menu{
    color: white;
    text-align: right;

}
.mobile-menu{
    display: none;
    padding-right: 10px;
}
.mobile-menu a{
    text-decoration: none;
    display: block;
    color: black;
    font-size: 22px;
}

@media only screen and (max-width: 768px){
    .mobile-menu{
        display: block;
    }
    .nav-menu{
        display: none;
    }
}
</style>