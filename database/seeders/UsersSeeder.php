<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        if ($response->successful()) {
            $users = $response->json();

            foreach ($users as $user) {
                $usersAddress = $user["address"];
                $usersCompany = $user["company"];
                $addressId = Address::select(["id"])
                    ->where([
                        "street" => $usersAddress["street"], 
                        "suite" => $usersAddress["suite"], 
                        "city" => $usersAddress["city"], 
                        "zipcode" => $usersAddress["zipcode"], 
                        "lat" => $usersAddress["geo"]["lat"], 
                        "lng" => $usersAddress["geo"]["lng"],
                    ])
                    ->first()->id ?? '';
                if($addressId == ''){
                    $addressData = [
                        "street" => $usersAddress["street"], 
                        "suite" => $usersAddress["suite"], 
                        "city" => $usersAddress["city"], 
                        "zipcode" => $usersAddress["zipcode"], 
                        "lat" => $usersAddress["geo"]["lat"], 
                        "lng" => $usersAddress["geo"]["lng"],
                    ];
                    $addressId = Address::create($addressData)->id;
                }
                $companyId = Company::select(["id"])
                    ->where([
                        "name" => $usersCompany["name"], 
                        "catch_phrase" => $usersCompany["catchPhrase"], 
                        "bs" => $usersCompany["bs"], 
                    ])
                    ->first()->id ?? '';
                if($companyId == ''){
                    $companyData = [
                        "name" => $usersCompany["name"], 
                        "catch_phrase" => $usersCompany["catchPhrase"], 
                        "bs" => $usersCompany["bs"], 
                    ];
                    $companyId = Company::create($companyData)->id;
                }
                $password = "Password@1";
                $hashedPassword = Hash::make($password);

                $usersData = [
                    "name" => $user["name"], 
                    "email" => $user["email"], 
                    "username" => $user["username"], 
                    "password" => $hashedPassword, 
                    "phone" => $user["phone"], 
                    "website" => $user["website"], 
                    "addresses_id" => $addressId, 
                    "companies_id" => $companyId, 
                ];
                User::create($usersData);
            }

        }
    }
}
