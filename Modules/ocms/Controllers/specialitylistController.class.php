<?php
namespace Modules\ocms\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\ocms\Entity\ocms_specialityEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-30 - 2017-12-21 18:36
*@lastUpdate 1396-09-30 - 2017-12-21 18:36
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class specialitylistController extends Controller {
	private $PAGESIZE=25;
	public function getData($PageNum,QueryLogic $QueryLogic)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		$specialityEntityObject=new ocms_specialityEntity($DBAccessor);
		$result['speciality_fid']=$specialityEntityObject->FindAll(new QueryLogic());
		if($PageNum<=0)
			$PageNum=1;        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		if($UserID!=null)
            $QueryLogic->addCondition(new FieldCondition(ocms_specialityEntity::$ROLE_SYSTEMUSER_FID,$UserID));
		$specialityEnt=new ocms_specialityEntity($DBAccessor);
		$result['speciality']=$specialityEnt;
		$allcount=$specialityEnt->FindAllCount($QueryLogic);
		$result['pagecount']=$this->getPageCount($allcount,$this->PAGESIZE);
		$QueryLogic->setLimit($this->getPageRowsLimit($PageNum,$this->PAGESIZE));
		$result['data']=$specialityEnt->FindAll($QueryLogic);
		$DBAccessor->close_connection();
		return $result;
	}
	private $adminMode=true;
    public function getAdminMode()
    {
        return $this->adminMode;
    }
        /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
	public function load($PageNum,$MotherSpecialityID=-1)
	{
		$DBAccessor=new dbaccess();
		$specialityEnt=new ocms_specialityEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		if($MotherSpecialityID>0)
		    $q->addCondition(new FieldCondition(ocms_specialityEntity::$SPECIALITY_FID,$MotherSpecialityID));
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
	public function Search($PageNum,$title,$speciality_fid,$sortby,$isdesc)
	{
		$DBAccessor=new dbaccess();
		$specialityEnt=new ocms_specialityEntity($DBAccessor);
		$q=new QueryLogic();
		$q->addOrderBy("id",true);
		$q->addCondition(new FieldCondition("title","%$title%",LogicalOperator::LIKE));
		$q->addCondition(new FieldCondition("speciality_fid","%$speciality_fid%",LogicalOperator::LIKE));
		$sortByField=$specialityEnt->getTableField($sortby);
		if($sortByField!=null)
			$q->addOrderBy($sortByField,$isdesc);
		$DBAccessor->close_connection();
		return $this->getData($PageNum,$q);
	}
}
?>