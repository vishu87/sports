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
	        @foreach($sports as $sport)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$sport->sport}}</td>
		        <td>
		        	{{ Form::open(array('action' => array('admin.sports.destroy', $sport->id),'role' => 'form', 'method' => 'DELETE')) }}
		        	{{link_to_route('admin.sports.edit', "Edit" , $parameters = array($sport->id) , $attributes = array('class'=>'btn blue')) }}
		        	<button class="btn red" type="submit">Delete</button>
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>