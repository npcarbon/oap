<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Map API 3 - google_map_v3_set_marker_from_list_menu.php</title>
<style type="text/css">
html { height: 100% }
body { 
    height:100%;
    margin:0;padding:0;
    font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
    font-size:12px;
}
/* css กำหนดความกว้าง ความสูงของแผนที่ */
#map_canvas { 
    width:550px;
    height:400px;
    margin:auto;
/*  margin-top:100px;*/
}
/* css กำหนดส่วนของการแสดง list menu */
div#list_menu_place{
    width:550px;
    margin:auto;    
}
</style>
 
 
</head>
 
<body>
<br />
<br />
<br />
<div id="list_menu_place">
<!--หาได้จากหน้า http://www.ninenik.com/content.php?arti_id=334-->
เลือกชื่อสถานที่ 
  <select name="name_place_list_menu" id="name_place_list_menu">
    <option value="">เลือกรายการ</option>
    <option value="15.9717357,102.62162109999997">ขอนแก่น</option>
    <option value="14.7579424,104.47233010000002">ศรีสะเกษ</option>
    <option value="17.7696871,102.75948470000003">หนองคาย</option>
    <option value="18.7964642,98.66005859999996">เชียงใหม่</option>
    <option value="19.8737421,99.72326729999997">เชียงราย</option>                
  </select>
  <input type="button" name="button2" id="button2" value="OK"  />
</div>
<div id="map_canvas"></div>
 <div id="showDD" style="margin:auto;padding-top:5px;width:550px;">  
  <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">  
  ข้อมูลสถานที่<br />
  <textarea name="place_value" rows="2" id="place_value" style="width:380px;"></textarea>  
    <br />
    Latitude  
    <input name="lat_value" type="text" id="lat_value" value="0" />  
    Longitude  
    <input name="lon_value" type="text" id="lon_value" value="0" />  
     
  Zoom  
  <input name="zoom_value" type="text" id="zoom_value" value="0" size="5" />  
  <br />
  <br />
  <input type="submit" name="button" id="button" value="บันทึก" />  
  </form>  
</div> 
   
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
var geocoder; // กำหนดตัวแปร สำหรับใช้งานข้อมูลสถานที่จาก Google Map
var my_Marker;
function initialize() { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    // กำหนดจุดเริ่มต้นของแผนที่
    var my_Latlng  = new GGM.LatLng(18.7964642,98.66005859999996);
     
    // เรียกใช้งานข้อมูล Geocoder ของ Google Map
    geocoder = new GGM.Geocoder();
     
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#map_canvas")[0]; 
    // กำหนด Option ของแผนที่
    var myOptions = {
        zoom: 7, // กำหนดขนาดการ zoom
        center: my_Latlng , // กำหนดจุดกึ่งกลาง
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
    };
    map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
     
    my_Marker = new GGM.Marker({ // สร้างตัว marker
        position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
    });
     
    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
    GGM.event.addListener(my_Marker, "dragend", function() {
        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
        map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker       
         
        // เรียกขอข้อมูลสถานที่จาก Google Map
        geocoder.geocode({"latLng": my_Point}, function(results, status) {
          if (status == GGM.GeocoderStatus.OK) {
            if (results[1]) {
                // แสดงข้อมูลสถานที่ใน textarea ที่มี id เท่ากับ place_value
              $("#place_value").val(results[1].formatted_address); // 
            }
          } else {
              // กรณีไม่มีข้อมูล
            alert("Geocoder failed due to: " + status);
          }
        });     
         
        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
        $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value 
        // $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
    });     
 
    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
    // GGM.event.addListener(map, "zoom_changed", function() {
    //     $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value  
    // });
 
}
// ฟังก์ชั่น สำหรับให้แผนทีไปที่จุดตามค่าตำแหน่งที่ส่งมา
function go_to_select_place(placeVal){
//  GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM   
//  console.log(placeVal);
    var positionVal=placeVal.split(","); // แยกค่าที่ส่งมาออกเป็นสองค่า คือ lat กับ lon
//  console.log(positionVal);
    var my_Latlng  = new GGM.LatLng(positionVal[0],positionVal[1]);
    map.setCenter(my_Latlng); // กำหนดตำแแน่งตรงกลางแผนที่
    my_Marker.setPosition(my_Latlng); // กำนหดตัวแปน่ง marker
//  map.panTo(my_Latlng);  // ให้แผนที่แสดงไปที่ตัว marker      
}
$(function(){
    // คำสั่งให้ทำเงิน เมื่อกดที่ปุ่ม นk ที่มี id เท่ากับ button2
    $("#button2").click(function(){
        // เอาคาจาก สist menu เข้าฟังก์ชัน go_to_select_place
        go_to_select_place($("select#name_place_list_menu").val()); 
    });
    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
    // v=3.2&sensor=false&language=th&callback=initialize
    //  v เวอร์ชัน่ 3.2
    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
    //  language ภาษา th ,en เป็นต้น
    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
    $("<script/>", {
      "type": "text/javascript",
      src: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDJwRvRpgrB96pTpRV6W0MVVaGRBh4dpsI&callback=initialize"
    }).appendTo("body");    
});
</script>  
</body>
</html>