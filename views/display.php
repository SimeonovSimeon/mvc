<script>
    function deleteOwner($ownerId){
        if(confirm("Are you sure you want to delete this entry")){
            window.location = 'index.php?p=delete&ownerId='+$ownerId;
        }
    }
</script>

<div>
    <h3>Display All owners</h3>
    <div id="message">
    <?php
   
     if (filter_has_var(INPUT_GET,"message")) {
        switch ($_REQUEST['message']) {
            case 'update':
                    echo "<p>Owner ".$_REQUEST['ownerID']." has been updated.</p>";
                    break;
            case 'delete':
                    echo "<p>Owner ".$_REQUEST['ownerID']." has been deleted.</p>";	
                    break;
            case 'add':
                    echo "<p>Owner ".$_REQUEST['ownerID']." has been added.</p>";
                    break;
            case 'delErr':
                    echo "<p>Unable to delete product ".$_REQUEST['ownerId']."</p>";
        }
    }
    ?>
    </div>
    <p><a href="index.php?p=add">Add new owner</a></p>
    <table>
        <tr>
            <th>Owner Id</th><th>First Name</th><th>Initial</th><th>Last Name</th>
        </tr>
    <?php
        if ($result) {
           while ($row = $result->fetch()) {
                echo "<td>".$row['OwnerId']."</td>";
                echo "<td>".$row['FirstName']."</td>";
                echo "<td>".$row['Initial']."</td>";
                echo "<td>".$row['LastName']."</td>";
                echo "<td><a href='index.php?p=update&ownerId=".$row['OwnerId']."'>Update</a></td>";
                echo "<td><a href='javascript:deleteOwner(".$row['OwnerId'].")'>Delete</a></td>";
                echo "</tr>";
                
            }
        }
    ?>
    </table>
</div>