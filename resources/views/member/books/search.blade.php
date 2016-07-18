{!! Form::open(['method'=>'GET','url'=>'member/booksearch','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
<div class="input-group custom-search-form">
    <input type="text" class="form-control" name="search" placeholder="Search...">
    <span class="input-group-btn">
        <button class="btn btn-default-sm" type="submit">
            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"-->i>
        </button>
    </span>
</div>

<div class="container">
	<div class="row">
		<div style="width:400px" class="pull-right">
	
		<div class="clearfix"></div>
		<div class="col-md-12">
			<h3 style="padding-bottom:25px;">Our Books</h3>
			<div class="pricing-grids" id="book_list">
				@foreach($books as $index =>$result)
				<div class="pricing-grid col-lg-3 col-md-3 col-sm-6 col-xs-12">							
					
					<div class="clearfix"></div>
					<h5><a href="bookview/{{$result->id}}">{{$result->title}}</a></h5>
					
					<div class="clearfix"></div>
					<div>Author: {{$result->author}} </div> 
					<div class="clearfix"></div>
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
{!! Form::close() !!}

