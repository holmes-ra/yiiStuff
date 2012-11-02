<?php

/**
 * This is the model class for table "yapeal_corpIndustryJobs".
 *
 * The followings are the available columns in table 'yapeal_corpIndustryJobs':
 * @property string $ownerID
 * @property integer $activityID
 * @property string $assemblyLineID
 * @property string $beginProductionTime
 * @property string $charMaterialMultiplier
 * @property string $charTimeMultiplier
 * @property integer $completed
 * @property integer $completedStatus
 * @property integer $completedSuccessfully
 * @property string $containerID
 * @property string $containerLocationID
 * @property string $containerTypeID
 * @property string $endProductionTime
 * @property string $installedInSolarSystemID
 * @property string $installedItemCopy
 * @property integer $installedItemFlag
 * @property string $installedItemID
 * @property string $installedItemLicensedProductionRunsRemaining
 * @property string $installedItemLocationID
 * @property string $installedItemMaterialLevel
 * @property string $installedItemProductivityLevel
 * @property string $installedItemQuantity
 * @property string $installedItemTypeID
 * @property string $installerID
 * @property string $installTime
 * @property string $jobID
 * @property string $licensedProductionRuns
 * @property string $materialMultiplier
 * @property integer $outputFlag
 * @property string $outputLocationID
 * @property string $outputTypeID
 * @property string $pauseProductionTime
 * @property string $runs
 * @property string $timeMultiplier
 */
