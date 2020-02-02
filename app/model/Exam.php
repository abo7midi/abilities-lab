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

}


?>
