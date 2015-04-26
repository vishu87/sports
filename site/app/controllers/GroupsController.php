<?php

class GroupsController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'groups';
		$this->layout->subsidebar = 0;
        $groups = Group::get();

		$sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);
        
        $this->layout->main = View::make("admin.groups.index", ["sports" => $sports,'groups' => $groups]);
	}

	public function edit($id){
        $this->layout->sidebar = 'groups';
        $this->layout->subsidebar = 0;

        $group = Group::find($id);
        
        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $category_list = Category::where('sport_id',$group->sport_id)->lists('category','id');
        $category_list[0]="None";
        ksort($category_list);
        
        $this->layout->main = View::make("admin.groups.edit", ["sports" => $sports,"category_list"=>$category_list, "group" => $group ]);
        $this->layout->list = '';
	}

	public function store(){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'name' => Input::get('name')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'name' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
    		$group = new Group;
            $group->sport_id = Input::get('sport_id');
            $group->category_id = Input::get('category_id');
            $group->name = Input::get('name');
            $group->save();
            return Redirect::Back()->with('success', 'Successfully Added');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput()->with('failure', 'Some Problem');;
        }
	}

	public function update($id){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'name' => Input::get('name')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'name' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
                $group = Group::find($id);
                $group->sport_id = Input::get('sport_id');
                $group->category_id = Input::get('category_id');
                $group->name = Input::get('name');
                $group->save();
                return Redirect::Back()->with('success', 'Successfully Updated');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function destroy($id){
        $group = Group::find($id);
		if($group->delete())
    		return Redirect::to('admin/groups')->with('success', 'Successfully deleted');
    	else
    		return Redirect::to('admin/groups')->with('success', 'Can\'t be deleted');
	}

}
