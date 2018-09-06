<?php

/**
 * This is the model class for table "entity_answer".
 *
 * The followings are the available columns in table 'entity_answer':
 * @property integer $id
 * @property integer $poll_id
 * @property integer $user_id
 * @property integer $entity_id
 * @property integer $eliminated
 * @property string $hashtag
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property Poll $poll
 * @property User $user
 * @property Entity $entity
 * @property EntityResponse[] $entityResponses
 */
class EntityAnswer extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entity_answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('poll_id, user_id, entity_id, eliminated, hashtag, created_on, updated_on', 'required'),
			array('poll_id, user_id, entity_id, eliminated', 'numerical', 'integerOnly'=>true),
			array('hashtag', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, poll_id, user_id, entity_id, eliminated, hashtag, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'poll' => array(self::BELONGS_TO, 'Poll', 'poll_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'entityResponses' => array(self::HAS_MANY, 'EntityResponse', 'entity_answer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'poll_id' => 'Poll',
			'user_id' => 'User',
			'entity_id' => 'Entity',
			'eliminated' => 'Eliminated',
			'hashtag' => 'Hashtag',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('poll_id',$this->poll_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('eliminated',$this->eliminated);
		$criteria->compare('hashtag',$this->hashtag,true);
		$criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
		$criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntityAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
