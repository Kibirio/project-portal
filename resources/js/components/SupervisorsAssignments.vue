<template>
    <div class="container mt-4">

        <nav class="navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                     <button class="btn btn-primary btn-xl" @click="assignModalNotice">Re-assign Supervisors <i class="fas fa-users"></i></button>
                </li>
            </ul>
            <ul class="ml-auto mb-0">
                <li class="nav-item">
                    <button class="btn btn-primary btn-xl" @click="assignModalNotice">Export PDF<i class="fas fa-users"></i></button>
                </li>
            </ul>
        </nav>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="card" v-if="$gate.isAdminOrSupervisor()">
              <div class="card-header">
                <h3 class="card-title text-bold text-center">Student vs Supervisors List</h3>
                <div class="card-tools d-flex">
                    <div class="mr-4">
                         <!-- <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus"></i></button> -->
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
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
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="students" @pagination-change-page="getResults"></pagination>
              </div>
            </div>

            <div v-if="!$gate.isAdminOrSupervisor()">
                <not-found></not-found>
            </div>
            <!-- /.card -->
          </div>
        </div>
</div>
    
</template>

<script>
    export default {
        data: () => {
            return {
              students : {},
            }
        },
        methods: {
            getAssignmentList(){
                axios.get('/supervisors-assignment-list').then(({ data }) => (this.students = data))
            },
            assignSupervisors(){
                axios.get('/supervisors-assignment');
            },
            assignModalNotice(){
                swal.fire({
                title: 'Assign Supervisor to Students Automatically?' ,
                text: "It won't take long!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Assign!'})
                .then((result) => {
                    if (result.isConfirmed) {
                        // Send request to the server
                        axios.get('/supervisors-assignment');
                        // Get names server
                        axios.get('/supervisors-assignment-list')
                        .then(({ data }) =>{
                            this.students = data
                            swal.fire(
                                'Assignment was Successfull!',
                                'success'
                            )
                            this.getAssignmentList();
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
				this.getAssignmentList();
			}
    }
</script>
