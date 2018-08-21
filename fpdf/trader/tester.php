<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="jQuery Calendar, Month Calendar, MonthCalendar, DateTimeInput, DateTimePicker, Date Picker" />
    <meta name="description" content="This demo demonstrates the jqxDateTimeInput widget. Click the calendar button to open the popup and select a date from the calendar. 
You can also enter a date by typing into the jqxDateTimeInput text input field." />
    <title id='Description'>This demo demonstrates the jqxDateTimeInput widget. Click the
        calendar button to open the popup and select a date from the calendar. You can also
        enter a date by typing into the jqxDateTimeInput text input field. </title>
        <link rel="stylesheet" href="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/scripts/jquery-1.11.1.min.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/scripts/demos.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/globalization/globalize.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxtooltip.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxcalendar.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxdatetimeinput.js"></script>
    <script src="https://www.jqwidgets.com/jquery-widgets-demo/jqwidgets/jqxcore.js"></script>

</head>
<body>
    <div id='content'>
        <script type="text/javascript">
            $(document).ready(function () {               
                // Create a jqxDateTimeInput
                $("#dateInput").jqxDateTimeInput({ width: '300px', height: '25px' });
                $("#timeInput").jqxDateTimeInput({formatString: "T", showTimeButton: true, showCalendarButton: false, width: '300px', height: '25px' });
                $("#dateTimeInput").jqxDateTimeInput({ formatString: "F", showTimeButton: true, width: '300px', height: '25px' });
            });
        </script>
        <label>Date Input</label>
        <div id='dateInput'>
        </div>
        <br />
        <label>Time Input</label>
        <div id='timeInput'>
        </div>
        <br />
        <label>Date Time Input</label>
        <input type="text" id='dateTimeInput'>
        </div>
    </div>
</body>
</html>