<?php

namespace Daaner\NovaPoshta\Models;

use Daaner\NovaPoshta\NovaPoshta;
use Daaner\NovaPoshta\Traits\Limit;
use Daaner\NovaPoshta\Traits\WarehousesFilter;

class Address extends NovaPoshta
{
    use Limit, WarehousesFilter;

    protected $model = 'Address';
    protected $calledMethod;
    protected $methodProperties = [];

    public function getAreas()
    {
        $this->calledMethod = 'getAreas';
        $this->methodProperties = null;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getCities($cityRef = '', $findByString = false)
    {
        $this->calledMethod = 'getCities';
        $this->addLimit();
        $this->getPage();

        if ($cityRef) {
            if ($findByString) {
                $this->methodProperties['FindByString'] = $cityRef;
            } else {
                $this->methodProperties['Ref'] = $cityRef;
            }
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getWarehouses($cityRef, $getByCityName = false)
    {
        $this->calledMethod = 'getWarehouses';
        $this->getTypeOfWarehouseRef();

        if ($getByCityName) {
            $this->methodProperties['CityName'] = $cityRef;
        } else {
            $this->methodProperties['CityRef'] = $cityRef;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getWarehouseTypes($cityRef, $getByCityName = false)
    {
        $this->calledMethod = 'getWarehouseTypes';

        if ($getByCityName) {
            $this->methodProperties['CityName'] = $cityRef;
        } else {
            $this->methodProperties['CityRef'] = $cityRef;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getWarehouseSettlements($settlementRef)
    {
        $this->calledMethod = 'getWarehouses';
        $this->getTypeOfWarehouseRef();

        $this->methodProperties['SettlementRef'] = $settlementRef;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function searchSettlements($search)
    {
        $this->calledMethod = 'searchSettlements';
        $this->addLimit();

        $this->methodProperties['CityName'] = $search;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function searchSettlementStreets($ref, $street = null)
    {
        $this->calledMethod = 'searchSettlementStreets';
        $this->addLimit();

        $this->methodProperties['SettlementRef'] = $ref;
        $this->methodProperties['StreetName'] = $street;

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    public function getStreet($cityRef = '', $findByString = false)
    {
        $this->calledMethod = 'getStreet';
        $this->addLimit();
        $this->getPage();


        if ($findByString) {
            $this->methodProperties['FindByString'] = $cityRef;
        } else {
            $this->methodProperties['CityRef'] = $cityRef ?: null;
        }

        return $this->getResponse($this->model, $this->calledMethod, $this->methodProperties);
    }

    //Counterparty API
    public function save()
    {
        $this->calledMethod = 'save';
    }

    public function update()
    {
        $this->calledMethod = 'update';
    }

    public function delete()
    {
        $this->calledMethod = 'delete';
    }
}
