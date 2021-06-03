import Vue from 'vue';
import VueRouter from 'vue-router';

// Use vue router
Vue.use(VueRouter);


// Register Components Here
import HomePage from '../main/pages/Home/Home.vue';


import ProtfolioPage from '../main/pages/Protfolio/Protfolio.vue';
import ProjectDetails from "../main/pages/Project/Details.vue";


import PhotoAlbum from "../main/pages/Gallery/Albums.vue";
import GalleryView from "../main/pages/Gallery/AlbumGallery.vue";

import Blog from "../main/pages/Blog/BlogCategory.vue";
import BlogCategory from "../main/pages/Blog/PostByCategory.vue";
import BlogDetails from "../main/pages/Blog/BlogDetails.vue";

import Page_404 from "../main/partials/404.vue";
// 

// Define routes
const routes = new VueRouter({
    mode:'history',
    linkExactActiveClass: 'menu-active',
    routes:[
        {
            path: '/',
            name: 'home',
            component: HomePage,
            meta:{
                title: 'Home'
            }
        },
        {
            path: '/protfolio',
            name: 'protfolio',
            component: ProtfolioPage,
            meta:{
                title: 'Protfolio'
            }
        },
        {
            path: '/project/:project_id/details-view',
            name: 'project-details',
            component: ProjectDetails,
            meta: {
                title: 'Project Details'
            }
        },

        // Gallery
        {
            path: "/photo-albums",
            name: "album",
            component: PhotoAlbum,
            meta:{
                title : "Photo Album"
            }
        },
        {
            path: "/gallery/album/:id",
            name: "album-view",
            component: GalleryView,
            meta:{
                title: "Gallery"
            }
        },
        // End

        // Blog
        {
            path: "/blog",
            name: "blog",
            component: Blog,
            meta:{
                title: "Blogs"
            }
        },
        {
            path: "/blog/posts/:slug",
            name: "blog-ctg",
            component: BlogCategory,
        },
        {
            path: "/blog/post-details/postid=:postid",
            name: "blog-details",
            component: BlogDetails,
        },
        // End



        // Handel 404
        {
            path: '*',
            name: '404',
            component: Page_404,
            meta:{
                title: "Page not found"
            }
        }
        // 
    ],
    scrollBehavior(to,from,savedPos){
        if(savedPos){
            return savedPos;
        } else{
            return {x:0, y:0};
        }
    }
});
// 

// export the routes
export default routes;