class YCorpIndustryJobs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpIndustryJobs the static model class
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
		return 'yapeal_corpIndustryJobs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, activityID, assemblyLineID, beginProductionTime, charMaterialMultiplier, charTimeMultiplier, completed, completedStatus, completedSuccessfully, containerID, containerLocationID, containerTypeID, endProductionTime, installedInSolarSystemID, installedItemCopy, installedItemFlag, installedItemID, installedItemLicensedProductionRunsRemaining, installedItemLocationID, installedItemMaterialLevel, installedItemProductivityLevel, installedItemQuantity, installedItemTypeID, installerID, installTime, jobID, licensedProductionRuns, materialMultiplier, outputFlag, outputLocationID, outputTypeID, pauseProductionTime, runs, timeMultiplier', 'required'),
			array('activityID, completed, completedStatus, completedSuccessfully, installedItemFlag, outputFlag', 'numerical', 'integerOnly'=>true),
			array('ownerID, assemblyLineID, containerID, containerLocationID, containerTypeID, installedInSolarSystemID, installedItemCopy, installedItemID, installedItemLicensedProductionRunsRemaining, installedItemLocationID, installedItemMaterialLevel, installedItemProductivityLevel, installedItemQuantity, installedItemTypeID, installerID, jobID, licensedProductionRuns, outputLocationID, outputTypeID, runs', 'length', 'max'=>20),
			array('charMaterialMultiplier, charTimeMultiplier, materialMultiplier, timeMultiplier', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, activityID, assemblyLineID, beginProductionTime, charMaterialMultiplier, charTimeMultiplier, completed, completedStatus, completedSuccessfully, containerID, containerLocationID, containerTypeID, endProductionTime, installedInSolarSystemID, installedItemCopy, installedItemFlag, installedItemID, installedItemLicensedProductionRunsRemaining, installedItemLocationID, installedItemMaterialLevel, installedItemProductivityLevel, installedItemQuantity, installedItemTypeID, installerID, installTime, jobID, licensedProductionRuns, materialMultiplier, outputFlag, outputLocationID, outputTypeID, pauseProductionTime, runs, timeMultiplier', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ownerID' => 'Owner',
			'activityID' => 'Activity',
			'assemblyLineID' => 'Assembly Line',
			'beginProductionTime' => 'Begin Production Time',
			'charMaterialMultiplier' => 'Char Material Multiplier',
			'charTimeMultiplier' => 'Char Time Multiplier',
			'completed' => 'Completed',
			'completedStatus' => 'Completed Status',
			'completedSuccessfully' => 'Completed Successfully',
			'containerID' => 'Container',
			'containerLocationID' => 'Container Location',
			'containerTypeID' => 'Container Type',
			'endProductionTime' => 'End Production Time',
			'installedInSolarSystemID' => 'Installed In Solar System',
			'installedItemCopy' => 'Installed Item Copy',
			'installedItemFlag' => 'Installed Item Flag',
			'installedItemID' => 'Installed Item',
			'installedItemLicensedProductionRunsRemaining' => 'Installed Item Licensed Production Runs Remaining',
			'installedItemLocationID' => 'Installed Item Location',
			'installedItemMaterialLevel' => 'Installed Item Material Level',
			'installedItemProductivityLevel' => 'Installed Item Productivity Level',
			'installedItemQuantity' => 'Installed Item Quantity',
			'installedItemTypeID' => 'Installed Item Type',
			'installerID' => 'Installer',
			'installTime' => 'Install Time',
			'jobID' => 'Job',
			'licensedProductionRuns' => 'Licensed Production Runs',
			'materialMultiplier' => 'Material Multiplier',
			'outputFlag' => 'Output Flag',
			'outputLocationID' => 'Output Location',
			'outputTypeID' => 'Output Type',
			'pauseProductionTime' => 'Pause Production Time',
			'runs' => 'Runs',
			'timeMultiplier' => 'Time Multiplier',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('activityID',$this->activityID);
		$criteria->compare('assemblyLineID',$this->assemblyLineID,true);
		$criteria->compare('beginProductionTime',$this->beginProductionTime,true);
		$criteria->compare('charMaterialMultiplier',$this->charMaterialMultiplier,true);
		$criteria->compare('charTimeMultiplier',$this->charTimeMultiplier,true);
		$criteria->compare('completed',$this->completed);
		$criteria->compare('completedStatus',$this->completedStatus);
		$criteria->compare('completedSuccessfully',$this->completedSuccessfully);
		$criteria->compare('containerID',$this->containerID,true);
		$criteria->compare('containerLocationID',$this->containerLocationID,true);
		$criteria->compare('containerTypeID',$this->containerTypeID,true);
		$criteria->compare('endProductionTime',$this->endProductionTime,true);
		$criteria->compare('installedInSolarSystemID',$this->installedInSolarSystemID,true);
		$criteria->compare('installedItemCopy',$this->installedItemCopy,true);
		$criteria->compare('installedItemFlag',$this->installedItemFlag);
		$criteria->compare('installedItemID',$this->installedItemID,true);
		$criteria->compare('installedItemLicensedProductionRunsRemaining',$this->installedItemLicensedProductionRunsRemaining,true);
		$criteria->compare('installedItemLocationID',$this->installedItemLocationID,true);
		$criteria->compare('installedItemMaterialLevel',$this->installedItemMaterialLevel,true);
		$criteria->compare('installedItemProductivityLevel',$this->installedItemProductivityLevel,true);
		$criteria->compare('installedItemQuantity',$this->installedItemQuantity,true);
		$criteria->compare('installedItemTypeID',$this->installedItemTypeID,true);
		$criteria->compare('installerID',$this->installerID,true);
		$criteria->compare('installTime',$this->installTime,true);
		$criteria->compare('jobID',$this->jobID,true);
		$criteria->compare('licensedProductionRuns',$this->licensedProductionRuns,true);
		$criteria->compare('materialMultiplier',$this->materialMultiplier,true);
		$criteria->compare('outputFlag',$this->outputFlag);
		$criteria->compare('outputLocationID',$this->outputLocationID,true);
		$criteria->compare('outputTypeID',$this->outputTypeID,true);
		$criteria->compare('pauseProductionTime',$this->pauseProductionTime,true);
		$criteria->compare('runs',$this->runs,true);
		$criteria->compare('timeMultiplier',$this->timeMultiplier,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}