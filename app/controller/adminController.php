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
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->model('Admin');
            $this->view('admin' . DIRECTORY_SEPARATOR . 'dashboard', ['admins' => $this->model->all()]);
            $this->view->pageTitle = 'admin index';
            $this->view->render();
        } else {
            $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
            $this->view->pageTitle='Error';
            $this->view->render();
        }
    }



    public function member()
    {
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->model('Admin');
            $this->view('admin'.DIRECTORY_SEPARATOR.'accounts',['accounts'=>$this->model->all(),'admins' => $this->model->all()]);
            $this->view->pageTitle='admin index';
            $this->view->render();
        } else {
            $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
            $this->view->pageTitle='Error';
            $this->view->render();
        }
    }

    public function category()
    {
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->model('Admin');
            $this->view('admin'.DIRECTORY_SEPARATOR.'category',['categories'=>$this->model->allCategories(),'cates'=>$this->model->allCategories(),'admins' => $this->model->all()]);
            $this->view->pageTitle='admin index';
            $this->view->render();
        } else {
            $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
            $this->view->pageTitle='Error';
            $this->view->render();
         }
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

                $users=$this->model('Admin');

                $user=$users->checkLogin($login);

                if (!empty($user)) {
                    Session::loggIn([$user[0]['user_id'],
                        $user[0]['user_name'],
                        $user[0]['group_id']]);

                    if ($user[0]["group_id"] == 2 && $user[0]["user_state"]==1 ) {

                        header("location:/exam/add");
                        echo "ur examiner";

                    } elseif  ($user[0]["group_id"] == 3 && $user[0]["user_state"]==1 ){
                        header("location:/exam/takeExam/5e366a4921621");
                        echo "ur members";
                    }elseif  ($user[0]["group_id"] == 1 && $user[0]["user_state"]==1 ) {
                        header('Location:/admin/dashboard');
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
            } else {
                $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
                $this->view->pageTitle='Error';
                $this->view->render();
            }
    }

    public function logout(){

        session_destroy();

        header("location:/admin");
    }

    public function error()
    {
        $this->model('Admin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
        $this->view->pageTitle='Error Page';
        $this->view->render();
    }


}

 ?>