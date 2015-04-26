<?php

class FootballPointController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'football';
		$this->layout->subsidebar = 1;
        $points = Point::get();

		$category = Category::where('level',2)->lists('category','id');
        $category[0]="Select";
        ksort($category);
        
        $this->layout->main = View::make("admin.point.index", ["category" => $category]);
	}

	public function getedit($id){
        $this->layout->sidebar = 'football';
        $this->layout->subsidebar = 1;

        $teams = Team::leftJoin('point','categories.id','=','point.team_id')->where('categories.parent_id',$id)->select('categories.id','categories.category')->orderBy('point.position','asc')->get();

        $points = Point::where('category_id',$id)->get();
        $points_table = array();
        foreach ($points as $point) {
            $points_table[$point->team_id]["team_id"] = $point->team_id;
            $points_table[$point->team_id]["position"] = $point->position;
            $points_table[$point->team_id]["played"] = $point->played;
            $points_table[$point->team_id]["won"] = $point->won;
            $points_table[$point->team_id]["draw"] = $point->draw;
            $points_table[$point->team_id]["lost"] = $point->lost;
            $points_table[$point->team_id]["goal_for"] = $point->goal_for;
            $points_table[$point->team_id]["goal_against"] = $point->goal_against;
            $points_table[$point->team_id]["goal_difference"] = $point->goal_difference;
            $points_table[$point->team_id]["points"] = $point->points;
        }

        $this->layout->main = View::make("admin.point.edit", ["category_id"=>$id,"teams" => $teams, "points_table" => $points_table ]);
	}



	public function postAdd(){
		$credentials = [
            'category_id' => Input::get('category_id')
        ];
        $rules = [
            'category_id' => 'required|not_in:0'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            return Redirect::to('admin/point/edit/'.Input::get('category_id'));
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

	public function putupdate($id){

        $teams = Team::where('parent_id',$id)->select('id','category')->get();
        foreach ($teams as $team) {

            $check = Point::where('category_id',$id)->where('team_id',$team->id)->select('id')->first();
            if(sizeof($check) == 0){
                $point = new Point;
            } else {
                $point = Point::find($check->id);
            }
                $point->category_id = $id;
                $point->team_id = $team->id;
                $point->played = (Input::get('played_'.$team->id))?Input::get('played_'.$team->id):0;
                $point->won = (Input::get('won_'.$team->id))?Input::get('won_'.$team->id):0;
                $point->draw = (Input::get('draw_'.$team->id))?Input::get('draw_'.$team->id):0;
                $point->lost = $point->played - ($point->won + $point->draw);
                $point->goal_for = (Input::get('goal_for_'.$team->id))?Input::get('goal_for_'.$team->id):0;
                $point->goal_against = (Input::get('goal_against_'.$team->id))?Input::get('goal_against_'.$team->id):0;
                $point->goal_difference = $point->goal_for - $point->goal_against;
                $point->points = 3*$point->won + $point->draw;
                $point->save();
        }

        $team_points = DB::table("point")->select('point.id','point.team_id','point.points','point.goal_difference', 'point.goal_for','categories.category')->join('categories','categories.id', '=', 'point.team_id')->where('point.category_id', $id)->orderBy('point.points', 'desc')->orderBy('point.goal_difference','desc')->orderBy('point.goal_for','desc')->orderBy('categories.category','asc')->get();
        $count = 1;
        foreach ($team_points as $points) {
            DB::table('point')->where('id',$points->id)->update(array('position'=>$count));
            $count++;
        }
        return Redirect::Back()->with('success', 'Successfully Updated');
	}

}
