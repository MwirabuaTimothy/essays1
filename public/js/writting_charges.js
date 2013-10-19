function doOrderFormCalculation() {
    orderForm = document.getElementById('order_form');
    var orderCostPerPage = 0;
    var orderTotalCost = 0;
    var single = orderForm.o_interval.checked;
    numpages = orderForm.numpages;

    var discount = orderForm.discount_percent_h.value;
    ecost = '';
    var ecostx = '';

    _document_type  =  orderForm.document_type;
    _academic_level  =  orderForm.academic_level;
    _urgency  =  orderForm.urgency;
    _subject_area  =  orderForm.subject_area;
    _curr  =  orderForm.curr;

    document_type  =  orderForm.document_type.selectedIndex+1;
    academic_level  =  orderForm.academic_level.selectedIndex+1;
    urgency  =  orderForm.urgency.selectedIndex+1;
    subject_area  =  orderForm.subject_area.selectedIndex+1;
    curr  =  orderForm.curr.selectedIndex+1;


    console.log('_document_type is '+document_type);
    console.log('_academic_level is '+academic_level);
    console.log('_urgency is '+urgency);
    console.log('_subject_area is '+subject_area);
    console.log('_curr is '+curr);

    console.log('doTypeOfDocumentCost(_document_type) is '+doTypeOfDocumentCost(_document_type));
    console.log('doAcademicLevelCost(_academic_level) is '+doAcademicLevelCost(_academic_level));
    console.log('doUrgencyCost(_urgency) is '+doUrgencyCost(_urgency));
    console.log('doSubjectAreaCost(_subject_area) is '+doSubjectAreaCost(_subject_area));
    console.log('doCurrencyRate(_curr) is '+doCurrencyRate(_curr));
    
    oc = 9.25 * doTypeOfDocumentCost(_document_type) * 
    doAcademicLevelCost(_academic_level) * 
    doUrgencyCost(_urgency) * 
    doSubjectAreaCost(_subject_area) * 
    doCurrencyRate(_curr);
    orderCostPerPage = (oc - (oc) * discount / 100) + doVasPP(document.getElementsByName('vas_id[]'));
    if (single == true) {
        orderCostPerPage = orderCostPerPage * 2;
        oc = oc * 2;
        numpages.options[0].value = '1';
        numpages.options[0].text = '1 page/approx 550 words';
   document.getElementById("num_pg_ord").innerHTML = 'approx 550 words per page';
        for (i = 1; i < numpages.length; i++) {

            numpages.options[i].text = (i + 1) + ' pages/approx ' + (2 * (i + 1) * 275) + ' words';

        }
    } else {
        // console.log(numpages);
        numpages.options[0].value = '1';
        numpages.options[0].text = '1 page/approx 275 words';
   document.getElementById("num_pg_ord").innerHTML = 'approx 275 words per page';
        for (i = 1; i < numpages.length; i++) {

            numpages.options[i].text = (i + 1) + ' pages/approx ' + ((i + 1) * 275) + ' words';

        }
    }
    numpages.options[numpages.selectedIndex].selected = true;
    ecost = Math.round(orderCostPerPage * Math.pow(10, 2)) / Math.pow(10, 2);
    document.getElementById("cost_per_page").innerHTML = ecost;
    orderForm.MTIuOTUYGREXGHNMKJGT23467GGFDSSSbbbbbIOK.value = encode64(ecost);
    ecostx = Math.round((orderCostPerPage * numpages.options[numpages.selectedIndex].value + doVasPO(document.getElementsByName('vas_id[]'))) * Math.pow(10, 2)) / Math.pow(10, 2);
    
    //writing the values...
    document.getElementById("total").innerHTML = ecostx;
	orderForm.total.value = ecostx;
    // orderForm.costperpage.value = Math.round(orderCostPerPage * Math.pow(10, 2)) / Math.pow(10, 2);
    $('span#tcost').html( _curr.selectedOptions[0].innerText + ' ' + 
            Math.round(
                (orderCostPerPage * (numpages.selectedIndex+1) * Math.pow(10, 2)) / Math.pow(10, 2)
            )
        );

    orderForm.MMNBGFREWQASCXZSOPJHGVNMTIuOTU.value = ecostx;

   /* if (discount > 0) {
  orderForm.discount_h.value = discount;
  document.getElementById('lblCustomerSavings').style.display = 'block';
  document.getElementById('lblCustomerSavingstext').style.display = 'none';
  orderForm.lblCustomerSavings.value = 'Your savings are: ' + discount + '% (' + Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * numpages.options[numpages.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2) + ' ' + orderForm.curr.options[orderForm.curr.selectedIndex].text+ ')';
        document.getElementById('lblCustomerSavings').innerHTML = 'Your savings are: ' + discount + '% (' + Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * numpages.options[numpages.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2) + ' ' + orderForm.curr.options[orderForm.curr.selectedIndex].text+ ')';
  orderForm.discount_h.value = Math.round(((oc - orderCostPerPage + doVasPP(document.getElementsByName('vas_id[]'))) * numpages.options[numpages.selectedIndex].value) * Math.pow(10, 2)) / Math.pow(10, 2);
    } else {
        document.getElementById('lblCustomerSavings').innerHTML = '';
        document.getElementById('lblCustomerSavingstext').style.display = 'block';
        document.getElementById('lblCustomerSavings').style.display = 'none';
    }*/
}



