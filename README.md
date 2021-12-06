# Spot2 Tech Challenge

## TL;DR
Tech challenge for Spot2. The objective is to create a basic API of ZIP Codes where the user will request
a zip code and a list of settlements will be returned.

## Endpoints
The following are the available endpoints for this challenge:

### List zip codes
**GET:** `/api/v1/zip-code`

### Retrieve zip code
**GET:** `/api/v1/zip-code/{zipCodeId}`

## Live Test
Here you can find the deployed project:

https://spot2api.gmoxca.com/api/v1/zip-code

## Initial Setup
* Create a DB
* Set up environment variables, you can use `.env.example` file as starting point

Run the following scripts:
1. `php artisan migrate`
2. `php artisan db:seed`

Inside the public folder is a `puebla_postal_codes.csv` file from where the seeder takes the example zip codes.

## Testing
So the tests can run, a new DB in MySQL must be created with the following name: `test_spot2_tech_challenge`.

To run the tests: `php artisan test`
