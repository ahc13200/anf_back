<?php


namespace Modules\services\Services;


use App\Services\Services;

class PersonService extends Services
{

 public function __construct()
  {
      parent::__construct('Modules\services\Models\Person');
   }

}

