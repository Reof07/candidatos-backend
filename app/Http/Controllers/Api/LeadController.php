<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\LeadResource;
use App\Services\LeadService;
use Exception;
use Illuminate\Http\Response;

class LeadController extends Controller
{

    protected $leadService;

    public function __construct(LeadService $leadService)
    {
        $this->leadService = $leadService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = $this->leadService->getAllLeads();
            return LeadResource::collection($result['data'])->additional([
                'meta' => [
                    'success' => $result['success'],
                    'status' => $result['status'],
                    'errors' => $result['success'] ? [] : []
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'meta' => [
                    'success' => false,
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'errors' => [$e->getMessage()],
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        $result = $this->leadService->createLead($request->all());

        return (new LeadResource($result['data']))->additional([
            'meta' => [
                'success' => $result['success'],
                'status' => $result['status'],
                'errors' => $result['success'] ? [] : [$result['message']],
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $result = $this->leadService->getLeadById($id);

        return (new LeadResource($result['data']))->additional([
            'meta' => [
                'success' => $result['success'],
                'status' => $result['status'],
                'errors' => $result['success'] ? [] : [$result['message']],
            ],
        ]);;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
