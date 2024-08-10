<?php
namespace App\Repositories;

use App\Models\Activity;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ActivityRepository extends AppRepository
{
    protected $model;
    
    public function __construct(Activity $model)
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
            'specifications' => $request->input('specifications')

        ];
    }
}