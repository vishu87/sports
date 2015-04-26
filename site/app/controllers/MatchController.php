<?php

class MatchController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
        $this->layout->sidebar = 'match';
		$this->layout->subsidebar = 2;
        
        $matches = Match::get();
        $sports = Sport::lists('sport','id');
        $teams = Team::lists('category','id');

        $this->layout->main = View::make("admin.match.all", array("matches" => $matches, "sports" => $sports,"teams" => $teams));
	}

	public function getedit($id){
        $this->layout->sidebar = 'match';
        $this->layout->subsidebar = 1;
        
        $match = Match::find($id);

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $teams = Team::where('sport_id',$match->sport_id)->where('level',3)->lists('category','id');
        $teams[0]="Select";
        ksort($teams);

        $this->layout->main = View::make("admin.match.edit", ["teams" => $teams, "sports" => $sports, "match" => $match ]);
	}

    public function getresult($id){
        $this->layout->sidebar = 'match';
        $this->layout->subsidebar = 1;
        
        $match = Match::find($id);

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $teams = Team::where('sport_id',$match->sport_id)->where('level',3)->lists('category','id');
        $teams[0]="Select";
        ksort($teams);

        $this->layout->main = View::make("admin.match.result", ["teams" => $teams, "sports" => $sports, "match" => $match ]);
    }

    public function getlive($id){
        $this->layout->sidebar = 'match';
        $this->layout->subsidebar = 1;
        
        $match = Match::find($id);

        $sports = Sport::lists('sport','id');
        $sports[0]="Select";
        ksort($sports);

        $teams = Team::where('sport_id',$match->sport_id)->where('level',3)->lists('category','id');
        $teams[0]="Select";
        ksort($teams);

        $scores = LiveScore::where('match_id',$match->id)->orderBy('time','desc')->get();

        $this->layout->main = View::make("admin.match.live", ["teams" => $teams, "sports" => $sports, "match" => $match, "scores" => $scores ]);
    }

    public function getLineup($id){
        $this->layout->sidebar = 'match';
        $this->layout->subsidebar = 1;
        
        $match = Match::find($id);

        $sports = Sport::lists('sport','id');

        $teams = Team::where('sport_id',$match->sport_id)->where('level',3)->lists('category','id');

        $players1 = DB::table("players")->where('team_id',$match->team1_id)->where('status',1)->get();
        $players2 = DB::table("players")->where('team_id',$match->team2_id)->where('status',1)->get();

        $match_players = DB::table('match_players')->where('match_id',$match->id)->lists('player_id');

        $this->layout->main = View::make("admin.match.lineup", ["teams" => $teams, "sports" => $sports, "match" => $match, "players1" => $players1 ,"players2" => $players2, "match_players" => $match_players]);
    }

     public function getMatchs(){
        $this->layout->sidebar = 'match';
        $this->layout->subsidebar = 1;

        $sports = DB::table('sports')->lists('sport','id');
        $sports[""] = "Select";
        ksort($sports);
        
        $this->layout->main = View::make("admin.match.index",array("sports" => $sports));
    }

	public function postAdd(){
		$credentials = [
            'sport_id' => Input::get('sport_id'),
            'team1_id' => Input::get('team1_id'),
            'team2_id' => Input::get('team2_id')
        ];
        $rules = [
            'sport_id' => 'required|not_in:0',
            'team1_id' => 'required|not_in:0',
            'team2_id' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if(Input::get('team1_id') != Input::get('team2_id')){
                $match = new match;
                $match->sport_id = Input::get('sport_id');
                $match->team1_id = Input::get('team1_id');
                $match->team2_id = Input::get('team2_id');
                $match->date = date('Y-m-d',strtotime(Input::get('date')));
                $match->time = Input::get('time');
                $match->venue = Input::get('venue');
                $match->save();
                return Redirect::Back()->with('success', 'Successfully Added');
            } else {
                return Redirect::Back()->with('failure', 'Two same teams can not play match!!');
            }
    		
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
	}

    public function postAddLive($id){
        $credentials = [
            'time' => Input::get('time')
        ];
        $rules = [
            'time' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
                $live = new LiveScore;
                $live->match_id = $id;
                $live->time = Input::get('time');
                $live->team1_score = Input::get('team1_score');
                $live->team2_score = Input::get('team2_score');
                $live->team1_remark = Input::get('team1_remark');
                $live->team2_remark = Input::get('team2_remark');
                $live->minute = Input::get('minute');
                $live->description = Input::get('description');
                $live->save();
                return Redirect::Back()->with('success', 'Successfully Added');    
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
    }

     public function postAddLineup($id){
        $credentials = [
            'players1' => Input::get('players1'),
            'players2' => Input::get('players2')
        ];
        $rules = [
            'players1' => 'required',
            'players2' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
                DB::table('match_players')->where('match_id',$id)->delete();
               foreach (Input::get('players1') as $player) {
                    DB::table('match_players')->insert(['match_id'=>$id,"player_id"=>$player]);
               }
               foreach (Input::get('players2') as $player) {
                    DB::table('match_players')->insert(['match_id'=>$id,"player_id"=>$player]);
               }
                return Redirect::Back()->with('success', 'Successfully Updated');    
        } else {
            return Redirect::Back()->withErrors($validator)->withInput()->with('failure', 'Select players for both the teams');
        }
    }


	public function putUpdate($id){
		$credentials = [
           'sport_id' => Input::get('sport_id'),
            'team1_id' => Input::get('team1_id'),
            'team2_id' => Input::get('team2_id')
        ];
        $rules = [
           'sport_id' => 'required|not_in:0',
            'team1_id' => 'required|not_in:0',
            'team2_id' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if(Input::get('team1_id') != Input::get('team2_id')){
                $match = Match::find($id);
                $match->sport_id = Input::get('sport_id');
                $match->team1_id = Input::get('team1_id');
                $match->team2_id = Input::get('team2_id');
                $match->date = date('Y-m-d',strtotime(Input::get('date')));
                $match->time = Input::get('time');
                $match->venue = Input::get('venue');
                $match->save();
                return Redirect::Back()->with('success', 'Successfully Updated');
            } else {
                return Redirect::Back()->with('failure', 'Two same teams can not play match!!');
            }   
        } else {
            return Redirect::Back()->with('failure', 'Error')->withErrors($validator)->withInput();
        }
	}

    public function putUpdateResult($id){
        $credentials = [
           'win_team_id' => Input::get('win_team_id'),
            'team1_score' => Input::get('team1_score'),
            'team2_score' => Input::get('team2_score')
        ];
        $rules = [
           'win_team_id' => 'required|not_in:0',
            'team1_score' => 'required',
            'team2_score' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            $match = Match::find($id);
            $match->win_team_id = Input::get('win_team_id');
            $match->team1_score = Input::get('team1_score');
            $match->team2_score = Input::get('team2_score');
            $match->team1_remark = Input::get('team1_remark');
            $match->team2_remark = Input::get('team2_remark');
            $match->save();
            return Redirect::Back()->with('success', 'Successfully Updated');  
        } else {
            return Redirect::Back()->withErrors($validator)->withInput();
        }
    }

	public function destroy(){
        $match = Match::find(Input::get("id"));
		if($match->delete())
    		return 'success';
    	else
    		return 'fail';
	}
    public function destroyscore(){
        $match = LiveScore::find(Input::get("id"));
        if($match->delete())
            return 'success';
        else
            return 'fail';
    }

      public function storemulti(){
          if (Input::hasFile('csv_file')) {
            $extension = Input::file('csv_file')->getClientOriginalExtension();
            if($extension == 'csv'){
              $file_name = strtotime("now").'.csv';
              Input::file('csv_file')->move('Temp', $file_name );

              $file = fopen('Temp/'.$file_name, 'r');

              $count =0;
              $str = '';
              $str .= '<table cellpadding="5" cellspacing="0" ><tr style="background:#4b8df8"><th>SN</th><th>Team1</th><th>Team2</th><th>Date</th><th>Success</th><tr>';
              while (($line = fgetcsv($file)) !== FALSE) {
                if($count >0) {

                  $team_name1 = $line[0];
                  $team_name2 = $line[1];
                  $date = date('Y-m-d',strtotime($line[2]));
                  $time = $line[3];
                  $venue = $line[4];

                  $team1 = Team::where('category',$team_name1)->select('id','sport_id')->first();
                  $team2 = Team::where('category',$team_name2)->select('id','sport_id')->first();
                  if(isset($team1) && isset($team2)){
                        if($team1->sport_id == $team2->sport_id){


                        if(DB::table('match')->where('team1_id',$team1->id)->where('team2_id',$team2->id)->where('date',$date)->count() == 0 ){
                          DB::table('match')->insert(
                            array('sport_id' => $team1->sport_id, 'team1_id' => $team1->id, 'team2_id' => $team2->id, 'date' => $date , 'time' => $time,'venue'=>$venue)
                            );
                          $success = 'success';

                        } else {
                          $success = 'Match already exists';
                        }
                    } else {
                        $success = 'Team sport doesnt match';
                    }
                  } else {
                    $success = 'Either Team not found';
                  }

                  
                  $str .= '<tr style="background:#';
                  $str .= ($success == 'success')?'35aa47':'e02222';
                  $str .= '"><td>'.$count.'</td><td>'.$team_name1.'</td><td>'.$team_name2.'</td><td>'.$date.'</td><td>'.$success.'</td></tr>';
                }
                $count++;
              }
              fclose($file);
              return $str;

            } else{
              return Redirect::back()->withErrors($validator)->with('failure','Please upload only csv file');
            }
          } else {
            return Redirect::back()->withErrors($validator)->with('failure','Please upload file');
          }
      }


}

