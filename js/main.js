
(function($) {
    $.fn.ddCurrency = function(options) {

    	
    	var settings = $.extend({
    		success : null
        }, options);
    	
    	var data = [
                    { text: "LAK", value: "LAK" },
                    { text: "USD", value: "USD" },
                    { text: "THB", value: "THB" }
                ];

        // create DropDownList from input HTML element
        $(this).kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            value : $(this).val(),
            dataSource: data,
            index: 0,
            optionLabel: {
            	text: '- Based Currency -',
            	value: ""
	        },
            
        });

    }
}(jQuery));



(function($) {
    $.fn.ddUnit = function(options) {

    	
    	var settings = $.extend({
    		success : null
        }, options);
    	
    	var data = [
                    { text: "piece", value: "piece" },
                    { text: "hour", value: "hour" },
                    { text: "metre", value: "metre" },
                    { text: "bag", value: "bag" },
                    { text: "kg", value: "kg" },
                    { text: "litre", value: "litre" },
                    { text: "unit", value: "unit" },
                    { text: "hut", value: "hut" },
                    { text: "bottle", value: "bottle" },
                    { text: "package", value: "package" },
                    { text: "dozen", value: "dozen" },
                    { text: "card", value: "card" },
                    { text: "day", value: "day" },
                    { text: "set", value: "set" },
                ];

        // create DropDownList from input HTML element
        $(this).kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            value : $(this).val(),
            dataSource: data,
            index: 0,
            optionLabel: {
            	text: '- Unit -',
            	value: ""
	        },
            
        });

    }
}(jQuery));