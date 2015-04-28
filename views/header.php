<?php //header.html by simeon simeonov
//this file is to be used for a header section
//within the entire mvc model

//check if title is being set

if (!isset($page_title)){
    $page_title = 'Default Page Title';
}
?>
<!DOCTYPE HTML>
<html>

<head>
  <title><?php echo $page_title; ?></title> 
  <link rel="stylesheet" type="text/css" href="styles/global.css" title="style" />
</head>
 
<body>
    <div id="container">
        <header>
            <!-- div containing logo-->
            <div></div>
            
            <h1>Simple MVC example</h1>
            <h2>by Simeon Simeonov</h2>
         
            <nav>  
                <ul id="menu"> 
                  <li><a href="index.php">Home</a></li>
                  <li><a href="index.php?p=add">Add</a></li>
                </ul>
            </nav>
      </header>
    </div>
<!-- End of header. -->