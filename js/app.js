$(function()
    {
    	$(document).foundation('reflow');
    	$(document).foundation(
			{
				tooltip:
				{
				    selector : '.has-tip',
				    touch_close_text: 'tap to close',
				    disable_for_touch: false
				}
			}
    	);

		de = function()
		{
			if(event.keyCode == 13)
			{
				var OPTIONS = Foundation.utils.S('#options').val();
				var DATE = Foundation.utils.S('#date').val();

				console.log(DATE);

    			if(DATE == '')
    			{
    				Foundation.utils.S('#date').focus();
    				alert('Bitte Datum angeben!');
    				return false;
    			}
    			else
    			{
        			location.href = './?date=' + DATE + '&options=' + OPTIONS;
    			}
			}  
		}

    	Foundation.utils.S('#datr').bind('submit', function()
        	{
    			return false;
			}
		);

    	Foundation.utils.S('#submitr').bind('click', Foundation.utils.debounce(function(e)
        	{
        		var OPTIONS = Foundation.utils.S('#options').val();
    			var DATE = Foundation.utils.S('#date').val();
    			
    			if(DATE == '')
    			{
    				Foundation.utils.S('#date').focus();
    				alert('Bitte Datum angeben!');
    				return false;
    			}
    			else
    			{
					location.href = './?date=' + DATE + '&options=' + OPTIONS;
    			}
			}
		,300,true));

		Foundation.utils.S('#options').bind('change', function ()
			{
				var OPTIONS = Foundation.utils.S('#options').val();
    			var DAY = Foundation.utils.S('#dp-day').val();
    			var MONTH = Foundation.utils.S('#dp-month').val();
				var YEAR = Foundation.utils.S('#dp-year').val();
				var DATE = DAY + '.' + MONTH + '.' + YEAR;

				if(DAY == '' || MONTH == '' || YEAR == '')
				{
					if(DAY == '')
					{
						Foundation.utils.S('#dp-day').focus();
					}
					else if(MONTH == '')
					{
						Foundation.utils.S('#dp-month').focus();
					}
					else if(YEAR == '')
					{
						Foundation.utils.S('#dp-year').focus();
					}

    				alert('Bitte Datum angeben!');
    				return false;
				}
				else
				{
					location.href = './?date=' + DATE + '&options=' + OPTIONS;
				}
			}
		);

    	Foundation.utils.S('.datepicker').bind('change', function()
        	{
        		var OPTIONS = Foundation.utils.S('#options').val();
    			var DAY = Foundation.utils.S('#dp-day').val();
    			var MONTH = Foundation.utils.S('#dp-month').val();
				var YEAR = Foundation.utils.S('#dp-year').val();
				var DATE = DAY + '.' + MONTH + '.' + YEAR;

				if(DAY == '' || MONTH == '' || YEAR == '')
				{
					if(DAY == '')
					{
						Foundation.utils.S('#dp-day').focus();
					}
					else if(MONTH == '')
					{
						Foundation.utils.S('#dp-month').focus();
					}
					else if(YEAR == '')
					{
						Foundation.utils.S('#dp-year').focus();
					}

    				alert('Bitte Datum angeben!');
    				return false;
				}
				else
				{
					location.href = './?date=' + DATE + '&options=' + OPTIONS;
				}
			}
		);
    }
);
