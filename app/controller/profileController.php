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


        $id = Session::get('userID');
        if(Session::get("userGroup")==3){
            $this->model('Profile');
            $this->view('home' . DIRECTORY_SEPARATOR . 'showProfile', ['eProfile' => $this->model->all($id)]);
            $this->view->pageTitle = 'admin showProfile';
            $this->view->render();
            return "";
        }elseif(Session::get("userGroup")==2){
            header("location:/profile/examiner_profile");
        }

    }

    public function editProfile($id)
    {

        $x= $this->model('Profile');
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validate = Validation::required(['', 'full_name', 'email', 'phone']);

            if (!empty($_FILES["fileToUpload"]["size"]))
            {
                $upload = 1;
                $file = $_FILES["fileToUpload"]["name"];
                $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
                $file_size = $_FILES["fileToUpload"]["size"];
                $target_dir = ROOT . "public" . DIRECTORY_SEPARATOR . "pictures" . DIRECTORY_SEPARATOR;
                $updatep = Helper::uploadFile($target_dir, $file, $file_tmp, $file_size);
            }


            if ($validate['status'] == 1)
            {
                # prepare the array of post to send it to News model to insert to news table

                if (isset($updatep)) {

                    $pass=empty($_REQUEST['password'])?$pass=$_REQUEST['old_pass']:Hashing::init($_REQUEST['password']);


                    $modify = array(
                        ':fullname' => htmlentities($_REQUEST['full_name']),
                        ':password' => $pass,
                        ':email' => htmlentities($_REQUEST['email']),
                        ':mobile' => htmlentities($_REQUEST['phone']),
                        ':picture' => $updatep,
                        ':id' => $id);
                } else {

                    $modify = array(
                        ':fullname' => htmlentities($_REQUEST['full_name']),
                        ':password' => Hashing::init($_REQUEST['password']),
                        ':email' => htmlentities($_REQUEST['email']),
                        ':mobile' => htmlentities($_REQUEST['phone']),
                        ':picture' => empty($_REQUEST['fileToUpload']) ? $_REQUEST['old_image'] : $updatep,
                        ':id' => $id

                    );
                }


                if ($x->updateProfile($modify)) {
                    Message::setMessage(1, 'main', ' تم تحديث الفئة بنجاح');
                }
            }
        }






        # show form view  to add new user


        $this->view('home'.DIRECTORY_SEPARATOR.'editpro',['editPro'=>$x->find( array(0 =>$id))]);

        $this->view->pageTitle='edit Profile';
        $this->view->render();
    }

    public function examiner_profile(){
        $u_id = Session::get("userID");
        $profiles = $this->model('Profile');
        $profile = $profiles->examiner_profile([$u_id]);

        $this->view('home' . DIRECTORY_SEPARATOR . 'examiner_profile', ["profile" => $profile]);
        $this->view->pageTitle = 'examiner_profile';
        $this->view->render();


    }



}