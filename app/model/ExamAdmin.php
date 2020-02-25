<?php
/**
 *
 */

class ExamAdmin
{
    protected  $data_file;
    protected $db;
    protected $inventory=[ ];

    function __construct()
    {
        $this->db=new Model();
    }

    public function all()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1");
    }

// return all row of table of users
    public function showexam()
    {
        return $this->db->query("SELECT categories.cat_name,users.user_name,exams.exam_name,exam_id,exam_state, 	create_Date_exam
                                             from categories
                                              INNER JOIN exams on exams.cat_id=categories.cat_id 
                                              INNER JOIN users on users.user_id=exams.user_id 
                                              WHERE users.group_id=2     ");
    }



    public function ExamActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE exams set exam_state=1 where exam_id=? ');
        return $oStmt->execute($aData);

    }
    public function ExamdisActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE exams set exam_state=0 where exam_id=? ');
        return $oStmt->execute($aData);

    }

    public function find($aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM exams WHERE exam_id =?');
        $oStmt->execute($aData);
        return $oStmt->fetch();

    }


    public  function ResultUser(){
        return $this->db->query('SELECT groups.group_name,user_exam.user_id ,user_exam_id,user_exam.exam_id,user_exam.user_exam_result
                                                ,users.user_name ,exams.exam_name,exams.exam_total_mark,exams.exam_pass_mark ,user_exam_date ,user_exam_finish_time 
                                                FROM `groups`
                                                 INNER JOIN users on users.group_id = groups.group_id
                                                  INNER JOIN user_exam on user_exam.user_id =users.user_id 
                                                  INNER JOIN exams on exams.exam_id=user_exam.exam_id 
                                                  WHERE groups.group_id=3 ');
    }
}


?>
