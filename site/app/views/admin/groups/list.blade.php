<div class="row">
	<div class="col-md-12 ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Name</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($groups as $group)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$group->name}}</td>
		        <td>
		        	{{link_to('admin/groups/edit/'.$group->id, "Edit" , $attributes = array('class'=>'btn blue')) }}
		        	{{link_to('admin/groups/destroy/'.$group->id, "Delete" , $attributes = array('class'=>'btn red')) }}
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>