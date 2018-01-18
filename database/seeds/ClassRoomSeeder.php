<?php

use Illuminate\Database\Seeder;
use App\ClassRoom;
class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user_id = "42cdf31e-fd87-5214-b021-4ba9eab29e51";
        for ($i=1; $i <= 10 ; $i++) {
          ClassRoom::create([
            'user_id'=>$user_id,
            'name'=>"Class Room ".$i,
            'avatar'=>"class".$i.".png",
            "section"=>$i." Year"
          ]);
        }
    }
}
