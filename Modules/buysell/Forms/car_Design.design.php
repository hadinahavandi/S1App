<?php
namespace Modules\buysell\Forms;
use core\CoreClasses\html\Image;
use core\CoreClasses\services\FormDesign;
use core\CoreClasses\html\ListTable;
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
use Modules\buysell\Entity\buysell_carphotoEntity;
use Modules\common\PublicClasses\AppRooter;
use Modules\common\PublicClasses\UrlParameter;
/**
*@author Hadi AmirNahavandi
*@creationDate 1396-03-31 - 2017-06-21 02:02
*@lastUpdate 1396-03-31 - 2017-06-21 02:02
*@SweetFrameworkHelperVersion 2.002
*@SweetFrameworkVersion 2.002
*/
class car_Design extends FormDesign {
	private $Data;
	/**
	 * @param mixed $Data
	 */
	public function setData($Data)
	{
		$this->Data = $Data;
	}
	/** @var lable */
	private $details;
	/** @var lable */
	private $price;
	/** @var lable */
	private $adddate;
	/** @var lable */
	private $body_carcolor_fid;
	/** @var lable */
	private $inner_carcolor_fid;
	/** @var lable */
	private $paytype_fid;
	/** @var lable */
	private $cartype_fid;
	/** @var lable */
	private $usagecount;
	/** @var lable */
	private $wheretodate;
	/** @var lable */
	private $carbodystatus_fid;
	/** @var lable */
	private $makedate;
	/** @var lable */
	private $carstatus_fid;
	/** @var lable */
	private $shasitype_fid;
	/** @var lable */
	private $isautogearbox;
    /** @var lable */
    private $carmodel_fid;
    /** @var lable */
    private $carmaker_fid;
	/** @var lable */
	private $cartagtype_fid;
	/** @var lable */
	private $carentitytype_fid;
    /** @var lable */
    private $city;
    /** @var lable */
    private $user;
    /** @var lable */
    private $usermob;
	public function __construct()
	{
		$this->details= new lable("توضیحات");
		$this->price= new lable("قیمت");
		$this->adddate= new lable("تاریخ");
		$this->body_carcolor_fid= new lable("رنگ بدنه");
		$this->inner_carcolor_fid= new lable("رنگ داخل");
		$this->paytype_fid= new lable("روش پرداخت");
		$this->cartype_fid= new lable("نوع خودرو");
		$this->usagecount= new lable("کیلومتر");
		$this->wheretodate= new lable("محل ملاقات");
		$this->carbodystatus_fid= new lable("وضعیت بدنه");
		$this->makedate= new lable("سال ساخت");
		$this->carstatus_fid= new lable("وضعیت");
		$this->shasitype_fid= new lable("شاسی");
		$this->isautogearbox= new lable("گیربکس اتوماتیک");
		$this->carmaker_fid= new lable("برند");
        $this->carmodel_fid= new lable("مدل");
		$this->cartagtype_fid= new lable("نوع پلاک");
		$this->carentitytype_fid= new lable("موجودیت");
        $this->city= new lable("شهر");
        $this->user= new lable("کاربر");
        $this->usermob= new lable("موبایل");
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("buysell_car");
		$PageTitlePart=new Div();
		$PageTitlePart->setClass("sweet_pagetitlepart");
        $PageTitlePart->addElement(new Lable("صفحه اصلی > فهرست خودرو ها > مشخصات خودرو"));
		$Page->addElement($PageTitlePart);
		$MessagePart=new Div();
		$MessagePart->setClass("sweet_messagepart");
		$MessagePart->addElement(new Lable($this->getMessage()));
		$Page->addElement($MessagePart);
		if (key_exists("car", $this->Data)){
			$this->details->setText($this->Data['car']->getDetails());
		}
		if (key_exists("car", $this->Data)){
			$this->price->setText($this->Data['car']->getPrice() . " ریال");
		}
		if (key_exists("car", $this->Data)){
			$this->adddate->setText($this->Data['car']->getAdddate());
		}
		if (key_exists("body_carcolor_fid", $this->Data)){
			$this->body_carcolor_fid->setText($this->Data['body_carcolor_fid']->getTitle());
		}
		if (key_exists("inner_carcolor_fid", $this->Data)){
			$this->inner_carcolor_fid->setText($this->Data['inner_carcolor_fid']->getTitle());
		}
		if (key_exists("paytype_fid", $this->Data)){
			$this->paytype_fid->setText($this->Data['paytype_fid']->getTitle());
		}
		if (key_exists("cartype_fid", $this->Data)){
			$this->cartype_fid->setText($this->Data['cartype_fid']->getTitle());
		}
		if (key_exists("car", $this->Data)){
			$this->usagecount->setText($this->Data['car']->getUsagecount());
		}
		if (key_exists("car", $this->Data)){
			$this->wheretodate->setText($this->Data['car']->getWheretodate());
		}
		if (key_exists("carbodystatus_fid", $this->Data)){
			$this->carbodystatus_fid->setText($this->Data['carbodystatus_fid']->getTitle());
		}
		if (key_exists("car", $this->Data)){
			$this->makedate->setText($this->Data['car']->getMakedate());
		}
		if (key_exists("carstatus_fid", $this->Data)){
			$this->carstatus_fid->setText($this->Data['carstatus_fid']->getTitle());
		}
		if (key_exists("shasitype_fid", $this->Data)){
			$this->shasitype_fid->setText($this->Data['shasitype_fid']->getTitle());
		}
		if (key_exists("carmodel_fid", $this->Data)){
			$this->carmodel_fid->setText($this->Data['carmodel_fid']->getTitle());
		}
        if (key_exists("carmaker_fid", $this->Data)){
            $this->carmaker_fid->setText($this->Data['carmaker_fid']->getTitle());
        }
		if (key_exists("cartagtype_fid", $this->Data)){
			$this->cartagtype_fid->setText($this->Data['cartagtype_fid']->getTitle());
		}
		if (key_exists("carentitytype_fid", $this->Data)){
			$this->carentitytype_fid->setText($this->Data['carentitytype_fid']->getTitle());
		}
        if (key_exists("city", $this->Data)){
            $this->city->setText($this->Data['city']->getTitle());
        }
        if (key_exists("user", $this->Data)){
            $this->user->setText($this->Data['user']->getName() . $this->Data['user']->getFamily());
        }
        if (key_exists("user", $this->Data)){
            $this->usermob->setText($this->Data['user']->getMob());
        }
		$LTable1=new ListTable(2);
		$LTable1->setClass("formtable");

        $LTable1=$this->getDataRow($LTable1,$this->carmaker_fid,"برند",false);

        $LTable1=$this->getDataRow($LTable1,$this->carmodel_fid,"مدل",false);

        $LTable1=$this->getDataRow($LTable1,$this->makedate,"سال ساخت",false);


        $LTable1=$this->getDataRow($LTable1,$this->price,"قیمت",false);

        $LTable1=$this->getDataRow($LTable1,$this->city,"شهر",false);

        $LTable1=$this->getDataRow($LTable1,$this->adddate," تاریخ ثبت آگهی",false);

        $LTable1=$this->getDataRow($LTable1,$this->body_carcolor_fid,"رنگ بدنه",false);

        $LTable1=$this->getDataRow($LTable1,$this->inner_carcolor_fid,"رنگ داخل",false);
        $LTable1=$this->getDataRow($LTable1,$this->paytype_fid,"روش پرداخت",false);
        $LTable1=$this->getDataRow($LTable1,$this->cartype_fid,"نوع خودرو",false);
        $LTable1=$this->getDataRow($LTable1,$this->usagecount,"کیلومتر",false);
        $LTable1=$this->getDataRow($LTable1,$this->wheretodate,"محله بازدید",false);
        $LTable1=$this->getDataRow($LTable1,$this->carbodystatus_fid,"وضعیت بدنه",false);
        $LTable1=$this->getDataRow($LTable1,$this->shasitype_fid,"شاسی",false);
        $LTable1=$this->getDataRow($LTable1,$this->isautogearbox,"گیربکس",false);
        /*
		$LTable1->addElement(new Lable("وضعیت"));
		$LTable1->setLastElementClass('form_item_titlelabel');
		$LTable1->addElement($this->carstatus_fid);
		$LTable1->setLastElementClass('form_item_datalabel');*/

        $LTable1=$this->getDataRow($LTable1,$this->cartagtype_fid,"نوع پلاک",false);
        $LTable1=$this->getDataRow($LTable1,$this->carentitytype_fid,"موجودیت",false);
        $LTable1=$this->getDataRow($LTable1,$this->user,"ثبت کننده",false);
        $LTable1=$this->getDataRow($LTable1,$this->usermob,"تلفن تماس",false);
        $LTable1=$this->getDataRow($LTable1,$this->carentitytype_fid,"روش تحویل",false);
        $LTable1=$this->getDataRow($LTable1,$this->details,"توضیحات",true);
		$Page->addElement($LTable1);

        $CarDet=new Div();
        $CarDet->setId("carphotobox");
        for($i=0;$i<count($this->Data['photos']);$i++)
        {
            $pt=$this->Data['photos'][$i];
//            $pt=new buysell_carphotoEntity();
            $img=new Image(DEFAULT_PUBLICURL . $pt->getImg_flu());
            $CarDet->addElement($img);
        }
        $Page->addElement($CarDet);
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}
	private function getDataRow($Table,$DataField,$DataTitle,$isBig)
    {
        if(trim($DataField->getText())!="")
        {

            if(!$isBig)
            {
                $Table->addElement(new Lable($DataTitle));
                $Table->setLastElementClass('form_item_titlelabel');
                $Table->addElement($DataField);
                $Table->setLastElementClass('form_item_datalabel');
            }
            else
            {

                $Table->addElement(new Lable("$DataTitle"),2);
                $Table->setLastElementClass('form_item_titlelabel bigtitlelabel');
                $Table->addElement($DataField,2);
                $Table->setLastElementClass('form_item_datalabel bigdatalabel');
            }
        }
        return $Table;
    }
}
?>