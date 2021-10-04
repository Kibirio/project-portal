<template>
	<div class="container mt-2">

		 <nav class="navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                     <button class="btn btn-outline-primary" @click="loadProjects()">Refresh <i class="fas fa-sync-alt"></i></button>
                </li>
            </ul>
            <ul class="ml-auto mb-0">
                <li class="nav-item">
                    <a class="nav-link text-muted">General Information</a>
                </li>
            </ul>
        </nav>
        <hr>

		<div class="modal fade" id="showStatusDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" v-show="isProjects" id="exampleModalLongTitle">Projects Done <i class="fas fa-user-plus"></i></h5>
							<h5 class="modal-title" v-show="isPending" id="exampleModalLongTitle">Pending Projects<i class="fas fa-user-plus"></i></h5>
							<h5 class="modal-title" v-show="isCancelled" id="exampleModalLongTitle">Project Cancelled <i class="fas fa-user-plus"></i></h5>
							<h5 class="modal-title" v-show="isApproved" id="exampleModalLongTitle">Project Approved <i class="fas fa-user-plus"></i></h5>
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
											<th>Project Title </th>
											<th>Documents</th>
											<th>Date Submitted</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="project in allProjects.list" :key="project.id" class="mb-3">
											<td>{{ project.id }}</td>
											<td >{{ project.regno }}</td>
											<td> {{ project.title }} <span class="mr-3"></i></span> </td>
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
											<td>
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
							<pagination :data="allProjects" @pagination-change-page="getResults"></pagination>
						</div>
					</div>		            
				</div>
			</div>
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
								<ckeditor :editor="editor" v-model="form.description" disabled :config="editorConfig"></ckeditor>
							</div>
							<hr>

							<label for="">Comment on the project</label>
							<ckeditor :editor="editor" v-model="form.comment" :config="editorConfig"></ckeditor>

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
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="$gate.isAdminOrSupervisor()" type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ allProjects.projects }}</h3>

						<p>Projects Done</p>
					</div>
					<div class="icon">
						<i class="fas fa-clipboard-check"></i>
					</div>
					<a href="#" @click="showProjects()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3> {{ allProjects.pending }}<sup style="font-size: 20px"></sup></h3>

						<p>Pending Projects</p>
					</div>
					<div class="icon">
						<i class="fas fa-calendar-alt"></i>
					</div>
					<a href="#" @click="showPending()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>{{ allProjects.cancelled }}</h3>

						<p>Cancelled Projects</p>
					</div>
					<div class="icon">
						<i class="fas fa-calendar-times"></i>
					</div>
					<a href="#" @click="showCancelled()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3>{{ allProjects.approved }}</h3>

						<p>Approved Projects</p>
					</div>
					<div class="icon">
						<i class="fas fa-check-double"></i>
					</div>
					<a href="#" id="approved" @click="showApproved()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<div class="row">
			<div class="offset-4 col-md-6">
				<pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
			</div>
		</div>
		<hr>

		<div class="row">
			<div class="col-md-6">
				<pie-chart :data="[
				['Python', allProjects.python ],
				['Java', allProjects.java ],
				['C#', allProjects.csharp],
				['C++', allProjects.cpp ],
				['JavaScript', allProjects.js ],
				['PHP', allProjects.php ],
				['C', allProjects.c ],
				]">								
			</pie-chart>
			<p class="text-center mt-2">Programming Languages used Statistics</p>
		</div>
		<div class="col-md-6">
			<pie-chart :data="[
			['Web Apps', allProjects.web ],
			['Mobile Apps', allProjects.apps ],
			['Machine Learning', allProjects.ml ],
			['IOT', allProjects.iot ],
			['Data Science', allProjects.ds ],
			['Networking', allProjects.network ],
			['Desktop App', allProjects.desktop ],
			]">
		</pie-chart>
		<p class="text-center mt-2">Project Type Statics</p>
		</div>
		</div>
		<hr>
		
	</div>
</template>

<script>
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {

	data: () => {
		return {
			python: '',
			java: '',
			c: '',
			cpp: '',
			php: '',
			csharp: '',
			color: 'blue',
			size: '30px',
			margin: '2px',
			radius: '2px',
			loading: false,
			isProjects: false,
			isPending: false,
			isCancelled: false,
			isApproved : false,
			count: '',
			allProjects: [],
			editor: ClassicEditor,
	        editorConfig: {
	            autosave : true,
	            wordCount :true,
	        },
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
			})

		}
	},

	methods: {
		projectCount(){
			this.count = this.allProjects;
			alert(this.count.data);
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
				$('#showProjectDetails').modal('hide');
				Fire.$emit('refreshProjects');
			})
			.catch(() => {
				this.$Progress.fail();
			})
		},

		projectDetails(project){
			this.form.reset();
			$('#showProjectDetails').modal('show');
			this.form.fill(project);
		},

		getResults(page = 1) {
			axios.get('/propose-project?page='+page).then(({ data }) => {
				this.allProjects = data
			});
		},
		showProjects(){
			this.isProjects = true;
			this.isApproved = false;
			this.isPending = false;
			this.isCancelled =false;
			this.form.reset();
			$('#showStatusDetails').modal('show');
			this.loadProjects();
			
		},
		showPending(){
			this.isProjects = false
			this.isApproved = false;
			this.isPending = true;
			this.isCancelled =false;
			this.form.reset();
			$('#showStatusDetails').modal('show');
			this.loadPending();
		},
		showCancelled(){
			this.isProjects = false;
			this.isApproved = false;
			this.isPending = false;
			this.isCancelled =true;
			this.form.reset();
			$('#showStatusDetails').modal('show');
			this.loadCancelled();
		},
		showApproved(){
			this.isProjects = false;
			this.isApproved = true;
			this.isPending = false;
			this.isCancelled =false;
			this.form.reset();
			$('#showStatusDetails').modal('show');
			this.loadApproved();
		},
		loadProjects() {
			this.loading = true;
			axios.get('/admin-dashboard/projects')
			.then(({ data }) => {
				this.allProjects = data;
				this.loading = false;
			})
			.catch(() => {
				this.loading = false;
			})
		},
		loadPending(){
			axios.get('/admin-dashboard/pending').then(({ data }) => (this.allProjects = data));
		},
		loadApproved(){
			axios.get('/admin-dashboard/approved').then(({ data }) => (this.allProjects = data));
		},
		loadCancelled(){
			axios.get('/admin-dashboard/cancelled').then(({ data }) => (this.allProjects = data));
		},
	},


	created() {
		this.loadProjects();
		Fire.$on('refreshProjects', () => {
			this.loadProjects();
			this.loadPending();
		})
	}
}
</script>
