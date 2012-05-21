<?php

class User {
    private $nickname;
    private $email;
    private $password;
    
    public function setNickname($nickname) {
        $this->nickname = $nickname;
        
        return $this;
    }
    
    public function getNickname() {
        return $this->nickname;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setPassword($password) {
        $this->password = $password;
        return $this;
        
    }
    
    public function getPassword() {
        return $this->password;
    }
}