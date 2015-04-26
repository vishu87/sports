<section class="portlet box blue">
	<header class="panel-heading">
	  <b>Points Table</b>
	</header>
	<div class="table-responsive" style="overflow:auto">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
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
	        @foreach($points as $point)
	        <tr>
		        <td>{{++$count}}</td>
		        <td><input type="text" name="position1"></td>
		        <td>{{$point->category}}</td>
		        <td><input type="text" name="team1"></td>
		        <td>{{$point->won}}</td>
		        <td>{{$point->draw}}</td>
		        <td>{{$point->lost}}</td>
		        <td>{{$point->goal_for}}</td>
		        <td>{{$point->goal_against}}</td>
		        <td>{{$point->goal_difference}}</td>
		        <td>{{$point->point}}</td>
		        <td>
		        	{{ Form::open(array("url"=>"/admin/point/delete/".$point->id,'role' => 'form', 'method' => 'get')) }}
		        	{{link_to('/admin/point/edit/'.$point->id, "Edit", array('class'=>'btn blue')) }}
		        	<button class="btn btn-s-md btn-danger" type="submit">Delete</button>
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</section>