<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Neighborhood;
use App\Models\Street;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use function Sodium\add;

class WarehouseEditPage extends Component
{
    public $warehouse;

    public $address;
    public $delete_modal = false;

    public $name = null;

    public $country = null;

    public $countries = [];

    public $city = null;

    public $cities = [];

    public $district = null;

    public $districts = [];

    public $neighborhood = null;

    public $neighborhoods = [];

    public $street = null;

    public $streets = [];

    public $lat = null;

    public $lng = null;

    public function mount($warehouse_id = null)
    {
        $this->countries = Country::all();
        if ($warehouse_id) {
            if (Warehouse::where("id", $warehouse_id)->count() == 0) {
                $this->redirect("/warehouses");
                return;
            }
            $this->warehouse = Warehouse::where("id", $warehouse_id)->first();
            $this->address = $this->warehouse->address;
            if ($this->warehouse->team_id!=Auth::user()->currentTeam->id){
                $this->redirect("/warehouses");
            }
            $this->name = $this->warehouse->name;
            $this->country = $this->warehouse->address->country_id;
            $this->city = $this->warehouse->address->city_id;
            $this->cities = City::where("country_id", $this->country)->get();
            $this->district = $this->warehouse->address->district_id;
            $this->districts = District::where("city_id", $this->city)->get();
            $this->neighborhood = $this->warehouse->address->neighborhood_id;
            if ($this->district) {
                $this->neighborhoods = Neighborhood::where("district_id", $this->district)->get();
            }
            $this->street = $this->warehouse->address->street_id;
            if ($this->neighborhood) {
                $this->streets = Street::where("neighborhood_id", $this->neighborhood)->get();
            }
            $this->lat = $this->warehouse->latitude;
            $this->lng = $this->warehouse->longitude;

        } else {
            $this->warehouse = new Warehouse();
            $this->address=new Address();
        }
    }

    public function selectCountry()
    {
        if ($this->country) {
            $this->cities = City::where("country_id", $this->country)->get();
        }
    }

    public function selectCity()
    {
        if ($this->country) {
            $this->districts = District::where("city_id", $this->city)->get();
        }
    }

    public function selectDistrict()
    {
        if ($this->country) {
            $this->neighborhoods = Neighborhood::where("district_id", $this->district)->get();
        }
    }

    public function selectNeighborhood()
    {
        if ($this->country) {
            $this->streets = Street::where("neighborhood_id", $this->neighborhood)->get();
        }
    }

    public function back()
    {
        $this->redirect("/warehouses");
    }

    public function save()
    {
        if (!$this->name) {
            $this->addError('form', __('Plesase set name!'));
            return;
        }
        if (!$this->country) {
            $this->addError('form', __('Plesase select country!'));
            return;
        }
        if (!$this->city) {
            $this->addError('form', __('Plesase select city!'));
            return;
        }
        if (!$this->district) {
            $this->addError('form', __('Plesase select District!'));
            return;
        }
        if (!$this->neighborhood) {
            $this->addError('form', __('Plesase select Neighborhood!'));
            return;
        }
        $this->warehouse->team_id=Auth::user()->currentTeam->id;
        $this->warehouse->name = $this->name;
        $this->warehouse->latitude = $this->lat;
        $this->warehouse->longitude = $this->lng;

        $this->address->country_id = $this->country;
        $this->address->city_id = $this->city;
        $this->address->district_id = $this->district;
        $this->address->neighborhood_id = $this->neighborhood;
        $this->address->street_id = $this->street;
        DB::beginTransaction();
        if (!$this->address->save()) {
            $this->addError('form', __('Can not saved!'));
            DB::rollBack();
            return;
        }
        $this->warehouse->address_id=$this->address->id;
        if (!$this->warehouse->save()) {
            $this->addError('form', __('Can not saved!'));
            DB::rollBack();
            return;
        }
        DB::commit();
        session()->flash('success', str_replace("?", $this->warehouse->name, __("Warehouse ? has been saved!")));
        $this->redirect("/warehouse/" . $this->warehouse->id);
    }

    public function delete(){
        $this->delete_modal = false;
        DB::beginTransaction();

        if(!$this->warehouse->delete()){
            DB::rollBack();
            $this->addError('form', __('Can not deleted!'));
            return;
        }
        if(!$this->warehouse->address->delete()){
            DB::rollBack();
            $this->addError('form', __('Can not deleted!'));
            return;
        }
        DB::commit();
        session()->flash('success',str_replace("?", $this->warehouse->name, __("Warehouse ? has been deleted!")));
        $this->redirect("/warehouses");
    }

    public function removeFormError()
    {
        $this->resetErrorBag('form');
    }

    public function render()
    {
        return view('livewire.warehouse-edit-page');
    }
}
