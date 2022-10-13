<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->runCommentsTableSeeder();
    }

    private function runCommentsTableSeeder() {
        // First root comment tree
        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, null, 'andre', 'main message', '2022-10-12 00:00:00', '2022-10-12 00:00:00')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 1, 'andre-sub', 'sub message 1', '2022-10-12 00:00:05', '2022-10-12 00:00:05')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 1, 'andre-sub', 'sub message 2', '2022-10-12 00:00:10', '2022-10-12 00:00:10')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 2, 'andre-sub-sub', 'sub-sub message 1', '2022-10-12 00:00:15', '2022-10-12 00:00:15');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 2, 'andre-sub-sub', 'sub-sub message 2', '2022-10-12 00:00:20', '2022-10-12 00:00:20');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 3, 'andre-sub-sub', 'sub-sub message 3', '2022-10-12 00:00:25', '2022-10-12 00:00:25');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 3, 'andre-sub-sub', 'sub-sub message 4', '2022-10-12 00:00:30', '2022-10-12 00:00:30');");

        // Second root comment tree
        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, null, 'maxim', 'main message', '2022-10-12 00:00:32', '2022-10-12 00:00:32')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 8, 'maxim-sub', 'sub message 1', '2022-10-12 00:00:35', '2022-10-12 00:00:35')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 8, 'maxim-sub', 'sub message 2', '2022-10-12 00:00:40', '2022-10-12 00:00:40')");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 9, 'maxim-sub-sub', 'sub-sub message 1', '2022-10-12 00:00:45', '2022-10-12 00:00:45');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 9, 'maxim-sub-sub', 'sub-sub message 2', '2022-10-12 00:00:50', '2022-10-12 00:00:50');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 10, 'maxim-sub-sub', 'sub-sub message 3', '2022-10-12 00:00:55', '2022-10-12 00:00:55');");

        DB::insert("INSERT INTO comments (post_id, parent_id, name, message, created_at, updated_at)
            values(1, 10, 'maxim-sub-sub', 'sub-sub message 4', '2022-10-12 00:00:58', '2022-10-12 00:00:58');");
    }
}
