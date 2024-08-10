<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRequest;
use App\Http\Requests\Admin\InvoiceRequest;
use App\Http\Requests\Admin\ManifestRequest;
use App\Http\Requests\Admin\PersonRequest;
use App\Http\Requests\Admin\ShipperCompanyRequest;
use App\Http\Resources\DriverResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\ManifestResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ShipperResource;
use App\Repositories\DriverRepository;
use App\Repositories\ManifestRepository;
use App\Repositories\PersonRepository;
use App\Repositories\ShipperCompanyRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class InvoiceController extends Controller
{

    protected $repository;
    use ApiResponse;


    public function __construct(ManifestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get list of all the posts.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        $data['rows'] = InvoiceResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
        ];
        return $this->okApiResponse($data,__('Invoices loaded'));

    }

    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\PersonRequest
     * @return json response
     */
    public function store(InvoiceRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return $this->createdApiResponse(new InvoiceResource($item),__('Invoice loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }

    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdatePersonRequest
     * @return json response
     */
    public function update($id, InvoiceRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->createdApiResponse(new InvoiceResource($item),__('Invoice loaded'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }

    /**
     * get single item by id.
     *
     * @param integer $id: integer post id.
     * @return json response.
     */

    public function show($id)
    {
        try {
            $item= $this->repository->show($id);
            return $this->okApiResponse(new InvoiceResource($item),__('Invoice loaded'));
        } catch (QueryException $e) {
            return $this->notFoundApiResponse('',$e->getMessage());
        }
    }
    /**
     * delete post by id.
     *
     * @param integer $id: integer post id.
     * @return json response.
     */
    public function destroy($id)
    {
        try {
            $this->repository->show($id);
            $this->repository->delete($id);
            return $this->okApiResponse('',__('Deleted'));
        } catch (QueryException $e) {
            return $this->notFoundApiResponse('',$e->getMessage());
        }
    }
}
