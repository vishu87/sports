<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      {{$team->category}}
    </h3>
  </div>
  <div class="col-md-6">
  {{link_to('/admin/teams', "Go Back" , $attributes = array('class'=>'btn yellow pull-right')) }}
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Player</th>
	        <th>Status</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($players as $player)
	        <tr id="tr_{{$player->id}}">
		        <td>{{++$count}}</td>
		        <td>{{$player->player}}</td>
		        <td>@if($player->status == 1) active @else inactive @endif</td>
		        <td>
		        	<button class="btn red" type="button" onclick="delete_player({{$player->id}})"><i class="fa fa-remove"></i></button>
		        	@if($player->status == 1)
		        		<button class="btn" type="button" id="btn_{{$player->id}}" onclick="change_status({{$player->id}},0)">Mark Inactive</button>
		        	@else 
		        		<button class="btn" type="button" id="btn_{{$player->id}}" onclick="change_status({{$player->id}},1)">Mark Active</button>
		        	@endif
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>