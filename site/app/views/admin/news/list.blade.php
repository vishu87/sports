<div class="row">
	<div class="col-md-12 ">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Name</th>
	        <th>Feed</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($news as $new)
	        <tr>
		        <td>{{++$count}}</td>
		        <td>{{$new->name}}</td>
		        <td>{{$new->rss_feed}}</td>
		        <td>
		        	{{link_to('admin/news/edit/'.$new->id, "Edit" , $attributes = array('class'=>'btn blue')) }}
		        	{{link_to('admin/news/destroy/'.$new->id, "Delete" , $attributes = array('class'=>'btn red')) }}
		        	{{Form::close()}}
		        </td>
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>