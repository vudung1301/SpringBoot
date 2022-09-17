<?php


class Format{
	public function formatDate($date){
		return date('F, j, y, g:i a', strtotime($date));
	}

	public function textShort($text, $litmit = 400){
		$text = $text." ";
		$text=  substr($text, 0, $litmit);
		$text= substr($text, 0, strrpos($text, ' '));
		$text= $text."....";
		return $text;
	}

	public function validation($data){
		$data =trim($data);
		$date= stripcslashes($data);
		$data= htmlspecialchars($data);
		return $data;
	}
	public function title(){
		$path=$_SERVER['SCRIPT_FILENAME'];
		$title= basename($path, ".php");
		if($title=='index'){
			$title= 'home';
		}elseif ($title=='contact') {
			$title='contact';
		}
		return $title =ucfirst($tiltle);
	}
}
?>