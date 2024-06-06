<?php

namespace App\Services;

use App\Exceptions\LeadException;
use App\Helpers\Constant;
use App\Models\Lead;
use App\Repositories\LeadRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class LeadService
{
    protected $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    /**
     * @description this function is used to create a new lead in the database and return it as a json object
     * @param $data
     * @return array
     */
    public function createLead($data)
    {
        if (Auth::user()->role !== 'manager') {
            throw new LeadException('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $lead = Lead::create([
            'name' => $data['name'],
            'source' => $data['source'],
            'owner' => $data['owner'],
            'created_by' => Auth::id()
        ]);

        return [
            'success' => true,
            'data' => $lead,
            'status' => Response::HTTP_CREATED
        ];
    }

    /**
     * @description this function is used to get the data by id from the database and return it as a json object
     * @param $id
     * @return array
     */
    public function getLeadById($id)
    {
        $lead = $this->leadRepository->findOne($id);
        if (!$lead) {
            throw new LeadException('No lead found', Response::HTTP_NO_CONTENT);
        }

        if (Auth::user()->role == 'agent' && $lead->owner != Auth::id()) {
            throw new LeadException('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return [
            'success' => true,
            'data' => $lead,
            'status' => Response::HTTP_OK
        ];
    }

    /**
     * @description this function is used to get all the data from the database and return it as a json object
     * @return array
     */
    public function getAllLeads()
    {
        if (Auth::user()->role == 'agent') {
            $leads = $this->leadRepository->getAll()->where('owner', Auth::id());
        } else {
            $leads = $this->leadRepository->getAll();
        }

        if ($leads->isEmpty()) {
            throw new LeadException('No leads found.', Response::HTTP_NO_CONTENT);
        }

        return [
            'success' => true,
            'data' => $leads,
            'status' => Response::HTTP_OK,
        ];
    }
}
