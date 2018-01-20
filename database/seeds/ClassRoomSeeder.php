<?php

use Illuminate\Database\Seeder;
use App\ClassRoom;
use App\Student;
use App\User;
class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = User::first();
        
        for ($i=1; $i <= 10 ; $i++) {
          $classroom = ClassRoom::create([
            'user_id'=>$user->id,
            'name'=>"Class Room ".$i,
            'avatar'=>"class".$i.".png",
            "section"=>$i." Year"
          ]);
        }
    }
}
