<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 m-4">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header text-white" style="background-image:url('./imgs/pexel1.jpg')">
            <h3 class="widget-user-username text-right">{{ this.form.student_name }}</h3>
          </div>
          <div class="widget-user-image">
            <!-- <img class="img-circle" :src="getProfilePicture()" alt="User Avatar">	 -->
          </div>    <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- </div> -->
    <div class="offset-2 col-md-7">
        <pulse-loader :loading="isLoading" :color="color" :size="size"></pulse-loader>
      </div>

    <div class="offset-2 col-md-7 ">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane" id="activity">
              <!-- Post -->
              <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="" alt="user image">
                  <span class="username">
                    <a href="#">Jonathan Burke Jr.</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                  </span>
                  <span class="description">Shared publicly - 7:30 PM today</span>
                </div>
                <!-- /.user-block -->
                <p>
                  Lorem ipsum represents a long-held tradition for designers,
                  typographers and the like. Some people hate it and argue for
                  its demise, but others ignore the hate as they create awesome
                  tools to help create filler text for everyone from bacon lovers
                  to Charlie Sheen fans.
                </p>

                <p>
                  <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                  <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                  <span class="float-right">
                    <a href="#" class="link-black text-sm">
                      <i class="far fa-comments mr-1"></i> Comments (5)
                    </a>
                  </span>
                </p>

                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
              </div>
              <!-- /.post -->

              <!-- Post -->
              <div class="post clearfix">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="" alt="User Image">
                  <span class="username">
                    <a href="#">Sarah Ross</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                  </span>
                  <span class="description">Sent you a message - 3 days ago</span>
                </div>
                <!-- /.user-block -->
                <p>
                  Lorem ipsum represents a long-held tradition for designers,
                  typographers and the like. Some people hate it and argue for
                  its demise, but others ignore the hate as they create awesome
                  tools to help create filler text for everyone from bacon lovers
                  to Charlie Sheen fans.
                </p>

                <form class="form-horizontal">
                  <div class="input-group input-group-sm mb-0">
                    <input class="form-control form-control-sm" placeholder="Response">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.post -->

              <!-- Post -->
              <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="" alt="User Image">
                  <span class="username">
                    <a href="#">Adam Jones</a>
                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                  </span>
                  <span class="description">Posted 5 photos - 5 days ago</span>
                </div>
                <!-- /.user-block -->
                <div class="row mb-3">
                  <div class="col-sm-6">
                    <img class="img-fluid" src="" alt="Photo">
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="" alt="Photo">
                        <img class="img-fluid" src="" alt="Photo">
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="" alt="Photo">
                        <img class="img-fluid" src="" alt="Photo">
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <p>
                  <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                  <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                  <span class="float-right">
                    <a href="#" class="link-black text-sm">
                      <i class="far fa-comments mr-1"></i> Comments (5)
                    </a>
                  </span>
                </p>

                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
              </div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
              <!-- The timeline -->
              <div class="timeline timeline-inverse">
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-danger">
                    10 Feb. 2014
                  </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-envelope bg-primary"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                      <a href="#" class="btn btn-primary btn-sm">Read more</a>
                      <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-user bg-info"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                    </h3>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-comments bg-warning"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                    <div class="timeline-body">
                      Take me to your leader!
                      Switzerland is small and neutral!
                      We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                      <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <div class="time-label">
                  <span class="bg-success">
                    3 Jan. 2014
                  </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                  <i class="fas fa-camera bg-purple"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                    <div class="timeline-body">
                      <img src="https://placehold.it/150x100" alt="...">
                      <img src="https://placehold.it/150x100" alt="...">
                      <img src="https://placehold.it/150x100" alt="...">
                      <img src="https://placehold.it/150x100" alt="...">
                    </div>
                  </div>
                </div>
                <!-- END timeline item -->
                <div>
                  <i class="far fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane active" id="settings">
              <form class="form-horizontal">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Name</label><br>
                        <input v-model="form.student_name" type="text" class="form-control" id="student_name" placeholder="Student Name" :class="{ 'is-invalid': form.errors.has('student_name') }">
                    <has-error :form="form" field="presentation_date" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Registration No. </label>
                    <input v-model="form.regno" type="text" name="regno" class="form-control" id="regno" placeholder="Registration Number" :class="{ 'is-invalid': form.errors.has('regno') }">
                  <has-error :form="form" field="regno" />
                  </div>
                </div>

              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="School">School</label><br>
                        <select disabled="" name="school" id="school" v-model="form.school" class="custom-select" 
                        :class="{ 'is-invalid': form.errors.has('school') }">
                          <option selected>Select School</option>
                          <option value="SCI">School of Computing</option>
                        </select>
                  </div>
                </div>
                <div class="col-md-6"> 
                    <label for="">Select Department</label>
                    <select 
                    id="department" 
                    v-model="form.department" 
                    name="department"  
                    class="custom-select"
                    :class="{ 'is-invalid': form.errors.has('department') }"
                    >
                    <option value="select" disabled selected="selected">Select Departmemt</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="SIK">SIK</option>
                    <option value="ETS">ETS</option>
                  </select>
                  <has-error :form="form" field="department" />
                </div>
            </div>

            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email</label><br>
                        <input v-model="form.email" type="test" class="form-control" id="email" placeholder="email" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Supervisor</label>
                    <input v-model="form.supervisor" type="test" disabled name="supervisor" 
                    class="form-control" id="supervisor" placeholder="Supervisor"
                    :class="{ 'is-invalid': form.errors.has('supervisor') }">
                  <has-error :form="form" field="supervisor" />
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Password</label><br>
                        <input v-model="form.password" type="password" class="form-control" id="password" name="password" 
                        placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Confirm Password</label>
                    <input v-model="form.password" type="password" name="confirmPassword" 
                    class="form-control" id="confirmPassword" placeholder="Confirm Password"
                    :class="{ 'is-invalid': form.errors.has('confirmPassword') }">
                  <has-error :form="form" field="confirmPassword" />
                  </div>
              </div>
            <div class="form-group row">
              <div class="offset-sm-0 col-sm-12">
                <!-- <button @click.prevent="updateProfile" type="submit" class="btn btn-primary btn-block">Update</button> -->
                <loading-button aria-label="Post message"
                      class="btn btn-block btn-primary mb-3 mt-2"
                      :disabled="form.busy"
                      @click.native="updateProfile"
                      :loading="loading"
                      :styled="isStyled">Update
                </loading-button>
              </div>
            </div>
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div><!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>
</div>
</template>

