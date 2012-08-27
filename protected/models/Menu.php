<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 */
class Menu extends CActiveRecord {

    public $children_id;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'menu';
    }

    public function behaviors() {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'ext.vlo.trees.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots' => true,
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, link', 'required'),
            array('lft, rgt, level', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 128),
            array('link', 'length', 'max' => 256),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, link, lft, rgt, level', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('level', 1);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}