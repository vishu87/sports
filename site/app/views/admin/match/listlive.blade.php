<div class="row">
	<div class="col-md-12">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Time</th>
	        <th>Minute</th>
	        <th>{{$teams[$match->team1_id]}} Score</th>
	        <th>{{$teams[$match->team1_id]}} Remark</th>
	        <th>{{$teams[$match->team2_id]}} Score</th>
	        <th>{{$teams[$match->team2_id]}} Remark</th>
	        <th>Description</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($scores as $score)
	        <tr id="tr_{{$score->id}}">
		        <td>{{++$count}}</td>
		        <td>{{$score->time}}</td>
		        <td>{{$score->minute}}</td>
		        <td>{{$score->team1_score}}</td>
		        <td>{{$score->team1_remark}}</td>
		        <td>{{$score->team2_score}}</td>
		        <td>{{$score->team2_remark}}</td>
		        <td>{{$score->description}}</td>
		        <td>
		        	<button class="btn red" type="button" onclick="delete_livescore({{$score->id}})"><i class="fa fa-remove"></i></button>
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>