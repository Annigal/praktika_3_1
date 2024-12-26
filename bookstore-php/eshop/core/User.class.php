<?php
class User {
    public $username;
    public $passwordHash;
    public $email;
    public $isAdmin;

    public function __construct($username, $passwordHash, $email = null, $isAdmin = 0) {
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }
}
?>
