<?php
namespace Modules\onlineclass\Controllers;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use Modules\finance\Entity\finance_bankpaymentinfoEntity;
use Modules\finance\PublicClasses\Payment;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\onlineclass\Entity\onlineclass_courseEntity;
use Modules\onlineclass\Entity\onlineclass_usercourseEntity;
use Modules\users\Entity\users_userEntity;
use Modules\users\PublicClasses\sessionuser;
use core\CoreClasses\db\QueryLogic;
use core\CoreClasses\db\FieldCondition;
use core\CoreClasses\db\LogicalOperator;
use Modules\users\PublicClasses\User;

/**
*@author Hadi AmirNahavandi
*@creationDate 1396-08-02 - 2017-10-24 14:14
*@lastUpdate 1396-08-02 - 2017-10-24 14:14
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class purchaseController extends Controller {
	private $PAGESIZE=10;
	public function load($ID,$CourseID,$MobileNumber,$DeviceCode,$UserName)
	{
		$Language_fid=CurrentLanguageManager::getCurrentLanguageID();
		$DBAccessor=new dbaccess();
		$su=new sessionuser();
		$role_systemuser_fid=$su->getSystemUserID();
		$result=array();
		if($ID!=-1){
			//Do Something...
		}
		$crs=new onlineclass_courseEntity($DBAccessor);
		$crs->setId($CourseID);

		$Pay=new Payment();
		$result=$Pay->startTransaction($crs->getPrice(),$DeviceCode,"",$MobileNumber,1,"سفارش دوره آموزشی",1,true,DEFAULT_PUBLICURL . "fa/onlineclass/purchasecommit.jsp?courseid=".$CourseID);
        $PaymentID=$result['transaction']['id'];
        $Payment=new finance_bankpaymentinfoEntity($DBAccessor);
        $Payment->setId($PaymentID);
        $Transaction=$Payment->getTransaction_fid();
        $user=new users_userEntity($DBAccessor);
        $SysUserID=$this->getSysUserID($DBAccessor,$UserName);
        if($SysUserID<=0)
            throw new \Exception('usernotfound');
        $q=new QueryLogic();
        $q->addCondition(new FieldCondition(users_userEntity::$ROLE_SYSTEMUSER_FID,$SysUserID,LogicalOperator::Equal));


        $user=$user->FindOne($q);
        $userCourse=new onlineclass_usercourseEntity($DBAccessor);
        $userCourse->setUser_fid($user->getId());
        $userCourse->setAdd_time(time());
        $userCourse->setFinance_transaction_fid($Transaction);
        $userCourse->setCourse_fid($CourseID);
        $userCourse->Save();

		$result['param1']="";
		$DBAccessor->close_connection();
		return $result;
	}
    private function getSysUserID(dbaccess $DBAccessor,$Username)
    {

        return User::getSystemUserIDFromUser($Username,$DBAccessor);
    }
}
?>