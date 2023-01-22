<?php
    session_start();
    if(isset($_SESSION['UserSession']))
    {
       include 'init.php';
       $do = isset($_GET['do'] ) ? $_GET['do'] : 'Manage';
       if($do == 'Manage')
       {
        $stmt = $con -> prepare("SELECT * FROM users WHERE GroupID != 1");
        $stmt -> execute();

        $rows = $stmt->fetchAll();
        ?>
        <h1 class="text-center"> Mnage Uses </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table  text-center table table-bordered">
                    <tr>
                        <td>User Id</td>
                        <td>User Name</td>
                        <td>User Full Name</td>
                        <td>Registered Date</td>
                        <td>Control</td>
                    </tr>
                    <tr>
                        <?php
                            foreach($rows as $row)
                            {
                                echo "<tr>";
                                    echo "<td>" .$row['UserId']. "</td>";
                                    echo "<td>".$row['UserName']."</td>";
                                    echo "<td>".$row['FullName']."</td>";
                                    echo "<td>".$row['AddDate']."</td>";
                                    echo "<td>
                                            <a href='users.php?do=Edit&userid=".$row['UserId']."' class='btn btn-success'>Edit</a>
                                            <a href='users.php?do=Delete&userid=".$row['UserId']."' class='btn btn-danger confirm'>Delete</a>
                                        </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                </table>
            </div>
            <a class="btn btn-primary" href="users.php ? do=Add"><i class="fa fa-plus"></i> Add new user</a>
        </div>
        <?php }
       elseif ($do=='Edit')
       {
            $userid= isset($_GET['userid'])&&is_numeric($_GET['userid'])?intval($_GET['userid']):0;
            $stmt = $con->prepare("SELECT  * from users where UserId  = ? LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count =  $stmt->rowCount();

            if($count>0){?>

            <h1 class="text-center"> Edit Uses </h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="userid" value="<?php echo $userid?>" />
                        <lable class="col-sm-2 control-lable">User Name </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="userName" value="<?php echo $row['UserName'] ?>" required="required"
                                autocomplate="off" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <lable class="col-sm-2 control-lable">Password </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['Pass'] ?>" />
                            <input type="password" name="newpassword" class="form-control" autocomplate="off"
                                autocomplate="new-password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <lable class="col-sm-2 control-lable">Full Name </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="fullName" required="required" value="<?php echo $row['FullName'] ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Update" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }else{
                echo 'There is no such ID';
            }
       }elseif($do=="Update")
       {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                echo '<h1 class="text-center"> Update Users </h1>';
                echo '<div class="container"';
                $id = $_POST['userid'];
                    $username = $_POST['userName'];
                    $pass = '';
                    $fullname = $_POST['fullName'];

                    $pass = empty($_POST['newpassword'])? $pass = $_POST['oldpassword']:$pass = sha1($_POST['newpassword']);
                    
                    $formError = array();
                    if(!empty($username) && strlen($username)<4)
                    {
                        $formError[]  = 'Username can not be less than <strong>4 charecters</strong>';
                    }
                    if(empty($username))
                    {
                        $formError[]  = 'Username can not be <strong>empty</strong>';
                    }
                    if(empty($fullname))
                    {
                        $formError[]  = 'Fullname can not be <strong>empty</strong>';
                    }

                    foreach($formError as $errors)
                    {
                        echo '<div class="alert alert-danger">'.$errors.'</div>';
                    }
                    
                    if(empty($formError))
                    {
                        $stmt = $con->prepare("UPDATE users SET UserName = ? ,Pass=? , FullName = ? WHERE UserId = ?");
                        $stmt->execute(array($username , $pass, $fullname , $id));
                        //echo "<div class='alert alert-success'>" . $stmt->rowCount().'  Records Updated'. "</div>";
                        $theMsg =  "<div class='alert alert-success'>" . $stmt->rowCount().'  Records Updated'. "</div>";
                        redirectToHome($theMsg , 'back'); 
                    }
                }
                else{
                    $theMsg =  '<div class="alert alert-danger" >You can not enter this page directly</div>'; 
                    redirectToHome($theMsg , 'back'); 
                }
            echo '</div>';
       }
       elseif($do=='Add')
       {?>
            <h1 class="text-center"> Add Uses </h1>

            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST">
                    <div class="form-group">
                        <lable class="col-sm-2 control-lable">User Name </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="userName" plaseholder="" required="required" autocomplate="off"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <lable class="col-sm-2 control-lable">Password </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="password" required="required" name="password" class="password form-control" plaseholder=""
                                autocomplate="off" autocomplate="new-password" />
                            <i class="show-pass fa fa-eye fa-2x"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <lable class="col-sm-2 control-lable">Full Name </lable>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="fullName" required="required" plaseholder="" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
            <?php
       }elseif($do=='Insert')
       {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            echo '<h1 class="text-center"> Insert Users </h1>';
            echo '<div class="container"';
                $username = $_POST['userName'];
                $pass = $_POST['password'];
                $fullname = $_POST['fullName'];
                $hashPass = sha1($_POST['password']);

                 $formError = array();
                if(!empty($username) && strlen($username)<4)
                {
                    $formError[]  = 'Username can not be less than <strong>4 charecters</strong>';
                }
                if(empty($username))
                {
                    $formError[]  = 'Username can not be <strong>empty</strong>';
                }
                if(empty($pass))
                {
                    $formError[]  = 'Password can not be <strong>empty</strong>';
                }
                if(empty($fullname))
                {
                    $formError[]  = 'Fullname can not be <strong>empty</strong>';
                }

                foreach($formError as $errors)
                {
                    echo $errors;
                }
                
                if(empty($formError))
                {
                    $check = checkItem("UserName","users",$username);
                    if($check == 1)
                    {
                        echo 'This user is already exist..';
                    }else{
                        
                        $stmt = $con->prepare("INSERT INTO 
                                                users(UserName , Pass , FullName , AddDate )
                                                VALUES(:zuname , :zpassword , :zfname , now())");
                        $stmt->execute(array(
                            'zuname' => $username , 
                            'zpassword' => $hashPass, 
                            'zfname' => $fullname
                        ));
                        //echo "<div class='alert alert-success'>" . $stmt->rowCount().'  Records Updated'. "</div>";
                        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount().'  Records Inserted'. "</div>";
                        redirectToHome($theMsg , 'back'); 
                    }
                }
            }
            else{
                $theMsg = '<div class="alert alert-danger" >You can not enter this page directly</div>';
                redirectToHome($theMsg , 'back'); 
            }
        echo '</div>';
       }elseif($do=='Delete'){

        echo  "<h1 class='text-center'> Delete Uses </h1>";
        echo "<div class='container'>";
            $userid= isset($_GET['userid'])&&is_numeric($_GET['userid'])?intval($_GET['userid']):0;
                $stmt = $con->prepare("SELECT  * from users where UserId  = ? LIMIT 1");
                $stmt->execute(array($userid));
                $count =  $stmt->rowCount();

                if($count>0){
                    $stmt = $con->prepare("DELETE FROM users WHERE UserId = :zuserid");
                    $stmt->bindParam(":zuserid" , $userid);
                    $stmt->execute();
                    echo "<div class='alert alert-success'>" . $stmt->rowCount().'  Records Deleted'. "</div>";
                }

            }
        echo "</div>";

       include $tpl. 'footer.php';
    }else
    {
        header('location: index.php');
    }
?>