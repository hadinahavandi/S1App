<?php
namespace Modules\iribfinance\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\iribfinance\Entity\iribfinance_departmentEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:22
*@lastUpdate 1396-11-05 - 2018-01-25 18:22
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedepartmentsController extends departmentlistController {
	private $PAGESIZE=10;
	public function DeleteItem($ID)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
        $role_systemuser_fid=$su->getSystemUserID();
        $UserID=null;
        if(!$this->getAdminMode())
            $UserID=$role_systemuser_fid;
		$departmentEnt=new iribfinance_departmentEntity($DBAccessor);
		$departmentEnt->setId($ID);
		if($departmentEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $departmentEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$departmentEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>