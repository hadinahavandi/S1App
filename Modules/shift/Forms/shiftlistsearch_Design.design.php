<?php
namespace Modules\shift\Forms;
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
*@creationDate 1396-11-05 - 2018-01-25 00:33
*@lastUpdate 1396-11-05 - 2018-01-25 00:33
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class shiftlistsearch_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	private $reportType;

    /**
     * @param mixed $reportType
     */
    public function setReportType($reportType)
    {
        $this->reportType = $reportType;
    }
	/** @var combobox */
	private $shifttype_fid;
	/**
	 * @return combobox
	 */
	public function getShifttype_fid()
	{
		return $this->shifttype_fid;
	}
	/** @var DatePicker */
	private $due_date_from;
	/**
	 * @return DatePicker
	 */
	public function getDue_date_from()
	{
		return $this->due_date_from;
	}
	/** @var DatePicker */
	private $due_date_to;
	/**
	 * @return DatePicker
	 */
	public function getDue_date_to()
	{
		return $this->due_date_to;
	}
	/** @var DatePicker */
	private $register_date_from;
	/**
	 * @return DatePicker
	 */
	public function getRegister_date_from()
	{
		return $this->register_date_from;
	}
	/** @var DatePicker */
	private $register_date_to;
	/**
	 * @return DatePicker
	 */
	public function getRegister_date_to()
	{
		return $this->register_date_to;
	}
	/** @var combobox */
	private $personel_fid;
	/**
	 * @return combobox
	 */
	public function getPersonel_fid()
	{
		return $this->personel_fid;
	}
	/** @var combobox */
	private $bakhsh_fid;
	/**
	 * @return combobox
	 */
	public function getBakhsh_fid()
	{
		return $this->bakhsh_fid;
	}
	/** @var combobox */
	private $role_fid;
	/**
	 * @return combobox
	 */
	public function getRole_fid()
	{
		return $this->role_fid;
	}
	/** @var combobox */
	private $inputfile_fid;
	/**
	 * @return combobox
	 */
	public function getInputfile_fid()
	{
		return $this->inputfile_fid;
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
    private $cmbNot;

    /**
     * @return ComboBox
     */
    public function getCmbNot()
    {
        return $this->cmbNot;
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
	public function __construct()
	{
		parent::__construct();

		/******* shifttype_fid *******/
		$this->shifttype_fid= new combobox("shifttype_fid");
		$this->shifttype_fid->setClass("form-control");

		/******* due_date_from *******/
		$this->due_date_from= new DatePicker("due_date_from");
		$this->due_date_from->setClass("form-control");

		/******* due_date_to *******/
		$this->due_date_to= new DatePicker("due_date_to");
		$this->due_date_to->setClass("form-control");

		/******* register_date_from *******/
		$this->register_date_from= new DatePicker("register_date_from");
		$this->register_date_from->setClass("form-control");

		/******* register_date_to *******/
		$this->register_date_to= new DatePicker("register_date_to");
		$this->register_date_to->setClass("form-control");

		/******* personel_fid *******/
		$this->personel_fid= new combobox("personel_fid");
        $this->personel_fid->setClass("form-control selectpicker");
        $this->personel_fid->SetAttribute("data-live-search",true);

		/******* bakhsh_fid *******/
		$this->bakhsh_fid= new combobox("bakhsh_fid");
        $this->bakhsh_fid->setClass("form-control selectpicker");
        $this->bakhsh_fid->SetAttribute("data-live-search",true);

		/******* role_fid *******/
		$this->role_fid= new combobox("role_fid");
        $this->role_fid->setClass("form-control selectpicker");
        $this->role_fid->SetAttribute("data-live-search",true);

		/******* inputfile_fid *******/
		$this->inputfile_fid= new combobox("inputfile_fid");
		$this->inputfile_fid->setClass("form-control");

		/******* sortby *******/
		$this->sortby= new combobox("sortby");
		$this->sortby->setClass("form-control");

		/******* isdesc *******/
		$this->isdesc= new combobox("isdesc");
		$this->isdesc->setClass("form-control");
        /******* cmbNot *******/
        $this->cmbNot= new combobox("cmbnot");
        $this->cmbNot->setClass("form-control");

		/******* search *******/
		$this->search= new SweetButton(true,"جستجو");
		$this->search->setAction("search");
		$this->search->setDisplayMode(Button::$DISPLAYMODE_BUTTON);
		$this->search->setClass("btn btn-primary");
	}
	public function getBodyHTML($command=null)
	{
		$this->FillItems();
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("shift_shiftlist");
		$Page->addElement($this->getPageTitlePart("جستجوی " . $this->Data['shift']->getTableTitle() . ""));
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$LTable1=new Div();
		$LTable1->setClass("searchtable");
		if($this->reportType==1)//Simple
        {
            $LTable1->addElement($this->getFieldRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->due_date_from,$this->getFieldCaption('due_date_from'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->due_date_to,$this->getFieldCaption('due_date_to'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->register_date_from,$this->getFieldCaption('register_date_from'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->register_date_to,$this->getFieldCaption('register_date_to'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->personel_fid,$this->getFieldCaption('personel_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->role_fid,$this->getFieldCaption('role_fid'),null,'',null));
        }
		elseif($this->reportType==2 || $this->reportType==4)//2Weeks or 1Weeks
        {
            $LTable1->addElement($this->getFieldRowCode($this->due_date_from,'تاریخ شروع',null,'',null));
          $LTable1->addElement($this->getFieldRowCode($this->bakhsh_fid,$this->getFieldCaption('bakhsh_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->cmbNot,$this->getFieldCaption('role_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->role_fid,"",null,'',null));
        }
        elseif($this->reportType==3)//Daily
        {

            $LTable1->addElement($this->getFieldRowCode($this->due_date_from,'تاریخ',null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->shifttype_fid,$this->getFieldCaption('shifttype_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode(new TextBox('pagelength','7'),'تعداد بخش در هر صفحه',null,'',null));

        }
        elseif($this->reportType==5)//Amar
        {
            $LTable1->addElement($this->getFieldRowCode($this->personel_fid,$this->getFieldCaption('personel_fid'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->due_date_from,$this->getFieldCaption('due_date_from'),null,'',null));
            $LTable1->addElement($this->getFieldRowCode($this->due_date_to,$this->getFieldCaption('due_date_to'),null,'',null));

        }
//		$LTable1->addElement($this->getFieldRowCode($this->inputfile_fid,$this->getFieldCaption('inputfile_fid'),null,'',null));
//		$LTable1->addElement($this->getFieldRowCode($this->sortby,$this->getFieldCaption('sortby'),null,'',null));
//		$LTable1->addElement($this->getFieldRowCode($this->isdesc,$this->getFieldCaption('isdesc'),null,'',null));
		$LTable1->addElement($this->getSingleFieldRowCode($this->search));
		$LTable1->addElement(new TextBox('reporttype',$this->reportType,false));
		$Page->addElement($LTable1);
		$form=new SweetFrom("", "GET", $Page);
		$form->setClass('form-horizontal');
		return $form->getHTML();
	}
	public function FillItems()
	{
	    $this->cmbNot->addOption('0','فقط');
        $this->cmbNot->addOption('1','همه به جز');
//			$this->shifttype_fid->addOption("", "همه");
		foreach ($this->Data['shifttype_fid'] as $item)
			$this->shifttype_fid->addOption($item->getID(), $item->getTitleField());
			$this->personel_fid->addOption("", "همه");
		foreach ($this->Data['personel_fid'] as $item)
			$this->personel_fid->addOption($item->getID(), $item->getName() . " " . $item->getFamily() . " : " . $item->getMellicode());
//			$this->bakhsh_fid->addOption("", "همه");
		foreach ($this->Data['bakhsh_fid'] as $item)
			$this->bakhsh_fid->addOption($item->getID(), $item->getTitleField());
			$this->role_fid->addOption("", "همه");
		foreach ($this->Data['role_fid'] as $item)
			$this->role_fid->addOption($item->getID(), $item->getTitleField());
			$this->inputfile_fid->addOption("", "همه");
		foreach ($this->Data['inputfile_fid'] as $item)
			$this->inputfile_fid->addOption($item->getID(), $item->getTitleField());
		if (key_exists("shift", $this->Data)){

			/******** shifttype_fid ********/
			$this->shifttype_fid->setSelectedValue($this->Data['shift']->getShifttype_fid());
			$this->setFieldCaption('shifttype_fid',$this->Data['shift']->getFieldInfo('shifttype_fid')->getTitle());

			/******** due_date_from ********/
			$this->due_date_from->setTime(time()-30*84600);

//            $this->due_date_from->setTime("1523215800");
			$this->setFieldCaption('due_date_from',$this->Data['shift']->getFieldInfo('due_date_from')->getTitle());

			/******** due_date_to ********/
			$this->due_date_to->setTime($this->Data['shift']->getDue_date_to());
			$this->setFieldCaption('due_date_to',$this->Data['shift']->getFieldInfo('due_date_to')->getTitle());
			$this->setFieldCaption('due_date',$this->Data['shift']->getFieldInfo('due_date')->getTitle());

			/******** register_date_from ********/
			$this->register_date_from->setTime($this->Data['shift']->getRegister_date_from());
			$this->setFieldCaption('register_date_from',$this->Data['shift']->getFieldInfo('register_date_from')->getTitle());

			/******** register_date_to ********/
			$this->register_date_to->setTime($this->Data['shift']->getRegister_date_to());
			$this->setFieldCaption('register_date_to',$this->Data['shift']->getFieldInfo('register_date_to')->getTitle());
			$this->setFieldCaption('register_date',$this->Data['shift']->getFieldInfo('register_date')->getTitle());

			/******** personel_fid ********/
			$this->personel_fid->setSelectedValue($this->Data['shift']->getPersonel_fid());
			$this->setFieldCaption('personel_fid',$this->Data['shift']->getFieldInfo('personel_fid')->getTitle());

			/******** bakhsh_fid ********/
			$this->bakhsh_fid->setSelectedValue($this->Data['shift']->getBakhsh_fid());
			$this->setFieldCaption('bakhsh_fid',$this->Data['shift']->getFieldInfo('bakhsh_fid')->getTitle());

			/******** role_fid ********/
			$this->role_fid->setSelectedValue($this->Data['shift']->getRole_fid());
			$this->setFieldCaption('role_fid',$this->Data['shift']->getFieldInfo('role_fid')->getTitle());

			/******** inputfile_fid ********/
			$this->inputfile_fid->setSelectedValue($this->Data['shift']->getInputfile_fid());
			$this->setFieldCaption('inputfile_fid',$this->Data['shift']->getFieldInfo('inputfile_fid')->getTitle());

			/******** sortby ********/

			/******** isdesc ********/

			/******** search ********/
		}
			$this->isdesc->addOption('0','صعودی');
			$this->isdesc->addOption('1','نزولی');

		/******** shifttype_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('shifttype_fid'),$this->getFieldCaption('shifttype_fid'));
		if(isset($_GET['shifttype_fid']))
			$this->shifttype_fid->setSelectedValue($_GET['shifttype_fid']);

		/******** due_date_from ********/

		/******** due_date_to ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('due_date'),$this->getFieldCaption('due_date'));

		/******** register_date_from ********/

		/******** register_date_to ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('register_date'),$this->getFieldCaption('register_date'));

		/******** personel_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('personel_fid'),$this->getFieldCaption('personel_fid'));
		if(isset($_GET['personel_fid']))
			$this->personel_fid->setSelectedValue($_GET['personel_fid']);

		/******** bakhsh_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('bakhsh_fid'),$this->getFieldCaption('bakhsh_fid'));
		if(isset($_GET['bakhsh_fid']))
			$this->bakhsh_fid->setSelectedValue($_GET['bakhsh_fid']);

		/******** role_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('role_fid'),$this->getFieldCaption('role_fid'));
		if(isset($_GET['role_fid']))
			$this->role_fid->setSelectedValue($_GET['role_fid']);

		/******** inputfile_fid ********/
		$this->sortby->addOption($this->Data['shift']->getTableFieldID('inputfile_fid'),$this->getFieldCaption('inputfile_fid'));
		if(isset($_GET['inputfile_fid']))
			$this->inputfile_fid->setSelectedValue($_GET['inputfile_fid']);

		/******** sortby ********/
		if(isset($_GET['sortby']))
			$this->sortby->setSelectedValue($_GET['sortby']);

		/******** isdesc ********/
		if(isset($_GET['isdesc']))
			$this->isdesc->setSelectedValue($_GET['isdesc']);

		/******** search ********/
	}
}
?>