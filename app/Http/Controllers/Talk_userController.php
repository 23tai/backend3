<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Talk_list;
use App\Talk;
use App\Facades\IdentifyId;
use App\Facades\TalkList;

use App\Repositories\User\Interfaces\UserDataRepositoryInterface;
use App\Services\User\Interfaces\UserDataServiceInterface;
use App\Services\Talk_list\Interfaces\TalkListDataServiceInterface;



class Talk_userController extends Controller
{
    private $UserDataRepository;
    private $UserDataService;
    private $TalkListDataService;


    public function __construct(UserDataRepositoryInterface $UserDataRepository, UserDataServiceInterface $UserDataService, TalkListDataServiceInterface $TalkListDataService)
    {
        $this->UserDataRepository = $UserDataRepository;
        $this->UserDataService = $UserDataService;
        $this->TalkListDataService = $TalkListDataService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 前提としてこのtalkにはトークをした事がある人だけを入れる
        $myId = $this->UserDataRepository->getAuthUserId();

        //  相手のuserを取ってきてアカウントのオブジェクトの配列を作る 順番大事！
        $talk_lists_accounts = $this->TalkListDataService->getTalkListAccounts($myId);

        return view('myService.talk')->with([
            'talk_lists_accounts' => $talk_lists_accounts,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        $identify_id = $request->identify_id;
        $his_id = $user->id;

        // どの人の詳細を表示させるかをuser_idで受け取ってその人をフォローしているかをbooleanで取得
        $follow_check = $this->UserDataService->AuthUserFollowCheck($his_id);

        // どの人の詳細を表示させるかをuser_idで受け取ってその人のアカウントを取得
        $his_account = $this->UserDataRepository->getHisAccount($his_id);

        // つまりここから出るidentify_idは全て talk_〇〇 になる。。それがtalk_から来ましたよって事になる。
        if (!IdentifyId::talkList($identify_id)) {
            $identify_id = 'talk_' . $identify_id;
        }

        // find系列だったら(era_id)($team_id)を渡す
        // 尚detailsのみこのtalk_findとかがある
        if (IdentifyId::find($identify_id) || IdentifyId::talkFind($identify_id)) {
            return view('myService.details')->with([
                'identify_id' => $identify_id,
                'hisAccount' => $his_account,
                'follow_check' => $follow_check,
                'era_id' => $request->era_id,
                'team_string' => $request->team_string,
            ]);
        }

        return view('myService.details')->with([
            'identify_id' => $identify_id,
            'hisAccount' => $his_account,
            'follow_check' => $follow_check,
        ]);
    }
}
