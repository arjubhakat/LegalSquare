/*
 * @author:		Edgar Hernandez
 * Email:		edgarr41@att.net
 * Date:		March 8, 2015
 * 
 * Formula used to calculate monthly payment:
 *      i * P * (1 + i)^n
 * A = -------------------
 *       (1 + i)^n - 1
 */ 
 
var payment; // Global variable to hold our payment array information
  
function amortization(){
   var P = document.getElementById("principal").value; // Original Loan Amount
   var i = document.getElementById("interest").value; // Interest Rate
   var n = document.getElementById("term").value; // Number of Payments
   
   valid = validateForm(P,i,n);
   if(valid === false){
      return;  //Validation failed.  Exit script after alerting user.
   }
   
   var A; // Monthly Payment
   var interest; // Interest payment
   var principal; // Principal payment
   var balance; // Loan balance
   var pages; // Number of pages
   
   i = (i/100) / 12; //Change from yearly to monthly interest
   n = n * 12; // Change from years to months
   A = (i * P * Math.pow(1+i,n))/(Math.pow(1+i,n)-1); // Amortized Monthly Payment
   balance = P; // Set balance to original loan amount
   payment = new Array(n); // Create an empty payment array and limit it to the number of payments (n)
   
   for(x=0;x<n;x++){
    interest = balance * i;  // Calculate monthly interest payment
    principal = A - interest; // Calculate monthly principal payment
    balance = balance - principal; //Calculate balance;
	
	// Fill array with data
	payment[x] = [A, principal, interest, balance];
   }
   
   pagination();  // Call our pagination function.
   pages = n / 12; // Set the number of pages to the number of years;
   paginationBar(pages); // Call our pagination bar.
}

function resetForm(){
    var elements = ["principal", "interest", "term"];
    var table = document.getElementById("amortization");
    var bar = document.getElementById("pagination");
    
    for(i=0;i<elements.length;i++){
        removeMessage(elements[i]);
    }
    
    table.innerHTML = ''; // Clear amortization table
    bar.innerHTML = ''; // Clear our pagination bar
    payment = ''; // Clear our payment array
    document.getElementById(elements[0]).focus();  // focus first element in array
}

function paginationBar(pages){
    var bar;
    var pages;
    
    bar = '<li id="previous"><a href="#" onclick="return false;" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a><li>';
    for(i=1;i<=pages;i++){
        bar+= '<li><a href="#" onclick="pagination(' + i + '); return false;">' + i + '</a></li>';
    }
    bar+= '<li id="next"><a href="#" onclick="pagination(2); return false" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
    
    document.getElementById("pagination").innerHTML = bar; // Write our pagination bar to the HTML document
}

function previousPage(p){
    var previous;
    var p = p - 1;
    
    previous = '<a href="#" aria-label="Previous" onclick="pagination(' + p + '); return false"><span aria-hidden="true">&laquo;</span></a>';
    document.getElementById("previous").innerHTML = previous; // Write our result to the HTML document
    
}

function nextPage(p){
    var next;
    var p = p + 1;
    
    next = '<a href="#" aria-label="Next" onclick="pagination(' + p + '); return false"><span aria-hidden="true">&raquo;</span></a>';
    document.getElementById("next").innerHTML = next; // Write our result to the HTML document	
}

function pagination(p, n){
    var tbody;
    var p = typeof p !== 'undefined' ? p : 1; // Set page 1 as our default starting page
    var n = typeof n !== 'undefined' ? n : 12; // Set 12 rows as default
    var end = p * n; // Set last record in range
    var start = end - n; // Set first record in range
    
    // Create amortization to fill our table
    
    tbody = "";
    try{
	for(i=start;i<end;i++){
           // Create the rows for the amortization table
	    paymentNumber = i + 1;
	    tbody+= "<tr>";
	    tbody+= "<td class=\"text-right\">" + paymentNumber + "</td>";
	    for(j=0;j<4;j++){
		number = numberWithCommas(payment[i][j].toFixed(2));  // Call our function to format our numeric value with commas
		tbody+= "<td class=\"text-right\">" + number + "</td>";
	    }
	    tbody+= "</tr>";
	}
	document.getElementById("amortization").innerHTML = tbody; // Write our result to the HTML document
	previousPage(p);
	nextPage(p);
    }
    catch(err){ // If we catch any errors on our pagination, we simply return.
	return;
    }
}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function validateForm(P,i,n){
    var P;
    var i;
    var n;
    
    principal = /^(?:[1-9]\d*(\.\d{1,2})?)$/; //Check for numeric characters; value has to be greater than 0
    interest = /^([1-9](\.\d{1,2})?|1\d(\.\d{1,2})?|2[0-4](\.\d{1,2})?|25)$/; //Check for numeric characters between 1 and 25
    term = /^(?:[1-9]|(?:[1-3][0-9])|(?:[4][0-5]))$/; //Check for numeric characters between 1 and 45
    
    if (!principal.test(P)) {
        /* non-digit found */
        displayMessage("principal");
        return false; //Failed validation
    } else {
        removeMessage("principal");
    }
    if(!interest.test(i)){
        /* non-digit or out of range number found */
        displayMessage("interest");
	return false; //Failed validation
    } else {
        removeMessage("interest");
    }
    if(!term.test(n)){
        /* non-digit or out of range number found */
        displayMessage("term");
	return false;//Failed validation
    } else {
        removeMessage("term");
    }
	return true; //Passed validation
}

function displayMessage(elementId){
    var element = document.getElementById(elementId);
    var group = document.getElementById(elementId + '-group');
    var error = document.getElementById(elementId + '-error');
    
    group.className += " has-error";
    error.className = "text-warning";
    element.focus();
}

function removeMessage(elementId){
    var group = document.getElementById(elementId + '-group');
    var error = document.getElementById(elementId + '-error');
    
    group.className = group.className.replace( /(?:^|\s)has-error(?!\S)/g , '' );
    error.className = "hidden";
}