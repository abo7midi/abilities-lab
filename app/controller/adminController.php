<?php

/**
 *
 */
class adminController extends Controller
{

  public function index()
  {
    $this->model('Admin');
    $this->view('admin'.DIRECTORY_SEPARATOR.'login',['admins'=>$this->model->all()]);
    $this->view->pageTitle='admin index';
    $this->view->render();
  }

    public function dashboard()
    {
        $this->model('Admin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'dashboard',['admins'=>$this->model->all()]);
        $this->view->pageTitle='admin index';
        $this->view->render();
    }

    public function member()
    {
        $this->model('Admin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'accounts',['accounts'=>$this->model->all()]);
        $this->view->pageTitle='admin index';
        $this->view->render();
    }

    public function category()
    {
        $this->model('Admin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'category',['categories'=>$this->model->allSubCate()]);
        $this->view->pageTitle='admin index';
        $this->view->render();
    }

    public function login()
        {
            // check if there submit

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $validate = Validation::required(['username', 'password']); //sure that first element in array most be null


                $login = array(
                    ':username' => htmlentities($_REQUEST['username']),
                    ':password' => Hashing::init($_POST['password'])
                );


                $users=$this->model('Users');

                $user=$users->checkLogin($login);

                if (!empty($user)) {
                    Session::loggIn([$user[0]['user_id'],
                        $user[0]['user_name'],
                        $user[0]['group_id']]);

                   if  ($user[0]["group_id"] == 1 && $user[0]["user_state"]==1 ) {
                        header('Location:/admin/dashboard');
                        echo $user[0]['user_id'];
                    }
                    else{
                        ?>
                        <script>alert("You Are Not An Authorization");</script>
                        <?php
                    }

                }


                $this->view('admin'.DIRECTORY_SEPARATOR.'login');
                $this->view->pageTitle='login User';
                $this->view->render();?>
                <script>alert("You Are Not Exist And An Authorization");</script>
                <?php
            }
    }
//    public function login()
//    {
//        // check if there submit
//
//        IF($_SERVER['REQUEST_METHOD'] == "POST"){
//            $username = $_POST['username'];
//            $password = $_POST['password'];
//            $hashedPass = md5($password);
//
//            $validate = Validation::required(['username', 'password']); //sure that first element in array most be null
//
//            $login = array(
//                ':username' => $username,
//                ':password' => $hashedPass
//            );
//
//
//            $this->model('Admin')->adminLogin($login);
//
//
//            // If Count > 0 This Mean The Database Contain Record About This Username
//
//            if (!empty($user)) {
//                Session::loggIn([$user[0]['user_id'],
//                    $user[0]['user_name'],
//                    $user[0]['group_id']]);
//
//                if ($user[0]["group_id"] == 1 && $user[0]["user_state"] == 1) {
//
//                    header("location:/admin/dashboard");
//
//                } else {
//                    echo "You Are Not An Authorization";
//                }
//            }
//
//        }
//        $this->view('admin'.DIRECTORY_SEPARATOR.'login');
//        $this->view->pageTitle='login';
//        $this->view->render();
////        IF($_SERVER['REQUEST_METHOD'] == "POST"){
////            $username = $_POST['username'];
////            $password = $_POST['password'];
////            $hashedPass = md5($password);
////
////            $validate = Validation::required(['username', 'password']); //sure that first element in array most be null
////
////
////            $login = array(
////                ':username' => $username,
////                ':password' => $hashedPass
////            );
////
////
////            $users=$this->model('Admin');
////
////            $user=$users->adminLogin($login);
////
////            if (!empty($user)) {
////                Session::loggIn([$user[0]['user_id'],
////                    $user[0]['user_name'],
////                    $user[0]['group_id']]);
////
////                if ($user[0]["group_id"] == 1 && $user[0]["user_state"]==1 ) {
////
////                    header("location:/admin/dashboard");
////
////                } else{
////                    echo "You Are Not An Authorization";
////                }
////            }
////
////            $this->view('admin'.DIRECTORY_SEPARATOR.'login');
////            $this->view->pageTitle='login';
////            $this->view->render();
////        }
//    }

    public function logout(){

        session_destroy();

        header("location:/admin");
    }

    }



?>
