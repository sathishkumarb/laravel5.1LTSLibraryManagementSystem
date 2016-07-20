@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div style="width:400px">
	
		<div class="clearfix"></div>
		<div class="col-md-12">
			<h3 style="padding-bottom:25px;">Laoned Books</h3>
			<div class="pricing-grids" id="book_list">
				@foreach($books as $index =>$result)
				<div class="pricing-grid col-lg-3 col-md-3 col-sm-6 col-xs-12">							
					
					<div class="clearfix"></div>
					<h5><a href="bookview/{{$result->id}}">{{$result->title}}</a></h5>
					
					<div class="clearfix"></div>
					<div>Author: {{$result->author}} </div> 

					<div class="clearfix"></div>
					<div>Quantities: {{$result->quantities}} </div> 
<div class="clearfix"></div>

					
					
				</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
	
		</div>			 
	</div>
</div>

<div class="clearfix"></div>

@endsection

