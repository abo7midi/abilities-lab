<?php


class questionController extends Controller
{

    public function index()
    {
        $this->model('Question');
        $this->view('home' . DIRECTORY_SEPARATOR . 'addQuestion', ['question' => $this->model->all()]);
        $this->view->pageTitle = 'admin question';
        $this->view->render();

    }


    public function add()
    {
        $sample = new sampleController();

        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sample_id = $_SESSION['sample_id'];
            $this->model('question');
            $total_degree = 0;
            for ($i = 1; $i <= $_SESSION['number_que']; $i++) {
                $validate = \Validation::validate([
                    'qns' . $i => array(['required' => 'required']),
                    'q_degree' . $i => array(['required' => 'required', 'minVal' => 1]),
                    'txt1' . $i => array(['required' => 'required']),
                    'txt2' . $i => array(['required' => 'required']),
                    'txt3' . $i => array(['required' => 'required']),
                    'txt4' . $i => array(['required' => 'required'])
                ]);

//                $validate=Validation::required(["qns$i","q_degree$i",'txt1'.$i,'txt2'.$i,'txt3'.$i,'txt4'.$i,'radio'.$i]);

                # add new record to the database

                if (count($validate) == 0) {
                    $q_degree = $_POST["q_degree$i"];
                    $total_degree += $q_degree;
                }
            }

            if ($total_degree != $_SESSION['total_mark']) {
                Message::setMessage('quez Degree', 'the total degrees of question should equal full mark of exam...', 0);
                header("location:/question/add");
                return '';
            }
            for ($i = 1; $i <= $_SESSION['number_que']; $i++) {
                $qid = uniqid();
                $q_content = $_POST['qns' . $i];
                $q_img = Helper::uploadFile(ROOT . "public/images/examsImg/", $_FILES['q_image' . $i]['name'], $_FILES['q_image' . $i]['tmp_name'], $_FILES['q_image' . $i]['size']);
                $q_degree = $_POST['q_degree' . $i];
                $Q_data = [
                    $qid,
                    $q_content,
                    $q_img,
                    $q_degree,
                    $sample_id
                ];
                $quez = $this->model->addQuez($Q_data);

                $oaid = uniqid();
                $obid = uniqid();
                $ocid = uniqid();
                $odid = uniqid();

                $a = $_POST['txt1' . $i];
                $data1 = [
                    $oaid,
                    $a,
                    '0',
                    $qid
                ];

                $quez = $this->model->addChoice($data1);

                $b = $_POST['txt2' . $i];
                $data2 = [
                    $obid,
                    $b,
                    '0',
                    $qid
                ];

                $quez = $this->model->addChoice($data2);
                $c = $_POST['txt3' . $i];
                $data3 = [

                    $ocid,
                    $c,
                    '0',
                    $qid

                ];

                $quez = $this->model->addChoice($data3);
                $d = $_POST['txt4' . $i];
                $data4 = [

                    $odid,
                    $d,
                    '0',
                    $qid

                ];

                $quez = $this->model->addChoice($data4);

                $e = $_POST['radio' . $i];    /*  يعني الـ id حق الإجابة الصحيحة */  /* = ans*/
                switch ($e) {
                    case 'a':
                        $this->model->correctAnsower([$oaid]);
                        break;
                    case 'b':
                        $this->model->correctAnsower([$obid]);
                        break;
                    case 'c':
                        $this->model->correctAnsower([$ocid]);
                        break;
                    case 'd':
                        $this->model->correctAnsower([$odid]);
                        break;
                    default:
                        $true_ans = '0';
                }
            }
            if ($_POST['save'] == "save") {
                $this->sampleNum = 2;
                header("location:/exam/add");

            } else if ($_POST['NewSample'] == "New Sample") {
                static $sampleNum = 1;
                ++$sampleNum;
                $sample = new sampleController();
                $sample->add($sampleNum);
            }
        }
        $this->view('home' . DIRECTORY_SEPARATOR . 'addQuestion');
        $this->view->pageTitle = 'admin question';
        $this->view->render();

    }


    public function saveQuestion()
    {

        $sample = new sampleController();
        $this->model('question');
        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
//            $sample_id = $_SESSION['sample_id'];
//            $this->model('question');
//            $total_degree = 0;
//            {
//                $validate = \Validation::validate([
//                    'qns' => array(['required' => 'required']),
//                    'q_degree' => array(['required' => 'required', 'minVal' => 1]),
//                    'txt1' => array(['required' => 'required']),
//                    'txt2' => array(['required' => 'required']),
//                    'txt3' => array(['required' => 'required']),
//                    'txt4' => array(['required' => 'required'])
//                ]);
//
////                $validate=Validation::required(["qns$i","q_degree$i",'txt1'.$i,'txt2'.$i,'txt3'.$i,'txt4'.$i,'radio'.$i]);
//
//                # add new record to the database
//
//                if (count($validate) == 0) {
//                    $q_degree = $_POST["q_degree"];
//                    $total_degree += $q_degree;
//                }
//            }
//
//            if ($total_degree != $_SESSION['total_mark']) {
//                Message::setMessage('quez Degree', 'the total degrees of question should equal full mark of exam...', 0);
//                header("location:/question/add");
//                return '';
//            }
            $qid = uniqid();
            $q_content = $_REQUEST['qns'];
//            $q_img = Helper::uploadFile(ROOT . "public/images/examsImg/", $_FILES['q_image' . $i]['name'], $_FILES['q_image' . $i]['tmp_name'], $_FILES['q_image' . $i]['size']);
            $q_img = 'mm';
            $q_degree = $_REQUEST['q_degree'];
            $sample_id = $_REQUEST['exam_id'];
            $Q_data = [
                $qid,
                $q_content,
                $q_img,
                $q_degree,
                $sample_id
            ];
            $quez = $this->model->addQuez($Q_data);

            $oaid = uniqid();
            $obid = uniqid();
            $ocid = uniqid();
            $odid = uniqid();

            $a = $_REQUEST['txt1'];
            $data1 = [
                $oaid,
                $a,
                '0',
                $qid
            ];

            $quez = $this->model->addChoice($data1);

            $b = $_REQUEST['txt2'];
            $data2 = [
                $obid,
                $b,
                '0',
                $qid
            ];

            $quez = $this->model->addChoice($data2);
            $c = $_REQUEST['txt3'];
            $data3 = [
                $ocid,
                $c,
                '0',
                $qid

            ];

            $quez = $this->model->addChoice($data3);
            $d = $_REQUEST['txt4'];
            $data4 = [
                $odid,
                $d,
                '0',
                $qid

            ];

            $quez = $this->model->addChoice($data4);

            $e = $_REQUEST['radio'];    /*  يعني الـ id حق الإجابة الصحيحة */  /* = ans*/
            switch ($e) {
                case 'a':
                    $this->model->correctAnsower([$oaid]);
                    break;
                case 'b':
                    $this->model->correctAnsower([$obid]);
                    break;
                case 'c':
                    $this->model->correctAnsower([$ocid]);
                    break;
                case 'd':
                    $this->model->correctAnsower([$odid]);
                    break;
                default:
                    $true_ans = '0';
            }
            $_SESSION['qns_n'] = ($_REQUEST['qns_n'] + 1);
            if ($_SESSION['number_que'] > $_REQUEST['qns_n'])
                echo $_REQUEST['qns_n'] + 1;
            else
                echo 0;

        }

    }


    public function addNameSample()
    {
        $sample_name = '--';
        $sample_state = 1;
        $exam_id = $_SESSION['exam_id'];
        $t_mark = $_SESSION['total_mark'];
        $_SESSION['sample_id'] = $s_id = uniqid();
        $sample = [
            $s_id,
            $sample_name,
            $sample_state,
            $exam_id
        ];

        $this->model('Sample');
        if ($this->model->add($sample)) {
            $_SESSION['qns_n'] = '1';
            echo $_SESSION['sample_id'];

        }


    }


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
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
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