<?php

/**
 *
 */
class examController extends Controller
{

    public function index()
    {
        $this->model('Exam');
        $this->view('admin'.DIRECTORY_SEPARATOR.'exam',['exam'=>$this->model->all()]);

        $this->view->pageTitle='exam';
        $this->view->render();

    }




    public function add()
    {

        $category=$this->model('Category');
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $postErr=0;

            $validate=Validation::required(['name','no_q','total_mark','pass_mark','duration','category','level']);

            # add new record to the database

            if ($validate['status'] == 1)
            {
                if(Validation::logicCheck($_POST['total_mark'],"<",$_POST['pass_mark'],"pass mark field should be less than full mark field")!==false){
                    # prepare the array of post to send it to News model to insert to news table
                    $name =Validation::test_input($_POST['name']);
                    $name = ucwords(strtolower($name));
                    $_SESSION['total_mark'] =  $total_mark =Validation::test_input($_POST['total_mark']);
                    $pass_mark = Validation::test_input($_POST['pass_mark']);
                    $_SESSION['number_que'] = $no_q = Validation::test_input($_POST['no_q']);
                    $duration = Validation::test_input($_POST['duration']);
                    $category = Validation::test_input($_POST['category']);
                    $level = Validation::test_input($_POST['level']);
                    $desc = Validation::test_input($_POST['desc']);
                    $price = Validation::test_input($_POST['price']);
                    $_SESSION['exam_id'] = $id = uniqid();

                    switch($level)
                    {
                        case 'h':
                            $lv ='1';
                            break;
                        case 'm':
                            $lv ='2';
                            break;
                        case 'e':
                            $lv ='3';
                            break;

                        default:
                            $lv ='';
                    }

                    if (!$price==''){
                        $paid='1';

                    }else{
                        $paid='0';
                    }

                    $exam= $data = [
                        $id,
                        $name,
                        $desc,
                        $lv,
                        $no_q,
                        $duration,
                        $price,
                        $paid,
                        "0",
                        Session::get("userID"),
                        $total_mark,
                        $pass_mark,
                        $category
                    ];
                    $this->model('Exam');
                    if ($this->model->add($exam)) {
                        Message::setMessage(1,'main',' تم اضفة الفئة بنجاح');
                    }
                    $sample=new sampleController();
                    $sample->add(1);
                }
            }
        }
        $this->view('admin'.DIRECTORY_SEPARATOR.'addExam',["category"=>$category->allSubCate()]);
        $this->view->pageTitle='exam';
        $this->view->render();
    }

/**********************************     take Exam    ******************************/
    public function takeExam($Examid)
    {
        $ifSubmit=0;
        $exam=$this->model('Exam');
        $sample=$this->model('Sample');
        $Q=$this->model('Question');
        $oneExam=$exam->getSpecificExam([$Examid]);
        $oneExamTime=$exam->getSpecificExam([$Examid])[0]['exam_duration'];
        $samples=$sample->getExamSamples([$Examid]);
        $oneSample=array_rand($samples);
        $Questions=$Q->getQofSample([$samples[$oneSample]['sample_id']]);
        $stateChoice=0;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['endExam'])){
                    $st_degree=0;
                    for($i=0;$i<$_POST['q_num'];$i++){
                        if (isset($_POST["q_".$i])){
                            $Q->addUserChoice([1,$_POST["q_".$i]]);   //user id / choice id
                            if($_POST["q_".$i]===$Q->True_choices($_POST["q_id".$i])[0]['choice_id']){
                                $st_degree+=$Q->Q_($_POST["q_id".$i])[0]['q_degree'];
                                Message::setMessage(1,'trueChoice'.$i,'Greate..True ansower');
                            }
                            else
                                Message::setMessage(0,'falseChoice'.$i ,'Ooh..Wrong ansower');
                        }else{
                            Message::setMessage(0,"q_".$i,"you should choose once of these choices");
                            $stateChoice=1;
                        }
                    }
                    if($stateChoice==1){
                        $this->view('admin'.DIRECTORY_SEPARATOR.'takeExam',["q"=>$Questions,"choice"=>Helper::getChoicesOfQuestions($Questions),"duration"=>$oneExamTime,"ifSubmit"=>$ifSubmit]);
                        $this->view->pageTitle='take Exam';
                        $this->view->render();
                        return '';
                    }
                    if($st_degree>=$exam->getSpecificExam([$Examid])[0]['exam_pass_mark'] && $st_degree < $exam->getSpecificExam([$Examid])[0]['exam_total_mark'] || $st_degree == $exam->getSpecificExam([$Examid])[0]['exam_total_mark']){

                        Message::setMessage(1,'trueExam','Congradulations...! You pass this exam');
                        Message::setMessage(1,'examDegreeT','Your Mark : '.$st_degree." /".$exam->getSpecificExam([$Examid])[0]['exam_total_mark']);

                    }else{

                        Message::setMessage(0,'falseExam','Try again...! You faild in this exam');
                        Message::setMessage(0,'examDegreeF','Your Mark : '.$st_degree." /".$exam->getSpecificExam([$Examid])[0]['exam_total_mark']);
                    }
                    $exam->addUserExam([Session::get("userID"),$Examid,$st_degree]);
                    $ifSubmit=1;
                }
                else if(isset($_POST['goback'])){
                    header("location:/home/index");
                }
            }
        $this->view('admin'.DIRECTORY_SEPARATOR.'takeExam',["q"=>$Questions,"choice"=>Helper::getChoicesOfQuestions($Questions),"duration"=>$oneExamTime,"ifSubmit"=>$ifSubmit]);
        $this->view->pageTitle='take Exam';
        $this->view->render();
    }
/***************************************************************************************/


/************************************************************************************/
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
        $this->view->render();
    }
}
?>
