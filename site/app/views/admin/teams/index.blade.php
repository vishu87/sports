<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Team Players
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
        	{{ Form::open(array('url' => '/admin/teams/store','role' => 'form', 'method'=>'POST', 'files'=>true, 'target'=>'_blank')) }}
        	<div class="form-body">
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Sport</label>
			          {{Form::select('sport_id', $sports , '',["class"=>"form-control","onchange"=>"get_team_sport('team_id','team_id','sport_id',-1,1)"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
			        </div>
			        <div class="form-group col-md-6">
			          <label>Team</label>
			          {{Form::select('team_id', [] , '',["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('team_id'); ?></span>
			        </div>
		        </div>
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Player File</label>
			          {{Form::file('csv_file', ["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('csv_file'); ?></span>
			        </div>
		        </div>
		    </div>
		        <div class="form-actions">
		        		<button type="submit" class="btn blue">Upload</button>
		        </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	  <div class="portlet box blue">
	    <div class="portlet-title"><div class="caption">Upload Team-Players</div></div>
	    <div class="portlet-body form">
        	{{ Form::open(array('url' => '/admin/teams/storemulti','role' => 'form', 'method'=>'POST', 'files'=>true, 'target'=>'_blank')) }}
        	<div class="form-body">
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Player File</label>
			          {{Form::file('csv_file', ["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('csv_file'); ?></span>
			        </div>
		        </div>
		    </div>
		        <div class="form-actions">
		        		<button type="submit" class="btn blue">Upload</button>
		        </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
@include('admin.teams.list')
