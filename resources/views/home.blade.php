@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center feather-grid"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hi <strong>{{ Auth::user()->name }},</strong> {{ __('You are logged in to ') }}{{ config('app.name', 'Laravel') }}</h5>
				</br> 
				<hr>
								
			<div class="row w-100">
					<div class="col-md-3">
						<div class="card border-info mx-sm-1 p-3 bg-info">
							<div class="card border-info text-info p-3" ><span class="text-center fa fa-plane-departure" aria-hidden="true"></span></div>
							<div class="text-info text-center mt-3"><h4>LOGISTIK</h4></div>
							<div class="text-info text-center mt-2"><h1>{{ $logistik }}</h1></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card border-success mx-sm-1 p-3 bg-warning">
							<div class="card border-success text-success p-3 my-card"><span class="text-center fa fa-luggage-cart" aria-hidden="true"></span></div>
							<div class="text-success text-center mt-3"><h4>POSKO</h4></div>
							<div class="text-success text-center mt-2"><h1>{{ $posko }}</h1></div>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="card border-danger mx-sm-1 p-3 bg-danger">
							<div class="card border-danger text-danger p-3 my-card" ><span class="text-center fa fa-person-booth" aria-hidden="true"></span></div>
							<div class="text-danger text-center mt-3"><h4>BENCANA</h4></div>
							<div class="text-danger text-center mt-2"><h1>{{ $bencana }}</h1></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card border-warning mx-sm-1 p-3 bg-success">
							<div class="card border-warning text-warning p-3 my-card" ><span class="text-center fa fa-users" aria-hidden="true"></span></div>
							<div class="text-warning text-center mt-3"><h4>Users</h4></div>
							<div class="text-warning text-center mt-2"><h1>{{ Auth::user()->count() }}</h1></div>
						</div>
					</div>
				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection