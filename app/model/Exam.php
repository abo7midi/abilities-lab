<?php
/**
 *
 */

class Exam
{
    protected  $data_file;
    protected $db;


    function __construct()
    {
        $this->db=new Model();
    }
//
    public function all()
    {
        return $this->db->query("select * from exams");
    }

    public  function  allExamAdmin(){
        return $this->db->query("select
                                          exams.`exam_id`,`exam_name`,`exam_description`,`exam_level`,
                                          `exam_q_num`,`exam_duration`,`exam_price`,`exam_paid`,`exam_total_mark`,exam_state, categories.cat_name
                                                 FROM 
                                                   exams 
                                                   INNER JOIN 
                                                     categories on exams.cat_id = categories.cat_id");

    }

    public function getSpecificExam(array $Data){
        $oStmt = $this->db->preparation("select * from exams where exam_id=?");
        $oStmt->execute($Data);
        return $oStmt->fetchAll();
    }

//

    public function add(array $aData)
    {

        $oStmt = $this->db->preparation('insert into exams values(?,?,?,?,?,?,?,?,?,?,?,?,?,now())');

        return $oStmt->execute($aData);

    }

    /************************************************************************/
    public function addUserExam(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO user_exam( user_id , exam_id , user_exam_state , user_exam_date , user_exam_result , user_exam_finish_time,sample_id) VALUES (?,?,1,now(),?,now(),?)');

        return $oStmt->execute($aData);

    }


    public function delete($id)
    {
        $oStmt = $this->db->preparation('DELETE FROM categories WHERE id=?');

        return $oStmt->execute($id);
    }


    //

    public function update($aData)
    {
        $oStmt = $this->db->preparation('UPDATE  categories
                                          SET   cat_title=:title
                                          WHERE id=:id ');
        return $oStmt->execute($aData);

    }

    //

    public function find($aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM categories WHERE id =?');
        $oStmt->execute($aData);
        return $oStmt->fetch();

    }

    public function getExaminer_exams($u_id){
        $Stmt = $this->db->preparation("select e.* ,COUNT(s.sample_id) sampleNo from exams e INNER join samples s using (exam_id) group by e.exam_id  having user_id=? ");
        $Stmt->execute($u_id);
        return $Stmt->fetchAll();


    }
    public function getExamDetails($s_id){
        $Stmt = $this->db->preparation("select user_exam.user_id as e_u_id,user_exam.exam_id as exam_id,user_exam_date,users.full_name as full_name,user_exam_result as degrees
                                            from user_exam left join users on users.user_id=user_exam.user_id  where user_exam.sample_id=? 
                                             GROUP BY user_exam.user_id ORDER BY degrees DESC");

        $Stmt->execute($s_id);
        return $Stmt->fetchAll();


    }

    public function activateExam(array $aData)
    {
        $oStmt = $this->db->preparation('update  exams set exam_state =:exam_state WHERE exam_id=:exam_id');
        return $oStmt->execute($aData);

    }



    public function dismit_exam($e_id)
    {
        $oStmt = $this->db->preparation('UPDATE exams SET exam_state =0 WHERE exam_id=?');

        return $oStmt->execute($e_id);
    }

    public function get_certification($data)
    {
        $Stmt = $this->db->preparation('select *,exams.user_id as exam_user_id,user_exam.user_id as e_u_id,user_exam.exam_id as exam_id,user_exam_date,users.full_name as full_name,user_exam_result as degrees from user_exam left join users on users.user_id=user_exam.user_id join exams on exams.exam_id=user_exam.exam_id where user_exam.sample_id=? and user_exam.user_id=? ORDER BY user_exam_id DESC LIMIT 1');

        $Stmt->execute($data);
        return $Stmt->fetchAll();

    }

    public function get_examiner($user_id)
    {
        $Stmt = $this->db->preparation('select * from users where user_id=?');

        $Stmt->execute($user_id);
        return $Stmt->fetchAll();

    }

    public function top_members()
    {
        $Stmt = $this->db->preparation('select SUM(t1.user_exam_result) as degrees , user_name , t1.user_id,count(*) rows 
                                            from user_exam t1 left join users on users.user_id=t1.user_id 
                                            WHERE t1.user_exam_date = (SELECT MAX(t2.user_exam_date)
                                            FROM user_exam t2
                                            WHERE t2.user_id = t1.user_id and t2.sample_id=t1.sample_id)
                                            GROUP BY t1.user_id ORDER BY degrees DESC ');

        $Stmt->execute();
        return $Stmt->fetchAll();

    }

    public function top_members_one_exam($exam_id)
    {


        $Stmt = $this->db->preparation('SELECT t1.*,user_exam_result as degrees ,t1.user_id,user_name
                                            FROM user_exam t1 left join users on users.user_id=t1.user_id
                                            WHERE t1.user_exam_date = (SELECT MAX(t2.user_exam_date)
                                            FROM user_exam t2
                                            WHERE t2.user_id = t1.user_id) and t1.exam_id=? GROUP BY t1.user_id ORDER BY degrees DESC  ');

        $Stmt->execute($exam_id);
        return $Stmt->fetchAll();
    }
    public function activeExamner($aData)
    {
        $oStmt = $this->db->preparation('UPDATE exams set exam_state=1 where exam_id=? ');
        return $oStmt->execute($aData);

    }
    public function nonActiveExamner($aData)
    {
        $oStmt = $this->db->preparation('UPDATE exams set exam_state=0 where exam_id=? ');
        return $oStmt->execute($aData);

    }

    public function get_exams($cat_id)
    {
        $Stmt = $this->db->preparation('select * from exams where cat_id=? or exam_id=? and exam_state=1');
        $Stmt->execute($cat_id);
        return $Stmt->fetchAll();

    }

    public function student_profile($u_id)
    {
        $Stmt = $this->db->preparation('select * from users where user_id=?');

        $Stmt->execute($u_id);
        return $Stmt->fetchAll();

    }


    public function search_exams($examName)
    {
        $Stmt = $this->db->preparation('select exam_name,exam_id from exams where exam_name like ? and exam_state=1');
        $Stmt->execute($examName);
        return $Stmt->fetchAll();

    }

}
?>
