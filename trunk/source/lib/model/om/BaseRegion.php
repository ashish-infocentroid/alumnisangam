<?php


abstract class BaseRegion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;

	
	protected $collChapterregions;

	
	protected $lastChapterregionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RegionPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = RegionPeer::NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Region object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RegionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RegionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RegionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RegionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RegionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collChapterregions !== null) {
				foreach($this->collChapterregions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = RegionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collChapterregions !== null) {
					foreach($this->collChapterregions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RegionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RegionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RegionPeer::DATABASE_NAME);

		if ($this->isColumnModified(RegionPeer::ID)) $criteria->add(RegionPeer::ID, $this->id);
		if ($this->isColumnModified(RegionPeer::NAME)) $criteria->add(RegionPeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RegionPeer::DATABASE_NAME);

		$criteria->add(RegionPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getChapterregions() as $relObj) {
				$copyObj->addChapterregion($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RegionPeer();
		}
		return self::$peer;
	}

	
	public function initChapterregions()
	{
		if ($this->collChapterregions === null) {
			$this->collChapterregions = array();
		}
	}

	
	public function getChapterregions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseChapterregionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collChapterregions === null) {
			if ($this->isNew()) {
			   $this->collChapterregions = array();
			} else {

				$criteria->add(ChapterregionPeer::REGION_ID, $this->getId());

				ChapterregionPeer::addSelectColumns($criteria);
				$this->collChapterregions = ChapterregionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ChapterregionPeer::REGION_ID, $this->getId());

				ChapterregionPeer::addSelectColumns($criteria);
				if (!isset($this->lastChapterregionCriteria) || !$this->lastChapterregionCriteria->equals($criteria)) {
					$this->collChapterregions = ChapterregionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastChapterregionCriteria = $criteria;
		return $this->collChapterregions;
	}

	
	public function countChapterregions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseChapterregionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ChapterregionPeer::REGION_ID, $this->getId());

		return ChapterregionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addChapterregion(Chapterregion $l)
	{
		$this->collChapterregions[] = $l;
		$l->setRegion($this);
	}


	
	public function getChapterregionsJoinChapter($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseChapterregionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collChapterregions === null) {
			if ($this->isNew()) {
				$this->collChapterregions = array();
			} else {

				$criteria->add(ChapterregionPeer::REGION_ID, $this->getId());

				$this->collChapterregions = ChapterregionPeer::doSelectJoinChapter($criteria, $con);
			}
		} else {
									
			$criteria->add(ChapterregionPeer::REGION_ID, $this->getId());

			if (!isset($this->lastChapterregionCriteria) || !$this->lastChapterregionCriteria->equals($criteria)) {
				$this->collChapterregions = ChapterregionPeer::doSelectJoinChapter($criteria, $con);
			}
		}
		$this->lastChapterregionCriteria = $criteria;

		return $this->collChapterregions;
	}

} 