<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Http\Resources\EventSpecialityResource;
use App\Repositories\EventSpecialityRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventSpecialityController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventSpecialityRepository $repository)
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
        $data['rows'] = EventSpecialityResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('event specialities loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\CountryRequest
     * @return json response
     */
    public function store(Request $request)
    {
        try {
            $item = $this->repository->store($request);
            return $this->createdApiResponse(new EventSpecialityResource($item),__('event specialities loaded'));
        } catch (QueryException  $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatusCode());

        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdateCountryRequest
     * @return json response
     */
    public function update($id, Request $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return response()->json(['item' => $item]);
        } catch (QueryException $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
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
            return $this->okApiResponse(new EventSpecialityResource($item),__('event specialities loaded'));
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
            return $this->okApiResponse('',__('speciality deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}