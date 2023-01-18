<?php 
    session_start();
    $noNavbar = '';
    $pageTitle = 'LogIn';
    if(isset($_SESSION['UserSession']))
    {
        header('location: dashboard.php');
    }
    include 'init.php';
    

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['name'];
        $password = $_POST['pass']; 
        $hashedPass = sha1($password);

        $stmt = $con->prepare("SELECT 
                                    UserId  , UserName , Pass 
                                from 
                                    users 
                                where 
                                    Username = ?
                                AND 
                                    pass = ?  
                                AND 
                                GroupID = 1
                                LIMIT 1");
        $stmt->execute(array($username , $hashedPass));
        $row = $stmt->fetch();
        $count =  $stmt->rowCount();
        
        if($count>0)
        {
            $_SESSION['UserId']=$row['UserId'];
            $_SESSION['UserSession'] = $username;
            header('location: dashboard.php');
            exit();
        }
    }
    ?>
    <form class= "login" action = "<?php echo $_SERVER['PHP_SELF']?> " method="POST">
        <h4 class= "text-center"> Log In</h4>
        <input class= "form-control"  type = "text" name = "name" placeholder = "userName" autocomplate="off" />
        <input class= "form-control" type = "password" name = "pass" placeholder = "password" autocomplate= "new-password" />
        <input class= "btn btn-primary btn-block" type="submit" value= "login" />
</form>  
<?php include "includes/templates/footer.php";?>