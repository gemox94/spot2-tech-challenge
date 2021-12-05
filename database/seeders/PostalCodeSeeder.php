<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\State;
use App\Models\PostalCode;

class PostalCodeSeeder extends Seeder
{

    /**
     * Helper function to map postal codes from CSV file.
     *
     * @return array
     */
    public function getPostalCodesFromFile() {
        $filePath = public_path('puebla_postal_codes.csv');
        $file = fopen($filePath,"r");
        $counter = 0;

        $states = [];
        $postalCodes = [];
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {

            if ($counter == 20) {
                break;
            }

            if ($counter >= 1) {
                $state = $data[4];

                if (!in_array($state, $states)) {
                    $states[] = $state;
                }

                $postalCodes[] = [
                    'code' => $data[0],
                    'settlement' => $data[1],
                    'settlement_type' => $data[2],
                    'municipality' => $data[3],
                    'city' => $data[5],
                    'zone' => $data[13],
                    'state_id' => $state
                ];
            }

            $counter++;
        }

        fclose($file);

        return [
            "states" => $states,
            "postalCodes" => $postalCodes
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getPostalCodesFromFile();
        $postalCodes = $data['postalCodes'];

        // Prepare states data to be created, set up structe to upsert
        $statesToCreate = [];
        foreach ($data['states'] as $state) {
            $statesToCreate[] = ['name' => $state];
        }

        State::upsert($statesToCreate, ['name']);

        // Create a states map [{name} => {id}] to match the ID with the state_id field in postal codes
        $states = State::all();
        $statesMap = [];
        foreach ($states as $state) {
            $statesMap[$state->name] = $state->id;
        }

        // Replace state_id value (which is the state name) with the ID
        // IMPORTANT: Use "&" to use array reference instead of copy
        foreach ($postalCodes as &$postalCode) {
            $state = $postalCode['state_id'];
            $postalCode['state_id'] = $statesMap[$state];
        }

        $fields = ['code', 'settlement', 'settlement_type', 'municipality', 'city', 'zone', 'state_id'];
        PostalCode::upsert($postalCodes, $fields);
    }
}
