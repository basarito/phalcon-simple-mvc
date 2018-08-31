<?php

use Phalcon\Mvc\Model\Query\Builder as QueryBuilder;

class SearchController extends ControllerBase
{

    public function indexAction()
    {
        $this->assets->addCss('public/css/custom.css');
    }

    public function resultAction()
    {
        $filterByName = $this->request->getPost('filter_by_name');
        $filterByClass = $this->request->getPost('filter_by_class');
        $filterByCompany = $this->request->getPost('filter_by_company');
        $filterByPlace = $this->request->getPost('filter_by_place');

        if(empty($filterByName) && empty($filterByClass) && empty($filterByCompany) && empty($filterByPlace)) {
            $this->flashSession->error("Unesite bar jedan filter za pretragu!");
            $this->response->redirect('search');
        } else {

            $queryBuilder = new QueryBuilder();
            $queryBuilder->columns("member.*, company.*, city.*");
            $queryBuilder->addFrom("Member", "member");
            $queryBuilder->join("Company", "company.company_id = member.company", "company");
            $queryBuilder->join("City", "city.city_id = company.city_id", "city");

            if(!empty($filterByName)) {
                $nameArray = explode(' ', $filterByName);
                if(sizeof($nameArray) > 1) {
                    $queryBuilder->andWhere("member.first_name LIKE :name1: OR member.last_name LIKE :name2: 
                                            OR member.first_name LIKE :name2: OR member.last_name LIKE :name1:",
                        [
                            "name1" => $nameArray[0] . '%',
                            "name2" => $nameArray[1] . '%'
                        ]);
                } else {
                    $queryBuilder->andWhere("member.first_name LIKE :name: OR member.last_name LIKE :name:",
                        [
                            "name" => $filterByName . '%'
                        ]);
                }
            }
            if(!empty($filterByClass)) {
                $queryBuilder->andWhere("member.class = :class:",
                    [
                        "class" => $filterByClass
                    ]);
            }
            if(!empty($filterByCompany)) {
                $queryBuilder->andWhere("company.name LIKE :company:",
                    [
                        "company" => $filterByCompany . '%'
                    ]);
            }
            if(!empty($filterByPlace)) {
                $queryBuilder->andWhere("city.name = :place: OR city.country = :place:",
                    [
                        "place" => $filterByPlace
                    ]);
            }

           $queryBuilder->orderBy("member.last_name ASC");

            $results = $queryBuilder->getQuery()->execute();
            $this->view->results = $results;
            $this->assets->addCss('public/css/custom.css');
        }
    }

}

