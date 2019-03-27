<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            'name' => "匿名A",
            'email' => "a@tekito.com",
            'password' => bcrypt("a@tekito.com"),
            'created_at'=> $now
        ]);
        DB::table('users')->insert([
            'name' => "適当ネーム",
            'email' => "2@tekito.com",
            'password' => bcrypt("2@tekito.com"),
            'created_at'=> $now
        ]);
        // 適当な人数のuser生成
        factory(App\User::class, 10)->create();

        //全ユーザに、ランダムに3人のフレンズをもたせる
        foreach (App\User::All() as $user){
            $random_friends_id = App\User::inRandomOrder()
                ->where('id', '<>', $user->id) //自分以外
                ->take(3) //友達の数
                ->pluck('id')->toArray();//user->idだけ配列化

            // 多対多の時はsave()ではなく、attach(配列)で保存する
            $user->friends()->attach(
                $random_friends_id
            );
        }

        DB::table('rooms')->insert([
            'name' => "ランチについて",
            'user_id' => 1,
            'created_at'=> $now
        ]);
        DB::table('rooms')->insert([
            'name' => "虎ノ門について",
            'user_id' => 2,
            'created_at'=> $now
        ]);
        DB::table('rooms')->insert([
            'name' => "休みの日、なにしている？",
            'user_id' => 3,
            'created_at'=> $now
        ]);

        DB::table('messages')->insert([
            'room_id' => 1,
            'user_id' => 1,
            'text' => "近頃はpaypayを使っているけど、まだ導入されていない店がマップにでてくる",
            'created_at'=> $now
        ]);
        DB::table('messages')->insert([
            'room_id' => 1,
            'user_id' => 2,
            'text' => "虎ノ門はランチがイマイチ。新橋の方がサラリーマンの聖地だけあって良いね",
            'created_at'=> $now
        ]);


        DB::table('messages')->insert([
            'room_id' => 2,
            'user_id' => 2,
            'text' => "会社の近くが再開発でコンビニも潰れて不便！ポニーキャニオンも移転するらしい",
            'created_at'=> $now
        ]);
        DB::table('messages')->insert([
            'room_id' => 2,
            'user_id' => 1,
            'text' => "正直言って虎ノ門飽きたわ～。",
            'created_at'=> $now
        ]);
        DB::table('messages')->insert([
            'room_id' => 2,
            'user_id' => 1,
            'text' => "引っ越しするなら、池袋・新宿・新宿とか副都心線がイイね ",
            'created_at'=> $now
        ]);


        DB::table('messages')->insert([
            'room_id' => 3,
            'user_id' => 3,
            'text' => "子供が出来ると休日が休みにならない…。",
            'created_at'=> $now
        ]);
    }
}
