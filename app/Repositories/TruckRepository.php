<?php
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Person;
use App\Models\Shipper;
use App\Models\Truck;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class TruckRepository extends AppRepository
{
    protected $model;

    public function __construct(Truck $model)
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
            'no_plate' => $request->input('no_plate'),
            'shipper_id' => $request->input('shipper_id'),
        ];
    }
}
