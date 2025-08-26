<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class IcountService
{
    protected string $baseUrl;
    protected string $sid;

    public function __construct()
    {
        // Ok so my production iCount is:

        // user: eyal
        // Pass: V011r37!!
        // CID: cig
        // $this->baseUrl = rtrim(config('services.icount.base_url'), '/');
        $this->baseUrl = "https://api.icount.co.il/api/v3.php";
        $response = $this->login([
                // "cid"=> "cigdev",
                // "user"=> "api-user",
                // "pass"=> "Au2025!!"

                // Production
                "cid"=> "cig",
                "user"=> "eyal",
                "pass"=> "V011r37!!"
        ]);

        $this->sid = $response['sid'];
    }

    /**
     * Create API token
     *
     * @param array $credentials
     * @return array|null
     */
    public function createToken(array $credentials): ?array
    {
        $response = $this->post('/token/create', $credentials);
        return $response;
    }

    public function login(array $credentials): ?array
    {
        return $this->post('/auth/login', $credentials);
    }

    /**
     * Create a document (e.g. invoice receipt)
     *
     * @param array $payload
     * @return array|null
     */
    public function createDocument(array $payload): ?array
    {
        return $this->post('/doc/create', $payload);
    }

    /**
     * Create HK (standing order / direct debit)
     */
    public function createRecurringProfile(array $payload): ?array
    {
        // $payload['sid'] = $this->sid;
        $payload['cid'] = "cigdev";
        $payload['user'] = "api-user";
        $payload['pass'] = "Au2025!!";


        // Production
        $payload['cid'] = "cig";
        $payload['user'] = "eyal";
        $payload['pass'] = "V011r37!!";

        return $this->post('/hk/create', $payload);
    }


    /**
     * Generic POST wrapper
     */
    protected function post(string $endpoint, array $data): ?array
    {
        $response = Http::acceptJson()
            ->post($this->baseUrl . $endpoint, $data);
            
        $json = $response->json();

        if($json['status'] == false){
            throw new Exception($json['error_description']."\n".$json['error_details'][0]);
        }

        return $json;
    }
}
