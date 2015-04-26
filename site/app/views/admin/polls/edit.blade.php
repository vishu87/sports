<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Polls
    </h3>
  </div>
  <div class="col-md-6">
  {{link_to_route('admin.poll.index', "Go Back" , $parameters = array() , $attributes = array('class'=>'btn yellow pull-right')) }}
	</div>
</div>
@if(Session::has('success'))
	<div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert">×</button>
    	<i class="fa fa-ban-circle"></i><strong>Success!</strong> {{Session::get('success')}}
  	</div>
@endif
@if(Session::has('failure'))
	<div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert">×</button>
    	<i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure')}}
  	</div>
@endif
<div class="row">
	<div class="col-md-12">
	  <div class="portlet box blue">
	    <div class="portlet-title font-bold"><div class="caption">Edit poll</div></div>
	    <div class="portlet-body form">
        	{{ Form::open(array('route' => array('admin.poll.update', $poll->id),'role' => 'form', 'method' => 'PUT')) }}
		        <div class="form-body">
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Sport</label>
			          {{Form::select('sport_id', $sports , $poll->sport_id,["class"=>"form-control","onchange"=>"get_option_sport('category_id','sport_id',0,1)"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('sport_id'); ?></span>
			        </div>
			        <div class="form-group col-md-6">
			          <label>Category</label>
			          {{Form::select('category_id', $categories , $poll->category_id ,["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('category_id'); ?></span>
			        </div>
		        </div>
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Poll Title</label>
			          {{Form::text('poll_title', $poll->poll_title,["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('poll_title'); ?></span>
			        </div>
		        </div>
		        </div>
		        <div class="form-actions">
		        		<button type="submit" class="btn blue">Submit</button>
		        </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	  <div class="portlet box blue">
	    <div class="portlet-title"><div class="caption">Add new option</div></div>
	    <div class="portlet-body form">
        	{{ Form::open(array('url' => 'admin/poll/option/'.$poll->id,'role' => 'form', 'method' => 'POST')) }}
		    <div class="form-body">    
		        <div class="row">
			        <div class="form-group col-md-6">
			          <label>Option</label>
			          {{Form::text('poll_option', '',["class"=>"form-control"])}}
			          <span class="parsley-error-list"><?php echo $errors->first('poll_option'); ?></span>
			        </div>
		        </div>
		    </div>
		         <div class="form-actions">
		        		<button type="submit" class="btn blue">Submit</button>
		        </div>
		    {{ Form::close()}}
	    </div>
	  </div>
	</div>
</div>
<section class="row">
	<div class="col-md-12">
	  <table class="table table-striped b-t b-light tablesorter">
	    <thead>
	      <tr>
	        <th>SN</th>
	        <th>Option</th>
	        <th>Points</th>
	        <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $count = 0 ?>
	        @foreach($poll_options as $poll_option)
	        <tr>
	        	@if($option_id != $poll_option->id)
			        <td>{{++$count}}</td>
			        <td>{{$poll_option->poll_option}}</td>
			        <td>{{$poll_option->points}}</td>
			        <td>
			        	{{ Form::open(array('url' => 'admin/poll/option/'.$poll_option->id,'role' => 'form', 'method' => 'DELETE')) }}
			        	{{link_to('admin/poll/'.$poll->id.'/edit/'.$poll_option->id, "Edit" , $attributes = array('class'=>'btn blue')) }}
			        	<button class="btn red" type="submit">Delete</button>
			        	{{Form::close()}}
			        </td>
		        @else
		        	{{Form::open(array('url' => 'admin/poll/option/'.$poll_option->id,'role' => 'form', 'method' => 'PUT')) }}
			        <td>{{++$count}}</td>
			        <td>
		        		{{Form::text('poll_option_edit', $poll_option->poll_option,["class"=>"form-control"])}}
			        	<span class="parsley-error-list"><?php echo $errors->first('poll_option_edit'); ?></span>
			        </td>
			        <td>{{$poll_option->points}}</td>
			        <td>
			        	<button class="btn blue" type="submit">SAVE</button>
			        	<a href="{{route('admin.poll.edit', $poll->id)}}" class="btn btn-s-md btn-danger" >Cancel</a>
			        	{{Form::close()}}
			        </td>
			    @endif
	    	</tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>