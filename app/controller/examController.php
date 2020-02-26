<?php

/**
 *
 */
class examController extends Controller
{
    public function index()
    {
        $this->model('Exam');
        $this->view('home' . DIRECTORY_SEPARATOR . 'exam', ['exam' => $this->model->all()]);
        $this->view->pageTitle = 'Exam';
        $this->view->render();
    }
/**/
    public function endExam()
    {
        $_SESSION['qns_n']=1;
        header("location:/exam/details");
    }

    public function exama()
    {
        $this->model('Exam');
        $this->view('admin' . DIRECTORY_SEPARATOR . 'exams', ['examsAdmin' => $this->model->allExamAdmin()]);
        $this->view->pageTitle = 'exam';
        $this->view->render();
    }

    public function add()
    {
        if (!(Session::get("userGroup") == 2)) {
            header("location:/home/index");
        }
        $category = $this->model('Category');

        // check if there submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['qns_n']=1;           // for counter Questions
            $validate = \Validation::validate([
                'name' => array(['required' => 'required']),
                'question_no' => array(['required' => 'required', 'minVal' => 1, "maxVal" => 100]),
                'total_mark' => array(['required' => 'required', 'minVal' => 1]),
                'pass_mark' => array(['required' => 'required', 'minVal' => 1, 'maxVal' => $_REQUEST['total_mark']]),
                'duration' => array(['required' => 'required', 'minVal' => 1, 'maxVal' => 300]),
                'price' => array(['minVal' => 0, 'maxVal' => 1000]),
            ]);

            $sample = new sampleController();

            # add new record to the database
            if (count($validate) == 0) {
                $_SESSION['name']="ali";
                 $_SESSION['number_que'] = $no_q = $_POST['question_no'];
               // echo "mokhtar ".count($validate);



                # prepare the array of post to send it to News model to insert to news table
                $name = Validation::test_input($_POST['name']);
                $name = ucwords(strtolower($name));
                $_SESSION['total_mark'] = $total_mark = Validation::test_input($_POST['total_mark']);
                $pass_mark = Validation::test_input($_POST['pass_mark']);
              //  echo "abc : ". $_POST['question_no'];

                $duration = Validation::test_input($_POST['duration']);
                $category = Validation::test_input($_POST['category']);
                $level = Validation::test_input($_POST['level']);
                $desc = Validation::test_input($_POST['desc']);
                $price = Validation::test_input($_POST['price']);
                $_SESSION['exam_id'] = $id = uniqid();

                $sample->add(1);
                switch ($level) {
                    case 'h':
                        $lv = '1';
                        break;
                    case 'm':
                        $lv = '2';
                        break;
                    case 'e':
                        $lv = '3';
                        break;

                    default:
                        $lv = '';
                }
                if (!$price == '') {
                    $paid = '1';
                } else {
                    $paid = '0';
                }
                $exam = $data = [
                    $id,
                    $name,
                    $desc,
                    $lv,
                    5,
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
                    Message::setMessage(1, 'main', ' تم اضفة الفئة بنجاح');

                    $this->view('home' . DIRECTORY_SEPARATOR . 'addQuestion');
                    $this->view->pageTitle = 'Questions';
                    $this->view->render();
                    return "";
                }
            }
        }


