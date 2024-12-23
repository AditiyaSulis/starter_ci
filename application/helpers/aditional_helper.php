<?php
defined('BASEPATH') OR exit('No direct script access allowed');




function removeTagFlashData($flashMssg){
    $string = trim(preg_replace('/\s+/', ' ', $flashMssg));
    return str_replace(['<p>', '</p>'], '', $string);
}