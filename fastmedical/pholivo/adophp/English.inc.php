<?php
Class MessageList{
public $ErrorMessages= Array();
	public function __construct(){
		$this->Fill();
	}
	public function Fill(){
		$this->ErrorMessages[0]="Can Not Connect to Database!";
		$this->ErrorMessages[1]="Can Not Select Database!";
		$this->ErrorMessages[2]="FAILED!";
	}
}
?>