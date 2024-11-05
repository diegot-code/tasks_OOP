
<?php

class User {
    public $UID;
    public $username;
    public $email;

    public function whoAmI() {
        echo $this->UID . " " . $this->username . " " . $this->email;
    }

}