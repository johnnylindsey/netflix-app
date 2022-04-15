<?php
require('connect_db_netflix.php');
require('comment_db.php');

$list_of_comments = getAllComments();
$comment_to_update = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  
    if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Add" )
    {  
      
      addComment($_POST['username'], $_POST['commentText']);
      $list_of_comments = getAllComments();
    }
    else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Update")
    {  
      
      $comment_to_update = getComment_byName($_POST['comment_to_update']);


    }
    else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete")
    {
      deleteComment($_POST['comment_to_delete']);
      $list_of_comments = getAllComments();
    }


  if(!empty($_POST['btnAction']) && $_POST['btnAction'] == "Confirm Update")
  {
    updateComment($_POST['username'], $_POST['commentText']);
    //refreshing the screen by calling getAllcomments again
    $list_of_comments = getAllComments();
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
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>DB interfacing example</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
</head>

<body style="background-color: rgb(28, 148, 148);">
<nav class="navbar navbar-dark bg-dark" >
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Netflix App</a>
    </div>
        <ul class="nav navbar-nav">
            <li><a href="?command=netflix" class="text-white">Netflix</a></li>
            <li><a href="?command=myAccount" class="text-white">My Account</a></li>
            <li><a href="?command=logout" class="text-white">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
  <h1>Comments</h1>  

  <form name="mainForm" action="commentForm.php" method="post">   
  <div class="row mb-3 mx-3">
    username:
    <input type="text" class="form-control" name="name" required 
            value="<?php if ($comment_to_update!=null) echo $comment_to_update['username'] ?>"
    />        
  </div>  
  <div class="row mb-3 mx-3">
    Comment:
    <input type="text" class="form-control" name="commentText" required 
            value="<?php if ($comment_to_update!=null) echo $comment_to_update['commentText'] ?>"
    /> 
  </div>  
  <input type="submit" value="Add" name="btnAction" class="btn btn-dark" 
        title="insert a comment" />  
  <input type="submit" value="Confirm Update" name="btnAction" class="btn btn-dark" 
      title="confirm update" />  
</form>    

<hr/>
<h2>List of comments</h2>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Username</th>        
    <th width="25%">Comment</th>        
    <th width="12%">Update</th>
    <th width="12%">Delete</th> 
  </tr>
  </thead>
  <?php foreach ($list_of_comments as $commentText): ?>
  <tr>
    <td><?php echo $commentText['username']; ?></td>
    <td><?php echo $commentText['commentText']; ?></td>
    <td>
      <form action="commentForm.php" method="post">
        <input type="submit" value="Update" name="btnAction" class="btn btn-primary" />
        <input type="hidden" name="comment_to_update" value="<?php echo $commentText['username'] ?>" />      
      </form>
    </td>
    <td>
    <form action="commentForm.php" method="post">
        <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
        <input type="hidden" name="comment_to_delete" value="<?php echo $commentText['username'] ?>" />      
      </form>
    </td> 
  </tr>
  <?php endforeach; ?>

  
  </table>

</div>    
</body>
</html>

