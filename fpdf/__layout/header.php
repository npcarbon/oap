<?php 
require '../function/database.php';
    if (!@isset($_SESSION['login'])) {
        header("Location: ../login.php");
        exit;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <title>สำนักงานปรมาณูเพื่อสันติ</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/dashboard/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
    $( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
  } );
      /*jslint browser:true*/
    /*global jQuery, document*/
    jQuery(document).ready(function () {
        'use strict';
        jQuery('#search-from-date').datetimepicker({format:'Y-m-d H:i:s'});
    });
  </script>
  <style>
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
    width:70%;
    height:400px;
    margin:auto;
}
/* css กำหนดส่วนของการแสดง list menu */
div#list_menu_place{
    width:550px;
    margin:auto;    
}

</style>
</head>