<style>
.widget-user-header{
  background-position: center center;
  height: 100px !important;
  background-size: cover;
  /*margin-right: 250p;*/
}
</style>

<script>
export default {
  data: ()=> {
    return{
      loading: false,
      isStyled: true,
      color: 'blue',
      size: '20px',
      isLoading: false,
      form : new Form({
        'id': '',
        'student_name': '',
        'email': '',
        'password': '',
        'type': '',
        'department': '',
        'regno': '',
        'school': '',
        'supervisor': '',
      })
    }
  },
  methods: {
    getProfilePicture(){
     let photo = (this.form.photo.length > 200) ? this.form.photo : 'imgs/profile/' + this.form.photo;
     return photo;
   },
   updateProfile(){
    this.loading = true;
     this.$Progress.start();
     this.form.put('/student-profile')
     .then(() => {
      swal.fire({
       title: 'Updates' ,
       text: "Profile details saved successfully",
       icon: 'success',
     })
      this.$Progress.finish();
      this.loading = false;
    })
     .catch(({response}) => {
      this.$Progress.fail();
      swal.fire({
       title: 'Failed' ,
       text: 'An Error Occurred! Try Again!',
       icon: 'error',
     });
    })
   },
   updateProfilePicture(e){
    let file = e.target.files[0];
    let reader = new FileReader();
    if (file['size'] < 2111775){
      reader.onloadend = () => {
        this.form.photo = reader.result;
      }
      reader.readAsDataURL(file);
    }else {
      swal.fire({
       title: 'Oops' ,
       text: "File size too large",
       icon: 'error',
     })
    }
  }
},
mounted() {
  console.log('Component mounted.')
},
created() {
  this.isLoading = true
  axios.get('/student-profile')
  .then(( {data} ) => {
    this.form.fill(data.profile[0]);
    this.isLoading = false;
  })
  .catch((response) => {
    alert(response.message);
  })
}
}
</script>
