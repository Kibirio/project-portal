<template>
		<div class="container mt-2">

				<!-- <dashboard></dashboard> -->
				<projectDetails></projectDetails>

		</div>
</template>

<script>
	export default {
		data: () => {
			return {
				projects: {},
			}
		},

		methods: {

		}, 

		created() {
			// alert('dashboard created..');
			Fire.$on('refreshProjects', () => {
				axios.get('/propose-project').then(response => console.log('hello'));
		})
		}
}
</script>
