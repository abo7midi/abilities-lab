<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav">

                <li><a href="#" class="text-center"><i data-show="show-side-navigation1" class="fa fa-bars show-side-btn" style="font-size: 22px;"></i></a></li>
            </ul>
            <a class="navbar-brand text-center" href="/user/dashboard"><i class="glyphicon glyphicon-home"  style="font-size: 22px;"></i> </br><?php echo lang('HOME_ADMIN')?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">

                <li><a class="text-center" href="categories.php"><i class="glyphicon glyphicon-th" style="font-size: 22px;"></i></br><?php echo lang('CATEGORIES')?></a></li>
                <li><a class="text-center" href="post.php"><i class="glyphicon glyphicon-star"  style="font-size: 22px;"></i></br><?php echo lang('STARS')?></a></li>
                <li><a class="text-center" href="/user"><i class="fa fa-users"  style="font-size: 22px;"></i></br><?php echo lang('MEMBERS')?></a></li>
                <li><a class="text-center" href="comment.php"><i class="glyphicon glyphicon-info-sign"  style="font-size: 22px;"></i></br><?php echo lang('ABOUT_US')?></a></li>
                <li><a class="text-center" href="statistics.php"><i class="glyphicon glyphicon-signal"  style="font-size: 22px;"></i></br><?php echo lang('STATISTICS')?></a></li>
              </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-comment" style="font-size: 18px;"></i><span>23</span></a></li>
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-bell" style="font-size: 18px;"></i><span>98</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo "username"; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="members.php?do=Edit&id="><i class="glyphicon glyphicon-edit"></i> Edit Profile</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
                        <li><a href="/user/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>