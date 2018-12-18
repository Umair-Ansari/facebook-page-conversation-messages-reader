<?php
ini_set('max_execution_time', 0);
/**
 * Created by Umair Ansari
 * Date: 12/15/2018
 * Time: 11:32 AM
 */


require_once  'Facebook/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Service\ConversationService.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Conversation.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\User.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Message.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Service\PageService.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Service\UserService.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Service\MessageService.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Service\FacebookService.php";

$fb = new \Facebook\Facebook([
    'app_id' => '',
    'app_secret' => '',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
]);


$pageService =  new PageService();
$messageService = new MessageService();
$conversationArray = array();
$updatedConversationArray = array();
$page = null;
foreach($pageService->get_all_pages() as $page) {

    try {

        $response = $fb->get(
            '/' . $page->getPageId() . '/conversations',
            '' . $page->getAccessToken() . ''
        );
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    $required_next = true;
    $graphEdge = $response->getGraphEdge();
    $updated_time = get_object_vars($graphEdge[0]["updated_time"])["date"];


    // check page user
    $userService = new UserService();
    $user = new User();
    $user->setUserId($page->getPageId());
    $user->setName($page->getPageName());
    $userService->getUser($user);


    $conversationService =new ConversationService();
    foreach ($graphEdge->asArray() as $responseArray) {

        $date = new DateTime(get_object_vars($responseArray["updated_time"])["date"]);
        $pageDate = new DateTime($page->getUpdatedTime());
        if($date > $pageDate){
            $conversation = new Conversation();

            $conversation->setConversationId($responseArray["id"]);
            $conversation->setUpdatedTime(get_object_vars($responseArray["updated_time"])["date"]);
            $conversation->setPageId($page->getId());
            if ($conversationService->isNewConversation($conversation)) {
                $conversationArray[] = $conversation;
            } else {

                $updatedConversationArray[] = $conversation;
            }

        }else{
            $required_next = false;
            $page->setUpdatedTime($updated_time);
            $pageService->updatePageUpdatedTime($page);
            break;
        }

    }

    while($required_next){
        $graphEdge = $fb->next($graphEdge);
        if($graphEdge != null) {
            foreach ($graphEdge->asArray() as $responseArray) {

                $date = new DateTime(get_object_vars($responseArray["updated_time"])["date"]);
                $pageDate = new DateTime($page->getUpdatedTime());
                if ($date > $pageDate) {
                    $conversation = new Conversation();

                    $conversation->setConversationId($responseArray["id"]);
                    $conversation->setUpdatedTime(get_object_vars($responseArray["updated_time"])["date"]);
                    $conversation->setPageId($page->getId());
                    if ($conversationService->isNewConversation($conversation)) {
                        $conversationArray[] = $conversation;
                    } else {
                        $updatedConversationArray[] = $conversation;

                    }

                } else {
                    $required_next = false;
                }

            }
        }else{
            $required_next = false;
        }


    }

    $page->setUpdatedTime($updated_time);
    $pageService->updatePageUpdatedTime($page);
}

$facebookService = new FacebookService();
foreach ($conversationArray as $conversation){
    $facebookService->getConversation($conversation, $page, $userService, $messageService,$fb, $conversationService);

}
foreach ($updatedConversationArray as $conversation){

    $facebookService->getUpdatedConversations($conversation, $page, $userService, $messageService,$fb, $conversationService);
}