        $this->view('home' . DIRECTORY_SEPARATOR . 'addExam', ["category" => $category->allSubCate()]);
        $this->view->pageTitle = 'Exams';
        $this->view->render();
    }

    /**********************************     take Exam    ******************************/
    public function takeExam($Examid)
    {

        if (!(Session::get("userGroup") == 3)) {
            Message::setMessage("unauth","you should be login as a student",0);

            header("location:/home/index");
        }
        $exam = $this->model('Exam');
        $sample = $this->model('Sample');
        $Q = $this->model('Question');
        $oneExam = $exam->getSpecificExam([$Examid]);
        $oneExamTime = $exam->getSpecificExam([$Examid])[0]['exam_duration'];
        $oneExamID = $exam->getSpecificExam([$Examid])[0]['exam_id'];
        $samples = $sample->getUserExamSamples([$Examid,Session::get("userID"),$Examid]);
        if(empty($samples)){
            Message::setMessage("No Exam","you examed all chances of this exam before...",0);
            header("location:/home/index");

        }
        $Questions = $Q->getQofSample([$samples[0]['sample_id']]);
        $sample_id = $samples[0]['sample_id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION[$Examid] = "yes";
            $st_degree = 0;
            $trueChoice = 0;
            $falseChoice = 0;
            $emptyChoice = 0;
            for ($i = 0; $i < $_POST['q_num']; $i++) {
                if (isset($_POST["q_" . $i])) {
                    $Q->addUserChoice([1, $_POST["q_" . $i]]);   //user id / choice id
                    if ($_POST["q_" . $i] === $Q->True_choices($_POST["q_id" . $i])[0]['choice_id']) {
                        $st_degree += $Q->Q_($_POST["q_id" . $i])[0]['q_degree'];
                        $trueChoice++;
                        // Message::setMessage(1,'trueChoice'.$i,'Greate..True ansower');
                    } else
                        //Message::setMessage(0,'falseChoice'.$i ,'Ooh..Wrong ansower');
                        $falseChoice++;
                } else {
                    $Q->addUserChoice([1, "no choice"]);   //user id / choice id
                    $emptyChoice++;
                }
            }
            $_SESSION['truechoice'] = $trueChoice;
            $_SESSION['falsechoice'] = $falseChoice;
            $_SESSION['unchoice'] = $emptyChoice;
            $_SESSION['studentdegree'] = $st_degree;
            $_SESSION['QNO'] = $_POST['q_num'];

            if ($st_degree >= $exam->getSpecificExam([$Examid])[0]['exam_pass_mark'] && $st_degree < $exam->getSpecificExam([$Examid])[0]['exam_total_mark'] || $st_degree == $exam->getSpecificExam([$Examid])[0]['exam_total_mark']) {
                $_SESSION['resultWord'] = "Congradulations...! You pass this exam";
                $_SESSION['success'] = true;
            } else {
                $_SESSION['resultWord'] = "Try again...! You faild in this exam";
                $_SESSION['success'] = false;
            }
            $exam->addUserExam([Session::get("userID"), $Examid, $st_degree, $samples[0]['sample_id']]);
            $this->view('home' . DIRECTORY_SEPARATOR . 'showResult', ["user_id" => Session::get('userID'), "sample_id" => $samples[0]['sample_id'], "studentDegree" => $_SESSION['studentdegree'], "trueChoice" => $_SESSION['truechoice'], "falseChoice" => $_SESSION['falsechoice'], "emptyChoice" => $_SESSION['unchoice'], "totalMark" => $exam->getSpecificExam([$Examid])[0]['exam_total_mark'], "numberQ" => $_SESSION['QNO'], "resultWord" => $_SESSION['resultWord'], "examState" => $_SESSION['success']]);
            $this->view->pageTitle = 'exam result';
            $this->view->render();
            return "";
        }
        if (empty($oneExam)) {
            header("location:/home/error");
        } else {
            if (!isset($_SESSION[$Examid])) {
                $this->view('home' . DIRECTORY_SEPARATOR . 'takeExam', ["exam_name"=>$oneExam[0]["exam_name"],"q" => $Questions, "choice" => Helper::getChoicesOfQuestions($Questions), "duration" => $oneExamTime,"exam_id" =>$Examid]);
                $this->view->pageTitle = 'Start Exam';
                $this->view->render();
                return "";
            } else {
                Session::delete($Examid);
                header("location:/home/index");
                return "";
            }
        }
    }
    /***************************************************************************************/



