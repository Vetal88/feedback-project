<?php

class User extends Model{

    public function getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select * from users where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0])){
            return $result[0];
        }
        return false;
    }
    
    
    
    public function auth($login, $password)
    {
        $user = $this->getByLogin($login);
        $hash = md5(Config::get('salt') . $password);
        
        if ( $user && $user['is_active'] && $hash == $user['password']){            
            Session::set('login', $user['login']);
            Session::set('role', $user['role']);
            return $user;
        }
        return false;
    }


}