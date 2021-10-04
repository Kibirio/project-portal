@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Projects</h2>
        </div>
        <div class="pull-right">
            @can('product-create')
            <a class="btn btn-success" href="{{ route('projects.create') }}">Create New Project</a>
            @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Description</th>
        <th width="280px">Actions</th>
    </tr>
    @foreach ($projects as $key => $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>

            <form action="{{ route('projects.destroy', $product->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                @can('project-edit')
                <a class="btnn btn-primary" href="{{ route('projects.edit', $project->id) }}">Edit</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('product-delete')
                <button type="submit" class="btn btn-danger">Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $projects->links() !!}

<p class="text-center text-primary"><small>Haryx Software inc</small></p>
@endsection