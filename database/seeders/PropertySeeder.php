<?php
namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [];
        $cards      = Card::all(); // Fetch all cards from the database

        foreach ($cards as $card) {
            $usedPropertyNames = [];         // Track used property names for the card
            $propertyCount     = rand(1, 5); // Random number of properties (1 to 5)
            for ($i = 1; $i <= $propertyCount; $i++) {
                do {
                    $propertyName = $this->getRandomPropertyName();
                } while (in_array($propertyName, $usedPropertyNames)); // Ensure no duplicates

                $usedPropertyNames[] = $propertyName; // Mark property name as used
                $propertyValue       = $this->getRandomPropertyValue($propertyName);

                $properties[] = [
                    'card_id' => $card->id,
                    'name'    => $propertyName,
                    'value'   => $propertyValue,
                ];
            }
        }

        DB::table('properties')->insert($properties);
    }

    /**
     * Get a random property name.
     */
    private function getRandomPropertyName(): string
    {
        $propertyNames = ['Type', 'HP', 'Attack', 'Defense', 'Speed', 'Special Ability'];
        return $propertyNames[array_rand($propertyNames)];
    }

    /**
     * Get a random property value based on the property name.
     */
    private function getRandomPropertyValue(string $propertyName): string
    {
        switch ($propertyName) {
            case 'Type':
                $types = ['Fire', 'Water', 'Electric', 'Grass', 'Psychic', 'Dark', 'Fairy'];
                return $types[array_rand($types)];
            case 'HP':
                return (string) rand(50, 200);
            case 'Attack':
                return 'Attack ' . rand(1, 100);
            case 'Defense':
                return (string) rand(10, 100);
            case 'Speed':
                return (string) rand(10, 100);
            case 'Special Ability':
                $abilities = ['Fly', 'Swim', 'Invisibility', 'Strength', 'Agility'];
                return $abilities[array_rand($abilities)];
            default:
                return 'Unknown';
        }
    }
}
