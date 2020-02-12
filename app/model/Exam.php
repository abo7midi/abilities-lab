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

        $oStmt = $this->db->preparation('insert into exams values(?,?,?,?,?,?,?,?,?,?,?,?,?)');

        return $oStmt->execute($aData);

    }

    /************************************************************************/
    public function addUserExam(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO user_exam( user_id , exam_id , user_exam_state , user_exam_date , user_exam_result , user_exam_finish_time) VALUES (?,?,1,now(),?,now())');

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

}


?>
