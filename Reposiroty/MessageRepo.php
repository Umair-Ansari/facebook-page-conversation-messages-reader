<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:08 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\Database.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Message.php";
class MessageRepo
{
    public function createMessage($message){

        $database = new Database();

        $sql = 'INSERT INTO `fbinbox_message`(`message`, `created_time`, `to`, `from`,`conversation_id`) VALUES ("'.$message->getMessage().'","'.$message->getCreatedAt().'","'.$message->getTo().'","'.$message->getFrom().'","'.$message->getConversationId().'")';
        mysqli_query($database->get_connection(), $sql);

        $database->close_connection();

    }
}