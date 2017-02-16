<?php

include('class.password.php');


class User extends Password{

    private $conn;
	
	function __construct($conn){
		parent::__construct();
	
		$this->_db = $conn;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}		
	}

	private function get_user_hash($username){	
            include '../includes/connection.php'; // may be need to write gblobal veriable in fucture. 
		try {
                        $sql = "SELECT password FROM blog_members WHERE username = '$username'";
                        $result = mysqli_query($conn, $sql);
                        if( mysqli_num_rows($result)> 0 ) {
    
                        //select and store id for the post
                            while ( $row = mysqli_fetch_assoc($result) ) {

                            return $row['password'];

                            }
                        }

		} catch(PDOException $e) { // may be need to write code. 
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	
	public function login($username,$password){	

		$hashed = $this->get_user_hash($username);
		
		if($this->password_verify($password,$hashed) == 1){
		    
		    $_SESSION['loggedin'] = true;
		    return true;
		}		
	}
	
		
	public function logout(){
		session_destroy();
	}
	
}


?>