<?php
namespace Modules\itsap\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\itsap\Entity\itsap_devicecomponentEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-01-13 - 2018-04-02 02:09
*@lastUpdate 1397-01-13 - 2018-04-02 02:09
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managedevicecomponentsController extends devicecomponentlistController {
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
		$devicecomponentEnt=new itsap_devicecomponentEntity($DBAccessor);
		$devicecomponentEnt->setId($ID);
		if($devicecomponentEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $devicecomponentEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$devicecomponentEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>