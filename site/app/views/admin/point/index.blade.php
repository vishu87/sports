<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Football Points
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
	    <div class="portlet-title"><div class="caption">Select League</div></div>
	    <div class="portlet-body form">
        	{{Form::open(array("url"=>"/admin/point" ,"method" => "POST","role" => "form"))}}
        	<div class="form-body">
		        <div class="row">
		        	<div class="form-group col-md-6">
				        <label>League</label>
				        {{Form::select('category_id', $category ,'',["class"=>"form-control"])}}
				        <span class="parsley-error-list"><?php echo $errors->first('category_id'); ?></span>
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