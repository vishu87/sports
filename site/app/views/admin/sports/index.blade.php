<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Sports
    </h3>
  </div>
</div>
<!-- END PAGE HEADER-->
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
	    	{{ Form::open(array('route' => 'admin.sports.store','role' => 'form')) }}
	    	<div class="form-body">
		        <div class="form-group">
		          <label>Sport Name</label>
		          {{Form::text('sport','',["class"=>"form-control", "placeholder"=>"e.g. Football"])}}
		          <span class="error"><?php echo $errors->first('sport'); ?></span>
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
@include('admin.sports.list')