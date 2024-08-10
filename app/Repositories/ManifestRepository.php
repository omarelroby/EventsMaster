<?php
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Manifest;
use App\Models\Person;
use App\Models\Shipper;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class ManifestRepository extends AppRepository
{
    protected $model;

    public function __construct(Manifest $model)
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
            'manifest_number' => $request->input('manifest_number'),
            'date_receiving_shipment' => $request->input('date_receiving_shipment'),
            'quantity' => $request->input('quantity'),
            'number_clearance_customs' => $request->input('number_clearance_customs'),
            'shipper_id' => $request->input('shipper_id'),
            'truck_id' => $request->input('truck_id'),
            'driver_id' => $request->input('driver_id'),
            'organization_id' => $request->input('organization_id'),
            'event_id' => $request->input('event_id'),
            'list_type_id' => $request->input('list_type_id'),
        ];
    }
}
