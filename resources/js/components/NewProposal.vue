<template>
    <div class="container mt-4">
            <!-- /.card-header -->

     	<div class="row">
     		<div class="offset-2 col-md-7">
     			<loading :active.sync="isLoading" />
     			<form @submit.prevent="propose()">
     				<label for="">Project Title</label>
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
                    	<label for="">Programming Language</label>
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
                    	<label for="">Type of Project</label>
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
                    <label for="">Describe your project idea</label>
                    <!-- <div class="form-group">
                        <textarea v-model="form.description" class="form-control" :class="{'is-invalid': form.errors.has('description') }" name="description" id="description" rows="3" placeholder="Project Description ..."></textarea>
                        <has-error :form="form" field="description" />
                    </div> -->
					  <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>

                    <!-- <button type="submit" :disabled="form.busy" class="btn btn-block btn-primary btn-lg mt-4">Submit</button> -->
                    <!-- <loader-overlay></loader-overlay> -->
                    <loading-button aria-label="Post message"
					      class="btn btn-block btn-primary mb-3 mt-2"
					      :disabled="form.busy"
					      @click.native="propose"
					      :loading="isLoading"
					      :styled="isStyled">
					</loading-button>
            </form>
     		</div>
                    
     	</div>
    </div>
       
</template>

<script>
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {

	// data
	data: () => {
		return {
			editor: ClassicEditor,
			loading: true,
      		isStyled: true,
	        editorConfig: {
	            autosave : true,
	            wordCount :true,
	        },
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
			this.isLoading = true;
			this.$Progress.start();
			this.form.post('/propose-project')
			.then(({response}) => {
				Fire.$emit('refreshProjects');
				toast.fire({
					type: 'success',
					title: 'You have Successfully submitted a proposal '
				})
				this.$Progress.finish();
				this.form.reset();
				this.isLoading = false;
			})
			.catch(({ response }) => {
				this.$Progress.fail()
					let msg = response.data.message;
					toast.fire({
						type: 'error',
						title: msg
				})
			})
			.finally(() => this.isLoading = false);
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
