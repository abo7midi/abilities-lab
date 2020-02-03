<?php


class sampleController extends Controller
{

    public function add($sampleName)
    {
            $sample_name=$sampleName;
            $sample_state=1;
            $exam_id =  $_SESSION['exam_id'];
            $t_mark =  $_SESSION['total_mark'];
            $_SESSION['sample_id'] = $s_id = uniqid();
            $sample = [
                $s_id,
                $sample_name,
                $sample_state,
                $exam_id
            ];

            $this->model('Sample');
            if ($this->model->add($sample)) {
                Message::setMessage(1,'main',' تم اضفة الفئة بنجاح');
            }

        header("location:/question/add");

    }

    public function delete($id)
    {
        $this->model('Category');
        $this->model->delete( array(0 => $id ));
        Message::setMessage('status',1);
        Message::setMessage('main','تم حذف الفئة بنجاح ّ!');
        header('Location:/category/index');

    }

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