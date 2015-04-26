<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Team Line Up: {{$teams[$match->team1_id]}} vs {{$teams[$match->team2_id]}} - {{$sports[$match->sport_id]}}
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
			<div class="portlet-title"><div class="caption">Line Up</div></div>
			<div class="portlet-body form">
				{{Form::open(array("url"=>"/admin/match/store/lineup/".$match->id ,"method" => "POST","role" => "form"))}}						    
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<h2>{{$teams[$match->team1_id]}}</h2>
							@foreach($players1 as $player)
								@if(in_array($player->id,$match_players))
									{{Form::checkbox('players1[]',$player->id, true)}} {{$player->player}} <br>
								@else
									{{Form::checkbox('players1[]',$player->id)}} {{$player->player}} <br>
								@endif
							@endforeach
						</div>
						<div class="col-md-6">
							<h2>{{$teams[$match->team2_id]}}</h2>
							@foreach($players2 as $player)
								@if(in_array($player->id,$match_players))
									{{Form::checkbox('players2[]',$player->id, true)}} {{$player->player}} <br>
								@else
									{{Form::checkbox('players2[]',$player->id)}} {{$player->player}} <br>
								@endif
							@endforeach
						</div>
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