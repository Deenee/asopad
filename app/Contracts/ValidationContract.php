<?php

namespace App;

interface ValidationContract{
	public function validate($rules);
	public function message();
}