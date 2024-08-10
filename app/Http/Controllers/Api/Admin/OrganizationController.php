<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Repositories\OrganizationRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;


class OrganizationController extends Controller
{

    protected $repository;
    use ApiResponse;


    public function __construct(OrganizationRepository $repository)
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
        $data['rows'] = OrganizationResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Organization loaded'));

    }

    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\OrganizationRequest
     * @return json response
     */
    public function store(OrganizationRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if ($request->password)
            {
                $item->password=Hash::make($request->password);
            }
            return $this->createdApiResponse(new OrganizationResource($item),__('Countries loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }

    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateOrganizationRequest
     * @return json response
     */
    public function update($id, OrganizationRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            if ($request->password)
            {
                $item->password=Hash::make($request->password);
            }
            return $this->createdApiResponse(new OrganizationResource($item),__('Countries loaded'));
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
            return $this->okApiResponse(new OrganizationResource($item),__('Countries loaded'));
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
            $this->repository->delete($id);
            return $this->okApiResponse('',__('Organization deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
}
