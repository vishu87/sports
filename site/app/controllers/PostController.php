<?php

class PostController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'post';
		$this->layout->subsidebar = 0;
        $posts = Post::get();

		$category = Category::lists('category','id');
        $category[0]="Select";
        ksort($category);

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $teams = Teams::lists('is_team','id');
        $teams[0]="Select";
        ksort($teams);


        $post_list = Post::lists('post','id');
        $post_list[0]="None";
        ksort($post_list);

        
        $this->layout->main = View::make("admin.post.index", ["category" => $category,"sports" => $sports,"teams" => $teams,"post_list"=>$post_list]);
		$this->layout->list = View::make("admin.post.list", array('posts' => $posts));
	}

	public function getedit($id){
        $this->layout->sidebar = 'post';
        $this->layout->subsidebar = 0;
        $posts = Post::get();

        $category = Category::lists('category','id');
        $category[0]="Select";
        ksort($category);


        $teams = Team::lists('category','id');
        $teams[0]="Select";
        ksort($teams);


        $post = Post::find($id);
        $category = DB::table('categories')->lists('category','id');
        $this->layout->main = View::make("admin.post.edit", ["category" => $category,"teams" => $teams, "post" => $post ]);
        $this->layout->list = View::make("admin.post.list", array('posts' => $posts,"category" => $category));
	}

     public function getPosts(){
         $this->layout->sidebar = 'post';
        $this->layout->subsidebar = 0;
        $post = DB::table('post')->join('categories','post.category_id','=','categories.id')->Select('post.*','categories.category')->get();
        $category = DB::table('categories')->lists('category','id');
        $teams = DB::table('categories')->lists('category','id');
        $sports = DB::table('sports')->lists('sport','id');
        $this->layout->main = View::make("admin.post.index",array("category" => $category,"teams" => $teams,"posts"=>$post,"sports" => $sports));
        $this->layout->list = View::make("admin.post.list", array('posts' => $post,"category" => $category,"teams" => $teams,"sports" => $sports));;

    }

	public function postAdd(){
		$credentials = [
            'title' => Input::get('title'),
            'type' => Input::get('type'),
            'category_id' => Input::get('category_id')
        ];
        $rules = [
            'title' => 'required|not_in:0',
            'type' => 'required',
            'category_id' => 'required|not_in:0'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
    		$post = new post;
            $post->title = Input::get('title');
            $post->type = Input::get('type');
            $post->category_id = Input::get('category_id');
            $post->is_topic = Input::get('is_topic');
            $post->content = Input::get('content');
            $post->save();
            return Redirect::Back()->with('success', 'Successfully Added');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function putupdate($id){
		$credentials = [
           'title' => Input::get('title'),
            'type' => Input::get('type'),
            'category_id' => Input::get('category_id')
        ];
        $rules = [
            'title' => 'required|not_in:0',
            'type' => 'required',
            'category_id' => 'required|not_in:0'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
                $post = Post::find($id);
                $post->title = Input::get('title');
                $post->type = Input::get('type');
                $post->category_id = Input::get('category_id');
                $post->is_topic = Input::get('is_topic');
                $post->content = Input::get('content');
                $post->save();
                return Redirect::Back()->with('success', 'Successfully Updated');
            } else {
                return Redirect::Back()->with('failure', 'post name is already taken')->withErrors($validator)->withInput();
            }
            
        } 

	public function getdelete($id){
        $post = Post::find($id);
		if($post->delete())
    		return Redirect::Back()->with('success', 'Deal type successfully deleted');
    	else
    		return Redirect::Back()->with('success', 'Deal type can\'t be deleted');
	}

}
