<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand active" href="#"> <?php  echo lang('HOME')?> </a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="#"><?php echo lang('CATEGORIES')?></a></li>
      <li class=""><a href="#"><?php echo lang('ITEMS')?></a></li>
      <li class=""><a href="users.php"><?php echo lang('MEMBERS')?></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="users.php?do=Edit&userid=<?php echo $_SESSION['UserId']?>"><span class="glyphicon glyphicon-user"></span> <?php echo lang('EDIT_PROFILE')?></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo lang('SETTING')?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo lang('LOG_OUT')?></a></li>
    </ul>
  </div>
</nav>



<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container navbarr">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Home</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Item</a>
                </li>
                <li>
                    <a href="#">Link</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"> 
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false" aria-haspopup="true">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li>
                            <hr>
                        </li>
                        <li><a href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav> -->
<?php include "includes/templates/footer.php";?>