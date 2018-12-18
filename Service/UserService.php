<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:05 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\UserRepo.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\User.php";
class UserService
{
    public function createUser($user){
        $userRepo =  new UserRepo();
        $userRepo->createUser($user);
    }

    public function getUser($user){
        $userRepo =  new UserRepo();
        $userResponse = $userRepo->getUser($user->getUserId());
        if($userResponse == null || $userResponse->getUserId() == null){
            $this->createUser($user);
            $userResponse = $userRepo->getUser($user->getUserId());

        }
        return $userResponse;
    }
}