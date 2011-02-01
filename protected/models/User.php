<?php

class User extends EMongoDocument
{

    public $login;
    public $first_name;
    public $password;

    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    // This method is required!
    public function getCollectionName()
    {
        return 'users';
    }

    public function rules()
    {
        return array(
            array('login, password', 'required'),
            array('login, password', 'length', 'max' => 20),
            array('first_name', 'length', 'max' => 255),
            array('login, first_name, password', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'login' => 'User Login',
            'first_name' => 'First name',
            'password' => 'Password',
        );
    }

    public function init()
    {
        $this->ensureIndexes = false;
    }
    
    public function indexes()
    {
        return array(
        // index name is not important, you may write whatever you want, just must be unique
        'index1_name' => array(
        // key array holds list of fields for index
        // you may define multiple keys for index and multikey indexes
        // each key must have a sorting direction SORT_ASC or SORT_DESC
        'key' => array(
        'login' => EMongoCriteria::SORT_ASC
        ),
        // unique, if indexed field must be unique, define a unique key
        'unique' => true,
        ),
        );
    }

    public function addRandomUser()
    {
        $user = new User();
        $rand = rand(1, 99);
        $user->login='s.'. $rand;
        $user->first_name='something' . $rand;
        $user->password=  substr(md5('something' . $rand), 0, 19);
        if ($user->validate() && !count(User::model()->findByAttributes(array('login'=>$user->login)))) {
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

}