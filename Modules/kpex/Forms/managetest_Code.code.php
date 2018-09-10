<?php
namespace Modules\kpex\Forms;
use core\CoreClasses\services\FormCode;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\html\DatePicker;
use Modules\common\PublicClasses\AppRooter;
use Modules\languages\PublicClasses\ModuleTranslator;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use core\CoreClasses\Exception\DataNotFoundException;
use Modules\kpex\Controllers\managetestController;
use Modules\files\PublicClasses\uploadHelper;
use Modules\common\Forms\message_Design;
/**
*@author Hadi AmirNahavandi
*@creationDate 1397-06-17 - 2018-09-08 05:13
*@lastUpdate 1397-06-17 - 2018-09-08 05:13
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managetest_Code extends FormCode {    
	private $adminMode=true;

    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
    }
    public function getAdminMode()
    {
        return $this->adminMode;
    }
	public function load()
	{
		return $this->getLoadDesign()->getResponse();
	}
	public function getLoadDesign()
	{
		$managetestController=new managetestController();
		$managetestController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("kpex");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
			$Result=$managetestController->load($this->getID());
			$design=new managetest_Design();
			$design->setAdminMode($this->adminMode);
			$design->setData($Result);
			$design->setMessage("");
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design;
	}
	public function __construct($namespace)
	{
		parent::__construct($namespace);
		$this->setTitle("Manage Test");
	}
	public function getID()
	{
		return $this->getHttpGETparameter('id',-1);
	}
	public function btnSave_Click()
	{
		$managetestController=new managetestController();
		$managetestController->setAdminMode($this->getAdminMode());
		$translator=new ModuleTranslator("kpex");
		$translator->setLanguageName(CurrentLanguageManager::getCurrentLanguageName());
		try{
		$design=new managetest_Design();
		$nouninfluence=$design->getNouninfluence()->getValue();
		$nounoutinfluence=$design->getNounoutinfluence()->getValue();
		$adjectiveinfluence=$design->getAdjectiveinfluence()->getValue();
		$adjectiveoutinfluence=$design->getAdjectiveoutinfluence()->getValue();
		$similarity_threshold=$design->getSimilarity_threshold()->getValue();
		$similarity_influence=$design->getSimilarity_influence()->getValue();
		$resultcount=$design->getResultcount()->getValue();
		$context_fid_ID=$design->getContext_fid()->getSelectedID();
		$description=$design->getDescription()->getValue();
		$words=$design->getWords()->getValue();
		$is_postaged_ID=$design->getIs_postaged()->getSelectedID();
		$is_similarityedgeweighed_ID=$design->getIs_similarityedgeweighed()->getSelectedID();
		$method_fid_ID=$design->getMethod_fid()->getSelectedID();
		$apprate=$design->getApprate()->getValue();
		$precisionrate=$design->getPrecisionrate()->getValue();
		$recall=$design->getRecall()->getValue();
		$fscore=$design->getFscore()->getValue();
		$Result=$managetestController->BtnSave($this->getID(),$nouninfluence,$nounoutinfluence,$adjectiveinfluence,$adjectiveoutinfluence,$similarity_threshold,$similarity_influence,$resultcount,$context_fid_ID,$description,$words,$is_postaged_ID,$is_similarityedgeweighed_ID,$method_fid_ID,$apprate,$precisionrate,$recall,$fscore);
		$design->setData($Result);
		$design->setMessage("اطلاعات با موفقیت ذخیره شد.");
		$design->setMessageType(MessageType::$SUCCESS);
		if($this->getAdminMode()){
			$ManageListRooter=new AppRooter("kpex","managetests");
		}
			AppRooter::redirect($ManageListRooter->getAbsoluteURL(),DEFAULT_PAGESAVEREDIRECTTIME);
		}
		catch(DataNotFoundException $dnfex){
			$design=new message_Design();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("آیتم مورد نظر پیدا نشد");
		}
		catch(\Exception $uex){
			$design=$this->getLoadDesign();
			$design->setMessageType(MessageType::$ERROR);
			$design->setMessage("متاسفانه خطایی در اجرای دستور خواسته شده بوجود آمد.");
		}
		return $design->getResponse();
	}
}
?>