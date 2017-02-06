<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert(['name' => 'MangaStream', 'url' => 'http://mangastream.com/']);

        DB::table('mangas')->insert([
            ['name' => 'One Piece'],
            ['name' => 'Dragon Ball Super'],
            ['name' => 'Haikyu'],
            ['name' => 'Fairy Tail'],
            ['name' => 'The Promised Neverland'],
        ]);

        DB::table('manga_source')->insert([
            ['manga_id' => 1, 'source_id' => 1],
            ['manga_id' => 2, 'source_id' => 1],
            ['manga_id' => 3, 'source_id' => 1],
            ['manga_id' => 4, 'source_id' => 1],
            ['manga_id' => 5, 'source_id' => 1],
        ]);

        DB::table('telegram_users')->insert([
            'user_id' => '108198894', 'first_name' => 'Junior', 'last_name' => 'Zavaleta', 'username' => 'JuniorZavaleta'
        ]);

        DB::table('subscriptions')->insert([
            ['manga_source_id' => 1, 'telegram_user_id' => 1],
            ['manga_source_id' => 2, 'telegram_user_id' => 1],
            ['manga_source_id' => 3, 'telegram_user_id' => 1],
            ['manga_source_id' => 4, 'telegram_user_id' => 1],
        ]);
    }
}
