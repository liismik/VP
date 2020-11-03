<?php

	class First{
		//muutujad, klassis omadused (properties)
		//klassis on olemas privaatsed muutujad ja avalikud muutujad
		private $mybusiness;
		public $everybodysbusiness;
		
		//kui klass kasutusele võtta, siis:
		function __construct($limit){
			//mybusiness ette pole $ vaja, sest this'i ees on juba $ olemas
			$this->mybusiness = mt_rand(0, $limit);
			$this->everybodysbusiness = mt_rand(0, 100);
			echo "Arvude korrutis on: " .$this->mybusiness * $this->everybodysbusiness;
			$this->tellSecret();
		} //construct lõppeb
		
		function __destruct(){
			echo " Nägite hulka mõttetut infot!";
		}
		
		private function tellSecret(){
			echo " Saladusi võib ka välja rääkida!";
		}
		//funktsioonid, klassis meetodid (methods)
		public function tellMe(){
			echo " Salajane arv on " .$this->mybusiness;
		}
	}//class lõppeb