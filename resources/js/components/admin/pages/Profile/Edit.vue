<template>
  <section class="section">
      <div class="row justify-content-center">
          <div class="col-md-12 col-lg-8">
              <div class="card">
                  <div class="card-header d-flex justify-content-between">
                      <h4 id="ss">Edit Profile</h4>
                      <router-link :to="{name:'admin-home'}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go back</router-link>
                    </div>
                    <div class="card-body">
                        <alert-error :form="form" message="Failed to update"></alert-error>
                        <form action="#" @submit.prevent="updateProfile" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="">Change Profile Image (Recomended Resolution : 483x613)</label>
                                    <div id="image-preview" class="image-preview" :style="'background-image: url('+profile.image_url+')'">
                                        <label for="image-upload" id="image-label">Change Image</label>
                                        <input type="file" name="image" id="image-upload" @change="selectFile">
                                    </div>
                                    <has-error :form="form" field="image"></has-error>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-sm-4">
                                    <label for="">First name</label>
                                    <input name="first_name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }" placeholder="First name..." v-model="form.first_name">
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Last name</label>
                                    <input name="last_name" type="text" class="form-control" placeholder="Last name..." v-model="form.last_name">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="">Job Title</label>
                                    <input name="job_title" type="text" class="form-control" placeholder="Job Title..." v-model="form.job_title">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Bio</label>
                                    <textarea name="bio" cols="30" rows="5" class="form-control" v-model="form.bio"></textarea>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Upload / Change Your CV</label>
                                    <input type="file" id="cv" name="cv" class="form-control-file" @change="selectCv">
                                    <has-error :form="form" field="cv"></has-error>
                                </div>
                                <div class="form-group col-12">
                                    <div class="mb-3 mt-3">
                                        <p class="text-muted"><strong>Social & Contact</strong></p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="">Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        </div>
                                        <input type="tel" class="form-control phone-number" placeholder="Phone number" v-model="form.phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email address" v-model="form.email" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="">Facebook</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-facebook"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Facebook" v-model="form.fb" name="fb">
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="">Github</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-github"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Github" v-model="form.github" name="github">
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="">Twitter</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-twitter"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Twitter.." v-model="form.twitter" name="twitter">
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="">Instagram</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Instagram.." v-model="form.insta" name="insta">
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="">Linkedin</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-linkedin"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Linkedin" v-model="form.linkedin" name="linkedin">
                                    </div>
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="">Skype</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-skype"></i>
                                        </div>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Skype.." v-model="form.skype" name="skype">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <button :disabled="form.busy" class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
          </div>
      </div>
  </section>
</template>
<script>
import { serialize }from 'object-to-formdata';
export default {
    data(){
        return {
            profile: {},
            form: new Form({
                first_name : '',
                last_name : '',
                job_title : '',
                bio : '',
                email : '',
                phone: '',
                fb : "",
                twitter : '',
                insta : '',
                skype : '',
                linkedin: '',
                github : '',
                cv: null,
                image: null,
            }),
        }
    },
    mounted(){
        $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });
    },
    created(){
        this.getProfileData();
    },
    methods:{
        getProfileData(){
            axios.get('/api/get-profile-data').then((resp)=>{
                return resp.data;
            }).then((data)=>{
                this.profile = data;
                this.form.first_name = data.first_name;
                this.form.last_name = data.last_name;
                this.form.job_title = data.job_title;
                this.form.bio = data.bio;
                this.form.email = data.email;
                this.form.phone= data.phone;
                this.form.fb = data.fb;
                this.form.twitter = data.twitter;
                this.form.insta = data.insta;
                this.form.skype = data.skype;
                this.form.linkedin= data.linkedin;
                this.form.github = data.github;
                
            }).catch((err)=>{
                console.error(err.response.data);
            });
        },
        selectFile(e){
            const file = e.target.files[0];
            if(file)
            {
                this.form.image = file;
            }
            else
            {
                this.form.image = "";
            }
        },
        selectCv(e){
            const cv = e.target.files[0];
            if(cv)
            {
                this.form.cv = cv;
            }
            else
            {
                this.form.cv = '';
            }
        },
        updateProfile(){
            this.form.submit('post','/admin/update-profile',{
                transformRequest: [function(data,headers){
                    return serialize(data)
                }]
            }).then((resp)=>{
                return resp.data;
            }).then((data)=>{
                if(data.status == "OK")
                {
                    Swal.fire({
                        title : "Success",
                        icon: "success",
                        text: data.msg,
                    });
                }
                else
                {
                    Swal.fire({
                        title : "Failed",
                        icon: "error",
                        text: data.msg,
                    });
                }
            }).catch((err)=>{
                console.error(err.response.data);
            });
        }
    }
}
</script>

<style>

</style>