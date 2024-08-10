<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationLegalFormRequest;
use App\Http\Resources\OrganizationLegalFormResource;
use App\Repositories\OrganizationLegalFormRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class OrganizationLegalFormController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(OrganizationLegalFormRepository $repository)
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
        $data['rows'] = OrganizationLegalFormResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Legal Form loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\OrganizationLegalFormRequest
     * @return json response
     */
    public function store(OrganizationLegalFormRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return $this->createdApiResponse(new OrganizationLegalFormResource($item),__('Legal Form loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateOrganizationLegalFormRequest
     * @return json response
     */
    public function update($id, OrganizationLegalFormRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->okApiResponse(new OrganizationLegalFormResource($item),__('Legal Form loaded'));
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
            return $this->okApiResponse(new OrganizationLegalFormResource($item),__('Legal Form loaded'));
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
            return $this->okApiResponse('',__('Legal Form deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
}