
<div id="map_canvas"></div>
 <div id="showDD" style="margin:auto;padding-top:5px;">  
  ข้อมูลสถานที่<br />
  <textarea name="place_value" class="form-control" rows="2" id="place_value" style="width:380px;"></textarea>  
    <!-- <br />
    Latitude  
    <input name="lat_value" class="form-control" type="text" id="lat_value" value="0" />  
    Longitude  
    <input name="lon_value" class="form-control" type="text" id="lon_value" value="0" />  
     <br> -->
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
    var my_Latlng  = new GGM.LatLng(13.847860,100.604274);
     
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
