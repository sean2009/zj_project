<?php

class MmsBuilder
{
	public $mmsContentList = array();
	public $i = 0;
	/**
	 * The main function for converting to an XML document.
	 * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
	 *
	 * @param array $data
	 * @param string $rootNodeName - what you want the root node to be - defaultsto data.
	 * @param SimpleXMLElement $xml - should only be used recursively
	 * @return string XML
	 */
	 
	public function BuildContentToXml()
	{
		$data = $this->mmsContentList;
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml.='<masmms>';
		$temp1 = '';
		// loop through the data passed in.
		foreach($data as $key => $value)
		{
			
			$temp = '<content ';
			foreach($value as $k => $v)
			{
				if($k!='byteOutput'){

					$temp.=$k.'="'.$v.'" ';
				}				
			}
			$temp .= '>'.$value[byteOutput].'</content>';
			$temp1.=$temp;

	}
		// pass back as string. or simple xml object if you want!
		return $xml.$temp1.'</masmms>';
	}

	public function AddContent($mmsContent){
		
		$temp = array('ContentType'=>$mmsContent->ContentType,
			'ContentID'=>$mmsContent->ContentID,
			'ContentLocation'=>$mmsContent->ContentLocation,
			'Charset'=>$mmsContent->Charset,
			'byteOutput'=>$mmsContent->byteOutput);
		$this->mmsContentList[$this->i] = $temp;
		$this->i++;

	}

}

?>