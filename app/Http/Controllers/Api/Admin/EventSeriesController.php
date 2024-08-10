<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Http\Resources\EventSeriesResource;
use App\Repositories\EventSeriesRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class EventSeriesController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(EventSeriesRepository $repository)
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
        $data['rows'] = EventSeriesResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Events  Series loaded'));

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
          
            return $this->createdApiResponse(new EventSeriesResource($item),__('Events Series loaded'));
        } catch (QueryException  $e) {
            return $this->errorApiResponse($e->getMessage(), $e->getStatus());

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
            return $this->okApiResponse(new EventSeriesResource($item),__('Event Series loaded'));
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
            return $this->okApiResponse('',__('Event Series deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}