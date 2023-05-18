<?php

namespace Modules\services\Http\Controllers;

use App\Http\Controllers\RestController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Modules\services\Models\Person;

class PersonController extends RestController
{


    /**
     *  PersonController constructor.
     */
    public function __construct()
    {
        $classnamespace = 'Modules\services\Models\Person';
        $classnamespaceservice = 'Modules\services\Services\PersonService';
        $this->modelClass = new $classnamespace;
        $this->service = new $classnamespaceservice(new $classnamespace);
    }

    public function calculos()
    {
        $persons = Person::query()->get()->all();
        $result = new \stdClass();
        $sum = 0;
        $result->prom = 0;
        $result->cantMasc = 0;
        $result->cantFem = 0;
        $edadMay = 0;
        $edadMen = 100000;


        foreach ($persons as $p) {
            /** @var Person $p */
            $sum += $p->age;

            if ($p->sex == "Masculino")
                $result->cantMasc++;
            else
                $result->cantFem++;


            if ($p->age > $edadMay) {
                $edadMay = $p->age;
                $result->nameMay = $p->first_name . " " . $p->last_name;
            }

            if ($p->age < $edadMen) {
                $edadMen = $p->age;
                $result->nameMen = $p->first_name . " " . $p->last_name;
            }
        }

        $result->prom = $sum / count($persons);

        return response()->json($result, 200);
    }

    public function index(Request $request)
    {
        $result = Person::query()->get()->all();
        foreach ($result as $p) {
            $client = new Client();
            $res = $client->request('GET', 'https://api.nationalize.io', ['query' => ['name' => $p->first_name]]);
            $resp = json_decode($res->getBody()->getContents());
            $p->country=count($resp->country)>0?$resp->country[0]->country_id:"Cuba";
        }
        return $result;
    }


}

