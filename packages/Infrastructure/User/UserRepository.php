<?php

namespace packages\Infrastructure\User;


// use Illuminate\Support\Facades\DB;
use packages\Domain\Domain\User\User;
// use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserRepositoryInterface
{
    // /**
    //  * @param User $user
    //  * @return mixed
    //  */
    // public function save(User $user)
    // {
    //     // なんでここでDBから取得しているのか、エロクエントを使わずに(getじゃなくてsaveだったら取得する値とかあまり考える必要が無いからエロークエントでもいいのではと思ってしまう)
    //     // 　　　　Illuminate\Database\Eloquent\Collectionはエロークエントで取得したやつ
    //     // 　　　　　　　↑　テーブルをPHPのクラス　レコードをクラスのインスタンス　フィールドをプロパティとして扱える
    //     // 　　　　Illuminate\Support\Collection  DB::table()->get(); とかのクエリビルダで取得したやつ
    //     // 　　　　　　　↑　ただデータベースのテーブルやレコードを連想配列に全てまとめてしまえ！となったもの
    //     // 　　　　Illuminate\Database\Query\Builder  これがただのDBクラス
    //     DB::table('users')
    //         ->updateOrInsert(
    //             ['id' => $user->getId()],
    //             ['name' => $user->getName()]
    //         );
    // }

    // /**
    //  * @param UserId $id
    //  * @return User
    //  */
    // public function find(UserId $id)
    // {
    //     $user = DB::table('users')->where('id', $id->getValue())->first();

    //     return new User($id, $user->name);
    //     // ↑　ここでデータベースからとってきた生の情報をエンティティに格納してreturn
    // }

    // /**
    //  * @param int $page
    //  * @param int $size
    //  * @return mixed
    //  */
    // public function findByPage($page, $size)
    // {
    //     // TODO: Implement findByPage() method.
    // }

    /**
     * @return User
     */
    public function getAuthUser()
    {
        $user = Auth::user();

        return new User($user->id, $user->name, $user->email, $user->user_name, $user->age, $user->image, $user->introduction, $user->area_id, $user->created_at, $user->updated_at);
    }
}