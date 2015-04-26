<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Match Schedule
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
	    <div class="portlet-title"><div class="caption">Add New</div></div>
	    <div class="portlet-body form">
        	{{Form::open(array("url"=>"/admin/match/store" ,"method" => "POST","role" => "form"))}}		       
		        <div class="form-body">
		        <div class="row">
		        	<div class="form-group col-md-6">
			          <label>Sport</label>
			          {{Form::select('sport_id', $sports , '',["class"=>"form-control","onchange"=>"get_team_sport('team1_id','team2_id','sport_id',-1,1)"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
			        </div>		        
		        </div>
		         <div class="row">
		         	  <div class="form-group col-md-6">
	                	<label>Team 1</label>
	                    {{Form::select('team1_id', [] , '',["class"=>"form-control"])}}
	                    <span>{{$errors->first('team1_id')}}</span>
	                </div>
		         	<div class="form-group col-md-6">
	                	<label>Team 2</label>
	                    {{Form::select('team2_id', [] , '',["class"=>"form-control"])}}
	                    <span>{{$errors->first('team2_id')}}</span>
	                </div>		        	             
		        </div>
		         <div class="row">
		         	<div class="form-group col-md-6">
	                	<label>Date</label>
	                    {{Form::text('date','',array("class"=>"form-control datepicker", "placeholder"=>"Date"))}}
	                    <span>{{$errors->first('date')}}</span>
	                </div>	  
		          <div class="form-group col-md-6">
	                	<label>Time</label>
	                    {{Form::text('time','',array("class"=>"form-control time", "placeholder"=>"HH:MM:SS"))}}
	                    <span>{{$errors->first('time')}}</span>
	                </div>
	                </div>
	                <div class="row">
		        	    <div class="form-group col-md-6">
		                	<label>Venue</label>
		                    {{Form::text('venue','',array("class"=>"form-control", "placeholder"=>"Venue"))}}
		                    <span>{{$errors->first('venue')}}</span>
	                    </div>	                              
		            </div>
		        
		      </div>
		      <div class="form-actions">
				<div class="row">
		        	<div class="col-md-12">
		        		<button type="submit" class="btn blue">Submit</button>
		        	</div>
		        </div>
		      </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	  <div class="portlet box blue">
	    <div class="portlet-title"><div class="caption">Upload Match Schedule</div></div>
	    <div class="portlet-body form">
        	{{ Form::open(array('url' => '/admin/match/storemulti','role' => 'form', 'method'=>'POST', 'files'=>true, 'target'=>'_blank')) }}
        	<div class="form-body">
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Match File</label>
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
