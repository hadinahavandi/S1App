<?php
namespace Modules\iribfinance\Forms;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\services\MessageType;
use core\CoreClasses\services\baseHTMLElement;
use core\CoreClasses\html\ListTable;
use core\CoreClasses\html\UList;
use core\CoreClasses\html\FormLabel;
use core\CoreClasses\html\UListElement;
use core\CoreClasses\html\Div;
use core\CoreClasses\html\link;
use core\CoreClasses\html\Lable;
use core\CoreClasses\html\TextBox;
use core\CoreClasses\html\DatePicker;
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\Button;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
use core\CoreClasses\SweetDate;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-11-05 - 2018-01-25 18:01
*@lastUpdate 1396-11-05 - 2018-01-25 18:01
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class nationality_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $title;
	/** @var lable */
	private $flag_flu;
	public function __construct()
	{

		/******* title *******/
		$this->title= new lable("title");

		/******* flag_flu *******/
		$this->flag_flu= new lable("flag_flu");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_nationality");
		$Page->addElement($this->getPageTitlePart("اطلاعات " . $this->Data['nationality']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		if (key_exists("nationality", $this->Data)){
			$this->setFieldCaption('title',$this->Data['nationality']->getFieldInfo('title')->getTitle());
			$this->title->setText($this->Data['nationality']->getTitle());
			$this->setFieldCaption('flag_flu',$this->Data['nationality']->getFieldInfo('flag_flu')->getTitle());
			$this->flag_flu->setText($this->Data['nationality']->getFlag_flu());
		}
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getInfoRowCode($this->title,$this->getFieldCaption('title')));
		$LTable1->addElement($this->getInfoRowCode($this->flag_flu,$this->getFieldCaption('flag_flu')));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("nationality", $this->Data)){
			$Result=$this->Data['nationality']->GetArray();
			return json_encode($Result);
		}
		return json_encode(array());
	}
}
?>