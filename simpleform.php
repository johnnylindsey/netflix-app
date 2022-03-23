<?php
require('connect-db.php');
require('friend_db.php');

$list_of_friends = getAllFriends();
$friend_to_update = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Add")
    {  
      // If the button is clicked and its value is "Add" then call addFriend() function

      addFriend($_POST['name'], $_POST['major'], $_POST['year']);
      $list_of_friends = getAllFriends();
    }
    else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Update")
    {  
      // If the button is clicked and its value is "Update" then retrieve info about that friend.
      // We'll later fill in the friend's info in the form so that a user can update the info.
       echo "Update --->" . $_POST['friend_to_update'];
      $friend_to_update = getFriend_byName($_POST['friend_to_update']);

      // To fill in the form, assign the pieces of info to the value attributes of form input textboxes.
      // Then, we'll wait until a user makes some changes to the friend's info 
      // and click the "Confirm update" button to actually make it reflect the database. 
      // (also note: "name" is a primary key -- refer to the friends table we created, thus can't be updated)
    } else if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete"){
      deleteFriend($_POST['friend_to_delete']);
      $list_of_friends = getAllFriends(); // update w/ fresh data
    }

    if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Confirm update"){
      updateFriend($_POST['name'], $_POST['major'], $_POST['year']);
      $list_of_friends = getAllFriends(); // update w/ fresh data
    }

    
}
?>


<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>DB interfacing example</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body>
<div class="container">
  <h1>Friend book</h1>  

  <form name="mainForm" action="simpleform.php" method="post">   
  <div class="row mb-3 mx-3">
    Name:
    <input type="text" class="form-control" name="name" required 
            value="<?php if ($friend_to_update!=null) echo $friend_to_update['name'] ?>"
    />        
  </div>  
  <div class="row mb-3 mx-3">
    Year:
    <input type="number" class="form-control" name="year" required min="1" max="4" 
            value="<?php if ($friend_to_update!=null) echo $friend_to_update['year'] ?>"
    /> 
  </div>  
  <div class="row mb-3 mx-3">
    Major:
    <input type="text" class="form-control" name="major" required 
            value="<?php if ($friend_to_update!=null) echo $friend_to_update['major'] ?>"
    />
  </div>  
  <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
        title="insert a friend" />
        
  <input type="submit" value="Confirm update" name="btnAction" class="btn btn-dark" 
        title="Confirm update a friend" />  
</form>    

<hr/>
<h2>List of Friends</h2>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Name</th>        
    <th width="25%">Major</th>        
    <th width="20%">Year</th> 
    <th width="12%">Update ?</th>
    <th width="12%">Delete ?</th> 
  </tr>
  </thead>
  <?php foreach ($list_of_friends as $friend): ?>
  <tr>
    <td><?php echo $friend['name']; ?></td>
    <td><?php echo $friend['major']; ?></td>
    <td><?php echo $friend['year']; ?></td> 
    <td>
      <form action="simpleform.php" method="post">
        <input type="submit" value="Update" name="btnAction" class="btn btn-primary" />
        <input type="hidden" name="friend_to_update" value="<?php echo $friend['name'] ?>" />      
      </form>
    </td>
    <td>
      <form action="simpleform.php" method="post">
        <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" />
        <input type="hidden" name="friend_to_delete" value="<?php echo $friend['name'] ?>" />      
      </form>
    </td> 
  </tr>
  <?php endforeach; ?>

  
  </table>
<!-- </div>   -->


  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>    
</body>
</html>