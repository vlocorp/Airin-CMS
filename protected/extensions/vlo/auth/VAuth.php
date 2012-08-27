<?php

class VAuth extends CComponent {

    /**
     * to generate users by group    
     */
    public static function getUsers($group_id=null) {
        //set group id from getGroupId if there is no input from param
        if(!$group_id)
            $group_id = self::getGroupId();

        //if group_id return null, then return null array
       if(!$group_id)
            return array('');

        $models = User::model()->findAllByAttributes(array(
            'group_id' => $group_id,
                ));

        $data = array();
        $i = 0;
        foreach ($models as $model) {
            $data[$i] = $model->username;
            $i++;
        }
        return $data;
    }

    /**
     * to get list of actions by classname and group id
     */
    public static function getActions($className='default',$group_id=null){                
        //set group id from getGroupId if there is no input from param
        if(!$group_id)
           $group_id = self::getGroupId();

       //if group_id return null, then return null array
       if(!$group_id)
            return array('');

        $model = GroupAuth::model()->findByAttributes(array(
            'className'=>$className,
            'group_id'=>$group_id,
        ))->action;
        
        $model = trim($model);
        
        $arrayModels = explode(',', $model);
        $data = array();        

        for($i=0;$i<sizeof($arrayModels);$i++){         
            $data[$i] = $arrayModels[$i];
        }       
        return $data;        
    }

    /**
     * to get user by login id
     */
    public static function getGroupId(){
        $user_id = Yii::app()->user->id;

        if($user_id)
            return User::model()->findByPk($user_id)->group_id;        
    }




}
