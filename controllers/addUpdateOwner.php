<?php
    // checks to see if the form has been submitted to do validation
    if (isset($_POST['submit'])) {
            // Create a flag to determine if the data is valid. Assume it is valid to start
            $valid = true;
            // Create a flag to determine if the data will be validated (ie. user entry)
            $validate = true;
            // retrieve the data from the form and trim any whitespace
            $fName = trim($_REQUEST['fName']);
            $initial = trim($_REQUEST['initial']);
            $lName = trim($_REQUEST['lName']);
            $ownerId = $_REQUEST['ownerId'];
    } else {
            if ($page=='add') {
                // if first time user comes to page (i.e. form not submitted), initialize all variables for sticky form fields
                $fName = "";
                $initial = "";
                $lName = '';
                $ownerId = '';
            } else {
                $dbConn = dbConnect::connect();
                $ownerId = $_GET['ownerId'];
                $result = Owners::getOwner($dbConn,$ownerId);
                if($result){
                    $owner = $result->fetch();
                    $fName = $owner['FirstName'];
                    $initial = $owner['Initial'];
                    $lName = $owner['LastName'];
                     
                } else {
                     echo mysqli_error($dbConn);
                }
                 
            }
            // if first time (no user input), set valid flag to false so form will display
            $valid = false;
            // set flag to ignore validation
            $validate = false;
    }
    require ('views/header.php');
    require ('views/add.php');
    require ('views/footer.html');
    // if everything is valid, transfer to addProduct to update database
    if ($valid) {
        // include database connection file
        $dbConn = dbConnect::connect();
        if ($page == 'add') {
            //Create the insert query and execute it
            $owner = new Owners($ownerId, $fName, $initial, $lName);
           
            $ownerId = $owner->insertOwner($dbConn);
            
            if ($ownerId) {
                // transfer to the display page
                header("Location:index.php?p=display&ownerId=$ownerId&msg=add");
                //clean out the buffer
                ob_end_clean();
                exit();
            } else {
                // If the query is not successful display the error.
                echo "<p class='error'>Unable to update database.</p>";
            }
        } else {
            $owner = new Owners($ownerId, $fName, $initial, $lName);
            Owners::updateOwner($owner);
            if ($result) {
                    header("Location:index.php?p=display&prodCode=$ownerId&msg=update");
            } else {
                    echo "<p class='error'>Unable to update database.</p>";
            }
        }
    }
    // Otherwise, send the html form page to the browser from the buffer
    ob_end_flush();

?>