/*function doDiscount() {
$("#discount_check").html("Please wait..."); 
  $.get("discount.php",{ total: $(".MMNBGFREWQASCXZSOPJHGVNMTIuOTU").val(),  code: $(".discount_code").val()  } ,function(data){
    if (isNaN (data)) {
    $("#discount_check").html(data);
    } else {
        // A valid Number
        // do some processing with the number
      if (data > 0) { 
        $(".discount_percent_h").val(data);
        document.getElementById('lblCustomerSavingstext').style.display = 'none';
        doOrderFormCalculation();
      } else {
        alert('discount 0') ;
        

      }
    }

        

  });
}*/

function doTypeOfDocumentCost(tod) {
 if (tod.selectedIndex == 0) {
        return 1.00    }
 else if (tod.selectedIndex == 1) {
        return 1.00    } 
 else if (tod.selectedIndex == 2) {
        return 1.20    } 
 else if (tod.selectedIndex == 3) {
        return 1.12    } 
 else if (tod.selectedIndex == 4) {
        return 1.12    } 
 else if (tod.selectedIndex == 5) {
        return 1    } 
 else if (tod.selectedIndex == 6) {
        return 1    } 
 else if (tod.selectedIndex == 7) {
        return 1    } 
 else if (tod.selectedIndex == 8) {
        return 1.40    } 
 else if (tod.selectedIndex == 9) {
        return 1.40    } 
 else if (tod.selectedIndex == 10) {
        return 1.40    } 
 else if (tod.selectedIndex == 11) {
        return 1.30    } 
 else if (tod.selectedIndex == 12) {
        return 1.30    } 
 else if (tod.selectedIndex == 13) {
        return 1.30    } 
 else if (tod.selectedIndex == 14) {
        return 1.30    } 
 else if (tod.selectedIndex == 15) {
        return 1.30    } 
 else if (tod.selectedIndex == 16) {
        return 1.30    } 
 else if (tod.selectedIndex == 17) {
        return 1.30    } 
 else if (tod.selectedIndex == 18) {
        return 1    } 
 else if (tod.selectedIndex == 19) {
        return 1    } 
 else if (tod.selectedIndex == 20) {
        return 1    } 
 else if (tod.selectedIndex == 21) {
        return 1    } 
 else if (tod.selectedIndex == 22) {
        return 1    } 
 else if (tod.selectedIndex == 23) {
        return 1    } 
 else if (tod.selectedIndex == 24) {
        return 0.50    } 
 else if (tod.selectedIndex == 25) {
        return 0.40    } 
 else if (tod.selectedIndex == 26) {
        return 0.40    } 
 else if (tod.selectedIndex == 27) {
        return 1.10    } 
 else if (tod.selectedIndex == 28) {
        return 1.10    } 
 else if (tod.selectedIndex == 29) {
        return 1.10    } 
 else if (tod.selectedIndex == 30) {
        return 1.10    } 
 else if (tod.selectedIndex == 31) {
        return 1.10    } 
 else if (tod.selectedIndex == 32) {
        return 1.10    } 
 else if (tod.selectedIndex == 33) {
        return 1    } 
 else if (tod.selectedIndex == 34) {
        return 1.10    } 
 else if (tod.selectedIndex == 35) {
        return 1.10    } 
 else if (tod.selectedIndex == 36) {
        return 1.27    } 
 else if (tod.selectedIndex == 37) {
        return 0.25    } 
 else if (tod.selectedIndex == 38) {
        return 1.50    } 
}


