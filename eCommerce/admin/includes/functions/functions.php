<?php
    function getTitle()
    {
        global $pageTitle;
        if(isset($pageTitle))
        {
            echo $pageTitle;
        }
        else{
            echo 'Default';
        }
    }


    /* redirct function */
    function redirectToHome($theMsg , $url=null ,  $second = 3){
        if($url === null)
        {
            $url = "index.php";
        }else{
            $url = isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!==''?$url = $_SERVER['HTTP_REFERER']:$url = "index.php";
        }
        echo $theMsg;
        echo "<div class='alert alert-info'>You will be redirected to $url page after $second seconds.</div>";
        header("refresh:$second; $url");
        exit();
    }

    function checkItem($select , $from , $value)
    {
        global $con;
        $statement =  $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statement -> execute(array($value));
        $count = $statement->rowCount();
        return $count;
    }
?>