<template>
    <div class="container mt-2">
        <div class="row">
          <!-- /.col (left) -->
		  	<div class="col-md-12">
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
						<thead>
							<tr>
								<th>No.</th>
								<th>Reg No.</th>
								<th>Project Title </th>
								<th>Documents</th>
								<th>Date Submitted</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="project in projects.data" :key="project.id" class="mb-3">
								<td>{{ project.id  }}</td>
								<td >{{ project.regno }}</td>
								<td> {{ project.title }} <span class="mr-3"><i class="fas fa-ellipsis-v"></i></span> </td>
								<td>
									<span 
										class="dot-app mr-2"
										:class="[
											project.project_type === 'Web Application' ? 'dot-web' : '', 
											project.project_type == 'Desktop Application' ?  'dot-app' : '',
											project.project_type == 'IOT' ?  'dot-iot' : '',
											project.project_type == 'Networking' ?  'dot-net' : '', 
											project.project_type == 'Machine Learning' ?  'dot-ml' : '',
											project.project_type == 'Data Science' ?  'dot-ds' : '',
											project.project_type == 'Mobile Application' ?  'dot-app' : '',
											]">
									</span>
										{{ project.project_type }}
									</td>
								<td>{{ project.created_at | dateFormat }}</td>
								<td >
									<span :class="[
										project.status === 'pending' ? 'badge badge-pending' : '',
										project.status === 'approved' ? 'badge badge-success' : '',
										project.status === 'rejected' ? 'badge badge-failed' : '',
									]">
		
									{{ project.status }}
									</span>
								</td>
								<td> 
		      					<button class="btn btn-success" @click="projectDetails(project)">View <i class="fa fa-eye"></i></button>
		             </td>
							</tr>
						</tbody>
						</table>
					</div>
				<div class="card-footer">
            <pagination :data="projects" @pagination-change-page="getResults"></pagination>
         </div>
			</div>
          <!-- /.col (right) -->
        </div>

        <div class="modal fade" id="showProjectDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	            <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLongTitle">Project Details <i class="fas fa-user-plus"></i></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <form @submit.prevent="checkProject()" >
	                <div class="modal-body">
	                    <div class="row">
	                    	<div class="col-md-6">
	                    		<div class="form-group">
	                    			<label for="">Student Name</label>
			                        <input id="name" v-model="form.name" type="text" name="name" disabled placeholder="Student Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
			                        <has-error :form="form" field="name" />
	                    		</div>
	                    	</div>
	                    	<div class="col-md-6">
	                    		<label for="">Registration Number</label>
	                    		<div class="form-group">
	                        		<input id="regno" v-model="form.regno" type="text" name="regno" disabled placeholder="Registration Number" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
			                        <has-error :form="form" field="name" />
			                    </div>
	                    	</div>
	                    </div>

	                    <div class="row">
	                    	<div class="col-md-8">
	                    		<label for="">Project Title</label>
	                    		<div class="form-group">
			                        <input id="title" v-model="form.title" type="text" name="title"  disabled placeholder="Project Title" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
			                        <has-error :form="form" field="name" />
	                    		</div>
	                    	</div>
	                    	<div class="col-md-4">
	                    		<label for="">Programming Language</label>
	                    		<div class="form-group">
	                        		<input id="language" v-model="form.language" type="text" name="language" disabled placeholder="Programming Language" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
			                        <has-error :form="form" field="name" />
			                    </div>
	                    	</div>
	                    </div>

	                    <div class="row">
	                    	<div class="col-md-6">
	                    	<label for="">Project Type</label>
	                    		<div class="form-group">
			                        <input id="project_type" v-model="form.project_type" type="text" name="project_type" disabled  placeholder="Project Type" class="form-control" :class="{ 'is-invalid': form.errors.has('project_type') }">
			                        <has-error :form="form" field="project_type" />
	                    		</div>
	                    	</div>
	                    	<div class="col-md-6">
			                    <label for="">Student Email</label>
			                    <div class="form-group">
			                        <input id="email" v-model="form.email" type="email" name="email" disabled placeholder="Email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
			                        <has-error :form="form" field="email" />
			                    </div>
	                    	</div>
	                    </div>
	                    

	                    <label for="">Project Description</label>
	                    <div class="form-group">
	                        <textarea id="description" v-model="form.description" name="description" disabled rows="5" placeholder="Describe briefly about project." class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
	                        <has-error :form="form" field="bio" />
	                    </div>
	                    <hr>

	                    <div class="form-group">
							 <label class="form-check-label mr-3" for="inlineRadio1">Check for the project  status</label>
	                    	<div class="form-check form-check-inline">
							  <input v-model="form.status" class="form-check-input" type="radio" name="status" id="status" value="pending" checked="Pending">
							  	<label class="form-check-label " for="inlineRadio1">Pending</label>
							</div>
							<div class="form-check form-check-inline">
							  <input v-model="form.status" class="form-check-input" type="radio" name="approved" id="approved" value="approved">
							  	<label class="form-check-label" for="inlineRadio1">Approve</label>
							</div>
							<div class="form-check form-check-inline">
							  <input v-model="form.status" class="form-check-input" type="radio" name="rejected" id="rejected" value="rejected">
							  	<label class="form-check-label" for="inlineRadio1">Reject</label>
							</div>
	                    </div>		

	                    <label for="">Comment on the project</label>
	                    <div class="form-group">
	                        <textarea id="comment" v-model="form.comment" name="comment"  rows="3" cols="5" placeholder="Comments on the project" class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>
	                        <has-error :form="form" field="comment" />
	                    </div>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			                <button v-show="$gate.isAdminOrSupervisor()" type="submit" class="btn btn-primary">Submit</button>
			            </div>
			        </form>
       			 </div>
        	</div>
    		</div>
    </div>
</template>

<script>
export default {

	// data
	data: () => {
		return {
			projects: {},
			form: new Form({
				'id': '',
				'name': '',
				'regno': '',
				'title': '',
				'language': '',
				'project_type': '',
				'email': '',
				'description': '',
				'status': '',
				'comment': ''
			}),
		}
	},

	// methods
	methods:{
		getResults(page = 1) {
			axios.get('/propose-project?page='+page).then(({ data }) => (this.projects = data));
		     },
		checkProject(){
            this.$Progress.start();
            this.form.put('api/bcs-dept/check-project')
            .then(() => {
              swal.fire({
                title: 'Update' ,
                text: "Project Successfully Checked!",
                icon: 'success',
						})
            this.$Progress.finish();
            Fire.$emit('refreshProjects');
            $('#showProjectDetails').modal('hide');
            })
            .catch(() => {
              this.$Progress.fail();
            })
          },

          // Method to show project information
		projectDetails(project){
			this.form.reset();
			$('#showProjectDetails').modal('show');
			this.form.fill(project);
		},
		propose(){
			this.$Progress.start();
			this.form.post('/propose-project')
			.then(() => {
				Fire.$emit('refreshProjects');
				toast.fire({
					type: 'success',
					title: 'You have Successfully submitted proposal '
				})
				this.$Progress.finish();
				this.form.reset();
				alert(this.projects);
			})
			.catch(() => {

			})
		},
		loadProjects() {
			axios.get('/propose-project').then(({ data }) => (this.projects = data));
		}
	},

	// 
	created() {
		// alert('created');
		this.loadProjects();
		Fire.$on('refreshProjects', () => {
			this.loadProjects();
		})
	},
}

</script>
