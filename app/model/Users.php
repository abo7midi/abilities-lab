<?php
/**
 *
 */

class Users
{
    protected  $data_file;
    protected $db;
    protected $inventory=[ ];

    function __construct()
    {
        $this->db=new Model();
    }
// return all row of table of users

    public function all()
    {
        return $this->db->query("select users.*, groups.group_name as groupName from users INNER JOIN groups on users.group_id = groups.group_id WHERE Existing =-1");
    }

//add new row to users table
    public function add(array $aData)
    {

        $oStmt = $this->db->preparation('INSERT INTO  users ( full_name, user_name, user_pwd,user_email,phone,user_entry_date,group_id,image)
                                                       VALUES ( :full_name,:user_name,:user_pass,:user_email,:phone,now(),:group_id,:picture)');

        return $oStmt->execute($aData);

    }
//-----------------------------------------------------start login--------------------------

//  // find user by ID
    public function checkLogin(array $aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE  user_name =:username  AND user_pwd =:password ');
        $oStmt->execute($aData);
        $users = $oStmt->fetchAll();

       // foreach ($users as $user){
            return $users;
        //}

// print_r( $user=$oStmt->fetchAll());
//    if($row['group_id']==1){
//        header("location/");
//    }
//    elseif($row['group_id']==2){
//        header("location/");
//
//    }

//      return $oStmt->rowCount();
    }


//-----------------------------------------------------end login--------------------------


//--------------------------------------start select ----------------------------


    public function getUserById($username){
        $this->db->query('SELECT *  FROM users WHERE user_name = :username  ' );
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        return $row;
    }


//    ------------------------------end select user-------------------------------------------------------
    public function delete($id)
    {
        $oStmt = $this->db->preparation('UPDATE users SET Existing = 0 WHERE user_id = ?');

        return $oStmt->execute($id);
    }


//

    public function update($aData)
    {
        $oStmt = $this->db->preparation('UPDATE `users` SET `full_name`=:fullname,`user_name`=:username,`user_pwd`=:password,`user_email`=:email,
                                            `phone`=:mobile,`group_id`=:type,image=:picture WHERE user_id =:id ');
        return $oStmt->execute($aData);

    }

    public function updateActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE users set user_state=1 where user_id=? ');
        return $oStmt->execute($aData);

    }
    public function updatedisActive($aData)
    {
        $oStmt = $this->db->preparation('UPDATE users set user_state=0 where user_id=? ');
        return $oStmt->execute($aData);

    }
//
////
//
    public function find($aData)
    {
        $oStmt = $this->db->preparation('SELECT * FROM users WHERE user_id =?');
        $oStmt->execute($aData);
        return $oStmt->fetch();

    }


}


?>
