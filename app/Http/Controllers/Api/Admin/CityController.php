<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Http\Resources\CityResource;
use App\Repositories\CityRepository;
use Illuminate\Database\QueryException;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class CityController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(CityRepository $repository)
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
        $data['rows'] = CityResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('cities loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\CityRepository
     * @return json response
     */
    public function store(CityRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return $this->createdApiResponse(new CityResource($item),__('cities loaded'));
        } catch (QueryException  $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\CityRepository
     * @return json response
     */
    public function update($id, CityRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return $this->createdApiResponse(new CityResource($item),__('cities updated'));
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
            return $this->okApiResponse(new CityResource($item),__('cities loaded'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
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
            return $this->okApiResponse('',__('city deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage(), 'status'=>'422']);
        }
    }
}