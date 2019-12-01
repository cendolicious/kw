<?php
namespace App\Http\Controllers;
use App\Libraries\ChecklistLibrary;
use App\Models\Checklist;
use App\Transformers\ChecklistCreateTransformer;
use App\Transformers\ChecklistTransformer;
use App\Responses\ChecklistResponse;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ChecklistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fractal;
    private $checkListResponse;
    public function __construct()
    {
        $this->fractal = new Manager();
        $this->checkListResponse = new ChecklistResponse();
    }
    /**
     * GET /checklists
     *
     * @return array
     */
    public function getList(){

        $checklist = Checklist::paginate();
        return $this->checkListResponse->generateResponsePagination(ChecklistLibrary::SUCCESS_GET_DATA, $checklist);

    }

    public function getOne($id){
        $checklist = Checklist::find($id);
        return $this->checkListResponse->generateResponse(ChecklistLibrary::SUCCESS_GET_DATA, $checklist);
    }

    public function create(Request $request){
        //validate request parameters
        $this->validate($request, [
            'data.attributes.object_domain' => 'bail|required|max:255',
            'data.attributes.object_id' => 'bail|required',
        ]);
        $checklist = Checklist::create($request->all()['data']['attributes']);
        return $this->checkListResponse->generateResponse(ChecklistLibrary::SUCCESS_CREATE_DATA, $checklist);
    }

    public function update($id, Request $request){
        //validate request parameters
        $this->validate($request, [
            'object_domain' => 'max:255',
        ]);

        //get data by id
        $checklist = Checklist::find($id);
        if($checklist){
            $checklist->update($request->all()['data']['attributes']);
        }
        return $this->checkListResponse->generateResponse(ChecklistLibrary::SUCCESS_UPDATE_DATA, $checklist);
    }

    public function delete($id){

        //get data by id
        $checklist = Checklist::find($id);
        if($checklist){
            $checklist->delete();
        }
        return $this->checkListResponse->generateResponse(ChecklistLibrary::SUCCESS_DELETE_DATA, $checklist, 204);
    }

}