<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Repositories\CountryRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class AccompanyingEventTypeController extends Controller
{
  
    protected $repository;
    use ApiResponse;

  
    public function __construct(CountryRepository $repository)
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
        $data['rows'] = CountryResource::collection($items);
        $data['meta'] = [
            'current_page' => $data['rows']->currentPage(),
            'last_page' => $data['rows']->lastPage(),
            'per_page' => $data['rows']->perPage(),
            'total' => $data['rows']->total(),
            ];
        return $this->okApiResponse($data,__('Countries loaded'));

    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\CountryRequest
     * @return json response
     */
    public function store(CountryRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            if($request->flag){
              $item->flag =  $this->saveImage($request->flag,'countries');
                $item->save();
            }
            return $this->createdApiResponse(new CountryResource($item),__('Countries loaded'));
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
    public function update($id, CountryRequest $request)
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
            return $this->okApiResponse(new CountryResource($item),__('Countries loaded'));
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
            return $this->okApiResponse('',__('country deleted'));
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}