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
						<h3 class="card-title text-bold">Scheduled Presentations</h3>
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
									<th>Id</th>
									<th>Reg No.</th>
									<th>Project Title </th>
									<th>Project Type</th>
									<th>Presentation Date</th>
									<th>Presentation Room</th>
									<th>Awarded</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="project in allProjects" :key="project.id" class="mb-3">
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
									<td>{{ project.presentation_date }}</td>
									<td>{{ project.room }}</td>
									<div v-if="project.isAwarded === 0">
										<td class="">
											<span class="btn btn-danger btn-xl text-white">False</span>
										</td>
									</div>
									<div v-if="project.isAwarded === 1">
										<td class="">
											<span class="btn btn-success btn-xl text-white">True</span>
										</td>
									</div>
									<td> 
										<div v-if="project.isAwarded === 0">
											<button class="btn btn-primary" @click="awardModal(project)">Award Marks<i class="fa fa"></i>
											</button>
										</div>
										<div v-if="project.isAwarded === 1">
											<button class="btn btn-primary" @click="awardModal(project)">Edit Marks<i class="fa fa"></i>
											</button>
										</div>
										<!-- <button v-show="" class="btn btn-primary btn-xl" @click="editModal(project)" >Edit Marks<i class="fa fa"></i></button> -->
									</td>
								</tr>
						</tbody>
					</table>
				</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<pagination :data="allProjects.presentations" @pagination-change-page="getResults"></pagination>
			</div>
		</div>

		<div v-if="!$gate.isAdminOrSupervisor()">
			<not-found></not-found>
		</div>
		<!-- /.card -->
	</div>
</div>
	<div class="modal fade" id="showAwardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Award Marks To Project<i class="fas fa"></i></h5>
					<h5  class="modal-title" id="exampleModalLongTitle">Edit Student Marks<i class="fas fa"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form @submit.prevent="awardProject()" >
					<div class="modal-body">
						<div class="row">
							<div class="col-md-8">
								<label for="">Registration Number</label>
								<div class="form-group">
			                        <input id="regno" v-model="form.regno" type="text" name="regno"  disabled placeholder="Registration Number" class="form-control" :class="{ 'is-invalid': form.errors.has('regno') }">
			                        <has-error :form="form" field="regno" />
			                    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Project Marks</label><br>
										<input type="text" v-model="form.marks" class="form-control" 
											name="marks" id="marks" placeholder="Award Marks" 
											:class="{ 'is-invalid': form.errors.has('marks') }"
											>
									<has-error :form="form" field="presentation_date" />
								</div>
							</div>
							<div class="col-md-12">
								<label for="">Remarks</label>
                                    <div class="form-group">
										<textarea v-model="form.remarks" class="form-control" :class="{'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks" rows="3" placeholder="Short Remarks on Project...">
										</textarea>
									<has-error :form="form" field="remarks" />
								</div>
                            </div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Award Marks</button>
                		<!-- <button  type="submit" class="btn btn-primary">Edit Marks</button> -->
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
			allProjects: {},
			form: new Form({
				'id': '',
				'regno': '',
				'marks': '',
				'remarks': '',
			}),
		}
	},

	methods: {
		editModal(project){
                this.editMode = true;
				this.form.reset();
				$('#showEditModal').modal('show');
				this.form.fill(project);
			},
		awardProject(){
			// this.editMode = false;
			this.$Progress.start();
			this.form.put('/presentation-list/award-project')
			.then(() => {
				swal.fire({
					title: 'Awarding' ,
					text: "Project Successfully Awarded!",
					icon: 'success',
				})
				Fire.$emit('refreshProjects');
				this.$Progress.finish();
				$('#showAwardModal').modal('hide')
			})
			.catch(() => {
				this.$Progress.fail();
				$('#showAwardModal').modal('hide')
				swal.fire({
					title: 'Failed' ,
					text: "An error occurred! Try Again",
					icon: 'error',
				})
			})
		},

		awardModal(project){
			this.editMode =false;
			this.form.reset();
			$('#showAwardModal').modal('show');
			this.form.fill(project);
		},

		getResults(page = 1) {
			axios.get('/propose-project?page='+page).then(({ data }) => (this.allProjects = data.presentations));
		},
		
		loadPresentations() {
			axios.get('/presentation-list').then(({ data }) => {
				this.allProjects = data.presentations;
			});
		},
	},

	created() {
		this.loadPresentations();
		Fire.$on('refreshProjects', () => this.loadPresentations());
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
