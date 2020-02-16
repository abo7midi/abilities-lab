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

        return $this->db->query("select  users.user_id,full_name as fullname,phone as mobile,user_email as email ,image as pacture,exams.exam_pass_mark as degree 
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

}