<div class="m-b-md">		        	
  <h1 class="m-b-none">Edit Property </h1><br>
  {{link_to_route('property.create', "Go Back" , $parameters = array('id' => $prop->deal_type) , $attributes = array('class'=>'btn btn-s-md btn-warning')) }}
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
	  <section class="portlet box blue">
	    <header class="panel-heading font-bold">Edit Property</header>
	    <div class="panel-body">
        	{{ Form::open(array('action' => array('property.update', $prop->id),'role' => 'form', 'method' => 'PUT')) }}
		        <div class="form-group">
		          <label>Proprty Name</label>
			      {{Form::text('property_name',$prop->property_name,$attributes=array('class'=>'form-control','placeholder'=>'e.g. Deal Number'))}}
		          <span class="parsley-error-list"><?php echo $errors->first('property_name','Please put a valid property name'); ?></span>
		        </div>
		        <div class="form-group">
		          <label>Property Slug without spaces like deal_number</label>
			      {{Form::text('property',$prop->property,$attributes=array('class'=>'form-control','placeholder'=>'e.g. deal_number'))}}
		          <span class="parsley-error-list"><?php echo $errors->first('property','Please put a valid property slug'); ?></span>
		        </div>
		        <div class="form-group">
		          <label>Type</label>
		          <?php $prop_types = Proptype::lists('prop', 'id'); ?>
		          {{ Form::select('prop_type', $prop_types,$prop->prop_type,$attributes=array('class'=>'form-control')) }}
		        </div>
		        <button type="submit" class="btn btn-sm btn-primary">Update</button>
	      	{{ Form::close()}}
	    </div>
	  </section>
	</div>
</div>