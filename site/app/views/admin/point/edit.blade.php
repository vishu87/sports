<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-6">
		<h3 class="page-title">
			Football Points Table
		</h3>
	</div>
	<div class="col-md-6">
		<h3 class="page-title">
			{{HTML::link('/admin/point', "Go Back" ,['class'=>'btn yellow pull-right']) }}
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
			<div class="table-responsive" style="overflow:auto">
        	{{Form::open(array("url"=>"/admin/point/update/".$category_id ,"method" => "PUT","role" => "form"))}}
			  <table class="table table-striped b-t b-light tablesorter small_in">
			    <thead>
			      <tr>
			        <th style="width:50px !important">SN</th>
			        <th>Position</th>
			        <th>Team</th>
			        <th>Played</th>
			        <th>Won</th>
			        <th>Draw</th>
			        <th>Lost</th>
			        <th>Goal For</th>
			        <th>Goals Against</th>
			        <th>Goal Difference</th>
			        <th>Points</th>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php $count = 0 ?>
			        @foreach($teams as $team)
			        <tr>
				       <td class="small_in">{{++$count}}</td>
				        <td class="small_in">@if(isset($points_table[$team->id])){{$points_table[$team->id]["position"]}}@endif</td>
				        <td class="small_in">{{$team->category}}</td>
				        <td class="small_in"><input type="text" name="played_{{$team->id}}" value="@if(isset($points_table[$team->id])){{$points_table[$team->id]["played"]}}@endif"></td>
				        <td class="small_in"><input type="text" name="won_{{$team->id}}" value="@if(isset($points_table[$team->id])){{$points_table[$team->id]["won"]}}@endif"></td>
				        <td class="small_in"><input type="text" name="draw_{{$team->id}}" value="@if(isset($points_table[$team->id])){{$points_table[$team->id]["draw"]}}@endif"></td>
				        <td class="small_in">@if(isset($points_table[$team->id])){{$points_table[$team->id]["lost"]}}@endif</td>
				        <td class="small_in"><input type="text" name="goal_for_{{$team->id}}" value="@if(isset($points_table[$team->id])){{$points_table[$team->id]["goal_for"]}}@endif"></td>
				        <td class="small_in"><input type="text" name="goal_against_{{$team->id}}" value="@if(isset($points_table[$team->id])){{$points_table[$team->id]["goal_against"]}}@endif"></td>
				        <td class="small_in">@if(isset($points_table[$team->id])){{$points_table[$team->id]["goal_difference"]}}@endif</td>
				        <td class="small_in">@if(isset($points_table[$team->id])){{$points_table[$team->id]["points"]}}@endif</td>
			    	</tr>
			        @endforeach
			    </tbody>
			  </table>
			  <div class="form-actions">
			  	<button type="submit" class="btn blue">Save</button>
			  </div>
		{{Form::close()}}
	</div>
</div>