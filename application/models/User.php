<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }
    // public function checkUser($data = array()){
    //     $this->db->select($this->primaryKey);
    //     $this->db->from($this->tableName);
    //     $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
    //     $prevQuery = $this->db->get();
    //     $prevCheck = $prevQuery->num_rows();
        
    //     if($prevCheck > 0){
    //         $prevResult = $prevQuery->row_array();
    //         $data['modified'] = date("Y-m-d H:i:s");
    //         $update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
    //         $userID = $prevResult['id'];
    //     }else{
    //         $data['created'] = date("Y-m-d H:i:s");
    //         $data['modified'] = date("Y-m-d H:i:s");
    //         $insert = $this->db->insert($this->tableName,$data);
    //         $userID = $this->db->insert_id();
    //     }

    //     return $userID?$userID:FALSE;
    // }
    public function checkUser($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->primaryKey);
            $this->db->from($this->tableName);
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['modified'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->tableName, $userData, array('id' => $prevResult['id']));
                
                //get user ID
                $userID = $prevResult['id'];
            }else{
                //insert user data
                $userData['created']  = date("Y-m-d H:i:s");
                $userData['modified'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->tableName, $userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }
}