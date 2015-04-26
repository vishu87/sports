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
	        @foreach($categories as $category)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$category->category}}</td>
		        <td>
		        	{{ Form::open(array('action' => array('admin.category.destroy', $category->id),'role' => 'form', 'method' => 'DELETE')) }}
		        	{{link_to_route('admin.category.edit', "Edit" , $parameters = array($category->id) , $attributes = array('class'=>'btn blue')) }}
		        	<button class="btn red" type="submit">Delete</button>
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>