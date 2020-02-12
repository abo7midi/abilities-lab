
<nav class="navbar navbar-inverse navbar-expand-lg  ">
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
            <a class="navbar-brand text-center" href="/admin/dashboard"><i class="glyphicon glyphicon-home"  style="font-size: 22px;"></i> </br><?php echo lang('HOME_ADMIN')?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">

                <li><a class="text-center" href="/admin/category"><i class="glyphicon glyphicon-th" style="font-size: 22px;"></i></br><?php echo lang('CATEGORIES')?></a></li>
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-star"  style="font-size: 22px;"></i></br><?php echo lang('STARS')?></a></li>
                <li><a class="text-center" href="/admin/member"><i class="fa fa-users"  style="font-size: 22px;"></i></br><?php echo lang('MEMBERS')?></a></li>
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-info-sign"  style="font-size: 22px;"></i></br><?php echo lang('ABOUT_US')?></a></li>
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-signal"  style="font-size: 22px;"></i></br><?php echo lang('STATISTICS')?></a></li>
                <li><a class="text-center" href="/exam/exama"><i class="glyphicon glyphicon-signal"  style="font-size: 22px;"></i></br>Exam</a></li>
              </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-comment" style="font-size: 18px;"></i><span>23</span></a></li>
                <li><a class="text-center" href="#"><i class="glyphicon glyphicon-bell" style="font-size: 18px;"></i><span>98</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo "username"; ?> </a>
                    <ul class="dropdown-menu" >
                        <li><a href="/user/edit/"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
                        <li><a href="/admin/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/layout/js/backend.js"></script>
<script src="/layout/js/main.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/script.js"></script>