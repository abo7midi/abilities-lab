<?php

/**
 *
 */
class categoryController extends Controller
{

  public function index()
  {
    $this->model('Category');
    $this->view('admin'.DIRECTORY_SEPARATOR.'category',['categories'=>$this->model->allSubCate()]);
    $this->view->pageTitle='admin category';
    $this->view->render();

  }




    public function add()
    {
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $postErr=0;

            $validate=Validation::required(['','name','c']);

            # add new record to the database

            if ($validate['status'] == 1)
            {
//                $id = null;
                $name = $_POST['name'];
                $desc = $_POST['description'];
//                $created_By = $_SESSION['user_id'];
//                $created_At = now();
                $c = $_POST['cat'];
                $cat = $_POST['categories'];

                $category = [
//                    $id,
                    $name,
                    $desc,
//                   $created_By,
//                    $created_At,
                    $c,
//                    $cat
                ];



                $this->model('Category');
                if ($this->model->add($category)) {
                    Message::setMessage('msgState',1,'');
                    Message::setMessage('','main',' تم اضفة الفئة بنجاح');
                }

            }
        }
//        $this->view('admin'.DIRECTORY_SEPARATOR.'addCategory');
        $this->model('Category');
        $this->view('admin'.DIRECTORY_SEPARATOR.'addCategory',['categories'=>$this->model->allSubCate()]);


        $this->view->pageTitle='admin category';
        $this->view->render();

    }

//  public function add()
//  {
//    // check if there submit
//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//      $postErr=0;
//
////do validation to POST
//     $validate=Validation::required(['','title']);
//
//      # add new record to the database
//
//      if ($validate['status'] == 1)
//      {
//    # prepare the array of post to send it to News model to insert to news table
//          $name = $_POST['name'];
//          $name = ucwords(strtolower($name));
//          $total_mark = $_POST['total_mark'];
//          $pass_mark = $_POST['pass_mark'];
//          $no_q = $_POST['no_q'];
//          $duration = $_POST['duration'];
//          $level = $_POST['level'];
////    $level = "HHard";
//          $desc = $_POST['desc'];
//          $price = $_POST['price'];
//          $id = uniqid();
//
//          switch($level)
//          {
//              case 'h':
//                  $lv ='1';
//                  break;
//              case 'm':
//                  $lv ='2';
//                  break;
//              case 'e':
//                  $lv ='3';
//                  break;
//
//              default:
//                  $lv ='';
//          }
//
//          if (!$price==''){
//              $paid='1';
//
//          }else{
//              $paid='0';
//          }
//
//                      $category= $data = [
//                          $id,
//                          $name,
//                          $desc,
//                          $lv,
//                          $no_q,
//                          $duration,
//                          $price,
//                          $paid,
//                          "0",
//                          "1",
//                          $total_mark,
//                          $pass_mark,
//                          "1"
//
//
//                      ];
//
//
//
//      $this->model('Category');
//    if ($this->model->add($category)) {
//      Message::setMessage('msgState',1);
//      Message::setMessage('main',' تم اضفة الفئة بنجاح');
//    }
//
//      }
//    }
//    $this->view('admin'.DIRECTORY_SEPARATOR.'addCategory');
//
//    $this->view->pageTitle='admin category';
//    $this->view->render();
//
//  }


//
public function delete($id)
{
  $this->model('Category');
  $this->model->delete( array(0 => $id ));
  Message::setMessage('status',1);
  Message::setMessage('main','تم حذف الفئة بنجاح ّ!');
  header('Location:/category/index');

}


//
public function edit($id)
{
  // check if there submit
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postErr=0;


  //do validation to POST

   $validate=Validation::required(['','title']);



    # add new record to the database

    if ($validate['status'] == 1)
    {
  # prepare the array of post to send it to News model to insert to news table


 $category= array(':title' => htmlentities($_REQUEST['title']),':id'=>$id);



    $this->model('Category');
    if ($this->model->update($category)) {
      Message::setMessage('msgState',1);
      Message::setMessage('main',' تم تحديث الفئة بنجاح');
    }
}

}


$category=isset($this->model)?$this->model: $this->model('Category');


$this->view('admin'.DIRECTORY_SEPARATOR.'editCategory',['categories'=>$category->find( array(0 =>$id))]);
$this->view->pageTitle='this page of index';

$this->view->render();}

}
 ?>
