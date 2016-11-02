function calculate_func(){
	interestPerc = document.getElementById('interestPerc').value;
	if(interestPerc == '') { 
			alert("Please enter the interest percentage");
			exit();
		}
		else {
			if(isNaN(interestPerc)){
				alert("Please enter a number for the interest percentage")
			}
		}
	if(interestPerc >= 100) { 
			alert("Enter a value between 0 to 99.9");
			exit();
		}	
	totalDebt = document.getElementById('totalDebt').value;
	if(totalDebt == '' || totalDebt == '00.00') { 
			alert("Please enter your total debt");
			exit();
		}
	else{	
		if (isNaN(totalDebt)) {
			alert("Please enter a number");
			exit();
		}
	else{

	}
	}
	monthlyPay = document.getElementById('monthlyPay').value;
	if(monthlyPay == '' || monthlyPay == '00.00') { 
			alert("Please enter the monthly payment you can afford to become debt free");
			exit();
		}
	else{	
		if (isNaN(monthlyPay))
		{
			alert("Please enter a number");
			exit();
			}
	else{
		paybackToCreditor = totalDebt*(39/100);
		TotalEnrolment = totalDebt*(15/100);
	Total= paybackToCreditor + TotalEnrolment + 199 + 5 + (84.95*36)+(9.45*36) ;
		monthly_payment = Total/36;
		years = '3 Years';
		time1 ='3 Years';
	  Total = Math.round(Total*100)/100;
	 	document.getElementById('debtsettlement').value = Total;
		document.getElementById('time1').value = time1;
		debt_settlment_graph = Total;
		payment = totalDebt*(2.4/100);
		yearly_APR = totalDebt*(8/100);
		monthly_APR = yearly_APR/12;
 		amount_toward_balance = payment - monthly_APR;
		total_months_to_pay_off = totalDebt/amount_toward_balance;
		amount_total = payment * total_months_to_pay_off; 
		time2 = total_months_to_pay_off;
		years = time2/12;
		remainingMonths = time2%12; 
		time2 = parseInt(years)+'Yrs '+parseInt(remainingMonths)+'months';
		amount_total = Math.round(amount_total*100)/100;
		document.getElementById('consumer_credit_counseling').value = amount_total;
		document.getElementById('time2').value = time2;		
		owed=totalDebt;

		months = 0;
		owed_amount = parseFloat(owed);
		while(owed_amount>0){
			interest_amnt = (owed_amount/100)*interestPerc;
   			this_month_interst = interest_amnt/12;
			interest_cut = parseInt(monthlyPay)-parseInt(this_month_interst);
    		owed_amount = parseFloat(owed_amount)-interest_cut;
			months++;
			if(months==200){
				owed_amount=-1;
			}
	}
	if(months>=200){
		total_including_interest=0;
		document.getElementById('staying_current').value ='can never pay';
		document.getElementById('time3').value = 'Infinite';
	}
	else{
total_including_interest = months*monthlyPay;
time3 =months;

years = time3/12;
		remainingMonths = time3%12; 
		time3 = parseInt(years)+' Yrs '+parseInt(remainingMonths)+'months';
		document.getElementById('staying_current').value =total_including_interest;
		document.getElementById('time3').value = time3;
	}
		document.getElementById('td1').value =totalDebt;
		document.getElementById('td2').value =totalDebt;
		document.getElementById('td3').value =totalDebt;
		document.getElementById('interestPerc1').value =interestPerc;
		monthly_payment = Math.round(monthly_payment*100)/100;

		document.getElementById('monthly_payment').value = monthly_payment;

		payment = Math.round(payment*100)/100;

		document.getElementById('payment').value = payment;

		monthlyPay = Math.round(monthlyPay*100)/100;

		document.getElementById('monthlyPay1').value = monthlyPay;

		//displayin box
	
		jQuery('#calculation').slideDown("slow");
		jQuery(document).ready(function(){
        jQuery.jqplot.config.enablePlugins = true;
        var s1 = [debt_settlment_graph, amount_total, total_including_interest];
        var ticks = ['Debt Settlment', 'Consumer Credit Counseling', 'On your own'];
        
        plot1 = jQuery.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !jQuery.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:jQuery.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
			axesDefaults: {
        tickRenderer: jQuery.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30
        }
    },
            axes: {
                xaxis: {
                    renderer: jQuery.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
        	},
            highlighter: { show: false }
        });
    
        jQuery('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                jQuery('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
   });
   
   jQuery(document).ready(function(){
        jQuery.jqplot.config.enablePlugins = true;
        var s1 = [monthly_payment, payment, monthlyPay];
        var ticks = ['Debt Settlment', 'Consumer Credit Counseling', 'On your own'];
        
        plot1 = jQuery.jqplot('chart2', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !jQuery.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:jQuery.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
			axesDefaults: {
        tickRenderer: jQuery.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: -30
        }
    },
            axes: {
                xaxis: {
                    renderer: jQuery.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
    
        jQuery('#chart2').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                jQuery('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
   });
	}}

}
function embed_func(){

	jQuery('#embed').slideDown("slow");

}