<?php

class NewsController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'news';
		$this->layout->subsidebar = 0;
        $news = News::get();

		$sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);
        
        $this->layout->main = View::make("admin.news.index", ["sports" => $sports,'news' => $news]);
	}

	public function edit($id){
        $this->layout->sidebar = 'news';
        $this->layout->subsidebar = 0;

        $news = News::find($id);
        
        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $category_list = Category::where('sport_id',$news->sport_id)->lists('category','id');
        $category_list[0]="None";
        ksort($category_list);
        
        $this->layout->main = View::make("admin.news.edit", ["sports" => $sports,"category_list"=>$category_list, "news" => $news ]);
        $this->layout->list = '';
	}

	public function store(){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'name' => Input::get('name'),
            'rss_feed' => Input::get('rss_feed')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'name' => 'required',
            'rss_feed' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
    		$news = new News;
            $news->sport_id = Input::get('sport_id');
            $news->category_id = Input::get('category_id');
            $news->name = Input::get('name');
            $news->rss_feed = Input::get('rss_feed');
            $news->save();
            return Redirect::Back()->with('success', 'Successfully Added');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput()->with('failure', 'Some Problem');;
        }
	}

	public function update($id){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'name' => Input::get('name'),
            'rss_feed' => Input::get('rss_feed')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'name' => 'required',
            'rss_feed' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
                $news = News::find($id);
                $news->sport_id = Input::get('sport_id');
                $news->category_id = Input::get('category_id');
                $news->name = Input::get('name');
                $news->rss_feed = Input::get('rss_feed');
                $news->save();
                return Redirect::Back()->with('success', 'Successfully Updated');
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function destroy($id){
        $news = News::find($id);
		if($news->delete())
    		return Redirect::to('admin/news')->with('success', 'Successfully deleted');
    	else
    		return Redirect::to('admin/news')->with('success', 'Can\'t be deleted');
	}

}
