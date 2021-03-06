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
*@creationDate 1396-11-27 - 2018-02-16 01:43
*@lastUpdate 1396-11-27 - 2018-02-16 01:43
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class activitylist_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
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
	/** @var textbox */
	private $title;
	/**
	 * @return textbox
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/** @var textbox */
	private $paycenter_type;
	/**
	 * @return textbox
	 */
	public function getPaycenter_type()
	{
		return $this->paycenter_type;
	}
	/** @var textbox */
	private $planingcode;
	/**
	 * @return textbox
	 */
	public function getPlaningcode()
	{
		return $this->planingcode;
	}
	/** @var combobox */
	private $taxtype_fid;
	/**
	 * @return combobox
	 */
	public function getTaxtype_fid()
	{
		return $this->taxtype_fid;
	}
	/** @var textbox */
	private $alalhesab;
	/**
	 * @return textbox
	 */
	public function getAlalhesab()
	{
		return $this->alalhesab;
	}
	/** @var combobox */
	private $isactive;
	/**
	 * @return combobox
	 */
	public function getIsactive()
	{
		return $this->isactive;
	}
	/** @var combobox */
	private $sortby;
	/**
	 * @return combobox
	 */
	public function getSortby()
	{
		return $this->sortby;
	}
	/** @var combobox */
	private $isdesc;
	/**
	 * @return combobox
	 */
	public function getIsdesc()
	{
		return $this->isdesc;
	}
	/** @var SweetButton */
	private $search;
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("iribfinance_activitylist");
		$Page->addElement($this->getPageTitlePart("فهرست " . $this->Data['activity']->getTableTitle() . " ها"));
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->paycenter_type,$this->getFieldCaption('paycenter_type'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->planingcode,$this->getFieldCaption('planingcode'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->taxtype_fid,$this->getFieldCaption('taxtype_fid'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->alalhesab,$this->getFieldCaption('alalhesab'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isactive,$this->getFieldCaption('isactive'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$Page->addElement($LTable1);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$Div1=new Div();
		$Div1->setClass("list");
		for($i=0;$i<count($this->Data['data']);$i++){
		$innerDiv[$i]=new Div();
		$innerDiv[$i]->setClass("listitem");
			$url=new AppRooter('iribfinance','activity');
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getTitleField();
			if($this->Data['data'][$i]->getTitleField()=="")
				$Title='-- بدون عنوان --';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$innerDiv[$i]->addElement($liTit[$i]);
			$Div1->addElement($innerDiv[$i]);
		}
		$Page->addElement($Div1);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"iribfinance","activitylist"));
		$PageLink=new AppRooter('iribfinance','activitylist');
		$form=new SweetFrom($PageLink->getAbsoluteURL(), "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function getJSON()
	{
		parent::getJSON();
		if (key_exists("data", $this->Data)){
			$AllCount1 = count($this->Data['data']);
			$Result=array();
			for($i=0;$i<$AllCount1;$i++){
				$Result[$i]=$this->Data['data'][$i]->GetArray();
			}
			return json_encode($Result);
		}
		return json_encode(array());
	}
	public function FillItems()
	{
			$this->taxtype_fid->addOption("", "مهم نیست");
		foreach ($this->Data['taxtype_fid'] as $item)
			$this->taxtype_fid->addOption($item->getID(), $item->getTitleField());
			$this->isactive->addOption("", "مهم نیست");
			$this->isactive->addOption(1,'بله');
			$this->isactive->addOption(0,'خیر');
		if (key_exists("activity", $this->Data)){

			/******** title ********/
			$this->title->setValue($this->Data['activity']->getTitle());
			$this->setFieldCaption('title',$this->Data['activity']->getFieldInfo('title')->getTitle());

			/******** paycenter_type ********/
			$this->paycenter_type->setValue($this->Data['activity']->getPaycenter_type());
			$this->setFieldCaption('paycenter_type',$this->Data['activity']->getFieldInfo('paycenter_type')->getTitle());

			/******** planingcode ********/
			$this->planingcode->setValue($this->Data['activity']->getPlaningcode());
			$this->setFieldCaption('planingcode',$this->Data['activity']->getFieldInfo('planingcode')->getTitle());

			/******** taxtype_fid ********/
			$this->taxtype_fid->setSelectedValue($this->Data['activity']->getTaxtype_fid());
			$this->setFieldCaption('taxtype_fid',$this->Data['activity']->getFieldInfo('taxtype_fid')->getTitle());

			/******** alalhesab ********/
			$this->alalhesab->setValue($this->Data['activity']->getAlalhesab());
			$this->setFieldCaption('alalhesab',$this->Data['activity']->getFieldInfo('alalhesab')->getTitle());

			/******** isactive ********/
			$this->isactive->setSelectedValue($this->Data['activity']->getIsactive());
			$this->setFieldCaption('isactive',$this->Data['activity']->getFieldInfo('isactive')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** title ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('title'),$this->getFieldCaption('title'));
		if(isset($_GET['title']))
			$this->title->setValue($_GET['title']);

		/******** paycenter_type ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('paycenter_type'),$this->getFieldCaption('paycenter_type'));
		if(isset($_GET['paycenter_type']))
			$this->paycenter_type->setValue($_GET['paycenter_type']);

		/******** planingcode ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('planingcode'),$this->getFieldCaption('planingcode'));
		if(isset($_GET['planingcode']))
			$this->planingcode->setValue($_GET['planingcode']);

		/******** taxtype_fid ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('taxtype_fid'),$this->getFieldCaption('taxtype_fid'));
		if(isset($_GET['taxtype_fid']))
			$this->taxtype_fid->setSelectedValue($_GET['taxtype_fid']);

		/******** alalhesab ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('alalhesab'),$this->getFieldCaption('alalhesab'));
		if(isset($_GET['alalhesab']))
			$this->alalhesab->setValue($_GET['alalhesab']);

		/******** isactive ********/
		$this->sortby->addOption($this->Data['activity']->getTableFieldID('isactive'),$this->getFieldCaption('isactive'));
		if(isset($_GET['isactive']))
			$this->isactive->setSelectedValue($_GET['isactive']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* paycenter_type *******/
		$this->paycenter_type= new textbox("paycenter_type");
		$this->paycenter_type->setClass("form-control");

		/******* planingcode *******/
		$this->planingcode= new textbox("planingcode");
		$this->planingcode->setClass("form-control");

		/******* taxtype_fid *******/
		$this->taxtype_fid= new combobox("taxtype_fid");
		$this->taxtype_fid->setClass("form-control");

		/******* alalhesab *******/
		$this->alalhesab= new textbox("alalhesab");
		$this->alalhesab->setClass("form-control");

		/******* isactive *******/
		$this->isactive= new combobox("isactive");
		$this->isactive->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
}
?>