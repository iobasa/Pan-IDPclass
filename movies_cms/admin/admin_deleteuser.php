<?php
    require_once '../load.php'; //load in admin_pages
    confirm_logged_in();

    $users = getAllUsers();

    if(!$users){
        $message = 'Failed to get user list';
    }

    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $delete_result = deleteUser($user_id);

        if($delete_result){
            $message = 'Failed to delete user';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete user</title>
</head>
<body>
    <h2>Time to delete some users...</h2>
    <?php echo !empty($message)?$message:'';?>
    <table>
    <tr>
    <th>User ID</th>
    <th>User name</th> 
    <th>User Email</th>
    <th>Delete User</th>
  </tr>

  <?php while($user = $users->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
    <td><?php echo $user['user_id'];?></td>
    <td><?php echo $user['user_name'];?></td>
    <td><?php echo $user['user_email'];?></td>
    <td><a href="admin_deleteuser.php?id=<?php echo $user['user_id'];?>">Delete</a></td>
    </tr>
    <?php endwhile;?>

    </table>
</body>
</html>