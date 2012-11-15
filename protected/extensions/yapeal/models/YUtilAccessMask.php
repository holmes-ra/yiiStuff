<?php

/**
 * This is the model class for table "yapeal_utilAccessMask".
 *
 * The followings are the available columns in table 'yapeal_utilAccessMask':
 * @property string $section
 * @property string $api
 * @property string $description
 * @property string $mask
 * @property integer $status
 */
class YUtilAccessMask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilAccessMask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yapeal_utilAccessMask';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('section, api, mask, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('section', 'length', 'max'=>8),
			array('api', 'length', 'max'=>32),
			array('mask', 'length', 'max'=>20),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('section, api, description, mask, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function scopes()
    {
        return array(
            'char'=>array(
                'condition'=>'section LIKE \'char\'',
                'limit'=> false,
            ),
            'corp'=>array(
                'condition'=>'section=corp',
                'limit'=>false,
            ),
        );
    }

	// returns only rows that are comparable to $bitmask
    public function bitmask($bitmask)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'mask & '.$bitmask,
        ));
        return $this;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'section' => 'Section',
			'api' => 'Api',
			'description' => 'Description',
			'mask' => 'Mask',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('section',$this->section,true);
		$criteria->compare('api',$this->api,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('mask',$this->mask,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}