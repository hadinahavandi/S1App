<?php

namespace Modules\appman\Entity;
use core\CoreClasses\services\EntityClass;
use core\CoreClasses\db\dbquery;
use core\CoreClasses\db\selectQuery;
use core\CoreClasses\db\updateQuery;
use core\CoreClasses\db\insertQuery;
use core\CoreClasses\db\dbaccess;


/**
 *@author Hadi AmirNahavandi
 *@CreationDate 2015/10/17 17:57:31
 *@LastUpdate 2015/10/17 17:57:31
 *@TableName appuser
 *@TableFields name t,mobile t,mail t,ismale i,role_systemuser_fid t
 *@SweetFrameworkHelperVersion 1.108
 *@TableCreationSQL
 
CREATE TABLE IF NOT EXISTS sweetp_appman_appuser (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`mobile` text NOT NULL,
`mail` text NOT NULL,
`ismale` int(11) NOT NULL,
`role_systemuser_fid` text NOT NULL,
`isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
*/


class appman_appuserEntity extends EntityClass {
	/**
	 * @var updateQuery
	 */
	private $UpdateQuery;
	/**
	 * @var selectQuery
	 */
	private $SelectQuery;
	/**
	 * @var insertQuery
	 */
	private $InsertQuery;
	public function __construct(dbaccess $DBAccessor)
	{
		$this->setDatabase(new dbquery($DBAccessor));
		$this->setTableName("appman_appuser");
	}
	public function Insert($Name,$Mobile,$Mail,$Ismale,$Role_systemuser_fid)
	{
		$this->InsertQuery=$this->getDatabase()->InsertInto($this->getTableName())
		->Set("name",$Name)
		->Set("mobile",$Mobile)
		->Set("mail",$Mail)
		->Set("ismale",$Ismale)
		->Set("role_systemuser_fid",$Role_systemuser_fid)
		->Set("isdeleted", "0");
		//echo $this->InsertQuery->getQueryString();
		//die();
		$this->InsertQuery->Execute();
		$InsertedID=$this->InsertQuery->getInsertedId();
		return $InsertedID;
	}
	public function Update($ID,$Name,$Mobile,$Mail,$Ismale,$Role_systemuser_fid)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->NotNullSet("name",$Name)
		->NotNullSet("mobile",$Mobile)
		->NotNullSet("mail",$Mail)
		->NotNullSet("ismale",$Ismale)
		->NotNullSet("role_systemuser_fid",$Role_systemuser_fid)
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Delete($ID)
	{
		$this->UpdateQuery=$this->getDatabase()->Update($this->getTableName())
		->Set("isdeleted","1")
		->Where()->Equal("isdeleted", "0")->AndLogic()->Equal("id",$ID);
		//echo $this->UpdateQuery->getQueryString();
		//die();
		$this->UpdateQuery->Execute();
	}
	public function Select($ID,$Name,$Mobile,$Mail,$Ismale,$Role_systemuser_fid,array $OrderByFields,array $IsDescendings,$Limit)
	{
		$this->SelectQuery=$this->getDatabase()->Select(array("*"))->From($this->getTableName())->Where()->Equal("1","1");
		if($ID!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("id",$ID);
		if($Name!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("name",$Name);
		if($Mobile!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mobile",$Mobile);
		if($Mail!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("mail",$Mail);
		if($Ismale!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("ismale",$Ismale);
		if($Role_systemuser_fid!==null)
			$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("role_systemuser_fid",$Role_systemuser_fid);
		for($i=0;$OrderByFields!==null && $i<count($OrderByFields);$i++)
			$this->SelectQuery=$this->SelectQuery->AddOrderBy($OrderByFields[$i], $IsDescendings[$i]);
		if($Limit!==null)
			$this->SelectQuery=$this->SelectQuery->setLimit($Limit);
		$this->SelectQuery=$this->SelectQuery->AndLogic()->Equal("isdeleted", "0");
		//echo $this->SelectQuery->getQueryString();
		//die();
		return $this->SelectQuery->ExecuteAssociated();
	}
}
?>
