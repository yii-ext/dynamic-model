<?php
/**
 * Class DynamicModel
 * Allows to use AR withour specific model.
 * @author  Dmitry Semenov <disemx@gmail.com>
 * @version 0.1
 * @package DynamicModel
 */
namespace yii-ext\dynamic-model;

class DynamicModel extends \CActiveRecord
{
    /**
     * @var string
     */
    protected $_tableName;

    /**
     * Table meta-data.Must redeclare (parent::_md is private).
     * @var object CActiveRecordMetaData
     */
    protected $_md;


    /**
     * Returns table name
     * @return string
     */
    public function tableName()
    {
        return $this->_tableName;
    }

    /**
     * Preventing using DynamicModel as usual model. Setting table name for model actions.
     *
     * @param string $tableName
     * @param string $scenario
     *
     * @return DynamicModel
     * @throws \CException
     */
    public static function model($tableName, $scenario = 'insert')
    {
        if ($tableName === null) {
            throw new \CException('Can\'t use DynamicModel without table name.');
        }
        return new DynamicModel($scenario, $tableName);
    }

    /**
     * Constructor
     *
     * @param string $scenario (defaults to 'insert')
     * @param string $tableName
     *
     * @throws \CException
     */
    public function __construct($scenario = 'insert', $tableName = null)
    {
        if ($tableName === null) {
            throw new \CException('Can\'t use DynamicModel without table name.');
        }
        $this->_tableName = $tableName;
        parent::__construct($scenario);
    }

    /**
     * Overrides default instantiation logic.
     * Instantiates AR class by providing table name
     *
     * @param array
     *
     * @return DynamicModel
     */
    protected function instantiate($attributes)
    {
        return new DynamicModel(null, $this->tableName());
    }


    /**
     * Returns meta-data for this DB table
     * @see CActiveRecord::getMetaData()
     * @return mixed CActiveRecordMetaData|string
     */
    public function getMetaData()
    {
        if ($this->_md !== null) {
            return $this->_md;
        } else {
            return $this->_md = new \CActiveRecordMetaData($this);
        }
    }

}s
