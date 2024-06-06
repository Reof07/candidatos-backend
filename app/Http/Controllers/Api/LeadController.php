<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\LeadException;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\LeadResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $leads = Lead::all();
            //$leads = [];

            if ($leads->isEmpty()) {
                throw new LeadException('No leads found.', Response::HTTP_NOT_FOUND);
            }
            return LeadResource::collection($leads)->additional([
                'meta' => [
                    'success' => true,
                    'status' => Response::HTTP_OK,
                    //'message' => Constant::CONST_RESOURCE_SUCCESSFULLY_RETRIEVED,
                    'errors' => [],
                ],
            ]);
        } catch (LeadException $e) {
            throw $e;
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
        $lead = Lead::create($request->all());
        return LeadResource::collection($lead)->additional([
            'meta' => [
                'success' => true,
                'status' => Response::HTTP_CREATED,
                //'message' => Constant::CONST_RESOURCE_SUCCESSFULLY_CREATED,
                'errors' => [],
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return (new LeadResource($lead))->additional([
            'meta' => [
                'success' => true,
                'status' => Response::HTTP_OK,
                //'message' => Constant::CONST_RESOURCE_SUCCESSFULLY_CREATED,
                'errors' => [],
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
