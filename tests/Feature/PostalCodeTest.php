<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostalCodeTest extends TestCase
{

    use RefreshDatabase;
    protected $seed = True;

    /**
     * Test list zip codes returns status code 200
     *
     * @return void
     */
    public function test_list_zip_codes()
    {
        $response = $this->getJson('/api/v1/zip-code');
        $response->assertStatus(200);
    }

    /**
     * Test retrieve zip code returns status code 200 and validate
     * that contains "status": true
     *
     * @return void
     */
    public function test_retrieve_zip_code_with_status_true()
    {
        $response = $this->getJson('/api/v1/zip-code/72100');
        $response->assertStatus(200)
            ->assertJson(['status' => true]);
    }

    /**
     * Test retrieve zip code returns status code 200 and validate
     * that contains "status": true
     *
     * @return void
     */
    public function test_retrieve_zip_code_with_status_false()
    {
        $response = $this->getJson('/api/v1/zip-code/00000');
        $response->assertStatus(200)
            ->assertJson(['status' => false]);
    }

    /**
     * Test retrieve zip code with exact match agains JSON
     *
     * @return void
     */
    public function test_retrieve_zip_code_exact_match()
    {
        $response = $this->getJson('/api/v1/zip-code/72094');
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('status')
                    ->has('payload', 1, fn ($json) =>
                        $json->where('code', '72094')
                            ->where('settlement', 'El Tamborcito')
                            ->where('settlement_type', 'Colonia')
                            ->where('municipality', 'Puebla')
                            ->where('city', 'Heroica Puebla de Zaragoza')
                            ->where('zone', 'Urbano')
                            ->where('state.name', 'Puebla')
                            ->etc() // IMPORTANT to call etc() as "id" from state is not being validated
                )
        );
    }
}
