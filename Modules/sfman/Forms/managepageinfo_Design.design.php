<?php
namespace Modules\sfman\Forms;
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
use core\CoreClasses\html\DataComboBox;
use core\CoreClasses\html\SweetButton;
use core\CoreClasses\html\CheckBox;
use core\CoreClasses\html\RadioBox;
use core\CoreClasses\html\SweetFrom;
use core\CoreClasses\html\ComboBox;
use core\CoreClasses\html\FileUploadBox;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-07-08 - 2017-09-30 23:34
*@lastUpdate 1396-07-08 - 2017-09-30 23:34
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class managepageinfo_Design extends FormDesign {
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("sfman_managepageinfo");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['pageinfo']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("formtable");
		$LTable1->addElement($this->getFieldRowCode($this->title,$this->getFieldCaption('title'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->description,$this->getFieldCaption('description'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->keywords,$this->getFieldCaption('keywords'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->themepage,$this->getFieldCaption('themepage'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->internalurl,$this->getFieldCaption('internalurl'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->canonicalurl,$this->getFieldCaption('canonicalurl'),null,''));
		$LTable1->addElement($this->getFieldRowCode($this->sentenceinurl,$this->getFieldCaption('sentenceinurl'),null,''));
		$LTable1->addElement($this->getSingleFieldRowCode($this->btnSave));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "POST", $Page);
		$form->SetAttribute("novalidate","novalidate");
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{

			/******** title ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->title->setValue($this->Data['pageinfo']->getTitle());
			$this->setFieldCaption('title',$this->Data['pageinfo']->getFieldInfo('title')->getTitle());
			$this->title->setFieldInfo($this->Data['pageinfo']->getFieldInfo('title'));
		}

			/******** description ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->description->setValue($this->Data['pageinfo']->getDescription());
			$this->setFieldCaption('description',$this->Data['pageinfo']->getFieldInfo('description')->getTitle());
			$this->description->setFieldInfo($this->Data['pageinfo']->getFieldInfo('description'));
		}

			/******** keywords ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->keywords->setValue($this->Data['pageinfo']->getKeywords());
			$this->setFieldCaption('keywords',$this->Data['pageinfo']->getFieldInfo('keywords')->getTitle());
			$this->keywords->setFieldInfo($this->Data['pageinfo']->getFieldInfo('keywords'));
		}

			/******** themepage ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->themepage->setValue($this->Data['pageinfo']->getThemepage());
			$this->setFieldCaption('themepage',$this->Data['pageinfo']->getFieldInfo('themepage')->getTitle());
			$this->themepage->setFieldInfo($this->Data['pageinfo']->getFieldInfo('themepage'));
		}

			/******** internalurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->internalurl->setValue($this->Data['pageinfo']->getInternalurl());
			$this->setFieldCaption('internalurl',$this->Data['pageinfo']->getFieldInfo('internalurl')->getTitle());
			$this->internalurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('internalurl'));
		}

			/******** canonicalurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->canonicalurl->setValue($this->Data['pageinfo']->getCanonicalurl());
			$this->setFieldCaption('canonicalurl',$this->Data['pageinfo']->getFieldInfo('canonicalurl')->getTitle());
			$this->canonicalurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('canonicalurl'));
		}

			/******** sentenceinurl ********/
		if (key_exists("pageinfo", $this->Data)){
			$this->sentenceinurl->setValue($this->Data['pageinfo']->getSentenceinurl());
			$this->setFieldCaption('sentenceinurl',$this->Data['pageinfo']->getFieldInfo('sentenceinurl')->getTitle());
			$this->sentenceinurl->setFieldInfo($this->Data['pageinfo']->getFieldInfo('sentenceinurl'));
		}

			/******** btnSave ********/
	}
	public function __construct()
	{
		parent::__construct();

		/******* title *******/
		$this->title= new textbox("title");
		$this->title->setClass("form-control");

		/******* description *******/
		$this->description= new textbox("description");
		$this->description->setClass("form-control");

		/******* keywords *******/
		$this->keywords= new textbox("keywords");
		$this->keywords->setClass("form-control");

		/******* themepage *******/
		$this->themepage= new textbox("themepage");
		$this->themepage->setClass("form-control");

		/******* internalurl *******/
		$this->internalurl= new textbox("internalurl");
		$this->internalurl->setClass("form-control");

		/******* canonicalurl *******/
		$this->canonicalurl= new textbox("canonicalurl");
		$this->canonicalurl->setClass("form-control");

		/******* sentenceinurl *******/
		$this->sentenceinurl= new textbox("sentenceinurl");
		$this->sentenceinurl->setClass("form-control");

		/******* btnSave *******/
		$this->btnSave= new SweetButton(true,"ذخیره");
		$this->btnSave->setAction("btnSave");
		$this->btnSave->setClass("btn btn-primary");
	}
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}    
private $adminMode=true;

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
	private $description;
	/**
	 * @return textbox
	 */
	public function getDescription()
	{
		return $this->description;
	}
	/** @var textbox */
	private $keywords;
	/**
	 * @return textbox
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}
	/** @var textbox */
	private $themepage;
	/**
	 * @return textbox
	 */
	public function getThemepage()
	{
		return $this->themepage;
	}
	/** @var textbox */
	private $internalurl;
	/**
	 * @return textbox
	 */
	public function getInternalurl()
	{
		return $this->internalurl;
	}
	/** @var textbox */
	private $canonicalurl;
	/**
	 * @return textbox
	 */
	public function getCanonicalurl()
	{
		return $this->canonicalurl;
	}
	/** @var textbox */
	private $sentenceinurl;
	/**
	 * @return textbox
	 */
	public function getSentenceinurl()
	{
		return $this->sentenceinurl;
	}
	/** @var SweetButton */
	private $btnSave;
}
?>