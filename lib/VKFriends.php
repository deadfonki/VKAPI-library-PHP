<?php
namespace VkAPI;
/**
 * Created by PhpStorm.
 * User: deadf
 * Date: 26.12.2016
 * Time: 14:09
 */
class VKFriends
{

    public function getFriends($id)//Возвращает ид всех друзей указанного пользователя
    {
        $params = require('/config/config.php');
        $u = 'https://api.vk.com/method/friends.get?user_id='.$id;
        $result = file_get_contents($u);
        return  $friends = json_decode($result);
    }

    public function areFriends($ids,$user_id)//возвращает 1 если пользователи друзья
    {
        $params = require('/config/config.php');
        $u = 'https://api.vk.com/method/friends.areFriends?access_token='.$params['access_token'].'&user_id='.$user_id.'&user_ids='.$ids;
        $result = file_get_contents($u);
        $status = json_decode($result);
        $status = $status->response;
        $status = $status[0]->friend_status;
       if($status == 0)
       {
           return 'Указанные пользователи не являются друзьями';
       }
       else
       {
           return 'Указанные пользователи друзья';
       }
    }


    public function getOnline($uid,$online_mob)//Возвращает массив  онлайн друзей
{
    $params = require('/config/config.php');
    $u = 'https://api.vk.com/method/friends.getOnline?access_token='.$params['access_token'].'&user_id='.$uid.'&online_mobile='.$online_mob;
    $result = file_get_contents($u);
    $friends = json_decode($result);
    $friends_mob =$friends->response->online_mobile;
    $friends = $friends->response->online;

    return array_merge($friends,$friends_mob);
}

}