@extends('layouts.master')

	@section('dashboard')
		<!-- Main content -->
		<dashboard 
			:pending= '{{ $pending }}'
			:approved = '{{ $approved }}'
			:projects = '{{ $projects }}'
			:cancelled = '{{ $cancelled }}'
			:python = '{{ $python }}'
			:java = '{{ $java }}'
			:cpp = '{{ $cpp }}'
			:c = '{{ $c }}'
			:js = '{{ $js }}'
			:csharp = '{{ $csharp }}'
			:php = '{{ $php }}'
			:web = '{{ $web }}'
			:apps = '{{ $apps }}'
			:desktop = '{{ $desktop }}'
			:iot = '{{ $iot }}'
			:networking = '{{ $networking }}'
			:ml = '{{ $ml }}'
			:ds = '{{ $ds }}'
			>
		</dashboard>
		<!-- /.content -->
	@endsection
	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->
	
