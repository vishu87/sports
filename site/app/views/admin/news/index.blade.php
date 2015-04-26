<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			News
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
				{{ Form::open(array('url' => 'admin/news/store','role' => 'form','method'=>'POST')) }}
				<div class="form-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label>Sport</label>
							{{Form::select('sport_id', $sports , '',["class"=>"form-control","onchange"=>"get_option_sport('category_id','sport_id',0,1)"])}}
							<span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Category</label>
							{{Form::select('category_id',[],'',["class"=>"form-control", "placeholder"=>"e.g. Football League"])}}
							<span class="parsley-error-list"><?php echo $errors->first('category_id'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Name</label>
							{{Form::text('name','',["class"=>"form-control"])}}
							<span class="parsley-error-list"><?php echo $errors->first('name'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Feed</label>
							{{Form::text('rss_feed','',["class"=>"form-control"])}}
							<span class="parsley-error-list"><?php echo $errors->first('rss_feed'); ?></span>
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
@include('admin.news.list')