<?php

class Model_Store extends \Orm\Model
{

    protected static $_table_name = 'stores';

    protected static $_properties = array(
        'id'                          => array(
            'data_type'  => 'int',
            'label'      => 'Id',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'name'                        => array(
            'data_type'  => 'varchar',
            'label'      => 'Name',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'email'                       => array(
            'data_type'  => 'varchar',
            'label'      => 'Email',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'website'                     => array(
            'data_type' => 'varchar',
            'label'     => 'website',
        ),
        'phone'                       => array(
            'data_type'  => 'varchar',
            'label'      => 'Phone',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'fax'                         => array(
            'data_type'  => 'varchar',
            'label'      => 'Fax',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'address'                     => array(
            'data_type'  => 'varchar',
            'label'      => 'Address',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'locality'                    => array(
            'data_type'  => 'varchar',
            'label'      => 'Locality',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'administrative_area_level_2' => array(
            'data_type'  => 'varchar',
            'label'      => 'Administrative area level 2',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'administrative_area_level_1' => array(
            'data_type'  => 'varchar',
            'label'      => 'Administrative area level 1',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'postal_code'                 => array(
            'data_type'  => 'varchar',
            'label'      => 'Postal code',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'country'                     => array(
            'data_type'  => 'varchar',
            'label'      => 'Country',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 255,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 255,
            ),
        ),
        'latitude'                    => array(
            'data_type'  => 'varchar',
            'label'      => 'Latitude',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 60,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 60,
            ),
        ),
        'longitude'                   => array(
            'data_type'  => 'varchar',
            'label'      => 'Longitude',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 60,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 60,
            ),
        ),
        'hours'                       => array(
            'data_type' => 'text',
            'label'     => 'Hours',
            'null'      => true,
        ),
        'description'                 => array(
            'data_type' => 'text',
            'label'     => 'Description',
            'null'      => true,
        ),
        'created_at'                  => array(
            'data_type'  => 'int',
            'label'      => 'Created at',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'updated_at'                  => array(
            'data_type'  => 'int',
            'label'      => 'Updated at',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => false,
            ),
        ),
        'user_id'                     => array(
            'data_type'  => 'int',
            'label'      => 'User id',
            'null'       => false,
            'validation' => array(
                0             => 'required',
                'numeric_min' => array(
                    0 => -2147483648,
                ),
                'numeric_max' => array(
                    0 => 2147483647,
                ),
            ),
            'form'       => array(
                'type' => 'number',
                'min'  => -2147483648,
                'max'  => 2147483647,
            ),
        ),
        'image'                       => array(
            'data_type' => 'varchar',
            'label'     => 'image',
        ),
        'twitter'                     => array(
            'data_type' => 'varchar',
            'label'     => 'twitter',
        ),
        'youtube'                     => array(
            'data_type' => 'varchar',
            'label'     => 'youtube',
        ),
        'googleplus'                  => array(
            'data_type' => 'varchar',
            'label'     => 'googleplus',
        ),
        'linkedin'                    => array(
            'data_type' => 'varchar',
            'label'     => 'linkedin',
        ),
        'pinterest'                   => array(
            'data_type' => 'varchar',
            'label'     => 'pinterest',
        ),
        'instagram'                   => array(
            'data_type' => 'varchar',
            'label'     => 'instagram',
        ),

        'facebook'                   => array(
            'data_type' => 'varchar',
            'label'     => 'facebook',
        ),
    );

    protected static $_observers = array(
        'Orm\\Observer_Self'      => array(
            'events' => array('after_save', 'before_save'),
        ),
        'Orm\Observer_Validation' => array(
            'events' => array('before_save'),
        ),
        'Orm\Observer_Typing'     => array(
            'events' => array('before_save', 'after_save', 'after_load'),
        ),
        'Orm\Observer_CreatedAt'  => array(
            'events'          => array('before_insert'),
            'mysql_timestamp' => false,
            'property'        => 'created_at',
        ),
        'Orm\Observer_UpdatedAt'  => array(
            'events'          => array('before_save'),
            'mysql_timestamp' => false,
            'property'        => 'updated_at',
        ),
    );


    public static function getPropertyKeys()
    {
        return array_keys(self::$_properties);
    }

    public function _event_before_save()
    {
        if (!$this->user_id) {
            $this->user_id = Model_User::getCurrent()->id;
        }

        if ($this->website) {
            $this->website = str_replace(array('http://', 'https://', '//'), '', $this->website);
        }

        $this->created_at = $this->created_at ? $this->created_at : time();
        $this->updated_at = time();
    }

    public function getLatLngStatus()
    {
        if ($this->latitude && $this->longitude) return true;
        return false;
    }

    public function getWebsite()
    {
        return str_replace(array('http://', 'https://', '//'), '', $this->website);
    }

    public function hasContent($id)
    {
        return Model_ContentToStores::query()
            ->where('store_id', $this->id)
            ->where('content_id', $id)->get_one();
    }

    public function getServices()
    {
        $items = Model_ContentToStores::query()
            ->where('content_parent_id', Model_Content::SERVICE_ID)
            ->where('store_id', $this->id)->get();
        return $items;
    }

    public function getCategories()
    {
        $items = Model_ContentToStores::query()
            ->where('content_parent_id', Model_Content::CAT_ID)
            ->where('store_id', $this->id)->get();
        return $items;
    }

    public function getServicesList()
    {
        $items = Model_ContentToStores::query()
            ->where('content_parent_id', Model_Content::SERVICE_ID)
            ->where('store_id', $this->id)->get();
        $list = array();
        foreach ($items as $item) {
            $list[] = "<i class='" . ($item->content->icon ? $item->content->icon : "fa fa-tags") . "'></i> {$item->content->title}<br>";
        }
        return $list;
    }

    public function getCategoriesList()
    {
        $items = Model_ContentToStores::query()
            ->where('content_parent_id', Model_Content::CAT_ID)
            ->where('store_id', $this->id)->get();
        $list = array();
        foreach ($items as $item) {
            $list[] = "<i class='" . ($item->content->icon ? $item->content->icon : "fa fa-tags") . "'></i> {$item->content->title}<br>";
        }
        return $list;
    }


    public static function getSearchContent($params = array())
    {
        if (!empty($params['store']) && ($store = self::find($params['store']))) {
            return array(
                'services'   => $store->getServicesList(),
                'categories' => $store->getCategoriesList()
            );
        }
        return null;
    }

    public static function search($scenario = 'browse', $params = array())
    {
        switch ($scenario) {
            case "radius-search":
                $query = DB::select()->from('stores');
                break;
            default:
                $query = Model_Store::query();

        }

        if (!empty($params['cats']) && empty($params['store'])) {
            $params['cats'] = explode(",", urldecode($params['cats']));
            $query->join('content_to_stores')->on('stores.id', '=', 'content_to_stores.store_id');
            foreach ($params['cats'] as $catId) {
                $query->where('content_to_stores.content_id', '=', $catId);
            }
        }

        if (!empty($params['name'])) {
            $query->where('name', 'LIKE', '%' . $params['name'] . '%');
        }

        $metric = Model_Setting::getValueByKey('default_county') == "US" ? "mi" : "km";

        if (!empty($params['iso2'])) {
            $query->where('country', $params['iso2']);
            if ($params['iso2'] == "US") $metric = "mi";
        }

        //add map search (lat,lng)
        if (!empty($params['latitude']) && !empty($params['longitude'])) {
            $earthRadius = ($metric == "mi" ? 3959 : 6371);
            $distance = "({$earthRadius} * acos(cos(radians({lat})) * cos(radians(latitude)) * cos(radians(longitude) - radians({lng})) + sin(radians({lat})) * sin(radians(latitude))))";
            $distance = str_replace(array('{lat}', '{lng}'), array(
                (float)$params['latitude'],
                (float)$params['longitude']
            ), $distance);
            $query->select('*', DB::expr($distance . ' as distance'), DB::expr("'$metric' as `metric`"));
            $query->where(DB::expr($distance), '<=', (int)Model_Setting::getValueByKey('max_distance'));
            //$query->order_by('distance');
            $query->order_by('name');
        }

        foreach (self::$_properties as $key => $value) {
            $key = gettype($key) != "string" ? $value : $key;
            if (in_array($key, array('name', 'iso2', 'latitude', 'longitude'))) continue;
            if (!empty($params[$key])) {
                $query->where($key, 'LIKE', "%{$params[$key]}%");
            }
        }


        return $query;
    }

}