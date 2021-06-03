<template>
  <section>
    <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input @change="changeLayoutColor('light')" type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" :checked="theme.layout_mode == 'light'">
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input @change="changeLayoutColor('dark')" type="radio" name="value" value="2" class="selectgroup-input-radio select-layout" :checked="theme.layout_mode == 'dark'">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" @change="changeSidebarColor('light')" name="icon-input" value="1" class="selectgroup-input select-sidebar" :checked="theme.sidebar_color=='light-sidebar'">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" @change="changeSidebarColor('dark')" name="icon-input" value="2" class="selectgroup-input select-sidebar" :checked="theme.sidebar_color=='dark-sidebar'">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li @click="changeThemeColor('theme-white')" title="white" :class="theme.color_theme=='theme-white'?'active':''">
                      <div class="white"></div>
                    </li>
                    <li @click="changeThemeColor('theme-cyan')" title="cyan" :class="theme.color_theme=='theme-cyan'?'active':''">
                      <div class="cyan"></div>
                    </li>
                    <li @click="changeThemeColor('theme-black')" title="black" :class="theme.color_theme=='theme-black'?'active':''">
                      <div class="black"></div>
                    </li>
                    <li @click="changeThemeColor('theme-purple')" title="purple" :class="theme.color_theme=='theme-purple'?'active':''">
                      <div class="purple"></div>
                    </li>
                    <li @click="changeThemeColor('theme-orange')" title="orange" :class="theme.color_theme=='theme-orange'?'active':''">
                      <div class="orange"></div>
                    </li>
                    <li @click="changeThemeColor('theme-green')" title="green" :class="theme.color_theme=='theme-green'?'active':''">
                      <div class="green"></div>
                    </li>
                    <li @click="changeThemeColor('theme-red')" title="red" :class="theme.color_theme=='theme-red'?'active':''">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" @change="changeHeader" :checked="theme.sticky_header=='sticky'">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 p-3 align-center">
                <button class="btn btn-icon icon-left btn-danger" @click="resetDB">
                  <i class="fas fa-undo"></i> Reset Database
                </button>
              </div>
            </div>
          </div>
      </div>
      <div class="spinner-area" v-if="reseting">
        <div class="spinner-box">
          <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <p class="text-white mt-3">Please wait. You will get redirect soon</p>
        </div>
      </div>
  </section>
        
</template>

<script>
export default {
    props:{
        theme: Object
    },
    data(){
      return{
        reseting: false,
      }
    },
    methods:{
        changeLayoutColor(color){
            
            if(color == "light")
            {
                $('body').removeClass();
                $('body').addClass("light light-sidebar theme-white");
            }
            else if(color == "dark")
            {
                $('body').removeClass();
                $('body').addClass("dark dark-sidebar theme-black");
            }

            axios.post("/admin/change-layout-color",{
                color: color
            }).then(resp =>{
                console.log(resp.data);
            }).catch(err => {
                console.error(err.response.data);
            });
        },
        changeSidebarColor(color){
            if(color == "light"){
                $("body").removeClass("dark-sidebar");
                $("body").addClass("light-sidebar");
            }
            else if(color == "dark"){
                $("body").removeClass("light-sidebar");
                $("body").addClass("dark-sidebar");
            }
            axios.post("/admin/change-sidebar-color",{
                color: color
            }).then(resp =>{
                console.log(resp.data);
            }).catch(err => {
                console.error(err.response.data);
            });
        },
        changeThemeColor(color){
            $('.choose-theme li').each(function(){
                $('body').removeClass("theme-"+$(this).attr("title"));
            });
            $("body").addClass(color);
            
            axios.post("/admin/change-color-theme",{
                color: color
            }).then(resp =>{
                console.log(resp.data);
            }).catch(err => {
                console.error(err.response.data);
            });
        },
        changeHeader(e){
            if(e.target.checked)
            {
                $('#topNav').addClass("sticky");
            }
            else
            {
                $('#topNav').removeClass("sticky");
            }
            axios.post("/admin/change-header",{
                style: e.target.checked
            }).then(resp =>{
                console.log(resp.data);
            }).catch(err => {
                console.error(err.response.data);
            });
        },
        resetDB(){
          Swal.fire({
                title: "Are you sure you want to reset everything?",
                
                html: `
                <p class="text-left">Following things will be done while reseting everything</p>
                <ul class="text-left text-danger">
                  <li>All Blog Posts</li>
                  <li>All Protfolio Items</li>
                  <li>All Skills</li>
                  <li>All Categories</li>
                  <li>All Uploaded content and images</li>
                  <li>Reset Dashboard Settings</li> 
                </ul>
                `,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#73e375',
                confirmButtonText: 'Reset All'
            }).then((data)=>{
                if(data.isConfirmed){
                  this.reseting = true;
                  axios.post("/admin/reset-database").then(resp =>{
                    if(resp.data.status == "OK")
                    {
                      window.location.href="/admin";
                    }
                  }).catch(err=>{
                    console.error(err.response.data);
                  });
                }
            });
        }
    }
}
</script>

<style>
.spinner-area{
  width: 100%;
  height: 100%;
  position: fixed;
  background-color: rgba(0,0,0,0.9);
  z-index: 9999;
  top: 0;
  left: 0;
}
.spinner-box{
  position: absolute;
  top: 50%;
  text-align: center;
  width: 100%;
}
</style>