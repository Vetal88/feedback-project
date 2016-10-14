<?php

class UsersController extends Controller{


    public function admin_login(){

        if ( $_POST && isset($_POST['login']) && isset($_POST['password']) ){
            $model = new User();
            $user = $model->auth($_POST['login'], $_POST['password']);
            if ( $user){
                Router::redirect('/admin/');
            }
        }

    }

    
    public function admin_logout(){
        Session::destroy();
        Router::redirect('/admin/');
    }
}