<?php 
/*
	List Class
*/


class List {

	public function __construct($input) {


		if ( is_array($input) ) {

			foreach($input as $key => $value ) {
				$this->$key = $value;
			}
			
		}


	}

}