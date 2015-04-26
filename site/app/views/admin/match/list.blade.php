<div class="row">
	<div class="col-md-12">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Sport</th>
	        <th>Team 1</th>
	        <th>Team 2</th>
	        <th>Date</th>
	        <th>Time</th>
	        <th>Venue</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($matches as $match)
	        <tr id="tr_{{$match->id}}">
		        <td>{{++$count}}</td>
		        <td>{{$sports[$match->sport_id]}}</td>
		        <td>{{$teams[$match->team1_id]}}</td>
		        <td>{{$teams[$match->team2_id]}}</td>
		        <td>{{date("d M Y",strtotime($match->date))}}</td>
		        <td>{{$match->time}}</td>
		        <td>{{$match->venue}}</td>
		        <td>
		        	{{ link_to('admin/match/edit/'.$match->id, 'Edit', array('class' => 'btn blue'))}}
		        	{{ link_to('admin/match/live/'.$match->id, 'Commentary', array('class' => 'btn blue'))}}
		        	{{ link_to('admin/match/lineup/'.$match->id, 'Line Up', array('class' => 'btn blue'))}}
		        	{{ link_to('admin/match/result/'.$match->id, 'Result', array('class' => 'btn blue'))}}
		        	<button class="btn red" type="button" onclick="delete_match({{$match->id}})"><i class="fa fa-remove"></i></button>
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>