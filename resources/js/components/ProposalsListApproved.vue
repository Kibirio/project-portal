<template>
	<div class="container mt-4">

		<nav class="navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<p>Export PDF</p>
					<!-- <button class="btn btn-primary btn-xl" @click="assignModalNotice">Assign Supervisor Student<i class="fas fa-users"></i></button> -->
				</li>
			</ul>
			<ul class="ml-auto mb-0">
				<li class="nav-item">
					<!-- <router-link to="/student-supervisor-list" class="btn btn-primary btn-xl" @click="assignModalNotice">View Assignment List<i class="fas fa-users"></i></router-link> -->
				</li>
			</ul>
		</nav>
		<hr>
		<div class="row">
			<div class="col-12">
				<div class="card" v-if="$gate.isAdminOrSupervisor()">
					<div class="card-header">
						<h3 class="card-title text-bold">Proposal List</h3>
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
								<button class="btn btn-success" @click="presentationModal(project)">Fix Presentation <i class="fa fa"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<pagination :data="allProjects" @pagination-change-page="getResults"></pagination>
			</div>
		</div>

		<div v-if="!$gate.isAdminOrSupervisor()">
			<not-found></not-found>
		</div>
		<!-- /.card -->
	</div>
</div>
	<div class="modal fade" id="showPresentationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Fix New Presentation<i class="fas fa"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form @submit.prevent="fixPresentation()" >
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Presentation Date</label><br>
									<date-picker name="presentation_date" id="presentation_date" 
										:class="{ 'is-invalid': form.errors.has('presentation_date') }" v-model="form.presentation_date" 
										valueType="format"
										 width="1000" placeholder="Select Presentation Date"  format="YYYY/MM/DD"> 
									</date-picker>
									<has-error :form="form" field="presentation_date" />
								</div>
							</div>
							<div class="col-md-6">
								<label for="">Presentation Room</label>
                                    <select 
                                        id="room" 
                                        v-model="form.room" 
                                        name="room"  
                                        class="custom-select"
                                        :class="{ 'is-invalid': form.errors.has('room') }"
                                        >
                                        <option disabled selected>Select Room</option>
                                        <option value="SPD 004">SPD 004</option>
                                        <option value="LBB 011">LBB 011</option>
                                        <option value="LBB 015">LBB 015</option>
                                        <option value="LBB 016">LBB 016</option>
                                    </select>
                                    <has-error :form="form" field="room" />
                            </div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Submit</button>
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
			allProjects: {},
			students : {},
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
				'comment': '',
				'presentation_date': '',
				'room': '',
				'isAwarded': '',
				'isFixed': '',
			})
		}
	},

	methods: {
		fixPresentation(){
			this.$Progress.start();
			this.form.put('/fix-presentation')
			.then(() => {
				swal.fire({
					title: 'Update' ,
					text: "Project Successfully Checked!",
					icon: 'success',
				})
				Fire.$emit('refreshProjects');
				this.$Progress.finish();
				$('#showPresentationModal').modal('hide');
			})
			.catch(() => {
				this.$Progress.fail();
			})
		},

		presentationModal(project){
			this.form.reset();
			$('#showPresentationModal').modal('show');
			this.form.fill(project);
		},

		getResults(page = 1) {
			axios.get('/propose-project?page='+page).then(({ data }) => (this.allProjects = data));
		},
		
		loadProjects() {
			axios.get('/admin-dashboard/projects').then(({ data }) => (this.allProjects = data));
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
		this.loadApproved();
		Fire.$on('searching', () => {
			let query = this.$parent.search;
			axios.get('api/findUser?q=' + query)
			.then((data) => {
				this.allProjects = data;
					// alert(this.users);
				})
			.catch(() => {
				alert("Error happened");
			});
		});
	}
}
</script>
