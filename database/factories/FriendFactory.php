<?php

namespace Database\Factories;

use App\Models\Friend;
use App\Models\User;
use App\Models\PrivateRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Friend::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $currentUserId = 1;

        $userCount = User::count();
        $privateRoomId = PrivateRoom::create([
            'first_user_id' => $currentUserId,
            'second_user_id' => $userCount + 1,
        ]);

        return [
            'user_id' => $currentUserId,
            'friend_user_id' => User::factory(),
            'private_room_id' => $privateRoomId->id,
        ];

        // テストユーザー（user_id:2のユーザーの友だちとしてadminを登録）実行は一回のみ
        // $currentUserId = 2;

        // return [
        //     'user_id' => $currentUserId,
        //     'friend_user_id' => 1,
        //     'private_room_id' => 1,
        // ];
    }
}
