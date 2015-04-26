<?php

class AdminController extends BaseController {

	protected $layout = 'admin.layout';

	public function getTree(){
		$this->layout->sidebar = 'sports';
		$this->layout->subsidebar = 3;
		$sports = Sport::get();
		$categories = Category::get();
        
        $this->layout->main = View::make("admin.tree", ["sports" => $sports,"categories"=>$categories]);
		$this->layout->list = '';
	}

}
