<div class="row">
  <div class="col-md-6">
    <h3 class="page-title">
      Sports Tree
    </h3>
  </div>
</div>
<div class="row">
	@foreach($sports as $sport)
		<div class="col-md-6">
		  <div class="portlet box blue">
		    <div class="portlet-title"><div class="caption">{{$sport->sport}}</div></div>
		    <div class="portlet-body">
	        	<div class="row m-b">
	                <div class="col-sm-12">              
	                  <div class="dd" id="nestable1">
	                    <ol class="dd-list">
	                    	@foreach($categories as $category)
	                    		@if($category->parent_id == 0 && $category->sport_id == $sport->id)
			                      	<li class="dd-item">
			                          	<div class="dd-handle">{{$category->category}}</div>
			                          	<?php get_childs($category->id, $categories); ?>
			                      	</li>
		                      	@endif
		                    @endforeach
	                  </ol>
	                  </div>
	                </div>
	              </div>
		    </div>
		  </div>
		</div>
	@endforeach
</div>
<?php
	function get_childs($id, $cats){
		echo '<ol class="dd-list">';
		foreach ($cats as $cat) {
			if($cat->parent_id == $id){

              	echo '<li class="dd-item">
                  	<div class="dd-handle">'.$cat->category.'</div>';
                  	get_childs($cat->id, $cats);
              	echo '</li>';
          	}
		}
		echo '</ol>';
	}

?>