<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\itsap\Entity\itsap_employeeEntity;
use Modules\itsap\Entity\itsap_servicerequestservicestatusEntity;
use Modules\itsap\Entity\itsap_servicetypeEntity;
use Modules\itsap\Entity\itsap_unitEntity;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_servicerequestEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-09-29 - 2017-12-20 15:49
*@lastUpdate 1396-09-29 - 2017-12-20 15:49
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class manageservicerequestController extends Controller {
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
	public function load($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$servicetypeEntityObject=new itsap_servicetypeEntity($DBAccessor);
		$result['servicetype_fid']=$servicetypeEntityObject->FindAll(new QueryLogic());
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequest_fid',$ID));
		$result['servicerequest']=$servicerequestEntityObject;
		if($ID!=-1){
			$servicerequestEntityObject->setId($ID);
			if($servicerequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();
			$result['servicerequest']=$servicerequestEntityObject;
		}
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
	public function BtnSave($ID,$title,$servicetype_fid,$description,$file1_flu,$request_date)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();        
		$UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$result=array();
		$servicerequestEntityObject=new itsap_servicerequestEntity($DBAccessor);
		$file1_fluURL='';
		if($file1_flu!=null && count($file1_flu)>0)
			$file1_fluURL=$file1_flu[0]['url'];

		$this->ValidateFieldArray([$title,$servicetype_fid,$description,$file1_fluURL,$request_date],[$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$TITLE),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$SERVICETYPE_FID),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$DESCRIPTION),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$FILE1_FLU),$servicerequestEntityObject->getFieldInfo(itsap_servicerequestEntity::$REQUEST_DATE)]);
        //Get Priority By Service Type
        $ServiceTypeEnt=new itsap_servicetypeEntity($DBAccessor);
        $ServiceTypeEnt->setId($servicetype_fid);
        if($ServiceTypeEnt==null || $ServiceTypeEnt->getId()<0) throw new DataNotFoundException();
        $priority=$ServiceTypeEnt->getPriority();
        //EOF Get Priority By Service Type
		if($ID==-1){
		    //Get Requester Employee Unit
            $emp=new itsap_employeeEntity($DBAccessor);
            $q1=new QueryLogic();
            $q1->addCondition(new FieldCondition(itsap_employeeEntity::$ROLE_SYSTEMUSER_FID,$role_systemuser_fid));
            $emp=$emp->FindOne($q1);
            if($emp==null || $emp->getId()<0) throw new DataNotFoundException();
            $unit=new itsap_unitEntity($DBAccessor);
            $unit->setId($emp->getUnit_fid());
            if($unit==null || $unit->getId()<0) throw new DataNotFoundException();
            //EOF Get Requester Employee Unit
			$servicerequestEntityObject->setTitle($title);
			$servicerequestEntityObject->setServicetype_fid($servicetype_fid);
			$servicerequestEntityObject->setDescription($description);
			$servicerequestEntityObject->setPriority($priority);
			if($file1_fluURL!='')
			$servicerequestEntityObject->setFile1_flu($file1_fluURL);
			$servicerequestEntityObject->setRequest_date($request_date);
			$servicerequestEntityObject->setRole_systemuser_fid($role_systemuser_fid);
			$servicerequestEntityObject->setUnit_fid($unit->getId());
			$servicerequestEntityObject->Save();
			$ID=$servicerequestEntityObject->getId();
			$statusEnt=new itsap_servicerequestservicestatusEntity($DBAccessor);
			$statusEnt->setServicestatus_fid(1);//Residegi Nashode
            $statusEnt->setServicerequest_fid($ID);
            $statusEnt->setRole_systemuser_fid($role_systemuser_fid);
            $statusEnt->setStart_date(time());
            $statusEnt->Save();

		}
		else{
			$servicerequestEntityObject->setId($ID);
			if($servicerequestEntityObject->getId()==-1)
				throw new DataNotFoundException();
			if($UserID!=null && $servicerequestEntityObject->getRole_systemuser_fid()!=$UserID)
				throw new DataNotFoundException();

            if($ServiceTypeEnt->getId()!=$servicerequestEntityObject->getServicetype_fid())
                $servicerequestEntityObject->setPriority($priority);
			$servicerequestEntityObject->setTitle($title);
			$servicerequestEntityObject->setServicetype_fid($servicetype_fid);
			$servicerequestEntityObject->setDescription($description);
			if($file1_fluURL!='')
			$servicerequestEntityObject->setFile1_flu($file1_fluURL);
			$servicerequestEntityObject->setRequest_date($request_date);
			$servicerequestEntityObject->Save();
		}
		$RelationLogic=new QueryLogic();
		$RelationLogic->addCondition(new FieldCondition('servicerequest_fid',$ID));
		$result=$this->load($ID);
		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
}
?>