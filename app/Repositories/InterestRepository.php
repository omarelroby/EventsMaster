<?php
namespace App\Repositories;

use App\Models\Interest;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class InterestRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Interest $model)
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
            'name' => $request->input('name')

        ];
    }
}