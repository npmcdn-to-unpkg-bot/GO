<?php
	$user = Auth::user();
	$current_group_id = session()->get('current_group');
	
	if($current_group_id != 0){
		$current_group = Group::find($current_group_id);
	}else{
		$current_group = null;
	}
	
	$group_matches = array('user_id' => $user->id, 'parent_id' => $current_group_id);
	$groups = Group::where($group_matches)->orderBy('name')->get();
	 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GO</title>

		<!-- General CSS -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap Core CSS -->
    	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!-- Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>		
    </head>
    <body id="myCss">
        <div class="container">
            <div class="content">
                <a href="{{ URL::to('/') }}"><div class="title">GO</div></a>
                <h2>Welcome back {{ $user->name }}</h2>
                <!--
                <p>Your user ID is {{ session()->get('user_id') }}</p>
                <p>Current group is {{ session()->get('current_group') }}</p>
                -->
                <a href="{{ URL::to('logout') }}" class="myBtn">LOGOUT</a>
            </div>
            <div class="row">
            	@if($current_group_id == 0)
	            	<h2>My Groups</h2>
	            @else
	            	<h2>
	            		<a href="{{ URL::to('profile/' . $current_group->parent_id) }}">
	            			<span class="glyphicon glyphicon-menu-left small" aria-hidden="true"></span>
	            		</a>
	            		&ensp;{{ $current_group->name }}
	            	</h2>
	            @endif
	            
            	@foreach($groups as $group)
					<div class="col-md-4">
						<div class="groupBtn">
						<a href="{{ URL::to('profile/' . $group->id) }}">
							<div class="groupText">
								{{ $group->name }}
							</div>
						</a>
						<a href="{{ URL::to('delete_group/' . $group->id) }}">
							<div class="deleteBtn">
								<span class="glyphicon glyphicon-remove small pull-right" aria-hidden="true"></span>
							</div>
						</a>
						</div>
					</div>
				@endforeach
				
				<div class="col-md-4">
					<div class="groupBtn" >
					{!! Form::open(array('url' => 'new_group')) !!}
						{!! csrf_field() !!}
						{!! Form::text('name', '', array('placeholder'=>'NEW GROUP', 'style'=>'float:left; width:80%; height:40px')) !!}
						{!! Form::submit('+', array('style'=>'width:20%; height:40px')) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			
	       	<!-- Footer -->
	        <footer>
	            <div class="row">
	            	<br>
	            	<br>
	            	<hr>
					<p>Bruno Freitas | 2016</p>
	            </div>
	            <!-- /.row -->
	        </footer>
        </div>
        
        
        <!-- jQuery -->
	    <script src="{{ asset('js/jquery.js') }}"></script>
	
	    <!-- Bootstrap Core JavaScript -->
	    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	    
        <!-- JS Files -->
		<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
		
    </body>
</html>
