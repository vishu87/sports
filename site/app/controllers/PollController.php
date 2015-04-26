<?php

class PollController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'poll';
        $this->layout->subsidebar = 0;

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        
        $polls = DB::select("SELECT polls.id, polls.poll_title, sports.sport, categories.category from polls inner join sports on sports.id = polls.sport_id left join categories on categories.id = polls.category_id order by polls.created_at DESC ");

        $this->layout->main = View::make("admin.polls.index", ["sports" => $sports,'polls' => $polls]);
    }

    public function edit($id, $option_id = null){
        $this->layout->sidebar = 'poll';
        $this->layout->subsidebar = 0;

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $poll = Poll::find($id);
        
        $categories = Category::where('sport_id',$poll->sport_id)->lists('category','id');
        $categories[0]="None";
        ksort($categories);
        
        $poll_options = DB::table("poll_options")->where('poll_id',$id)->get();


        $this->layout->main = View::make("admin.polls.edit", ["sports" => $sports, "poll"=>$poll, "categories"=>$categories, "poll_options"=>$poll_options, "option_id" => $option_id ]);
        $this->layout->list = '';
    }

    public function store(){
      $credentials = [
      'sport_id' => Input::get('sport_id'),
      'poll_title' => Input::get('poll_title')
      ];
      $rules = [
      'sport_id' => 'required|not_in:0',
      'poll_title' => 'required'
      ];
      $validator = Validator::make($credentials, $rules);
      if ($validator->passes()) {
          $poll = new Poll;
          $poll->category_id = Input::get('category_id');
          $poll->sport_id = Input::get('sport_id');
          $poll->poll_title = Input::get('poll_title');
          $poll->save();
          foreach (Input::get("poll_option") as $value) {
            if($value != ''){
              DB::table("poll_options")->insert(["poll_option"=>$value, "poll_id" => $poll->id ]); 
            }
          }
          return Redirect::Back()->with('success', 'Successfully Added');
      } else {
        return Redirect::Back()->withErrors($validator)->withInput();
    }
}

public function update($id){
  $credentials = [
  'sport_id' => Input::get('sport_id'),
  'poll_title' => Input::get('poll_title')
  ];
  $rules = [
  'sport_id' => 'required|not_in:0',
  'poll_title' => 'required'
  ];
  $validator = Validator::make($credentials, $rules);

  if ($validator->passes()) {
        $poll = Poll::find($id);
        $poll->category_id = Input::get('category_id');
        $poll->sport_id = Input::get('sport_id');
        $poll->poll_title = Input::get('poll_title');
        $poll->save();
        return Redirect::Back()->with('success', 'Successfully Updated');        
    } else {
        return Redirect::Back()->withErrors($validator)->withInput();
    }
}

public function destroy($id){
    $poll = Poll::find($id);
    if($poll->delete())
      return Redirect::Back()->with('success', 'Poll successfully deleted');
  else
      return Redirect::Back()->with('failure', 'Poll can\'t be deleted');
}

public function storeOption($id){
    $credentials = [
    'poll_option' => Input::get('poll_option')
    ];
    $rules = [
    'poll_option' => 'required'
    ];
    $validator = Validator::make($credentials, $rules);
    if ($validator->passes()) {

    if(DB::table("poll_options")->insert(["poll_option"=>Input::get("poll_option"), "poll_id" => $id ]))
      return Redirect::Back()->with('success', 'Poll option successfully added');
    else
      return Redirect::Back()->with('failure', 'Poll option can\'t be added');
    } else {
        return Redirect::Back()->withErrors($validator)->withInput();
    }
}

public function updateOption($id){
    $credentials = [
    'poll_option_edit' => Input::get('poll_option_edit')
    ];
    $rules = [
    'poll_option_edit' => 'required'
    ];
    $validator = Validator::make($credentials, $rules);
    if ($validator->passes()) {

    DB::table("poll_options")->where('id',$id)->update(["poll_option"=>Input::get("poll_option_edit")]);
      return Redirect::Back()->with('success', 'Poll option successfully updated');
    } else {
        return Redirect::Back()->withErrors($validator)->withInput();
    }
}

public function destroyOption($id){
    if(DB::table("poll_options")->where("id", $id )->delete())
      return Redirect::Back()->with('success', 'Poll option successfully deleted');
    else
      return Redirect::Back()->with('failure', 'Poll option can\'t be deleted');
}

}
