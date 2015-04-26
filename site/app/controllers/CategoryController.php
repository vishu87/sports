<?php

class CategoryController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'sports';
		$this->layout->subsidebar = 2;
        $categories = Category::get();

		$sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $category_list = Category::lists('category','id');
        $category_list[0]="None";
        ksort($category_list);
        
        $this->layout->main = View::make("admin.category.index", ["sports" => $sports,"category_list"=>$category_list,'categories' => $categories]);
	}

	public function edit($id){
        $this->layout->sidebar = 'sports';
        $this->layout->subsidebar = 2;
        $categories = Category::get();

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $category_list = Category::lists('category','id');
        $category_list[0]="None";
        ksort($category_list);

        $cat = Category::find($id);
        
        $this->layout->main = View::make("admin.category.edit", ["sports" => $sports,"category_list"=>$category_list, "cat" => $cat ]);
        $this->layout->list = View::make("admin.category.list", array('categories' => $categories));
	}

	public function store(){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'category' => Input::get('category')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'category' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
    		$category = new Category;
            $category->category = Input::get('category');
            $category->sport_id = Input::get('sport_id');
            $category->level = Input::get('level');
            $category->parent_id = Input::get('parent_id');
            $category->is_team = Input::get('is_team');
            $category->save();
            return Redirect::Back()->with('success', 'Successfully Added');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function update($id){
		$credentials = [
            'sport_id' => Input::get('sport_id')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            $count = Category::where('category',Input::get('category'))->where('id','!=',$id)->count();
            if($count == 0){
                $category = Category::find($id);
                $category->category = Input::get('category');
                $category->sport_id = Input::get('sport_id');
                $category->level = Input::get('level');
                $category->parent_id = Input::get('parent_id');
                $category->is_team = Input::get('is_team');
                $category->save();
                return Redirect::Back()->with('success', 'Successfully Updated');
            } else {
                return Redirect::Back()->with('failure', 'Category name is already taken')->withErrors($validator)->withInput();
            }
            
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function destroy($id){
        $category = Category::find($id);
		if($category->delete())
    		return Redirect::route('admin.category.index')->with('success', 'Deal type successfully deleted');
    	else
    		return Redirect::route('admin.category.index')->with('success', 'Deal type can\'t be deleted');
	}

}
