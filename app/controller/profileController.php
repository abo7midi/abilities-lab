<?php
/**
 * Created by PhpStorm.
 * User: Alzubeer
 * Date: 03/02/2020
 * Time: 09:40 م
 */
class profileController extends Controller
{
    public function index()
    {


            $id=Session::get('userID');

//           return var_dump($id);
        $this->model('Profile');
        $this->view('admin'.DIRECTORY_SEPARATOR.'showProfile',['Profile'=>$this->model->all($id)]);
        $this->view->pageTitle='admin showProfile';
        $this->view->render();

    }


//    edit profile
////controller for adding user by admin
///
    public function editProfile($id)
    {

        $x= $this->model('Profile');
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validate=Validation::required(['','full_name','email','phone']);

            if ($validate['status'] == 1)
            if ($_FILES)
            {
                $upload = 1;
                $file = $_FILES["fileToUpload"]["name"];
                $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
                $file_size = $_FILES["fileToUpload"]["size"];
                $target_dir = ROOT."public".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR;
                $updatep = Helper::uploadFile($target_dir, $file, $file_tmp, $file_size);
            }


            $modify= array(
                ':fullname' => htmlentities($_REQUEST['full_name']),
                ':password' =>  Hashing::init($_REQUEST['password']),
                ':email' => htmlentities($_REQUEST['email']),
                ':mobile' => htmlentities($_REQUEST['phone']),
                ':picture' => $updatep,
                ':id'=>$id

            );




            if ($x->updateProfile($modify)) {
                Message::setMessage(1,'main',' تم تحديث الفئة بنجاح');
            }
        }




//        $modifying=$this->model("Profile");//isset()?$this->model: $this->model('Profile');

        # show form view  to add new user


        $this->view('admin'.DIRECTORY_SEPARATOR.'editpro',['editPro'=>$x->find( array(0 =>$id))]);

        $this->view->pageTitle='edit Profile';
        $this->view->render();
    }

}