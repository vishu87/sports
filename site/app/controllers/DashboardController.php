<?php

class DashboardController extends BaseController {

	protected $layout = 'admin.layout';

	public function getIndex(){
		$this->layout->sidebar = 'dashboard';
		$this->layout->subsidebar = 0;
		$this->layout->main = View::make("admin.dashboard.index");
	}

	public function getSportCategory($id,$level){
		if($level == 0){
			$category_list = Category::where('sport_id',$id)->lists('category','id');
		} else if($level == -1) {
			$category_list = Category::where('sport_id',$id)->where('is_team',1)->lists('category','id');
		} else {
			$category_list = Category::where('sport_id',$id)->where('level',$level)->lists('category','id');
		}
		$category_list[0]="None";

        ksort($category_list);
        $response["options"] = $category_list;
        $response["success"] = true;
        return json_encode($response);
	}

}
