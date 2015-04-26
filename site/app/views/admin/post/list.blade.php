<section class="panel panel-default">
	<header class="panel-heading">
	  <b>Posts</b>
	</header>
	<div class="table-responsive ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Title</th>
	        <th>Type</th>
	        <th>Category</th>
	        <th>Is Topic</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($posts as $post)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$post->title}}</td>
		        <td>{{$post->type}}</td>
		        <td>{{$post->category}}</td>
		        <td>{{$post->is_topic}}</td>
		        <td>
		        	{{ Form::open(array("url"=>"/admin/post/delete/".$post->id,'role' => 'form', 'method' => 'get')) }}
		        	{{ link_to('admin/post/edit/'.$post->id, 'Edit', array('class' => 'btn blue')) }}
		        	<button class="btn btn-s-md btn-danger" type="submit">Delete</button>
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</section>