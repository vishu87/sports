<div class="row">
	<div class="col-md-12 ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Team</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($teams as $team)
	        <tr id="tr_{{$team->team_id}}">
		        <td>{{++$count}}</td>
		        <td>{{$team->category}}</td>
		        <td>
		        	{{link_to('/admin/teams/'.$team->team_id, "View" , $attributes = array('class'=>'btn blue')) }}
		        	<button class="btn red" type="button" onclick="delete_team({{$team->team_id}})"><i class="fa fa-remove"></i></button>
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>