<template>
    <div class="container mt-4">

        <nav class="navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                     <button class="btn btn-primary btn-xl" @click="assignModalNotice">Assign Supervisor Student<i class="fas fa-users"></i></button>
                </li>
            </ul>
            <ul class="ml-auto mb-0">
                <li class="nav-item">
                   <router-link to="/student-supervisor-list" class="btn btn-primary btn-xl" @click="assignModalNotice">View Assignment List<i class="fas fa-users"></i></router-link>
                </li>
            </ul>
        </nav>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="card" v-if="$gate.isAdminOrSupervisor()">
              <div class="card-header">
                <h3 class="card-title text-bold">Registered Admins and Supervisors</h3>
                <div class="card-tools d-flex">
                    <div class="mr-4">
                         <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus"></i></button>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>User's Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Registered At</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td><span :class="[user.type === 'admin' ? 'badge badge-admin' : 'badge badge-student', user.type === 'supervisor' ?  'badge badge-supervisor' : 'badge badge-admin']">{{ user.type | upText}}</span></td>
                      <td>{{ user.created_at | dateFormat }}</td>
                      <td> 
                            <!-- <a class="btn btn-success" href="">Show <i class="fa fa-eye"></i></a> -->
                            <a class="btn btn-primary" href="" @click.prevent="editModal(user)">Edit <i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" @click.prevent="deleteUser(user.id, user.name)" href="">Delete <i class="fa fa-trash"></i></a>
                     </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getSupervisorsResults"></pagination>
              </div>
            </div>

            <div v-if="!$gate.isAdminOrSupervisor()">
                <not-found></not-found>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Button trigger modal -->
 
        <!-- Add New User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Add User <i class="fas fa-user-plus"></i></h5>
                <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Update User <i class="fas fa-user-plus"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editMode ? updateUser() : createUser()" >
                <div class="modal-body">
                    <!-- <alertError :form="form" /> -->
                    <div class="form-group">
                        <input id="name" v-model="form.name" type="text" name="name"  placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name" />
                    </div>
                     <div class="form-group">
                        <input id="regno" v-model="form.regno" type="text" name="regno"  placeholder="Supervisor/Admin Number" class="form-control" :class="{ 'is-invalid': form.errors.has('regno') }">
                        <has-error :form="form" field="regno" />
                    </div>
                    <div class="form-group">
                        <input id="email" v-model="form.email" type="email" name="email"  placeholder="Email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email" />
                    </div>
                    <div class="form-group">
                        <select id="department" v-model="form.department" name="department" class="form-control" :class="{ 'is-invalid': form.errors.has('department') }">
                            <option value="" disabled selected>Select a Department</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="ETS">ETS</option>
                            <option value="SIK">SIK</option>
                        </select>
                        <has-error :form="form" field="department" />
                    </div>
                    <div class="form-group">
                        <select id="type" v-model="form.type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="" disabled selected>Select User Role</option>
                            <option value="admin">Admin</option>
                            <!-- <option value="student">Student</option> -->
                            <option value="supervisor">Supervisor</option>
                        </select>
                        <has-error :form="form" field="type" />
                    </div>
                    <div class="form-group">
                        <input id="password" v-model="form.password" type="password" name="password"  placeholder="Password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password" />
                    </div>
                    <div class="form-group">
                    <label class="form-check-label mr-3" for="inlineRadio1">Select Gender</label>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" v-model="form.gender" type="radio" name="gender" id="gender" value="Male" :class="{ 'is-invalid': form.errors.has('gender') }" >
                       <label class="form-check-label " for="inlineRadio1">Male</label>
                       <has-error :form="form" field="gender" />
                    </div>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" v-model="form.gender" type="radio" name="gender" id="gender" value="Female" :class="{ 'is-invalid': form.errors.has('gender') }" >
                       <label class="form-check-label " for="inlineRadio1">Female</label>
                       <has-error :form="form" field="gender" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show="!editMode" type="submit" class="btn btn-primary">Create User</button>
                <button v-show="editMode" type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
        </div>
        </div>
    </div>

    <!-- Supervisor Assignment List Modal -->
    <div class="modal fade" id="showListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Student vs Supervisors List <i class="fas fa-user-plus"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-md-12">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Reg No.</th>
                                    <th>Student Name</th>
                                    <th>Department</th>
                                    <th>Supervisor Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="student in students.data" :key="student.id" class="mb-3">
                                    <td>{{ student.id }}</td>
                                    <td >{{ student.regno }}</td>
                                    <td> {{ student.student_name }}  </td>
                                    <td> {{ student.department }}  </td>
                                    <td> {{ student.name }}  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <pagination :data="students" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</div>
    
