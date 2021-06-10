<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence, '.'),
            'content' => $this->faker->text, //$this->faker->paragraphs(3, true)
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'image' => $this->faker->imageUrl()
        ];
    }
}
