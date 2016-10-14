<?php

class Message extends Model {


    public function getList($only_published = false){
        $sql = "select * from messages WHERE 1 ";
        if ( $only_published){
            $sql .= " and is_published = 1";
        }

        return $this->db->query($sql);
    }

    public function save($data, $id = null){
        if ( !isset($data['name']) || !isset($data['email']) || !isset($data['message']) ) {
            return false;
         }

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if ( !$id){ // Add new record
            $sql = "
            insert into messages
            set name = '{$name}',
                email = '{$email}',
                message = '{$message}',
                   edit_admin = 0,
                is_published = '{$is_published}'
           ";
        }else{ //Update existing record
            $sql = "
            update messages
            set name = '{$name}',
                email = '{$email}',
                message = '{$message}',
                 edit_admin = 1,
                is_published = '{$is_published}'
                WHERE id = {$id}
           ";

        }
        return $this->db->query($sql);

    }


    public function getById($id){
        $id = (int)$id;
        $sql = "select * from messages WHERE id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }


    public function delete($id){
        $id = (int)$id;
        $sql = "delete from messages where id = {$id}";
        return $this->db->query($sql);
    }

    public function checkName($name){
        $name = $this->db->escape($name);
        $sql = "select * from message where name = '{$name}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0])){
            return $result[0];
        }
        return false;
    }


}
