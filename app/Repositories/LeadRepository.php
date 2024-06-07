<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{

    /**
     * Crear un nuevo Lead.
     *
     * @param array $data
     * @return Lead
     */
    public function create(array $data): Lead
    {
        return Lead::create([
            'name' => $data['name'],
            'source' => $data['source'],
            'owner' => $data['owner'],
            'created_by' => $data['created_by'],
        ]);
    }

    public function getAll()
    {
        return Lead::all();

        //OJO - problems with redis.
        // return Cache::remember('leads', 60, function () {
        //     return Lead::all();
        // });
    }

    public function findOne($id)
    {
        return Lead::find($id);
    }
}
