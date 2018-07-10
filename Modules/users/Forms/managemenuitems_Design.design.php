<?php
namespace Modules\users\Forms;
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
*@creationDate 1397-01-17 - 2018-04-06 23:29
*@lastUpdate 1397-01-17 - 2018-04-06 23:29
*@SweetFrameworkHelperVersion 2.004
*@SweetFrameworkVersion 2.004
*/
class managemenuitems_Design extends FormDesign {
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
        private $listPage;
    private $itemPage;
    private $itemViewPage;
    /**
     * @param bool $adminMode
     */
    public function setAdminMode($adminMode)
    {
        $this->adminMode = $adminMode;
        $this->itemViewPage = 'menuitem';
        if($adminMode==true)
        {
            $this->itemPage = 'managemenuitem';
            $this->listPage = 'managemenuitems';
        }
        else
        {
            $this->itemPage = 'manageusermenuitem';
            $this->listPage = 'manageusermenuitems';
        }
    }
	public function __construct()
	{
		parent::__construct();
	}
	public function getBodyHTML($command=null)
	{
		$Page=new Div();
		$Page->setClass("sweet_formtitle");
		$Page->setId("users_managemenuitems");
		$Page->addElement($this->getPageTitlePart("مدیریت " . $this->Data['menuitem']->getTableTitle() . " ها"));
		$addUrl=new AppRooter('users',$this->itemPage);
		$LblAdd=new Lable('افزودن آیتم جدید');
		$lnkAdd=new link($addUrl->getAbsoluteURL(),$LblAdd);
		$lnkAdd->setClass('linkbutton btn btn-primary');
		$lnkAdd->setGlyphiconClass('glyphicon glyphicon-plus');
		$lnkAdd->setId('addmenuitemlink');
		$Page->addElement($lnkAdd);
		$SearchUrl=new AppRooter('users',$this->listPage);
		$SearchUrl->addParameter(new URLParameter('search',null));
		$LblSearch=new Lable('جستجو');
		$lnkSearch=new link($SearchUrl->getAbsoluteURL(),$LblSearch);
		$lnkSearch->setClass('linkbutton btn btn-primary');
		$lnkSearch->setGlyphiconClass('glyphicon glyphicon-search');
		$lnkSearch->setId('searchmenuitemlink');
//		$Page->addElement($lnkSearch);
		if($this->getMessage()!="")
			$Page->addElement($this->getMessagePart());
		$TableDiv=new Div();
		$TableDiv->setClass('table-responsive');
		$LTable1=new ListTable(3);
		$LTable1->setHeaderRowCount(1);
		$LTable1->setClass("table-striped table-hover managelist");
		$LTable1->addElement(new Lable('#'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عنوان'));
		$LTable1->setLastElementClass("listtitle");
		$LTable1->addElement(new Lable('عملیات'));
		$LTable1->setLastElementClass("listtitle");
		for($i=0;$i<count($this->Data['data']);$i++){
			$url=new AppRooter('users',$this->itemPage);
			$url->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$Title=$this->Data['data'][$i]->getLatintitle();
			if($Title=="")
				$Title='- بدون عنوان -';
			$lbTit[$i]=new Lable($Title);
			$liTit[$i]=new link($url->getAbsoluteURL(),$lbTit[$i]);
			$UPURL=new AppRooter('users',$this->listPage);
			$UPURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $UPURL->addParameter(new UrlParameter('moveup',1));
            $UPURL->addParameter(new UrlParameter('place',$i*1));
			$lbUP[$i]=new Lable('');
			$lnkUP[$i]=new link($UPURL->getAbsoluteURL(),$lbUP[$i]);
			$lnkUP[$i]->setGlyphiconClass('glyphicon glyphicon-chevron-up');
			$lnkUP[$i]->setClass('btn btn-primary');
            $DownURL=new AppRooter('users',$this->listPage);
            $DownURL->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
            $DownURL->addParameter(new UrlParameter('movedown',1));
            $DownURL->addParameter(new UrlParameter('place',$i*1));
            $lbDown[$i]=new Lable('');
            $lnkDown[$i]=new link($DownURL->getAbsoluteURL(),$lbDown[$i]);
            $lnkDown[$i]->setGlyphiconClass('glyphicon glyphicon-chevron-down');
            $lnkDown[$i]->setClass('btn btn-primary');
			$delurl=new AppRooter('users',$this->listPage);
			$delurl->addParameter(new UrlParameter('id',$this->Data['data'][$i]->getID()));
			$delurl->addParameter(new UrlParameter('delete',1));
			$lbDel[$i]=new Lable('حذف');
			$lnkDel[$i]=new link($delurl->getAbsoluteURL(),$lbDel[$i]);
			$lnkDel[$i]->setGlyphiconClass('glyphicon glyphicon-remove');
			$lnkDel[$i]->setClass('btn btn-danger');
			$operationDiv[$i]=new Div();
			$operationDiv[$i]->setClass('operationspart');
			$operationDiv[$i]->addElement($lnkDown[$i]);
            $operationDiv[$i]->addElement($lnkUP[$i]);
			$operationDiv[$i]->addElement($lnkDel[$i]);
			$LTable1->addElement(new Lable($i+1));
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($liTit[$i]);
			$LTable1->setLastElementClass("listcontent");
			$LTable1->addElement($operationDiv[$i]);
			$LTable1->setLastElementClass("listcontent");
		}
		$TableDiv->addElement($LTable1);
		$Page->addElement($TableDiv);
		$Page->addElement($this->getPaginationPart($this->Data['pagecount'],"users",$this->listPage));
		$form=new SweetFrom("", "POST", $Page);
		return $form->getHTML();
	}    
    public function getJSON()
    {
       parent::getJSON();
       $Result=['message'=>$this->getMessage(),'messagetype'=>$this->getMessageType()];
       return json_encode($Result);
    }
}
?>