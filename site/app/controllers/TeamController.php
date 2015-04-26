<?php

class TeamController extends BaseController {

	protected $layout = 'admin.layout';

	public function index(){
    $this->layout->sidebar = 'teams';
    $this->layout->subsidebar = 0;

    $sports = Sport::lists('sport','id');
    $sports[0]="Select";
    ksort($sports);

    $teams = DB::select("SELECT distinct(players.team_id), categories.category from players join categories on players.team_id = categories.id ");

    $this->layout->main = View::make("admin.teams.index", ["sports" => $sports, "teams"=>$teams]);
  }

  public function getteam($id){
    $this->layout->sidebar = 'teams';
    $this->layout->subsidebar = 0;

    $sports = Sport::lists('sport','id');
    $sports[0]="Select";
    ksort($sports);

    $players = DB::table('players')->where('team_id',$id)->orderBy('status', 'desc')->get();
    $team = DB::table('categories')->where('id',$id)->select('category')->first();

    $this->layout->main = View::make("admin.teams.player", ["sports" => $sports, "players"=>$players, "team"=>$team]);
  }

  public function store(){
    $credentials = [
    'team_id' => Input::get('team_id')
    ];
    $rules = [
    'team_id' => 'required|not_in:0'
    ];
    $validator = Validator::make($credentials, $rules);

    if ($validator->passes()) {
      if (Input::hasFile('csv_file')) {
        $extension = Input::file('csv_file')->getClientOriginalExtension();
        if($extension == 'csv'){
          $file_name = strtotime("now").'.csv';
          Input::file('csv_file')->move('Temp', $file_name );
            // return Redirect::back()->with('success','Uploaded successfully');

          $file = fopen('Temp/'.$file_name, 'r');
          $team_id = Input::get('team_id');
          DB::table('players')->where('team_id',$team_id)->update(array('status' => 0));
          $count =0;
          $str = '';
          $str .= '<table cellpadding="5" cellspacing="0" ><tr style="background:#4b8df8"><th>SN</th><th>Player</th><th>Success</th><tr>';
          while (($line = fgetcsv($file)) !== FALSE) {
            if($count >0) {

              $player = $line[0];

              if(DB::table('players')->where('team_id',$team_id)->where('player',$player)->count() == 0 ){
                DB::table('players')->insert(
                  array('team_id' => $team_id, 'player' => $player , 'status' => 1)
                  );
                $success = 'success';

              } else {
                DB::table('players')->where('team_id',$team_id)->where('player',$player)->update(array('status' => 1));
                $success = 'success';
              }
              $str .= '<tr style="background:#';
              $str .= ($success == 'success')?'35aa47':'e02222';
              $str .= '"><td>'.$count.'</td><td>'.$player.'</td><td>'.$success.'</td></tr>';
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
    } else {
      return Redirect::back()->withErrors($validator)->withInput();
    }
  }


  public function destroy(){
    if(DB::table('players')->where('team_id',Input::get("id"))->delete())
      return 'success';
    else
      return 'fail';
  }

  public function destroyPlayer(){
    if(DB::table('players')->where('id',Input::get("id"))->delete())
      return 'success';
    else
      return 'fail';
  }

  public function statusPlayer(){
    $player_id = Input::get('player_id');
    $status = Input::get('status');
    DB::table('players')->where('id',$player_id)->update(['status'=>$status]);
    return 'success';
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
          $str .= '<table cellpadding="5" cellspacing="0" ><tr style="background:#4b8df8"><th>SN</th><th>Team</th><th>Player</th><th>Success</th><tr>';
          while (($line = fgetcsv($file)) !== FALSE) {
            if($count >0) {

              $team_name = $line[0];
              $player = $line[1];
              $status = $line[2];

              $team = Team::where('category',$team_name)->select('id')->first();
              if(isset($team)){
                if(DB::table('players')->where('team_id',$team->id)->where('player',$player)->count() == 0 ){
                  DB::table('players')->insert(
                    array('team_id' => $team->id, 'player' => $player , 'status' => $status)
                    );
                  $success = 'success';

                } else {
                  DB::table('players')->where('team_id',$team->id)->where('player',$player)->update(array('status' => $status));
                  $success = 'success';
                }
              } else {
                $success = 'Team not found';
              }

              
              $str .= '<tr style="background:#';
              $str .= ($success == 'success')?'35aa47':'e02222';
              $str .= '"><td>'.$count.'</td><td>'.$team_name.'</td><td>'.$player.'</td><td>'.$success.'</td></tr>';
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
