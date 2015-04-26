<section class="portlet box blue">
	<header class="panel-heading">
	  <b>Deal Types</b>
	</header>
	<div class="table-responsive ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Name</th>
	        <th>Slug</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($props as $prop)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$prop->property_name}}</td>
		        <td>{{$prop->property}}</td>
		        <td>
		        	{{ Form::open(array('action' => array('property.destroy', $prop->id),'role' => 'form', 'method' => 'DELETE')) }}
		        	{{link_to_route('property.edit', "Edit" , $parameters = array($prop->id) , $attributes = array('class'=>'btn blue')) }}
		        	<button class="btn btn-s-md btn-danger" type="submit">Delete</button>
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</section>