<?php

class MemberController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function newAction()
    {
        $companies = Company::find();
        $this->view->companies = $companies;

        $this->assets->addCss('public/css/custom.css');
        $this->assets->addJs('public/js/newMember.js');
    }

    public function saveAction()
    {
        $companyId = $this->request->getPost('company_id');

        switch ($companyId) {
            case 'null':
                $this->flashSession->error("Niste odabrali kompaniju!");
                break;
            case 'new':
                $this->addNewMemberWithCompany();
                break;
            default:
                $this->addNewMember($companyId);
                break;
        }
        $this->response->redirect('member/new');
    }

    private function addNewMember($companyId)
    {
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $dateOfBirth = $this->request->getPost('date_of_birth');
        $class = $this->request->getPost('class');

        $company = Company::findFirst(
            [
                "company_id = :id:",
                "bind" => [
                    "id" => $companyId
                ]
            ]
        );

        if ($company) {
            $member = new Member();
            $member->first_name = $firstName;
            $member->last_name = $lastName;
            $member->date_of_birth = $dateOfBirth;
            $member->class = $class;
            $member->company = $company->company_id;

            if ($member->save()) {
                $this->flashSession->success("Uspešno sačuvan član!");
            } else {
                $this->flashSession->error("Došlo je do greške pri čuvanju člana u bazu!");
            }
        } else {
            $this->flashSession->error("Kompanija ne postoji!");
        }
    }

    private function addNewMemberWithCompany()
    {
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $dateOfBirth = $this->request->getPost('date_of_birth');
        $class = $this->request->getPost('class');
        $companyName = $this->request->getPost('company_name');
        $companyAddress = $this->request->getPost('company_address');
        $companyCity = $this->request->getPost('company_city');
        $companyCountry = $this->request->getPost('company_country');

        //pocetak transakcije
        $this->db->begin();

        $city = City::findFirst(
            [
                "name = :city: AND country = :country:",
                "bind" => [
                    "city" => $companyCity,
                    "country" => $companyCountry
                ]
            ]
        );
        if (!$city) {
            $city = new City();
            $city->name = $companyCity;
            $city->country = $companyCountry;
            if (!$city->save()) {
                $this->db->rollback();
                $this->flashSession->error("Došlo je do greške pri čuvanju grada u bazu!");
                return;
            }
        }
        $company = new Company();
        $company->name = $companyName;
        $company->address = $companyAddress;
        $company->city_id = $city->city_id;

        if ($company->save()) {
            $member = new Member();
            $member->first_name = $firstName;
            $member->last_name = $lastName;
            $member->date_of_birth = $dateOfBirth;
            $member->class = $class;
            $member->company = $company->company_id;

            if ($member->save()) {
                //samo u slucaju da je doslo do ovde moze da se sacuva
                $this->db->commit();
                $this->flashSession->success("Uspešno sačuvan član!");
            } else {
                $this->db->rollback();
                $this->flashSession->error("Došlo je do greške pri čuvanju člana u bazu!");
            }
        } else {
            $this->db->rollback();
            $this->flashSession->error("Došlo je do greške pri čuvanju kompanije u bazu!");
        }
    }

    public function viewAllAction()
    {
        $members = Member::find();
        $this->view->members = $members;
        $this->assets->addCss('public/css/custom.css');
        $this->assets->addJs('public/js/viewMembers.js');
    }

    public function editAction()
    {
        $memberId = $this->request->getPost('member_id');
        $action = $this->request->getPost('action');

        switch ($action) {
            case 'edit':
                $this->editMember($memberId);
                break;
            case 'delete':
                $this->deleteMember($memberId);
                $this->response->redirect('member/view-all');
                break;
        }
    }

    private function deleteMember($memberId)
    {
        $member = Member::findFirst(
            [
                "member_id = :id:",
                "bind" => [
                    "id" => $memberId
                ]
            ]
        );
        if ($member) {
            if ($member->delete()) {
                $this->flashSession->success("Uspešno obrisan član!");
            } else {
                $this->flashSession->error("Došlo je do greške pri brisanju člana!");
            }
        } else {
            $this->flashSession->error("Traženi član ne postoji!");
        }
    }

    private function editMember($memberId)
    {
        $member = Member::findFirst(
            [
                "member_id = :id:",
                "bind" => [
                    "id" => $memberId
                ]
            ]
        );

        if ($member) {
            $companies = Company::find();
            $this->view->member = $member;
            $this->view->companies = $companies;
            $this->assets->addCss('public/css/custom.css');
            $this->assets->addJs('public/js/newMember.js');

        } else {
            $this->flashSession->error("Traženi član ne postoji!");
            $this->response->redirect('member/view-all');
        }
    }

    public function updateAction($memberId)
    {
        $companyId = $this->request->getPost('company_id');
        $member = Member::findFirst(
            [
                "member_id = :id:",
                "bind" => [
                    "id" => $memberId
                ]
            ]
        );

        if ($member) {
            switch ($companyId) {
                case 'null':
                    $this->flashSession->error("Niste odabrali kompaniju!");
                    break;
                case 'new':
                    $this->updateMemberWithCompany($member);
                    break;
                default:
                    $this->updateMember($member, $companyId);
                    break;
            }
        } else {
            $this->flashSession->error("Traženi član ne postoji!");
        }
        $this->response->redirect('member/view-all');
    }

    private function updateMember($member, $companyId)
    {
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $dateOfBirth = $this->request->getPost('date_of_birth');
        $class = $this->request->getPost('class');

        $company = Company::findFirst(
            [
                "company_id = :id:",
                "bind" => [
                    "id" => $companyId
                ]
            ]
        );

        if ($company) {
            $member->first_name = $firstName;
            $member->last_name = $lastName;
            $member->date_of_birth = $dateOfBirth;
            $member->class = $class;
            $member->company = $company->company_id;

            if ($member->update()) {
                $this->flashSession->success("Uspešno sačuvan član!");
            } else {
                $this->flashSession->error("Došlo je do greške pri čuvanju člana u bazu!");
            }
        } else {
            $this->flashSession->error("Kompanija ne postoji!");
        }
    }

    private function updateMemberWithCompany($member)
    {
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');
        $dateOfBirth = $this->request->getPost('date_of_birth');
        $class = $this->request->getPost('class');
        $companyName = $this->request->getPost('company_name');
        $companyAddress = $this->request->getPost('company_address');
        $companyCity = $this->request->getPost('company_city');
        $companyCountry = $this->request->getPost('company_country');

        //pocetak transakcije
        $this->db->begin();

        $city = City::findFirst(
            [
                "name = :name: AND country = :country:",
                "bind" => [
                    "name" => $companyCity,
                    "country" => $companyCountry
                ]
            ]
        );
        if (!$city) {
            $city = new City();
            $city->name = $companyCity;
            $city->country = $companyCountry;
            if (!$city->save()) {
                $this->db->rollback();
                $this->flashSession->error("Došlo je do greške pri čuvanju grada u bazu!");
                return;
            }
        }
        $company = new Company();
        $company->name = $companyName;
        $company->address = $companyAddress;
        $company->city_id = $city->city_id;

        if ($company->save()) {
            $member->first_name = $firstName;
            $member->last_name = $lastName;
            $member->date_of_birth = $dateOfBirth;
            $member->class = $class;
            $member->company = $company->company_id;

            if ($member->update()) {
                //samo u slucaju da je doslo do ovde moze da se sacuva
                $this->db->commit();
                $this->flashSession->success("Uspešno sačuvan član!");
            } else {
                $this->db->rollback();
                $this->flashSession->error("Došlo je do greške pri čuvanju člana u bazu!");
            }
        } else {
            $this->db->rollback();
            $this->flashSession->error("Došlo je do greške pri čuvanju kompanije u bazu!");
        }
    }

}


