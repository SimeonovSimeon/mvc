<?php //index.php

/*main page 
 *creted by Simeon Simeonov
 */

//require the connection to the db
require('classes/db.php');
//require the model
require('classes/owners.php');

if(isset($_GET['p'])){
    $page = $_GET['p'];
}elseif(isset($_POST['p'])){
    $page = $_POST['p'];
}else{
    $page = 'display';
}

//Determine what page to display:
switch ($page) {
    case 'display':
            $dbConn = dbConnect::connect();
            $result = Owners::listOwners($dbConn);
            require('views/header.php');
            require('views/display.php');
            require('views/footer.html');
            $page_title = 'List Owners';
    break;
    case 'delete':
        $dbConn = dbConnect::connect();
        $ownerId = $_GET['ownerId'];
        $page_title = 'Delete Item';
        if (owners::deleteOwner($dbConn,$ownerId)) {
                // transfer to the display page		
                header("Location:index.php?page=display&ownerId=$ownerId&msg=delete");
        } else {
                header("Location:index.php?page=display&ownerId=$ownerId&msg=delErr");
        }
        break;
    case 'add':
    case 'update':
        require("controllers/addUpdateOwner.php");
        $page_title = 'Update or Add item';
    break; 
    // Default is to include the main page.
    default:
            require('views/header.html');
            require('views/error.html');
            require('views/footer.html');
        break;
        
} // End of main switch.
    
