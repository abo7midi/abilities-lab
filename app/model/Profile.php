<?php


class Profile
{
    protected  $data_file;
    protected $db;
    protected $inventory=[ ];

    function __construct()
    {
        $this->db=new Model();
    }
// return all row of table of users
    public function all($id)
    {
//

        return $this->db->query("select  users.user_id,full_name,user_name,phone,user_email,image ,exams.exam_pass_mark,exam_name  
                     from exams RIGHT JOIN users on exams.user_id= users.user_id WHERE users.user_id=$id ");
    }


    public function updateProfile($aData)
    {

        $oStmt = $this->db->preparation('UPDATE `users` SET `full_name`=:fullname,`user_pwd`=:password,`user_email`=:email,`phone`=:mobile,image=:picture WHERE user_id=:id
');
      return $oStmt->execute($aData);

    }
    public function find($aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE user_id =?');
        $oStmt->execute($aData);
        return $oStmt->fetch();

    }

    /*Examiner Profile*/

    public function examiner_profile($u_id){
        $oStmt = $this->db->preparation("select *,COUNT(*) No_exam ,exams.user_id,users.user_id from users left join exams on users.user_id=exams.user_id WHERE users.user_id=? GROUP BY users.full_name");
        $oStmt->execute($u_id);
        return $oStmt->fetchAll();
    }

}