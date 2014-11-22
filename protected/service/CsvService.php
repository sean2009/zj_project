<?php
class CsvService extends BaseService{
	public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	
	public function import($filename,$result){
		$filename = $filename.".csv";
	    header('Content-type:text/csv; charset=UTF-8');
	    header('Content-Disposition:attachment;filename='.$filename);
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	    header('Expires:0');
	    header('Pragma:public');
	    $result = "\xEF\xBB\xBF".$result;
	    exit($result);
	}
}
?>