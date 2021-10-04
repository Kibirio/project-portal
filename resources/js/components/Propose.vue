<template>
    <div class="container mt-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-bold">Propose New Project</h3>
                <div class="card-tools d-flex">
                    <div class="mr-4">
                         <button class="btn btn-success" @click="newProjectModal">New Project<i class="fas fa-user-plus"></i></button>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th> <span><i class=""></i></span> No.</th>
							<th><span><i class=""></i></span>Project Title</th>
							<th><span><i class=""></i></span>Type</th>
							<th><span><i class=""></i></span>Date Submitted</th>
							<th><span><i class=""></i></span>Status</th>
							<th><span><i class=""></i></span>Feedback</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="project in projects" :key="project.id" class="mb-3">
							<td>{{ project.id  }}</td>
							<td >{{ project.title }}</td> 
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
								<button class="btn btn-success" @click="showFeedBack(project)">View <i class="fa fa-eye"></i></button>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
              <!-- /.card-body -->

              <div class="card-footer">
                <!-- <pagination :data="projects" @pagination-change-page="getResults"></pagination> -->
              </div>
            </div>

            <!-- /.card -->
          </div>
        </div>
        <!-- Button trigger modal -->
 
        <!-- Add New User Modal -->
        <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">New Project<i class="fas fa-user-plus"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            
                    <form @submit.prevent="propose()">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input v-model="form.title" name="title" id="title" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" placeholder="Project Title">
                                    <has-error :form="form" field="title" />
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group"> 
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <select v-model="form.language" class="form-control select2" :class="{'is-invalid': form.errors.has('language') }" name="language" id="language">
                                        <option value="" selected disabled>Select Programming Language</option>
                                        <option value="Java">Java</option>
                                        <option value="Python">Python</option>
                                        <option value="C#">C#</option>
                                        <option value="C++">C++</option>
                                        <option value="C">C</option>
                                        <option value="PHP">PHP</option>
                                        <option value="Javascript">Javascript</option>
                                    </select>
                                    <has-error :form="form" field="language" />
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div> 
                                    <select v-model="form.project_type" class="form-control select2" :class="{'is-invalid': form.errors.has('project_type') }" name="project_type" id="project_type">
                                        <option value="" selected disabled>Select Project Type</option>
                                        <option value="Web Application">Web Application</option>
                                        <option value="Desktop Application">Desktop Application</option>
                                        <option value="IOT">IOT</option>
                                        <option value="Mobile Application">Mobile Application</option>
                                        <option value="Machine Learning">Machine Learning</option>
                                        <option value="Data Science">Data Science</option>
                                        <option value="Networking">Networking</option>
                                    </select>
                                    <has-error :form="form" field="project_type" />
                                </div>
                            <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.description" class="form-control" :class="{'is-invalid': form.errors.has('description') }" name="description" id="description" rows="3" placeholder="Project Description ..."></textarea>
                                <has-error :form="form" field="description" />
                            </div>
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Submit</button>
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
			projects: [],
			form: new Form({
				'id': '',
				'title': '',
				'language': '',
				'type': '',
				'description': '',
				'comment': '',
			}),
		}
	},

	// methods
	methods:{
		newProjectModal(){

		},
		showFeedBack(project){
			this.form.reset();
			$('#feedbackModal').modal('show');
			this.form.fill(project);
		},
		propose(){
			this.$Progress.start();
			this.form.post('/propose-project')
			.then(() => {
				Fire.$emit('refreshProjects');
				toast.fire({
					type: 'success',
					title: 'You have Successfully submitted a proposal '
				})
				this.$Progress.finish();
				this.form.reset();
			})
			.catch(() => {
				this.$Progress.fail()
			})
		},
		loadProjects() {
			axios.get('/admin-dashboard/projects').then(( {data} ) => (this.projects = data));
			// alert('Loading...')
		}
	},

	// 
	created() {
		this.loadProjects();
		Fire.$on('refreshProjects', () => {
			this.loadProjects();
		})
	},
}

</script>
