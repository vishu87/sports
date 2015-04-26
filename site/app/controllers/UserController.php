<?php

class UserController extends BaseController {

    public function postLogin()
    {
        $credentials = [
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ];
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if (Auth::attempt($credentials))
                return Redirect::to('admin/dashboard');
            else return Redirect::back()->withInput()->with('failure', 'username or password is invalid!');
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    public function getUserProfile(){
        $this->layout->sidebar = 'changep';
        $this->layout->subsidebar = 0;
        $this->layout->main = View::make("admin.profile.index");
        $this->layout->list = '';
    }

    public function postChangePassword(){
        $credentials = [
            'old_p' => Input::get('old_p'),
            'new_p' => Input::get('new_p'),
            're_new_p' => Input::get('re_new_p')
        ];
        $rules = [
            'old_p' => 'required',
            'new_p' => array('required', 'min:8'),
            're_new_p' => array('required')
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) { 
            if (Hash::check(Input::get('old_p'), Auth::user()->password )) {
                if(Input::get('new_p') === Input::get('re_new_p')){
                    $password = Hash::make(Input::get('new_p'));
                    $user = User::find(Auth::id());
                    $user->password = $password;
                    $user->save();
                    return Redirect::back()->withInput()->with('success', 'Password successfully changed');
                }
            } else {
                return Redirect::back()->withInput()->with('failure', 'Old password does not match.');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }
}