//
    /* details for examiner */
    public function details()
    {

        $exam = $this->model('Exam');
        $sample = $this->model('Sample');
        $u_id = Session::get("userID");
        $ex_exams = $exam->getExaminer_exams([$u_id]);
        $this->view('home'.DIRECTORY_SEPARATOR.'details_for_examiner',["ex_exams"=>$ex_exams]);
        $this->view->pageTitle='Details for examiner';
        $this->view->render();
    }
    public function who_do_exam($s_id){
        $exam=$this->model('Exam');
        $u_exams= $exam->getExamDetails([$s_id]);
        $this->view('home'.DIRECTORY_SEPARATOR.'who_do_exam',["u_exams"=>$u_exams]);
        $this->view->pageTitle='Who Do Exam';
        $this->view->render();
    }

    public function active()
    {

        $data = array(
            ':exam_id' => htmlentities($_REQUEST['id']),
            ':exam_state' => htmlentities(($_REQUEST['status'] == 1) ? 0 : 1),
        );
        $course = $this->model('Exam');
        $status = ($course->activateExam($data));
        echo ($_REQUEST['status'] == 1) ? 0 : 1;
    }

    public function dismit_exam($e_id)
    {
        $exam = $this->model('Exam');
        $e = $exam->dismit_exam([$e_id]);
        header("Location:/exam/details");
    }

    public function get_certification($user_id, $sample_id)
    {

        echo $user_id . "<br>" . $sample_id;
        $exam = $this->model('Exam');

        $cert = $exam->get_certification([$sample_id, $user_id]);

        foreach ($cert as $r) {
            echo '<br>' . $r['exam_user_id'];
            $examiner = $exam->get_examiner([$r['exam_user_id']]);
        }

        $date = strtotime($cert[0]['user_exam_date']);

        ob_start();
        require ROOT . "public/pdfPrint/fpdf.php";

        $pdf = new FPDF("L", "mm", "A4");
        $pdf->AliasNbPages();
        $pdf->addPage("L", "A4", 0);
        $pdf->SetFont("Times");
        $pdf->Image(ROOT . "public/pdfPrint/Certificate.png", 0, 0, 297, 212);

        $pdf->SetXY(148, 100);
        $pdf->SetFont("Arial", "B", 28);
        $pdf->Cell(20, 10, strtoupper($cert[0]['full_name']), 0, 0, "C");

        $pdf->SetXY(68, 152);
        $pdf->SetFont("Arial", "B", 24);
        $pdf->Cell(20, 10, $cert[0]['exam_name'], 0, 0, "C");


        $pdf->SetXY(180, 139);
        $pdf->SetFont("Courier", "B", 16);
        $pdf->SetTextColor(110, 110, 110);
        $pdf->Cell(20, 10, "Mark : ", 0, 0, "C");

        $pdf->SetXY(200, 139);
        $pdf->SetFont("Courier", "B", 16);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 10, $cert[0]['degrees'] . "/" . $cert[0]['exam_total_mark'], 0, 0, "C");

        $pdf->SetTextColor(110, 110, 110);
        $pdf->SetFont("Courier", "", 14);
        $pdf->SetXY(200, 179);
        $pdf->Cell(20, 10, date('Y-M-d', $date), 0, 0, "C");

        $pdf->SetXY(91, 179);
        $pdf->Cell(20, 10, $examiner[0]['user_name'], 0, 0, "C");

        $pdf->Output("I", "certificate.pdf");
        ob_end_flush();
    }

    public function top_members()
    {
        $exam = $this->model('Exam');
        $top = $exam->top_members();

        $this->view('home' . DIRECTORY_SEPARATOR . 'top_members', ["top" => $top]);
        $this->view->pageTitle = 'Top Members';
        $this->view->render();

    }

    public function top_members_one_exam()
    {
        $exma_id=$_REQUEST['exam_id'];
        $exam = $this->model('Exam');
        $top = $exam->top_members_one_exam([$exma_id]);
        echo json_encode($top);

    }

    public function activeExamner($id)
    {
        $this->model('Exam');
        $this->model->activeExamner(array(0 => $id));
        header("Location:/exam/details");
    }

    public function nonactiveExamner($id)
    {
        $this->model('Exam');
        $this->model->nonActiveExamner(array(0 => $id));
        Message::setMessage(1, 'status', 1);
        Message::setMessage(1, 'main', ' No!');
        header('Location:/exam/all');
    }

    public function show_exams($sub_cat_id)
    {
        $exam = $this->model('Exam');
        $exams = $exam->get_exams([$sub_cat_id]);
        $this->view('home' . DIRECTORY_SEPARATOR . 'index', ["exams" => $exams, "form_id" => 3]);
        $this->view->pageTitle = 'Top Members in This Exam';
        $this->view->render();
    }

    public function student_profile(){
        $u_id=$_REQUEST['user_id'];
        $exam = $this->model('Exam');
        $exams = $exam->student_profile([$u_id]);
        echo json_encode($exams);
    }
}

?>
