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
                 function checkcat($cn)
                {
                    $oStmt = DB::init()->preparation("select cat_name from categories WHERE cat_name = ? ");
                    $oStmt->execute([$cn]);
                    $r=$oStmt->fetchAll();

                    if (sizeof( $r)>0) {
                        return true;
                    } else {
                        return false;
                    }
                }

                if (checkcat($_POST["name"]) == true) {
                    echo '<div class="container-fluid">';
                    echo "This Is Existing";
                    echo '</div>';

                } else {
                    $name = $_POST['name'];
                    $desc = $_POST['description'];
                    $c = $_POST['cat'];

                    $category = [
                        $name,
                        $desc,
                        $c
                    ];

                    $this->model('Category');
                    if ($this->model->add($category)) {
                        Message::setMessage('msgState', 1, '');
                        Message::setMessage('', 'main', ' تم اضفة الفئة بنجاح');
                    }
                }
            }
        }
//        $this->view('admin'.DIRECTORY_SEPARATOR.'addCategory');
        $this->model('Category');
        $this->view('admin'.DIRECTORY_SEPARATOR.'addCategory',['categories'=>$this->model->allSubCate()]);


        $this->view->pageTitle='admin category';
        $this->view->render();

    }

public function delete($id)
{
  $this->model('Category');
  $this->model->delete( array(0 => $id ));
  Message::setMessage('status',1,'');
  Message::setMessage('','main','تم حذف الفئة بنجاح ّ!');
  header('Location:/category/index');

}


//
public function edit($id)
{
  // check if there submit
  if ($_SERVER["REQUEST_METHOD"] == "POST") {


  //do validation to POST

   $validate=Validation::required(['','name']);

    # add new record to the database

    if ($validate['status'] == 1)
    {

        $category= [
            ':name' => $_POST['name'],
            ':description' => $_POST['description'],
            ':cat' => $_POST['cat'],
            ':id'=>$id
        ];



    $this->model('Category');
    if ($this->model->update($category)) {
      Message::setMessage('msgState',1,'');
      Message::setMessage('','main',' تم تحديث الفئة بنجاح');
    }
}

}


$category=isset($this->model)?$this->model: $this->model('Category');


$this->view('admin'.DIRECTORY_SEPARATOR.'editCategory',['categories'=>$category->find( array(0 =>$id)),'cats'=>$this->model->allSubCate(),'catJoins'=>$this->model->selfjoin()]);

$this->view->pageTitle='this page of index';

$this->view->render();}



   public function active($id)
    {
        $this->model('Category');
        $this->model->updateActive( array(0 => $id ));
        Message::setMessage('status',1,'');
        Message::setMessage('','main','الحساب بنجاحّ!');
        header('Location:/category');

    }

    public function nonactive($id)
    {
        $this->model('Category');
        $this->model->updatedisActive( array(0 => $id ));
        Message::setMessage('status',1,'');
        Message::setMessage('','main','تقفلّ الحساب!');
        header('Location:/category');

    }
}
 ?>
