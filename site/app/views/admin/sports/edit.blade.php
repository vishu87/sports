<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Sports
    </h3>
  </div>
  <div class="col-md-6">  {{link_to_route('admin.sports.index', "Go Back" , $parameters = array() , $attributes = array('class'=>'btn yellow pull-right')) }}</div>
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
	    <div class="portlet-title"><div class="caption">Edit</div></div>
	    <div class="portlet-body form">
	    	{{ Form::open(array('action' => array('admin.sports.update', $sport->id),'role' => 'form', 'method' => 'PUT')) }}
	    	<div class="form-body">
		        <div class="form-group">
		          <label>Deal Name</label>
		          {{Form::text('sport',$sport->sport,["class"=>"form-control", "placeholder"=>"e.g. Football"])}}
		          <span class="error"><?php echo $errors->first('sport'); ?></span>
		        </div>
	      	
	      	</div>
	      	<div class="form-actions">
            	<button type="submit" class="btn blue">Update</button>
         	</div>
         	{{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>