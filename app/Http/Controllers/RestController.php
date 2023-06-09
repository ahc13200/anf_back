<?php

/**
*@author Amanda  
*@date Wed May 17 21:42:06 GMT-04:00 2023  
*@time Wed May 17 21:42:06 GMT-04:00 2023  
*/




namespace App\Http\Controllers;


use App\Services\Services;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class RestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $modelClass = "";

    /** @var Services $service */
    protected $service = "";

    /**
     * Display a listing of the resource.
     * @return []
     */
    public function process_request(Request $request)
    {
        $parameters = [];
        array_key_exists('relations', $request->request->all()) ? $parameters['relations'] = $request['relations'] : $parameters['relations'] = null;
        array_key_exists('soft_delete', $request->request->all()) ? $parameters['soft_delete'] = $request['soft_delete'] : $parameters['soft_delete'] = null;
        array_key_exists('attr', $request->request->all()) ? $parameters['attr'] = $request['attr'] : $parameters['attr'] = null;
        array_key_exists('eq', $request->request->all()) ? $parameters['attr'] = $request['eq'] : false;
        array_key_exists('select', $request->request->all()) ? $parameters['select'] = $request['select'] : $parameters['select'] = "*";
        array_key_exists('pagination', $request->request->all()) ? $parameters['pagination'] = $request['pagination'] : $parameters['pagination'] = null;
        array_key_exists('orderby', $request->request->all()) ? $parameters['orderby'] = $request['orderby'] : $parameters['orderby'] = null;
        array_key_exists('oper', $request->request->all()) ? $parameters['oper'] = $request['oper'] : $parameters['oper'] = null;

        return $parameters;
    }

    public function index(Request $request)
    {
        $params = $this->process_request($request);
        $result = $this->service->list_all($params);
        return $result;
    }

    /**
     * Display a listing of the resource.
     * @return Json
     */
    public function validate_model(Request $request)
    {
        $params = $request->request->all();
        $scenario = isset($params['_scenario']) ? $params['_scenario'] : "create";
        $specific = isset($params["_specific"]) ? $params["_specific"] : false;
        $response = $this->service->validate_all($params, $scenario, $specific);
        if (!$response['success']) {
            return response($response, 200);
        }
        return $response;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $result = $this->service->create($params);
            if ($result['success'])
                DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $result;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $result = $this->service->update($params, $id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $result;
    }

    public function update_multiple(Request $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();
            $result = $this->service->update_multiple($params);
            if ($result['success'])
                DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $result;
    }

    public function show(Request $request, $id)
    {
        $params = $this->process_request($request);
        return $this->service->show($params, $id);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->service->destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $result;
    }
    public function deletebyid(Request $request)
    {

        $params = $request->all();
        DB::beginTransaction();
        try {
            $result = $this->service->destroybyid($params);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return $result;
    }
}


