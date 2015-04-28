<h1>Simeon Simeonov - <?php echo $page .' page'; ?> </h1>

<div>
<form method="post" action="index.php">
        <p><label for="First_Name">First Name:</label> <input type="text" name="fName" id="fName" value="<?php echo $fName ?>"><?php
        if ($validate) {
                if (empty($fName)) {
                        echo "<span class='error'> First Name is required field</span>";
                        $valid = false;
                }
                if (strlen($fName) > 15) {
                        echo "<span class='error' This field has a maximum length of 15 characters</span>";
                        $valid = false;
                }
        }
        ?></p>
        <p><label for="Initial">Initial: </label><input type="text" name="initial" id="initial" value="<?php echo $initial ?>"><?php
        if ($validate) {
                if (empty($initial)) {
                        echo "<span class='error'> Initial is required</span>";
                        $valid = false;
                }
                if (strlen($initial) > 2) {
                        echo "<span class='error'> This field has a maximum length of 2 characters</span>";
                        $valid = false;
                }
        }
        ?></p>
        <p><label for="Last_Name">Last Name: </label><input type="text" name="lName" id="lName" value="<?php echo $lName ?>"><?php
        if ($validate) {
                if (empty($lName)) {
                        echo "<span class='error'> Last Name is required</span>";
                        $valid = false;
                }
                if (strlen($lName) > 15) {
                        echo "<span class='error'> This field has a maximum length of 15 characters</span>";
                        $valid = false;
                }
        }
        ?></p>  
        
        <p>
            <input type="hidden" name="p" value="<?php echo $page;?>">
            <input type="hidden" name="ownerId" value="<?php echo $ownerId; ?>">
            <input type="submit" name="submit" value="<?php echo $page; ?> Owner">
        </p>
</form>


