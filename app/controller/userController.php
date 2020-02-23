<?php

/**
 *
 */
class userController extends Controller
{
    public function index()
    {
        header("location:/home/index");
    }

//

//controller for adding user by admin
    public function add()
    {
//
//        $login = array(
//            ':username' => "kholodk",
//            ':password' => Hashing::init("123456")
//        );
//
//        $user=$this->model("Users");
//           print_r( $user->checkLogin($login));
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $validate= Validation::required(['full_name','username','password','email','phone','group_id']); //sure that first element in array most be null

            if ($_FILES)
            {
                $upload = 1;
                $file = $_FILES["fileToUpload"]["name"];
                $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
                $file_size = $_FILES["fileToUpload"]["size"];
                $target_dir = ROOT."public".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR;
                $filename = Helper::uploadFile($target_dir, $file, $file_tmp, $file_size);
            }

            if ($validate['status']==1) {
                function checkemail($us,$ue)
                {
                    $oStmt = DB::init()->preparation("select user_name,user_email from users WHERE user_name = ? or user_email = ?");
                    $oStmt->execute([$us,$ue]);
                    $r=$oStmt->fetchAll();

                    if (sizeof( $r)>0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                if (checkemail($_POST["username"], $_POST["email"]) == true) {
                    echo "This Is Existing";
                } else {
                    $post = array(
                        ':full_name' => htmlentities($_REQUEST['full_name']),
                        ':user_name' => htmlentities($_REQUEST['username']),
                        ':user_email' => htmlentities($_REQUEST['email']),
                        ':phone' => htmlentities($_REQUEST['phone']),
                        ':user_pass' => Hashing::init($_REQUEST['password']),
                        ':group_id' => htmlentities($_REQUEST['type']),
                        ':picture' => $filename
                    );

                    $this->model('Users');


                    if ($this->model->add($post)) {
                        Message::setMessage(1,'main', 'تم اضافة المستخدم بنجاح');
                    }
                }
            }

        }

        $category=  $this->model('Category');
        $cat = $category->get_category();
        $sub_cat=array();
        foreach ($cat as $parent){
            array_push($sub_cat,$category->get_sub_cat([$parent['cat_id']]));
        }
        print_r($sub_cat);

        # show form view  to add new user
        $this->view('home'.DIRECTORY_SEPARATOR.'index',["sub_cat" => $sub_cat,"cat" => $cat,"form_id"=>1]);
        $this->view->pageTitle='Add New User';
        $this->view->render();
    }

    /*********************************************************************************/

//---------------------------------------login---------------------------------------------------------------------------------
    public function login()
    {
        // check if there submit

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validate = Validation::required(['username', 'password']);
            //sure that first element in array most be null
            $login = array(
                ':username' => htmlentities($_REQUEST['username']),
                ':password' => Hashing::init($_REQUEST['password'])
            );
            $users=$this->model('Users');
            $user=$users->checkLogin($login);
            if (!empty($user)) {
                Session::loggIn([$user[0]['user_id'],
                    $user[0]['user_name'],
                    $user[0]['group_id'],
                    $user[0]['image']]);

                if ($user[0]["group_id"] == 2 && $user[0]["user_state"]==1 ) {
                    header("location:/exam/add");
                    echo "ur examiner";

                } elseif  ($user[0]["group_id"] == 3 && $user[0]["user_state"]==1 ){
                    header("location:/home/index");
                    echo "ur members";
                }elseif  ($user[0]["group_id"] == 1 && $user[0]["user_state"]==1 ) {
                    header('Location:/admin/dashboard');
                }
                else{
                    echo "error";
                }

            }
            $this->view('admin'.DIRECTORY_SEPARATOR.'addUser');
            $this->view->pageTitle='login User';
            $this->view->render();


        } else {
            $this->model('Admin');
            $this->view('admin'.DIRECTORY_SEPARATOR.'errorPage');
            $this->view->pageTitle='Error';
            $this->view->render();

        }
    }
    public function logout(){
        session_destroy();
        header("location:/user/index");
    }
//---------------------------------------------------start update user----------------------------------------------------------------------

////controller for adding user by admin
    public function edit($id)
    {

        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_FILES)
            {
                $upload = 1;
                $file = $_FILES["fileToUpload"]["name"];
                $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
                $file_size = $_FILES["fileToUpload"]["size"];
                $target_dir = ROOT."public".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR;
                $updatefile = Helper::uploadFile($target_dir, $file, $file_tmp, $file_size);
            }

            $validate= Validation::required(['full_name','username','password','email','phone','group_id']); //sure that first element in array most be null

            $account= array(
                ':fullname' => htmlentities($_REQUEST['full_name']),
                ':username' => htmlentities($_REQUEST['username']),
                ':password' =>  Hashing::init($_REQUEST['password']),
                ':email'    => htmlentities($_REQUEST['email']),
                ':mobile'   => htmlentities($_REQUEST['phone']),
                ':type'     =>  htmlentities($_REQUEST['type']),
                ':picture'  => $updatefile,
                ':id'=>$id

            );




            $this->model('Users');
            if ($this->model->update($account)) {
                Message::setMessage('msgState',1,'');
                Message::setMessage('','main','تم تحديث بيانات الحساب بنجاح');
            }
        }




        $account=isset($this->model)?$this->model: $this->model('Users');

        # show form view  to add new user


        $this->view('admin'.DIRECTORY_SEPARATOR.'editUser',['accounts'=>$account->find( array(0 =>$id))]);

        $this->view->pageTitle='Add New User';
        $this->view->render();
    }
//---------------------------------------------------end update user----------------------------------------------------------------------






//---------------------------------------------------start delete user----------------------------------------------------------------------
    public function delete($id)
    {
        $this->model('Users');
        $this->model->delete( array(0 => $id ));
        Message::setMessage('status',1,'');
        Message::setMessage('','main','تم حذف الحساب بنجاحّ!');
        header('Location:/user');

    }
//---------------------------------------------------end delete user----------------------------------------------------------------------
//---------------------------------------------------start active user----------------------------------------------------------------------
    public function active($id)
    {
        $this->model('Users');
        $this->model->updateActive( array(0 => $id ));
        Message::setMessage('status',1,'');
        Message::setMessage('','main','الحساب بنجاحّ!');
        header('Location:/user');

    }

    public function nonactive($id)
    {
        $this->model('Users');
        $this->model->updatedisActive( array(0 => $id ));
        Message::setMessage('status',1,'');
        Message::setMessage('','main','تقفلّ الحساب!');
        header('Location:/user');

    }

//---------------------------------------------------end active  user----------------------------------------------------------------------

}

?>
