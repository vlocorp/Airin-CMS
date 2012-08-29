<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $website
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Post $post
 * @property User $user
 */
class Comment extends CActiveRecord {

    public $verifyCode;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'comment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('comment', 'required'),
            array('email', 'email'),
            array('website', 'url'),
            array('post_id, user_id', 'numerical', 'integerOnly' => true),
            array('name, email', 'length', 'max' => 128),
            array('website', 'length', 'max' => 256),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, post_id, user_id, name, email, website, comment', 'safe', 'on' => 'search'),
        );
    }

    public function beforeValidate() {
        if (Yii::app()->user->isGuest) {
            $this->validatorList->add(Yii::createComponent(array(
                        'class' => 'CRequiredValidator',
                        'attributes' => array('name', 'email'),
                    )));
        }

        return parent::beforeValidate();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'post_id' => 'Post',
            'user_id' => 'User',
            'name' => 'Name',
            'email' => 'Email',
            'website' => 'Website',
            'comment' => 'Comment',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('post_id', $this->post_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}