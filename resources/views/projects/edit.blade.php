@extends(layouts.app)

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Edit Project</h2>
		</div>
		<div class="pull-right">
			<a href="{{ route('projects.index') }}" class="btn btn-primary">Back</a>
		</div>
	</div>
</div>

@if ($errors->any())
	<div class="alert alert-danger">
		<strong>Whoops</strong>There was some problem with your input. <br><br>
		<ul>
			@foreach ($errors->all() as $errors)
				<li>{{ $error }}</li>
			@endforeach	
		</ul>
	</div>
@endif

<form action="{{  route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $project->name }}" class="form-control" placeholder="Name">  
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" style="height: 150px;" placeholder="Project Description"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		    <button type="submit" class="btn btn-primary">Submit</button>
	    </div>
    </div>
</form>

<p class="text-center text-primary"><small>copyright 2020 Harryx Software Inc</small></p>

@endsection