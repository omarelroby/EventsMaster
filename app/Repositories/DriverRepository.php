<?php
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Person;
use App\Models\Shipper;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class DriverRepository extends AppRepository
{
    protected $model;

    public function __construct(Driver $model)
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
            'surname' => $request->input('surname'),
            'tag_name' => $request->input('tag_name'),
            'type_id' => $request->input('type_id'),
            'date_birth' => $request->input('date_birth'),
            'phone1' => $request->input('phone1'),
            'phone2' => $request->input('phone2'),
            'photo' => $request->hasFile('photo') ? $this->saveImage($request->file('photo'), 'drivers') : null, // Assuming 'photo' is the file input name
            'shipper_id' => $request->input('shipper_id'),
        ];
    }
}
