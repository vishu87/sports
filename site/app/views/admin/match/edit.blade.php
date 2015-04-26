<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Edit Match Schedule
		</h3>
	</div>
	<div class="col-md-6">
		<a href="{{URL('admin/match/all')}}" class="btn yellow pull-right">Go Back</a>
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
	    <div class="portlet-title"><div class="caption">Edit Match Schedule</div></div>
	    <div class="portlet-body form">
        	{{Form::open(array("url"=>"/admin/match/update/".$match->id ,"method" => "PUT","role" => "form"))}}		       
		        <div class="form-body">
		        <div class="row">
		        	<div class="form-group col-md-6">
			          <label>Sport</label>
			          {{Form::select('sport_id', $sports , $match->sport_id,["class"=>"form-control","onchange"=>"get_team_sport('team1_id','team2_id','sport_id',-1,1)"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
			        </div>		        
		        </div>
		         <div class="row">
		         	  <div class="form-group col-md-6">
	                	<label>Team 1</label>
	                    {{Form::select('team1_id', $teams , $match->team1_id,["class"=>"form-control"])}}
	                    <span>{{$errors->first('team1_id')}}</span>
	                </div>
		         	<div class="form-group col-md-6">
	                	<label>Team 2</label>
	                    {{Form::select('team2_id',$teams , $match->team2_id,["class"=>"form-control"])}}
	                    <span>{{$errors->first('team2_id')}}</span>
	                </div>		        	             
		        </div>
		         <div class="row">
		         	<div class="form-group col-md-6">
	                	<label>Date</label>
	                    {{Form::text('date',date("d-m-Y",strtotime($match->date)),array("class"=>"form-control datepicker", "placeholder"=>"Date"))}}
	                    <span>{{$errors->first('date')}}</span>
	                </div>	  
		          <div class="form-group col-md-6">
	                	<label>Time</label>
	                    {{Form::text('time',$match->time,array("class"=>"form-control time", "placeholder"=>"HH:MM:SS"))}}
	                    <span>{{$errors->first('time')}}</span>
	                </div>
	                </div>
	                <div class="row">
		        	    <div class="form-group col-md-6">
		                	<label>Venue</label>
		                    {{Form::text('venue',$match->venue,array("class"=>"form-control", "placeholder"=>"Venue"))}}
		                    <span>{{$errors->first('venue')}}</span>
	                    </div>	                              
		            </div>
		        
		      </div>
		      <div class="form-actions">
				<div class="row">
		        	<div class="col-md-12">
		        		<button type="submit" class="btn blue">Update</button>
		        	</div>
		        </div>
		      </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>