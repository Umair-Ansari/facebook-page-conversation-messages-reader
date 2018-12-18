<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:05 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\MessageRepo.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Message.php";
class MessageService
{
    public function createMessage($message){
        $messageRepo = new MessageRepo();
        $messageRepo->createMessage($message);
    }
}