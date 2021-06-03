import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// 
import ProfileIndex from "../admin/pages/Profile/Index.vue";
import ProfileEdit from '../admin/pages/Profile/Edit.vue';

import SkillIndex from '../admin/pages/Skills/Index.vue';
import SkillCreate from '../admin/pages/Skills/Create.vue';
import SkillEdit from '../admin/pages/Skills/Edit.vue';

import ProjectCategoryIndex from '../admin/pages/ProjectCategory/Index.vue';
import ProjectCategoryEdit from '../admin/pages/ProjectCategory/Edit.vue';
import ProjectCategoryCreate from '../admin/pages/ProjectCategory/Create.vue';

import MyProjectIndex from "../admin/pages/Projects/Index.vue";
import MyProjectCreate from "../admin/pages/Projects/Create.vue";
import MyProjectEdit from "../admin/pages/Projects/Edit.vue";

import PhotoAlbumIndex from "../admin/pages/Gallery/Index.vue";
import PhotoAlbumCreate from "../admin/pages/Gallery/Create.vue";
import PhotoAlbumEdit from "../admin/pages/Gallery/Edit.vue";
import PhotoAlbumDetails from "../admin/pages/Gallery/Details.vue";
import PhotoAlbumUpload from "../admin/pages/Gallery/Upload.vue";

import BlogCategoryIndex from "../admin/pages/BlogCategory/Index.vue";
import BlogCategoryCreate from "../admin/pages/BlogCategory/Create.vue";
import BlogCategoryEdit from "../admin/pages/BlogCategory/Edit.vue";

import BlogIndex from "../admin/pages/Blog/Index.vue";
import BlogCreate from "../admin/pages/Blog/Create.vue";
import BlogEdit from "../admin/pages/Blog/Edit.vue";



// 
let prefix = "/admin/dashboard"
const routes = new VueRouter({
    mode:'history',
    linkExactActiveClass: 'active',
    routes:[
        //Profile
        {
            path: prefix+'/home',
            name: 'admin-home',
            component: ProfileIndex,
            meta:{
                title: "Dashboard - My Profile"
            }
        },
        {
            path: prefix+'/edit-profile',
            name: 'edit-profile',
            component: ProfileEdit,
            meta:{
                title: 'Edit Profile'
            }
        },
        //Skills
        {
            path: prefix+'/skills',
            name: 'admin-skill',
            component: SkillIndex,
            meta:{
                title: 'My Skills'
            }
        },
        {
            path: prefix+'/create-skills',
            name: 'admin-skill-create',
            component: SkillCreate,
            meta:{
                title: 'Create new skill'
            }
        },
        {
            path: prefix+'/edit-skill/:id',
            name: 'admin-edit-skill',
            component: SkillEdit,
            meta:{
                title: "Edit Skill"
            }
        },
        // ##### Projects #####
        // Project
        {
            path: prefix+'/my-projects',
            name:'admin-projects',
            component: MyProjectIndex,
            meta: {
                title: 'My Projects'
            }
        },
        {
            path: prefix+'/make-new-project',
            name: 'admin-make-project',
            component: MyProjectCreate,
            meta: {
                title : "Make new project"
            }
        },
        {
            path: prefix+'/edit-project/:id',
            name: 'admin-edit-project',
            component: MyProjectEdit,
            meta:{
                title: "Edit Project"
            }
        },
        // 
        // ####################

        // Project category
        {
            path: prefix+'/project-category',
            name: 'admin-project-ctg',
            component: ProjectCategoryIndex,
            meta:{
                title: "Project Categories"
            }
        },
        {
            path: prefix+'/project-category-create',
            name: 'admin-project-ctg-create',
            component: ProjectCategoryCreate,
            meta:{
                title: "Create Project Category"
            }
        },
        {
            path: prefix+'/project-category-edit/:id',
            name: 'admin-project-ctg-edit',
            component: ProjectCategoryEdit,
            meta:{
                title: "Edit Category"
            }
        },
        // 

        // Gallery
        {
            path: prefix+"/photo-albums",
            name: "admin-photo-album",
            component: PhotoAlbumIndex,
            meta:{
                title: "Photo Albums"
            }
        },
        {
            path: prefix+"/create-photo-album",
            name: "admin-photo-album-create",
            component: PhotoAlbumCreate,
            meta:{
                title: "Create Photo Albums"
            }
        },
        {
            path: prefix+"/edit-album/:id",
            name: "admin-edit-album",
            component: PhotoAlbumEdit,
            meta:{
                title: "Edit Album"
            }
        },
        {
            path : prefix + "/view-album/:id",
            name: "admin-view-album",
            component: PhotoAlbumDetails,
            meta:{
                title: "Album View"
            }
        },
        {
            path: prefix+"/upload-photos/album/:id",
            name: "admin-upload-album-photo",
            component: PhotoAlbumUpload,
            meta:{
                title: "Upload Photo"
            }
        },
        // 

        // Blog Category
        {
            path: prefix+"/blog-catergory",
            name: "admin-blog-ctg",
            component: BlogCategoryIndex,
            meta:{
                title: "Blog Category"
            }
        },
        {
            path: prefix+"/create-blog-categroy",
            name: "admin-create-blog-ctg",
            component: BlogCategoryCreate,
            meta:{
                title: "Create Blog Category"
            }
        },
        {
            path: prefix+"/blog-category-edit/:id",
            name: "admin-blog-ctg-edit",
            component: BlogCategoryEdit,
            meta:{
                title : "Edit Blog Category",
            }
        },
        // 
        // Blogs
        {
            path: prefix+"/blogs",
            name: "admin-blogs",
            component: BlogIndex,
            meta: {
                title: "My Blogs"
            }
        },
        {
            path: prefix+"/create-blog",
            name: "admin-make-blog",
            component: BlogCreate,
            meta:{
                title: "Create new blog"
            }
        },
        {
            path: prefix+"/edit-blog/:id",
            name: "admin-blog-edit",
            component: BlogEdit,
            meta:{
                title: `Edit Blog`,
            }
        },
        // 




        // ####################
        
    ]
});
export default routes;