function doSubjectAreaCost(subject) {
    if (subject.selectedIndex+1 == 0) {
        return 1.20
    }  else if (subject.selectedIndex+1 == 1) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 2) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 3) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 4) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 5) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 6) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 7) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 8) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 9) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 10) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 11) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 12) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 13) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 14) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 15) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 16) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 17) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 18) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 19) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 20) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 21) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 22) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 23) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 24) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 25) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 26) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 27) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 28) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 29) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 30) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 31) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 32) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 33) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 34) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 35) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 36) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 37) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 38) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 39) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 40) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 41) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 42) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 43) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 44) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 45) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 46) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 47) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 48) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 49) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 50) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 51) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 52) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 53) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 54) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 55) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 56) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 57) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 58) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 59) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 60) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 61) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 62) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 63) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 64) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 65) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 66) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 67) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 68) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 69) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 70) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 71) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 72) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 73) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 74) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 75) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 76) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 77) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 78) {
        return 1.00    } 
 else if (subject.selectedIndex+1 == 79) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 80) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 81) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 82) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 83) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 84) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 85) {
        return 1.45    } 
 else if (subject.selectedIndex+1 == 86) {
        return 1.00    } 

}

function doAcademicLevelCost(al) {
    if (al.selectedIndex == 0) {
        return 1.00
    } else if (al.selectedIndex == 1) {
        return 1.20
    } else if (al.selectedIndex == 2) {
        return 1.30
    } else if (al.selectedIndex == 3) {
        return 1.40
    }
}

function doUrgencyCost(urgency) {
    if (urgency.selectedIndex == 0) {
        return 1.15
    } else if (urgency.selectedIndex == 1) {
        return 1.15
    } else if (urgency.selectedIndex == 2) {
        return 3.00
    } else if (urgency.selectedIndex == 3) {
        return 2.60
    } else if (urgency.selectedIndex == 4) {
        return 2.20
    } else if (urgency.selectedIndex == 5) {
        return 1.90
    } else if (urgency.selectedIndex == 6) {
        return 1.75
    } else if (urgency.selectedIndex == 7) {
        return 1.65
    } else if (urgency.selectedIndex == 8) {
        return 1.40
    } else if (urgency.selectedIndex == 9) {
        return 1.15
    } else if (urgency.selectedIndex == 10) {
        return 1.15
    } else if (urgency.selectedIndex == 11) {
        return 1.15
    } else if (urgency.selectedIndex == 1) {
        return 3.30
    }
}


function doCurrencyRate(curr) {
    if (curr.selectedIndex == 0) {
        return 1.00
    } else if (curr.selectedIndex == 1) {
        return 1.00
    } else if (curr.selectedIndex == 2) {
        return 0.60
    } else if (curr.selectedIndex == 3) {
        return 0.93
    } else if (curr.selectedIndex == 4) {
        return 0.92
    } else if (curr.selectedIndex == 5) {
        return 0.68
    }
}
// function doCurrencyRate(curr) {
//     if (curr.selectedIndex == "USD") {
//         return 1.00
//     } else if (curr.selectedIndex == "GBP") {
//         return 0.60
//     } else if (curr.selectedIndex == "CAD") {
//         return 0.93
//     } else if (curr.selectedIndex == "AUD") {
//         return 0.92
//     } else if (curr.selectedIndex == "EUR") {
//         return 0.68
//     }
// }



function doVasPP(vas) {
    var return_sum = 0;
    for (var i = 0; i < vas.length; i++) {
        if ((vas[i].checked == true) && (vas[i].id.indexOf('page') != -1) && (!isNaN(pp[vas[i].value]))) {
            return_sum += pp[vas[i].value];
        }
    }
    return return_sum;
}

function doVasPO(vas) {
    var return_sum = 0;
    for (var i = 0; i < vas.length; i++) {
        if ((vas[i].checked == true) && (vas[i].id.indexOf('order') != -1) && (!isNaN(po[vas[i].value]))) {
            return_sum += po[vas[i].value];
        }
    }
    return return_sum;
}




  var keyStr = "ABCDEFGHIJKLMNOP" +
               "QRSTUVWXYZabcdef" +
               "ghijklmnopqrstuv" +
               "wxyz0123456789+/" +
               "=";




  function encode64(input) {
     input = escape(input);
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
           enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
           enc4 = 64;
        }

        output = output +
           keyStr.charAt(enc1) +
           keyStr.charAt(enc2) +
           keyStr.charAt(enc3) +
           keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
     } while (i < input.length);

     return output;
  }

  function decode64(input) {
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
     var base64test = /[^A-Za-z0-9\+\/\=]/g;
     if (base64test.exec(input)) {
        alert("There were invalid base64 characters in the input text.\n" +
              "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
              "Expect errors in decoding.");
     }
     input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

     do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
           output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
           output = output + String.fromCharCode(chr3);
        }

        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";

     } while (i < input.length);

     return unescape(output);
  }


