<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class UChatPartnerService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.uchat.base_url', 'https://www.uchat.com.au/api');
        $this->apiKey = config('services.uchat.api_key');
    }

    /**
     * Common request handler
     */
    protected function request(string $method, string $endpoint, array $data = [])
    {
        try {
            $response = Http::withToken($this->apiKey)
                ->acceptJson()
                ->$method("{$this->baseUrl}{$endpoint}", $data);

            if ($response->failed()) {
                throw new RequestException($response);
            }

            return $response->json();
        } catch (RequestException $e) {
            return [
                'success' => false,
                'error' => $e->response ? $e->response->json() : $e->getMessage(),
            ];
        }
    }

    /**
     * Create a new workspace (user + environment)
     */
    public function createWorkspace(array $payload)
    {
        return $this->request('post', '/partner/workspace/create', $payload);
    }

    /**
     * List all active workspaces
     */
    public function listWorkspaces()
    {
        return $this->request('get', '/partner/workspaces');
    }

    /**
     * Create a new environment for an existing user
     */
    public function createWorkspaceForExistingUser(array $payload)
    {
        return $this->request('post', '/partner/workspace/create-for-existing-user', $payload);
    }

    /**
     * Get workspace details
     */
    public function getWorkspaceDetails(string $workspaceId)
    {
        return $this->request('get', "/partner/workspace/{$workspaceId}");
    }

    /**
     * Change workspace plan
     */
    public function changeWorkspacePlan(string $workspaceId, array $payload)
    {
        return $this->request('put', "/partner/workspace/{$workspaceId}/change-plan", $payload);
    }

    /**
     * Add Add-On (bots, clients, agents, etc.)
     */
    public function addAddon(string $workspaceId, array $payload)
    {
        return $this->request('post', "/partner/workspace/{$workspaceId}/add-addon", $payload);
    }

     /**
     * Get all available Add-ons
     */
    public function getAddons(): array
    {
        return $this->request('get', '/partner/addons');
    }
}
