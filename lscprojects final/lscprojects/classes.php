<?php
	/* Created by Lucas Chapman 8/5/2020 */
	/* This PHP file is used to be included in other files, in order to create objects using the class created in this file */
	
	/*
	 * This class is used to store information related to orders
	 */
	class Orders {
		private $fname;
		private $lname;
		private $email;
		private $addr;
		private $city;
		private $state;
		private $cntry;
		private $zip;
		private $ccnum;
		private $ccexpm;
		private $ccexpy;
		private $cvv;
		private $itemType;	// used to hold data for a purchased product or service
		private $item;	// used to hold data for a purchased product or service
		private $qtyMon;	// used to hold the data for both quantity and months
		private $mem;
		private $cost;
		private $disc;
		
		/*
		 * Orders' Constructor
		 */
		public function __construct() {
			$this -> fname = "N.A.";
			$this -> lname = "N.A.";
			$this -> email = "N.A.";
			$this -> addr = "N.A.";
			$this -> city = "N.A.";
			$this -> state = "N.A.";
			$this -> cntry = "N.A.";
			$this -> zip = 0;
			$this -> ccnum = "N.A.";
			$this -> ccexpm = "N.A.";
			$this -> ccexpy = 0;
			$this -> cvv = 0;
			$this -> itemType = "N.A.";
			$this -> item = "N.A.";
			$this -> qtyMon = 0;
			$this -> mem = "No";
			$this -> cost = 0;
			$this -> disc = 0;
		}
		
		/*
		 * Setters (accessors)
		 */
		public function setFname(String $fn) {
			$this -> fname = $fn;
		}
		
		public function setLname(String $ln) {
			$this -> lname = $ln;
		}
		
		public function setEmail(String $e) {
			$this -> email = $e;
		}
		
		public function setAddr(String $ad) {
			$this -> addr = $ad;
		}
		
		public function setCity(String $cty) {
			$this -> city = $cty;
		}
		
		public function setState(String $st) {
			$this -> state = $st;
		}
		
		public function setCntry(String $ctry) {
			$this -> cntry = $ctry;
		}
		
		public function setZip(int $zCde) {
			$this -> zip = $zCde;
		}
		
		public function setCcnum(String $ccn) {
			$this -> ccnum = $ccn;
		}
		
		public function setCcexpm(String $expm) {
			$this -> ccexpm = $expm;
		}
		
		public function setCcexpy(int $expy) {
			$this -> ccexpy = $expy;
		}
		
		public function setCvv(int $cv) {
			$this -> cvv = $cv;
		}
		
		public function setItemType(String $imTe) {
			$this -> itemType = $imTe;
		}
		
		public function setItem(String $im) {
			$this -> item = $im;
		}
		
		public function setQtyMon(String $qm) {
			$this -> qtyMon = $qm;
		}
		
		public function setMem(String $mr) {
			$this -> mem = $mr;
		}
		
		public function setCost(float $cst) {
			$this -> cost = $cst;
		}
		
		public function setDisc(float $dct) {
			$this -> disc = $dct;
		}
		
	    /*
		 * Getters (mutators)
		 */
		public function getFname() {
			return $this -> fname;
		}
		
		public function getLname() {
			return $this -> lname;
		}
		
		public function getEmail() {
			return $this -> email;
		}
		
		public function getAddr() {
			return $this -> addr;
		}
		
		public function getCity() {
			return $this -> city;
		}
		
		public function getState() {
			return $this -> state;
		}
		
		public function getCntry() {
			return $this -> cntry;
		}
		
		public function getZip() {
			return $this -> zip;
		}
		
		public function getCcnum() {
			return $this -> ccnum;
		}
		
		public function getCcexpm() {
			return $this -> ccexpm;
		}
		
		public function getCcexpy() {
			return $this -> ccexpy;
		}
		
		public function getCvv() {
			return $this -> cvv;
		}
		
		public function getItemType() {
			return $this -> itemType;
		}
		
		public function getItem() {
			return $this -> item;
		}
		
		public function getQtyMon() {
			return $this -> qtyMon;
		}
		
		public function getMem() {
			return $this -> mem;
		}
		
		public function getCost() {
			return $this -> cost;
		}
		
		public function getDisc() {
			return $this -> disc;
		}
	}
?>