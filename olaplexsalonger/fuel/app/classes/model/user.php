<?php

class Model_User extends \Orm\Model
{
    const USER_GROUP_ADMIN = 100;


    protected static $_table_name = 'users';

    protected static $_properties = array(
        'id'             => array(
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
        'first_name'     => array(
            'data_type'  => 'text',
            'label'      => 'First name',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 65535,
                ),
            ),
            'form'       => array(
                'type' => 'textarea',
            ),
        ),
        'last_name'      => array(
            'data_type'  => 'text',
            'label'      => 'Last name',
            'null'       => true,
            'validation' => array(
                'max_length' => array(
                    0 => 65535,
                ),
            ),
            'form'       => array(
                'type' => 'textarea',
            ),
        ),
        'username'       => array(
            'data_type'  => 'varchar',
            'label'      => 'Username',
            'null'       => false,
            'validation' => array(
                0            => 'required',
                'max_length' => array(
                    0 => 50,
                ),
            ),
            'form'       => array(
                'type'      => 'text',
                'maxlength' => 50,
            ),
        ),
        'password'       => array(
            'data_type'  => 'varchar',
            'label'      => 'Password',
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
        'group'          => array(
            'data_type'  => 'int',
            'label'      => 'Group',
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
        'email'          => array(
            'data_type'  => 'varchar',
            'label'      => 'Email',
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
        'last_login'     => array(
            'data_type'  => 'int',
            'label'      => 'Last login',
            'null'       => true,
            'validation' => array(
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
        'login_hash'     => array(
            'data_type'  => 'varchar',
            'label'      => 'Login hash',
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
        'created_at'     => array(
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
        'updated_at'     => array(
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
        'profile_fields' => array(
            'label' => 'Profile Fields',
        )
    );

    protected static $_observers = array(

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

    public static function getCurrent()
    {
        if (!($email = Auth::get_email())) return null;
        return self::query()->where('email', $email)->get_one();
    }

    public static function isAdmin($user = null)
    {
        $user = !$user ? self::getCurrent() : $user;
        if (!$user) return false;
        if ($user->group != self::USER_GROUP_ADMIN) return false;
        return true;
    }

    public static function logout($redirect = true)
    {
        Auth::logout();
        if ($redirect) {
            Response::redirect('admin/login');
        }
    }

    public static function gravator($user)
    {
        $defaultImage = Theme::instance()->asset->get_file('avatar.png', 'img');
        return sprintf("https://www.gravatar.com/avatar/%s?d=%s", md5(strtolower($user->email)), urlencode($defaultImage));
    }

    public function getGravator($opts = null)
    {
        return Html::img($this->gravator($this), $opts);
    }

    public static function getPropertyKeys()
    {
        return array_keys(self::$_properties);
    }

    public static function search($scenario = 'browse', $params = array())
    {
        $query = self::query();

        foreach (self::$_properties as $key => $value) {
            $key = gettype($key) != "string" ? $value : $key;
            if (!empty($params[$key])) {
                $query->where($key, 'LIKE', "%{$params[$key]}%");
            }
        }

        return $query;
    }

    public static function validate($factory)
    {
        $val = Validation::forge($factory);

        $val->add_field('first_name', 'First Name', 'required|max_length[255]');
        $val->add_field('last_name', 'Last Name', 'required|max_length[255]');


        switch ($factory) {
            case "create":
                $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
                $val->add_field('confirm_password', 'Confirm Password', 'required|max_length[255]');
                $val->add_field('password', 'Password', 'required|max_length[255]|match_field[confirm_password]');
                break;
            case "edit":
                $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
                $val->add_field('old_password', 'Old Password', 'max_length[255]');
                $val->add_field('confirm_password', 'Confirm Password', 'required_with[old_password]|max_length[255]');
                $val->add_field('password', 'Password', 'required_with[old_password]|max_length[255]|match_field[confirm_password]');
                break;
        }

        return $val;
    }

}