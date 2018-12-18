<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:08 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\Database.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\User.php";
class UserRepo
{
    public function createUser($user){
        $database = new Database();

        $sql = 'INSERT INTO `fbinbox_user`( `user_id`, `email`, `name`) VALUES ("'.$user->getUserId().'","'.$user->getEmail().'","'.$user->getName().'")';
        mysqli_query($database->get_connection(), $sql);

        $database->close_connection();


    }

    public function getUser($user_id){
        $database = new Database();

        $user = new User();
        $sql = 'SELECT * FROM fbinbox_user WHERE user_id="'.$user_id.'"';
        $query = mysqli_query($database->get_connection(), $sql);
        while ($row = mysqli_fetch_array($query)) {

            $user->setRow($row);
        }

        $database->close_connection();
        return $user;

    }

}