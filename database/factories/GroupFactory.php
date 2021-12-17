<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use App\Models\MstStyle;
use App\Models\MstGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userCount = User::count();
        $styleCount = MstStyle::count();
        $gameCount = MstGame::count();
        // $groupCount = Group::count() + 1;
        return [
            'group_name' => $this->faker->userName(),
            'leader_id' => rand(1, $userCount),
            'icon' => null,
            'participants' => $this->faker->numberBetween(5, 10),
            'recruitment' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->text(150),
            // 'group_chat_id' => $groupCount,
            'style_id' => rand(1, $styleCount),
            'game_id' => rand(1, $gameCount),
        ];
    }
}
