<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $decks = [];
        for ($i = 1; $i <= 100; $i++) {
            $decks[] = [
                'name'        => "Deck $i",
                'description' => "Description for Deck $i",
            ];
        }

        DB::table('decks')->insert($decks);
    }
}
