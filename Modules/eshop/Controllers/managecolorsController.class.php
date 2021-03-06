<?php
namespace Modules\eshop\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\Exception\DataNotFoundException;
use core\CoreClasses\db\dbaccess;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\eshop\Entity\eshop_colorEntity;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-26 - 2017-11-17 21:29
*@lastUpdate 1396-08-26 - 2017-11-17 21:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managecolorsController extends colorlistController {
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
		$colorEnt=new eshop_colorEntity($DBAccessor);
		$colorEnt->setId($ID);
		if($colorEnt->getId()==-1)
			throw new DataNotFoundException();
		if($UserID!=null && $colorEnt->getRole_systemuser_fid()!=$UserID)
			throw new DataNotFoundException();
		$colorEnt->Remove();
		$DBAccessor->close_connection();
		return $this->load(-1);
	}
}
?>