<?php
/**
 * Created by Umair Ansari
 * Date: 12/17/2018
 * Time: 4:31 PM
 */

class FacebookService
{
    function getConversation($conversation, $page, $userService, $messageService,$fb, $conversationService){

        try {
            $response = $fb->get('/' . $conversation->getConversationId().'?fields=messages{message,created_time,id,from,to}',
                '' . $page->getAccessToken() . '');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $graphEdge = $response->getGraphNode();

        $decodedObject = json_decode($response->getBody(), true)["messages"];
        $conversationId = $conversationService->getConversationId($conversation);

        if($decodedObject["data"][0]["from"]["id"] != $page->getPageId()) {
            $fromUser = new User();
            $fromUser->setName($decodedObject["data"][0]["from"]["name"]);
            $fromUser->setEmail($decodedObject["data"][0]["from"]["email"]);
            $fromUser->setUserId($decodedObject["data"][0]["from"]["id"]);
            $userService->createUser($fromUser);

        }
        else {
            $toUser = new User();
            $toUser->setName($decodedObject["data"][0]["to"]["data"][0]["name"]);
            $toUser->setEmail($decodedObject["data"][0]["to"]["data"][0]["email"]);
            $toUser->setUserId($decodedObject["data"][0]["to"]["data"][0]["id"]);
            $userService->createUser($toUser);
        }



        foreach (json_decode($response->getBody(), true)["messages"]["data"] as $date){
            $message = new Message();

            $toUser = new User();
            $toUser->setUserId($date["to"]["data"][0]["id"]);
            $message->setTo($userService->getUser($toUser)->getId());
            $fromUser = new User();
            $fromUser->setUserId($date["from"]["id"]);
            $message->setFrom($userService->getUser($fromUser)->getId());
            $message->setMessage($date["message"]);
            $message->setCreatedAt($date["created_time"]);
            $message->setConversationId($conversationId);
            $messageService->createMessage($message);

        }
        while(isset($decodedObject["paging"]["next"]) ){
            $url = str_replace("https://graph.facebook.com/v3.2/","",$decodedObject["paging"]["next"]);
            try {
                $response = $fb->get($url);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $decodedObject = json_decode($response->getBody(), true);

            foreach (json_decode($response->getBody(), true)["data"] as $date){
                $message = new Message();

                $toUser = new User();
                $toUser->setUserId($date["to"]["data"][0]["id"]);
                $message->setTo($userService->getUser($toUser)->getId());
                $fromUser = new User();
                $fromUser->setUserId($date["from"]["id"]);
                $message->setFrom($userService->getUser($fromUser)->getId());
                $message->setMessage($date["message"]);
                $message->setCreatedAt($date["created_time"]);
                $message->setConversationId($conversationId);
                $messageService->createMessage($message);

            }
        }

    }
    function getUpdatedConversations($conversation, $page, $userService, $messageService,$fb,$conversationService){
        $isFound = false;
        try {
            $response = $fb->get('/' . $conversation->getConversationId().'?fields=messages{message,created_time,id,from,to}',
                '' . $page->getAccessToken() . '');
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $decodedObject = json_decode($response->getBody(), true)["messages"];

        $conversationResponse = $conversationService->getConversation($conversation);
        $updateTime = json_decode($response->getBody(), true)["messages"]["data"][0]["created_time"];
        $updateTime = str_replace("T"," ",$updateTime);
        $updateTime = str_replace("+",".",$updateTime);
        $updateTime .= "00";

        $reverted = new ArrayIterator(json_decode($response->getBody(), true)["messages"]["data"]);
        foreach ($reverted as $date){
            $created_time = str_replace("T"," ",$date["created_time"]);
            $created_time = str_replace("+",".",$created_time);
            $created_time .= "00";
            if($created_time == $conversationResponse->getUpdatedTime()){
                $isFound = true;
                break;

            }

            $message = new Message();

            $toUser = new User();
            $toUser->setUserId($date["to"]["data"][0]["id"]);
            $message->setTo($userService->getUser($toUser)->getId());
            $fromUser = new User();
            $fromUser->setUserId($date["from"]["id"]);
            $message->setFrom($userService->getUser($fromUser)->getId());
            $message->setMessage($date["message"]);
            $message->setCreatedAt($date["created_time"]);
            $message->setConversationId($conversationResponse->getId());

            $messageService->createMessage($message);

        }
        while(isset($decodedObject["paging"]["next"]) && !$isFound){

            $url = str_replace("https://graph.facebook.com/v3.2/","",$decodedObject["paging"]["next"]);
            try {
                $response = $fb->get($url);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $decodedObject = json_decode($response->getBody(), true);
            $reverted = new ArrayIterator(json_decode($response->getBody(), true)["data"]);
            foreach ($reverted as $date){
                $created_time = str_replace("T"," ",$date["created_time"]);
                $created_time = str_replace("+",".",$created_time);
                $created_time .= "00";
                if($created_time == $conversationResponse->getUpdatedTime()){
                    break;
                }

                $message = new Message();

                $toUser = new User();
                $toUser->setUserId($date["to"]["data"][0]["id"]);
                $message->setTo($userService->getUser($toUser)->getId());
                $fromUser = new User();
                $fromUser->setUserId($date["from"]["id"]);
                $message->setFrom($userService->getUser($fromUser)->getId());
                $message->setMessage($date["message"]);
                $message->setCreatedAt($date["created_time"]);
                $message->setConversationId($conversationResponse->getId());

                $messageService->createMessage($message);

            }
        }

        $conversationResponse->setUpdatedTime($updateTime);
        $conversationService->updateConversationTime($conversationResponse);
    }
}