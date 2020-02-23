<?php
/**
 * Created by PhpStorm.
 * User: Alzubeer
 * Date: 20/02/2020
 * Time: 08:49 م
 */

class examadminController extends Controller
{

    public function index()
    {
        $this->model('ExamAdmin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'showexam_admin',['adminexam'=>$this->model->showexam()]);

        $this->view->pageTitle='exam';
        $this->view->render();

    }

    //---------------------------------------------------start active user----------------------------------------------------------------------
    public function ExamActive($id)
    {
        $this->model('ExamAdmin');
        $this->model->ExamActive( array(0 => $id ));
        Message::setMessage('status',1);
        Message::setMessage('main','الحساب بنجاحّ!');
        header('Location:/examadmin');

    }

    public function ExamdisActive($id)
    {
        $this->model('ExamAdmin');
        $this->model->ExamdisActive( array(0 => $id ));
        Message::setMessage('status',1);
        Message::setMessage('main','تقفلّ الحساب!');
        header('Location:/examadmin');

    }

//--------------------------------------------------user_exams----------------------------------------------------------------------------

    public function usere()
    {
        $this->model('ExamAdmin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'user_exams',['Exams'=>$this->model->ResultUser()]);

        $this->view->pageTitle='ResultUser';
        $this->view->render();

    }

    public function date()
    {
        $this->model('ExamAdmin');
        $this->view('admin'.DIRECTORY_SEPARATOR.'user_exams',['Date'=>$this->model->DateExam()]);

        $this->view->pageTitle='ResultUser';
        $this->view->render();

    }





}

//
//function checkemail($us,$ue)
//{
//    $oStmt = DB::init()->preparation("select user_name,user_email from users WHERE user_name = ? or user_email = ?");
//    $oStmt->execute([$us,$ue]);
//    $r=$oStmt->fetchAll();
//
//    if (sizeof( $r)>0) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//if (checkemail($_POST["username"], $_POST["email"]) == true) {
//    echo "This Is Existing";
//}