<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Commentary: {{$teams[$match->team1_id]}} vs {{$teams[$match->team2_id]}} - {{$sports[$match->sport_id]}}
			<br><small>{{date("d-m-Y",strtotime($match->date))}} @ {{$match->time}} at {{$match->venue}}</small>
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
			<div class="portlet-title"><div class="caption">Commentary</div></div>
			<div class="portlet-body form">
				{{Form::open(array("url"=>"/admin/match/store/live/".$match->id ,"method" => "POST","role" => "form"))}}						    
				<div class="form-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label>Time</label>
							{{Form::text('time','',array("class"=>"form-control", "placeholder"=>"HH:MM:SS"))}}
							<span>{{$errors->first('win_team_id')}}</span>
						</div>
					</div>	
					<div class="row">
						<div class="form-group col-md-6">
							<label>{{$teams[$match->team1_id]}} Score</label>
							{{Form::text('team1_score','',array("class"=>"form-control", "placeholder"=>"Team1 Score"))}}
							<span>{{$errors->first('team1_score')}}</span>
						</div>
						<div class="form-group col-md-6">
							<label>{{$teams[$match->team2_id]}} Score</label>
							{{Form::text('team2_score','',array("class"=>"form-control", "placeholder"=>"Team2 Score"))}}
							<span>{{$errors->first('team2_score')}}</span>
						</div>	        	             
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>{{$teams[$match->team1_id]}} Remark</label>
							{{Form::textarea('team1_remark','',array("class"=>"form-control", "placeholder"=>"Team1 Remark"))}}
							<span>{{$errors->first('team1_remark')}}</span>
						</div>
						<div class="form-group col-md-6">
							<label>{{$teams[$match->team2_id]}} Remark</label>
							{{Form::textarea('team2_remark','',array("class"=>"form-control", "placeholder"=>"Team2 Remark"))}}
							<span>{{$errors->first('team2_remark')}}</span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Minute</label>
							{{Form::text('minute','',array("class"=>"form-control", "placeholder"=>"Team1 Remark"))}}
							<span>{{$errors->first('team1_remark')}}</span>
						</div>
						<div class="form-group col-md-6">
							<label>Description</label>
							{{Form::textarea('description','',array("class"=>"form-control", "placeholder"=>"Team2 Remark"))}}
							<span>{{$errors->first('team2_remark')}}</span>
						</div>
					</div>
				</div>           
				<div class="form-actions">
					<button type="submit" class="btn blue">Add</button>
				</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
</div>
@include('admin.match.listlive')