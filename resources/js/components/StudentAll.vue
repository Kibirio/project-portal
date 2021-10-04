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
                                    <th>Student Name</th>
                                    <th>Gender</th>
                                    <th>Joined On</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="row">
                                    <div class="offset-4 col-md-6">
                                        <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                                    </div>
                                </div>
                                <tr v-for="student in students" :key="student.id" class="mb-3">
                                    <td>{{ student.id  }}</td>
                                    <td >{{ student.regno }}</td>
                                    <td>
                                        <span class="mt-0 mr-2">
                                            <div class="user-block">
                                                <img alt="" :src="getProfilePicture()" class="img-thumbnail"> 
                                            </div> 
                                        </span>
                                            {{ student.name }}
                                        </td>
                                    <td> {{ student.gender }} </td>
                                    <td>{{ student.created_at | dateFormat }}</td>
                                    <td>{{ student.department }}</td>
                                    
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                    <pagination :data="students" @pagination-change-page="getResults"></pagination>
                 </div>
            </div>
          <!-- /.col (right) -->
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                students: {},
            }
        },

        methods: {
            getProfilePicture(){
             return 'imgs/user-1.png';
           },
            loadStudents(){
                axios.get('admin-dashboard/students-list').then(({ data }) => (this.students = data));
            },

            getResults(){
                axios.get('/propose-project?page='+page).then(({ data }) => (this.students = data));
            },
        }, 

        mounted() {
            // this.loadStudents();
            alert('component created');
            Fire.$on('refreshProjects', () => {
                // axios.get('/propose-project').then(response => console.log('hello'));
        });
    }
}
</script>
