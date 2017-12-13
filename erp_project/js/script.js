/**
 * Created by Afaeld on 25/11/2017.
 */

(function($){
    $(function(){

        $('.button-collapse').sideNav();

    }); // end of document ready
})(jQuery); // end of jQuery name space

$(document).ready(function() {
    $('select').material_select();
});

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 120, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    format: 'yyyy-mm-dd',
    closeOnSelect: false // Close upon selecting a date,
});

$('.datepicker').change(function () {
    console.log($(this).val());
   $.post(
       "Controller/data.php",
       {
           newDate : $(".datepicker").val()
       },
       checkResult,
       'text'
   );
});

function checkResult(text)
{
    console.log(text);
}