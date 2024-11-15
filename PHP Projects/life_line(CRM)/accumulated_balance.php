<?php
include('config.php');
include('allFunctions.php');
$id=$_REQUEST['id'];
$ending_date=$_REQUEST['ending_date'];
$dr=showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$id' AND info='Dr' AND tr_date<'$ending_date'");
$cr=showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$id' AND info='Cr' AND tr_date<'$ending_date'");
$bal=$dr-$cr;

?>