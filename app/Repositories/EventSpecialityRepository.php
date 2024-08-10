<?php
namespace App\Repositories;
use App\Models\EventSpecialty;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class EventSpecialityRepository extends AppRepository
{
    protected $model;
    
    public function __construct(EventSpecialty $model)
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
            'serial_number' => $request->input('serial_number'),
            'description' => $request->input('description')


        ];
    }
}