</template>

<script>
    export default {
        data: () => {
            return {
              editMode: false,
              students : {},
              users: {},
              form : new Form({
                  'id': '',
                  'regno': '',
                  'name': '',
                  'email': '',
                  'password': '',
                  'gender': '',
                  'type': '',
                  'department': '',
              })
            }
        },
        methods: {
            assignModalNotice(){
                swal.fire({
                title: 'Assign Supervisors to Students Automatically?' ,
                text: "It won't take long!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Assign!'})
                .then((result) => {
                    if (result.isConfirmed) {
                        // Send request to the server
                        axios.get('/supervisors-assignment')
                        axios.get('/supervisors-assignment-list')
                        .then(({ data }) =>{
                            this.students = data
                            swal.fire(
                                'Assignment was Successfull!',
                                'success'
                            )
                            Fire.$emit('refreshUsers');
                            $('#showListModal').modal('show');
                        }).catch( () => {
                        swal.fire('Failed', 'There was something wrong', 'warning');
                        })
                    }
                })
            },

          getResults(page = 1) {
			      axios.get('/supervisors-assignment-list?page=' + page)
				  .then(response => {
					    this.students = response.data
			    	});
		     },

             getSupervisorsResults(page = 1) {
                  axios.get('/admin-dashboard/supervisors-list?page=' + page)
                  .then(response => {
                        this.users = response.data
                    });
             },

          updateUser(){
            this.$Progress.start();
            this.form.put('/supervisors')
            .then(({ data }) => {
                this.users = data
              swal.fire({
                title: 'Update' ,
                text: "User information updated successfully",
                icon: 'success',
			})
            this.$Progress.finish();
            Fire.$emit('refreshUsers');
            $('#addUserModal').modal('hide');
            })
            .catch(() => {
              this.$Progress.fail();
            })
          },

			newModal(){
                this.editMode = false;
				this.form.reset();
				$('#addUserModal').modal('show');
			},

			editModal(user){
                this.editMode = true;
				this.form.reset();
				$('#addUserModal').modal('show');
				this.form.fill(user);
			},

			deleteUser (id, name) {
				swal.fire({
				title: 'Delete '+ name + '?' ,
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete!'})
				.then((result) => {
                    if (result.isConfirmed) {
                        // Send request to the server
                        this.form.delete('api/user/'+id)
                        .then(() =>{
                        swal.fire(
                            'Deleted!',
                            name + ' deleted successfully.',
                            'success'
                        )
                        Fire.$emit('refreshUsers');
                        }).catch( () => {
                        swal.fire('Failed', 'There was something wrong', 'warning');
                        })
                    }
			    })
			},

			loadUsers(){
                if(this.$gate.isAdminOrSupervisor()){
                    axios.get('/admin-dashboard/supervisors-list').then(({ data }) => (this.users = data));
                }
		    },

			createUser(){
				this.$Progress.start();
				this.form.post('/supervisors')
				.then(() => {
					Fire.$emit('refreshUsers');
					toast.fire({
						type: 'success',
						title: 'User created successfully'
					})
					this.$Progress.finish();
					$('#addUserModal').modal('hide');
				})
				.catch(() => {
                    this.$Progress.fail();
				})
			}
			},
			created() {
                Fire.$on('searching', () => {
                    let query = this.$parent.search;
                    axios.get('api/findUser?q=' + query)
                    .then((data) => {
                        this.users = data.data;
                        // alert(this.users);
                    })
                    .catch(() => {
                        alert("Error happened");
                    });
                });
				this.loadUsers();
				Fire.$on('refreshUsers', () => {
					this.loadUsers();
				});
			}
    }
</script>
