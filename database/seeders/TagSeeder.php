<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::first();
        if (!$tag) {
            $this->command->line("Generating Tags");
            $tags = ['น้ำท่วม', 'เสาไฟ', 'แซงคิว', 'ไม่สะอาด', 'รถตะลัย', 'ห้องเรียน', 'สนามบาส',
                'สนามบอล', 'สนามแบด', 'สนามวอลเลย์', 'สนามวิ่ง', 'สนามปิงปอง', 'โรงอาหาร', 'ไฟถนน', 'ทางเดิน', 'ตึกเรียน',
                'ห้องน้ำ', 'กระดาษทิชชู', 'ห้องแลป', 'อุปกรณ์', 'กดDropตรงไหน',
                'ห้องสมุด', 'สำนักคอม', 'คอมพิวเตอร์', 'โปรเจ็คเตอร์', 'สื่อการเรียนการสอน',
                'อาจารย์', 'นิสิต', 'ชีวิตนิสิต', 'คาเฟ่',
                'ไก่มะเร็ง', 'สโมสรนิสิต', 'ทางเท้า', 'จักรยาน', 'มอเตอร์ไซค์',
                'รถยนต์'];
            collect($tags)->each(function ($tag_name, $key) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            });
        }

        $this->command->line("Generating tags for all posts");
        $posts = Post::get();
        $posts->each(function($post, $key) {
            $n = fake()->numberBetween(1, 3);
            $tag_ids = Tag::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $post->tags()->sync($tag_ids);
        });
    }
}
