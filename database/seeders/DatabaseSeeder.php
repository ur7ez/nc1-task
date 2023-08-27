<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Get the path to the CSV file
        $csvFile = __DIR__ . '/data.csv';
        if (file_exists($csvFile) && ($fileData = file($csvFile))) {
            // read the CSV file into array
            $csvData = array_map('str_getcsv', $fileData);
            // remove the header (first row) from the CSV data
            $header = array_shift($csvData);
            // and seed the 'property' table
            foreach ($csvData as $row) {
                Property::create([
                    'name' => $row[0],
                    'price' => $row[1],
                    'bedrooms' => $row[2],
                    'bathrooms' => $row[3],
                    'storeys' => $row[4],
                    'garages' => $row[5],
                ]);
            }
        } else {
            // fill some data with factory
            Property::factory(10)->create();
        }

    }
}
