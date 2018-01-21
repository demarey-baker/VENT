$(function(){

	$("#date-picker-2").datepicker({ 
		minDate: 0,
        dateFormat:'yy/mm/dd', 
		 onSelect: function (date) {
                var date2 = $('#date-picker-2').datepicker('getDate');
                date2.setDate(date2.getDate());
                $('#date-picker-3').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#date-picker-3').datepicker('option', 'minDate', date2);
	}
	});

	$("#date-picker-3").datepicker({ 
        dateFormat:'yy/mm/dd', 
		 onClose: function () {
                var dt1 = $('#date-picker-2').datepicker('getDate');
                console.log(dt1);
                var dt2 = $('#date-picker-3').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = $('#date-picker-3').datepicker('option', 'minDate');
                    $('#date-picker-3').datepicker('setDate', minDate);

               }
        }
	});

});

 