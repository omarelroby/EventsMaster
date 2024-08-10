<?php
namespace App\Repositories;
use App\Models\ListType;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ListTypeRepository extends AppRepository
{
    protected $model;
    
    public function __construct(ListType $model)
    {
        $this->model = $model;
    }
    
    /**
     * set payload data for posts table.
     * 
     * @param Request $request [specification]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'serial_number' => $request->input('serial_number'),
            'specification' => $request->input('specification')


        ];
    }
}