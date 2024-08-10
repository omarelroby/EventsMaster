<?php
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Invoice;
use App\Models\Manifest;
use App\Models\Person;
use App\Models\Shipper;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class InvoiceRepository extends AppRepository
{
    protected $model;

    public function __construct(Invoice $model)
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
            'invoice_number' => $request->input('invoice_number'),
            'date_Invoice' => $request->input('date_Invoice'),
            'organization_id' => $request->input('organization_id'),
            'event_id' => $request->input('event_id'),
            'list_type_id' => $request->input('list_type_id'),
        ];
    }
}
