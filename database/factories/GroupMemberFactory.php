<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GroupMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => Group::factory(),
            'user_id' => 1,
        ];

        // return [
        //     'group_id' => 1,
        //     'user_id' => 2,
        // ];
    }
}
