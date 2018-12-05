<?php

class Controller_Api_Search extends Controller_Rest
{


    public function checkAuth()
    {
        //disable for the moment
        //if (!Common::checkPostToken()) throw new HttpNotFoundException;
    }

    public function post_index()
    {
        $this->checkAuth();

        $query = Model_Store::search('radius-search', Input::post());
        $count = current(Model_Store::search('radius-search', Input::post())->select(DB::expr("count(*) as `count`"))->execute()->as_array());

        $pagination = Pagination::forge('store_search', array(
            'total_items'  => (int)$count['count'],
            'per_page'     => (int)Input::post('per_page', 50),
            'current_page' => Input::post('page', 1),
        ));
        $stores = $query->limit($pagination->per_page)->offset($pagination->offset)->execute()->as_array();
        for ($i = 0; $i < count($stores); $i++) {
            $store = Model_Store::find($stores[$i]['id']);
            if(!$store) continue;
            $stores[$i]['categories'] = $store->getCategoriesList();
            $stores[$i]['services'] = $store->getServicesList();
        }
        return array(
            'pagination'   => array(
                'total_items'  => $pagination->total_items,
                'per_page'     => $pagination->per_page,
                'current_page' => $pagination->current_page,
                'total_pages'  => ceil($pagination->total_items / $pagination->per_page),
            ),
            'max_distance' => Model_Setting::getValueByKey('max_distance'),
            'stores'       => $stores,
            'content'      => Model_Store::getSearchContent(Input::post()),
        );
    }

    public function post_countries()
    {
        $this->checkAuth();
        $countries = DB::select('countries.iso2', 'countries.iso3')->from('stores')
            ->join('countries')->on('stores.country', '=', 'countries.iso2')
            ->group_by('stores.country')
            ->execute()->as_array();
        return array('countries' => $countries);
    }

    public function post_us_states()
    {
        $this->checkAuth();
        $states = DB::select('states.name', 'states.short_name')->from('stores')
            ->join('states')->on('states.short_name', '=', 'stores.administrative_area_level_1')
            ->where('stores.country', '=', 'US')
            ->group_by('stores.administrative_area_level_1')
            ->execute()->as_array();
        return array('states' => $states);
    }

    public function post_store()
    {
        $this->checkAuth();
        return Model_Store::find((int)Input::post('id'))->to_array();
    }

    public function post_map_data()
    {
        $this->checkAuth();
        //$query = DB::select('id','latitude','longitude','phone','address','administrative_area_level_1','administrative_area_level_2','postal_code','name','country')->from('stores');
        $query = DB::select('id', 'latitude', 'longitude')->from('stores');

        if (Input::post('administrative_area_level_1')) {
            $query->where('administrative_area_level_1', Input::post('administrative_area_level_1'));
        }
        if (Input::post('country')) {
            $query->where('country', Input::post('country'));
        }
        return array("stores" => $query->execute()->as_array());

    }

    public function action_map_settings()
    {
        return Model_Setting::getMapSettings();
    }

}
