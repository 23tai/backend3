<?php

namespace App\MyClasses;

use App\User;



class TalkList
{

  public function getOpponentIds($talk_lists, $myId)
  {
    // 引数のtalk_listsレコード達から相手のidだけを抜き取って配列にしてreturnする
    $opponent_ids = array();
    foreach ($talk_lists as $talk_list) {
      if ($talk_list->to != $myId) {
        $opponent_ids[] = $talk_list->to;
      }
      if ($talk_list->from != $myId) {
        $opponent_ids[] = $talk_list->from;
      }
    }

    return $opponent_ids;
  }


  public function getTalkListAccounts($opponent_ids)
  {
    $talk_lists_accounts = array();
    foreach ($opponent_ids as $id) {
      $talk_lists_accounts[] = User::find($id);
    }

    return $talk_lists_accounts;
  }


  public function changeYetColumnsTrue($talkDatas)
  {
    foreach ($talkDatas as $talkData) {
      $talkData->yet = true;
      $talkData->save();
    }
  }



}
