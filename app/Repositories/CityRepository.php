<?php
namespace App\Repositories;

use App\Models\City;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class CityRepository extends AppRepository
{
    protected $model;
    
    public function __construct(City $model)
    {
        $this->model = $model;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'country_id' => $request->input('country_id'),
            'initials' => $request->input('initials')

        ];
    }
}