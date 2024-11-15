<?php
//include("config.php");
//include("allFunctions.php");


executeQuery( " UPDATE `m_account_detail` SET status='Dispatched' WHERE type!='' AND tr_description LIKE '%dispatch%';");

executeQuery( " UPDATE `m_account_detail` SET status='Paid Service Charges' WHERE type!='' AND tr_description LIKE '%Paid Service Charges%';");

executeQuery( " UPDATE `m_account_detail` SET status='Paid Return Service Charges' WHERE type!='' AND tr_description LIKE '%Paid Return Service Charges%';");

executeQuery( " UPDATE `m_account_detail` SET status='Delivered' WHERE type!='' AND tr_description LIKE '%Delivering%';");

executeQuery( " UPDATE `m_account_detail` SET status='Consultency Fee Charged' WHERE type!='' AND tr_description LIKE '%Consultency Fee Charged%';");

executeQuery( " UPDATE `m_account_detail` SET status='Return Stock Received' WHERE type!='' AND tr_description LIKE '%Return Stock Received%';");executeQuery( "UPDATE `m_account_detail` SET status='Consultency Fee' WHERE type!='' AND tr_description LIKE '%Consultency Fee%';");

executeQuery( "UPDATE `m_account_detail` SET status='Received Payment' WHERE type!='' AND tr_description LIKE '%Received Payment%';");

executeQuery( "UPDATE `m_account_detail` SET status='Automated Clearance' WHERE type!='' AND tr_description LIKE '%Automated Clearance%';");


executeQuery( " UPDATE `m_account_detail` SET order_date=(SELECT order_date FROM `order_dispatch_info` WHERE order_id=m_account_detail.type) WHERE type>=0;");

executeQuery( " UPDATE order_dispatch_info_history
SET order_dispatch_info_history.status =
  (SELECT order_dispatch_info.status
   FROM order_dispatch_info
   WHERE order_dispatch_info.order_id = order_dispatch_info_history.order_id)");

executeQuery( "UPDATE order_dispatch_info_history
SET order_dispatch_info_history.tracking_id =
  (SELECT order_dispatch_info.tracking_id
   FROM order_dispatch_info
   WHERE order_dispatch_info.order_id = order_dispatch_info_history.order_id);");
?>