
@extends('layouts.app')
@push('style')
	<style type="text/css">
		.my-active span{
			background-color: #5cb85c !important;
			color: white !important;
			border-color: #5cb85c !important;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                  <table class="table table-stripped">
                  	<thead>
                  		<tr>
                  			<th>No</th>
                  			<th>Name</th>
                  			<th>Email</th>
                  		</tr>
                  	</thead>
                  	<tbody>
                  		@forelse($words as $user)
                  		<tr>
                  			<td>{{ $loop->index + 1 }}</td>
                  			<td>{{ $user->word }}</td>
                  			<td>{{ $user->word_type }}</td>
                  		</tr>
                  		@empty
                  		<p>No user found!</p>
                  		@endforelse
                  	</tbody>
                  </table>
               {{ $words->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection
