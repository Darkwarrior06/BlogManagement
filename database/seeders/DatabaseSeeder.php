<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Writer::create([
            "first_name"=>"Marlo",
            "last_name"=>"Gallano",
            "email"=>"gallano@gmail.com",
            "password"=>"Password",
            "gender"=>"male",
            "writer_access" => "1"
        ]);

        Writer::create([
            "first_name"=>"Jefferson",
            "last_name"=>"Detalo",
            "email"=>"detalo@gmail.com",
            "password"=>"Password",
            "gender"=>"male",
            "writer_access" => "1"
        ]);

        Writer::create([
            "first_name"=>"Alfred",
            "last_name"=>"Cunanan",
            "email"=>"cunanan@gmail.com",
            "password"=>"Password",
            "gender"=>"male",
            "writer_access" => "0"
        ]);

//for admin

        Admin::create([
            "name"=>"Marlo",
            "username"=>"Darkwarrior",
            "password"=>"Password"
        ]); 

        Admin::create([
            "name"=>"Jericho",
            "username"=>"Eco",
            "password"=>"Pass"
        ]); 
 

//for category

        for($i=0; $i<5; $i++)
        {
            if($i==0)
            {
                $type = "Movies";
                $restriction = "Movies Blog Only";
            }
            elseif($i==1)
            {
                $type = "Musics";
                $restriction = "Musics Blog Only";
            }
            elseif($i==2)
            {
                $type = "Travels";
                $restriction = "Travels Blog Only";
            }
            elseif($i==3)
            {
                $type = "Fasion";
                $restriction = "Fasion Blog Only";
            }
            elseif($i==4)
            {
                $type = "all";
                $restriction = "Access for all categories";
            }
            
            Category::create(["type" => $type, "restricted"=> $restriction]);
        }

        $writer = Writer::first();
        $writer->posts()->create(["text" => "Post 1","photo"=>"no photo","video"=>"no video","title"=>"My post"]);

        $category = Category::find(2);
        $category -> posts() -> attach (Post::orderBy('id', 'desc') -> first() -> id);
        
        $writer = Writer::first();
        $writer -> comments()-> create(["text" => "My comment","time"=>"5:40","post_id" => 1]);

    }
}
