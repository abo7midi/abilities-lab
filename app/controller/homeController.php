<?php
/**
 *
 */
class homeController extends Controller
{


  public function index($id='',$name='')
  {

      $exam= $this->model('exam');
      $sample= $this->model('sample');
      $category= $this->model('Category');
      $cat = $category->get_category();
      $sub_cat=array();
      foreach ($cat as $parent){
          array_push($sub_cat,$category->get_sub_cat([$parent['cat_id']]));
      }
      $exams="";
      $catArray=array("0","0");
      $sampleArray=array();
      $allSamples=array();
      $results=[];

      $top = $exam->top_members();

      $this->view('home'.DIRECTORY_SEPARATOR.'index',["sub_cat" => $sub_cat,"cat" => $cat,"form_id"=>1,"top" => $top]);
      $this->view->pageTitle='Home';
    $this->view->render();
  }

  public function showCategoryExams(){
      $exam= $this->model('exam');
      $sample= $this->model('sample');
      $category= $this->model('Category');
      $cat = $category->get_category();
      $sub_cat=array();

      if($_SERVER["REQUEST_METHOD"]=="POST"){
          if(isset($_POST['subcat'])){
              $catArray=explode("%",$_POST['subcat']);
              $exams = $exam->get_exams([$catArray[0],""]);
              foreach ($exams as $e){
                  $temp=array_merge($e,
                      array('studentSample'=>count($sample->getUserExamSamples([$e['exam_id'],Session::get("userID"),$e['exam_id']]))),
                      array('allSample'=>count($sample->getExamSamples([$e['exam_id']])))
                  );
                  $results[]=$temp;
              }
          }
          else if(isset($_POST['resultSelect'])){
              $exams = $exam->get_exams(["",$_POST['resultSelect']]);
              foreach ($exams as $e){
                  $temp=array_merge($e,
                      array('studentSample'=>count($sample->getUserExamSamples([$e['exam_id'],Session::get("userID"),$e['exam_id']]))),
                      array('allSample'=>count($sample->getExamSamples([$e['exam_id']])))
                  );
                  $results[]=$temp;
              }
          }
      }
      if(empty($results))
          $results="no result";

      echo json_encode(['statusCode'=>200,'data'=>  $results]);
}
    public function search()
    {
        $exam = $this->model('exam');
        $sample = $this->model('sample');
        $category = $this->model('Category');
        if (isset($_POST['search'])) {
            $exams = $exam->search_exams(["%".$_POST['search']."%"]);
            echo json_encode(['statusCode' => 200, 'data' => $exams]);
        }
    }

    public function error()
    {
        $this->view('home'.DIRECTORY_SEPARATOR.'error');
        $this->view->pageTitle='Not Found';
        $this->view->render();
    }

    public function back()
{
  header('Location:'.$_SERVER['HTTP_REFERER']);
  exit;
}


  public function aboutus()
  {
    // echo 'i am in '.__CLASS__.'<br>method '.__METHOD__.'';
    $this->view('home'.DIRECTORY_SEPARATOR.'about');
    $this->view->pageTitle='about Us';
    $this->view->render();
  }
    public function contact()
    {
        // echo 'i am in '.__CLASS__.'<br>method '.__METHOD__.'';
        $this->view('home'.DIRECTORY_SEPARATOR.'contact');
        $this->view->pageTitle='contact us';
        $this->view->render();
    }
    public function faq()
    {
        // echo 'i am in '.__CLASS__.'<br>method '.__METHOD__.'';
        $this->view('home'.DIRECTORY_SEPARATOR.'faq');
        $this->view->pageTitle='FAQs';
        $this->view->render();
    }


  public function loggin()
    {

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //do validation to POST

          $validate=Validation::required(['','email','password']);

               if ($validate['status'] == 0){
                   $this->index();
                   return;
                   }

             $password=Hashing::init($_REQUEST['password'])->__toString();
            $userForm= array(':email' =>$_REQUEST['email'] ,':password' =>$password);
            $this->model('Users');
           $user=$this->model->checkLogin($userForm);


           if ($user['status']==0) {
             Message::setMessage('msgState',0);
             Message::setMessage('main','لم يتم تسجيل الدخول بنجاح الرجاء المحاولة مرة اخرى');
             $this->index();
             return;
           }
           Session::loggIn($user);
           if (Session::logged()) {

             Message::setMessage('msgState',1);
             Message::setMessage('main','لقد تم تسجيل الدخول بنجاح');
             if (Session::get('type')=='Admin') {

                $adminController=new adminController();
                $adminController->index();
                return ;


             }
             else {

               $this->index();
               return ;
             }

           }
           else {
             $this->index();
             return ;
           }
   }
   else {
     $this->index();
     return ;
   }

  }

public function logout()
{

  Session::destroy();
  $this->index();
}


public function viewPost($id)
{

  $news= $this->model('News');
  $comments= $this->model('Comments');
    $category= $this->model('Category');

  $this->view('home'.DIRECTORY_SEPARATOR.'post',['news'=>$news->find( array(0 =>$id)),'comments'=>$comments->newComments(array(0 =>$id)),'category'=>$category->all()]);
  $this->view->pageTitle='this page of index';

  $this->view->render();

}


public function categoryItem($id)
{

  $news= $this->model('ADMIN');
  $category= $this->model('Category');

 $categories= array('cat_title' =>Helper::catName($id) ,'id'=>$id );

  $this->view('home'.DIRECTORY_SEPARATOR.'category',['news'=>$news->findCategory( array(0 =>$id)),'categories'=>$categories,'category'=>$category->all()]);
  $this->view->pageTitle='this page of '.Helper::catName($id);

  $this->view->render();

}

}

 ?>
