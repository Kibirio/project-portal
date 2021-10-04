<template>
    <div class="container mt-4">
        <div class="row">
          <div class="col-12">
            <div class="card" v-if="$gate.isAdminOrSupervisor()">
              <div class="card-header">
                <h3 class="card-title text-bold">Registered Users</h3>
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
                        <!-- <td v-for="x = 0; x < user.length(); x++">
                            {{ x }}
                        </td> -->
                      <!-- <td>{{ user.id }}</td> -->
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
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
                        <input id="super_id" v-model="form.super_id" type="text" name="super_id"  placeholder="Supervisor/Admin Number" class="form-control" :class="{ 'is-invalid': form.errors.has('super_id') }">
                        <has-error :form="form" field="super_id" />
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
    </div>
    
</template>

<script>
    export default {
        data: () => {
            return {
              editMode: false,
              users : {},
              form : new Form({
                  'id': '',
                  'super_id': '',
                  'name': '',
                  'email': '',
                  'password': '',
                  'type': '',
                  'department': '',
              })
            }
        },
        methods: {
          getResults(page = 1) {
			      axios.get('api/user?page=' + page)
				  .then(response => {
					    this.users = response.data;
			    	});
		     },
          updateUser(){
            this.$Progress.start();
            this.form.put('api/user/'+this.form.id)
            .then(() => {
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
                    axios.get('api/user').then(({ data }) => (this.users = data));
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
