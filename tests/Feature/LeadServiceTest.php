<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use App\Repositories\LeadRepository;
use App\Services\LeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LeadServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $leadService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->leadService = new LeadService(new LeadRepository());
    }

    /**
     * @description test create lead as manager
     */
    public function testCreateLeadAsManager()
    {
        $manager = User::where('role', 'manager')->first();
        Auth::login($manager);

        $data = [
            'name' => 'Test Candidate',
            'source' => 'Source',
            'owner' => $manager->id,
        ];

        $result = $this->leadService->createLead($data);

        $this->assertTrue($result['success']);
        $this->assertEquals(201, $result['status']);
        $this->assertNotNull($result['data']);
    }

    /**
     * @description Tests create lead as agent.
     */
    public function testCreateLeadAsAgent()
    {
        $agent = User::where('role', 'agent')->first();
        Auth::login($agent);

        $data = [
            'name' => 'Test Candidate',
            'source' => 'Source',
            'owner' => $agent->id,
        ];

        $result = $this->leadService->createLead($data);

        $this->assertFalse($result['success']);
        $this->assertEquals(401, $result['status']);
    }

    /**
     * test get all leads
     */
    public function testGetAllLeadsAsManager()
    {
        $manager = User::where('role', 'manager')->first();
        Auth::login($manager);

        $result = $this->leadService->getAllLeads();

        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['status']);
        $this->assertNotEmpty($result['data']);
    }

    /**
     * @description Tests get lead by id as manager.
     */
    public function testGetLeadByIdAsManager()
    {
        $manager = User::where('role', 'manager')->first();
        Auth::login($manager);

        $lead = Lead::factory()->create();

        $result = $this->leadService->getLeadById($lead->id);

        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['status']);
        $this->assertNotNull($result['data']);
    }

    /**
     * @description Tests get lead by id as agent.
     */
    public function testGetLeadByIdAsAgent()
    {
        $agent = User::where('role', 'agent')->first();
        Auth::login($agent);

        $lead = Lead::factory()->create(['owner' => $agent->id]);

        $result = $this->leadService->getLeadById($lead->id);

        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['status']);
        $this->assertNotNull($result['data']);
    }

    /**
     * @description Get all leads as agent.
     */
    public function testGetAllLeadsAsAgent()
    {
        $agent = User::where('role', 'agent')->first();
        Auth::login($agent);

        $result = $this->leadService->getAllLeads();

        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['status']);
        $this->assertNotEmpty($result['data']);
    }
}
