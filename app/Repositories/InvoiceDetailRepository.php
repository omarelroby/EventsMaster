<?php
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Manifest;
use App\Models\Person;
use App\Models\Shipper;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class InvoiceDetailRepository extends AppRepository
{
    protected $model;

    public function __construct(InvoiceDetail $model)
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
            'quantity' => $request->input('quantity'),
            'invoice_id' => $request->input('invoice_id'),
            'item_id' => $request->input('item_id'),

        ];
    }
}
