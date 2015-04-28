<?php

class Owners {
    //properties
    protected $_OwnerId;
    protected $_FirstName;
    protected $_Initial;
    protected $_LastName;
    
    //constructor
    function __construct($ownerId, $fname, $initial, $lname){
        $this->_OwnerId = $ownerId;
        $this->_FirstName = $fname;
        $this->_LastName = $lname;
        $this->_Initial = $initial;
    }
    
    //set the getters
    public function getOwnerId() {
        return $this->_OwnerId;
    }
    public function getFname() {
        return $this->_FirstName;
    }
    public function getInitial() {
        return $this->_Initial;
    }
    public function getLname() {
        return $this->_LastName;
    }
    
    //set the setters
    public function setOwnerId($ownerId) {
        $this->_OwnerId = $ownerId;
    }
    public function setFname($fName) {
        $this->_FirstName = $fName;
    }
    public function setInitial($initial) {
        $this->_Initial = $initial;
    }
    public function setLname($lName) {
        $this->_LastName = $lName;
    }
   
    //db methods
    public function insertOwner($dbConn){
        $query = "INSERT INTO `ssimeonov`.`owners` (`OwnerId`, `FirstName`, `Initial`, `LastName`) VALUES (NULL, '$this->_FirstName', '$this->_Initial', '$this->_LastName');";
        
        try {
            $result=$dbConn->prepare($query);
            $result->execute(array(':fName'=>$this->_FirstName, ':initial'=>$this->_Initial, 'lName'=>$this->_LastName, 'ownerId'=>$this->_OwnerId));
            
            if($result && $result->rowCount() == 1) {
                $ownerId = $dbConn->lastInsertId();
                return $ownerId;
            }else{
                $error = $result->errorInfo();
		throw new Exception($error[2]);
            }
        } catch (PDOException $e) {
            throw new Exception('Unable to execute query' .$e.getMessage());
        }
    }
    
    public function updateOwner($dbConn) {
        $query = sprintf("Update owners set OwnerId=%d, FirstName='%s', Initial='%s', LastName=%s where OwnerId = %d", $this->_OwnerId, $this->_FirstName, $this ->_Initial, $this->_LastName);
        try{
            $result = $dbConn -> prepare($query);
            $result->execute(array(':fName'=>$this->_FirstName, ':initial'=>$this->_Initial, 'lName'=>$this->_LastName, 'ownerId'=>$this->_OwnerId));
            if ($result && $result -> rowCount() == 1) {
                return $result;
            } else {
                $error = $stmt->errorInfo();
            echo 'Update query not successfull: '.$error[2];
            }
        } catch (PDOException $e) {
            echo "A database problem has occurred: " . $e - getMessage();
        }
    }
    
    static function deleteOwner($dbConn,$ownerId) {
        $query = "Delete from owners where OwnerId = $ownerId";
        $result = $dbConn->prepare($query);
        $result->execute(array($ownerId));
        if ($result) {
            if (mysqli_affected_rows($dbConn)==1) {
                return true;
            }else{
                return false;
            }
        }
        throw new Exception('Unable to delete');
    }
    
    static function getOwner($dbConn, $ownerId) {
        $query = "Select * from owners where OwnerId = $ownerId";
        $result = $dbConn -> prepare($query);
        $result -> execute(array(':ownerId'=> $ownerId)); 
        If ($result->rowCount()==1) {
			return $result;
		} else {
			return false;
		}
        
    }
    
    static function listOwners($dbConn) {
        $query = "Select * from owners";
        $result = $dbConn->query($query);
        return $result;
    }
}//end of class Owners

