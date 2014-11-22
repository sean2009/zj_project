<?php

require_once('MmsBuilder.php');
require_once('MmsConst.php');
class MmsContent{
	  public $ContentType;
	  public $ContentID;
	  public $ContentLocation;
	  public $Charset;
	  public $byteOutput;

	  public $fileName;

	 function __construct() 
    { 
		$this->ContentID = "";
		$this->ContentLocation = "";
		$this->Charset = "utf-8";

    }
    public function getSize()
  {
    return filesize($this->fileName);
  }
	public function toString()
  {
	$sb = "ContentType=" . $this->ContentType . "\n".
	"ContentID=" . $this->ContentID . "\n".
    "Charset=" . $this->Charset . "\n".
    "ContentLocation=" . $this->ContentLocation . "\n".
    "byteOutput=" . $this->byteOutput . "\n";
    return $sb;
  }

  public function CreateFromBytes($data)
  {
    $this->byteOutput = $data;
	$this->ContentID = "";
	$this->ContentLocation = "";
	$this->Charset = "utf-8";
  }

  

   public function CreateFromFile($fileName)
  {
		  $this->fileName = $fileName;

	      $data = base64_encode(file_get_contents($this->fileName));
	      $name = basename($this->fileName);
	      
	      $this->byteOutput = $data;
	      $this->ContentID = $name;
	      if(stripos($name,"gif")>0){
	    	  $this->ContentType = $GIF;
	      }
	      else if(stripos($name,"amr")>0){
	    	  $this->ContentType = $AMR;
	      }
	      else if(stripos($name,"JPEG")>0){
	    	  $this->ContentType = $JPEG;
	      }
	      else if(stripos($name,"JPG")>0){
	    	  $this->ContentType = $JPEG;
	      }
	      else if(stripos($name,"MID")>0){
	    	  $this->ContentType = $MIDI;
	      }
	      else if(stripos($name,"MIDI")>0){
	    	  $this->ContentType = $MIDI;
	      }
	      else if(stripos($name,"PNG")>0){
	    	  $this->ContentType = $PNG;
	      }
	      else if(stripos($name,"SMIL")>0){
	    	  $this->ContentType = $SMIL;
	      }
	      else if(stripos($name,"TXT")>0){
	    	  $this->ContentType = $TEXT;
	      }
	      else if(stripos($name,"TEXT")>0){
	    	  $this->ContentType = $TEXT;
	      }
	      else if(stripos($name,"WBMP")>0){
	    	  $this->ContentType = $WBMP;
	      }

		  return $this;
	}

}
	$Mms = new MmsContent();
	$temp = new MmsBuilder();

	$Mms->CreateFromFile("C:\\logo.gif");

	
	$temp->AddContent($Mms);

	//$Mms = new MmsContent();
	$Mms->CreateFromBytes(base64_encode('你好'));
	$Mms->Charset='gbk2312';
	$Mms->ContentID='2';
	$Mms->ContentType=$TEXT;
	
	$temp->AddContent($Mms);

	echo $temp->BuildContentToXml();
?>