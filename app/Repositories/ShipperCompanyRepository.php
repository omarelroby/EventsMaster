<?php
namespace App\Repositories;

use App\Models\Person;
use App\Models\Shipper;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use App\Helpers;
class ShipperCompanyRepository extends AppRepository
{
    protected $model;

    public function __construct(Shipper $model)
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
            'account_number' => $request->input('account_number'),
            'shipper_name' => $request->input('shipper_name'),
            'name_commercial' => $request->input('name_commercial'),
            'abbreviation' => $request->input('abbreviation'),
            'id_registry_commercial' => $request->input('id_registry_commercial'),
            'file_register_commercial' => $request->hasFile('file_register_commercial') ? $this->saveImage($request->file('file_register_commercial'), 'shipper') : null, // Assuming 'photo' is the file input name
            'registry_id_tax' => $request->input('registry_id_tax'),
            'email' => $request->input('email'),
            'zip' => $request->input('zip'),
            'phone1' => $request->input('phone1'),
            'phone2' => $request->input('phone2'),
        ];
    }
}
