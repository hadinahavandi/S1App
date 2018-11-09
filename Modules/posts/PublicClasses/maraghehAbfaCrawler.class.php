<?php

namespace Modules\posts\PublicClasses;

use core\CoreClasses\SweetDate;
/**
 *
 * @author nahavandi
 *        
 */
class maraghehAbfaCrawler extends Crawler{
	private $ArchiveUrl;
	private $MaxPosts=5;
	private $SearchText;
	public function __construct()
	{
	}
	public function getPostsArray()
	{
		
		$ListURL="http://www.abfa-maragheh.ir/";
		$ListItemsLogic="#table1 a.bd1";
		$RootURL="http://www.abfa-maragheh.ir";
		$ContentLogic="#toph1";
		
		$titles=array();
		$links=array();
		$summary=array();
		$contents=array();
		$dposter=new \data_poster();
		$dom=new \simple_html_dom();
		
		
		//***********Title***********//

		$html=sweet_file_get_html($ListURL);
		$Elements=$html->find($ListItemsLogic);
 		echo count($Elements);
		$maxTitleLength=110;
		$maxSummaryLength=300;
		for($i=0;$i<count($Elements) && $i<$this->MaxPosts;$i++)
		{
			$titles[$i]=trim($Elements[$i]->plaintext);
			
			if(strlen($titles[$i])>=$maxTitleLength)
			{
			    $spaceaftermax=strpos($titles[$i]," ",$maxTitleLength);
			    $titles[$i]=substr($titles[$i],0,$spaceaftermax) . "...";
			}
			     
			$links[$i]=$RootURL . html_entity_decode($Elements[$i]->href);
			echo $titles[$i] . "</br>";
		}
		$postsCount=$i;
		//***********Title***********//
		$contents=array();
		for($i=0;$i<$postsCount;$i++)
		{
			$response=sweet_file_get_html($links[$i]);
			$html=str_get_html($response);
			$element=$html->find($ContentLogic,0);
			$contents[$i]=$element->innertext;
			$contents[$i]=str_replace("src=\"","src=\"".$RootURL,$contents[$i]);
			$contents[$i]=str_replace("src='","src='".$RootURL,$contents[$i]);
			$contents[$i]=str_replace("style","disabledstyle",$contents[$i]);
			$contents[$i]=str_replace("bgcolor","disabledbgcolor",$contents[$i]);
			$contents[$i]=str_replace("table","div",$contents[$i]);
			$contents[$i]=str_replace("td","div",$contents[$i]);
			$contents[$i]=str_replace("tr","div",$contents[$i]);
			$contents[$i]=str_replace("face","disabledface",$contents[$i]);

			$summary[$i]=$element->plaintext;
            $firstSentenceEnd=strpos($summary[$i],".",$maxSummaryLength);
            $foundSentenceEnd=true;
            if($firstSentenceEnd<=1)
            {
                $foundSentenceEnd=false;
                $firstSentenceEnd=strpos($summary[$i]," ",$maxSummaryLength);
            }
            $summary[$i]=substr($summary[$i],0,$firstSentenceEnd+1);
 			if(!$foundSentenceEnd && strlen($summary[$i])>=$maxSummaryLength)
     			$summary[$i]=$summary[$i]. "...";
		}
		$result=array("titles"=>$titles,"contents"=>$contents,"summary"=>$summary,"links"=>$links,"description"=>$summary);
//		print_r($result);
//		die();
		return $result;
		
	}

	protected function getMaxPosts()
	{
	    return $this->MaxPosts;
	}

	protected function setMaxPosts($MaxPosts)
	{
	    $this->MaxPosts = $MaxPosts;
	}

	public function getSearchText()
	{
	    return $this->SearchText;
	}

	public function setSearchText($SearchText)
	{
	    $this->SearchText = $SearchText;
	}
}

?>