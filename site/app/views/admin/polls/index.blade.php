<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Poll Management
    </h3>
  </div>
</div>
@if(Session::has('success'))
	<div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert">×</button>
    	<i class="fa fa-ban-circle"></i><strong>Success!</strong> {{Session::get('success')}}
  	</div>
@endif
@if(Session::has('failure'))
	<div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert">×</button>
    	<i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure')}}
  	</div>
@endif
<div class="row">
	<div class="col-md-12">
	  <div class="portlet box blue">
	    <div class="portlet-title"><div class="caption">Add new</div></div>
	    <div class="portlet-body form">
        	{{ Form::open(array('route' => 'admin.poll.store','role' => 'form')) }}
        	<div class="form-body">
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Sport</label>
			          {{Form::select('sport_id', $sports , '',["class"=>"form-control","onchange"=>"get_option_sport('category_id','sport_id',0,1)"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
			        </div>
			        <div class="form-group col-md-6">
			          <label>Category</label>
			          {{Form::select('category_id', [] , '',["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('category_id'); ?></span>
			        </div>
		        </div>
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Poll Title</label>
			          {{Form::text('poll_title', '',["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('poll_title'); ?></span>
			        </div>
		        </div>
		        <h3>Poll Options</h3>
		        <div class="row">
		        	<div class="form-group col-md-12">
			          <label>Poll Options</label>
			          {{Form::text('poll_option[]', '',["class"=>"form-control"])}} <br>
			          {{Form::text('poll_option[]', '',["class"=>"form-control"])}} <br>
			          {{Form::text('poll_option[]', '',["class"=>"form-control"])}} <br>
			          {{Form::text('poll_option[]', '',["class"=>"form-control"])}}
			        </div>
		        </div>
		    </div>
		        <div class="form-actions">
		        		<button type="submit" class="btn blue">Submit</button>
		        </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
@include('admin.polls.list')
