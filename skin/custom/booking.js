$(document).ready(function() {
    var nextbt2 = document.getElementById("nextbt2");
    var nextbt3 = document.getElementById("nextbt3");
    var back1 = document.getElementById("back1");
    var back2 = document.getElementById("back2");
    var back3 = document.getElementById("back3");



    // ------------------------------------------------------------------
    //  var secndtab = document.getElementById("tabz4");
    // secndtab.classList.add("active");
    // --------------------------------------------------------------------

    nextbt2.classList.add("nextbtnhid");
    nextbt3.classList.add("nextbtnhid");
    back1.classList.add("nextbtnhid");
    back2.classList.add("nextbtnhid");
    back3.classList.add("nextbtnhid");
});


function validationFun() {
    var gust = $("select[name='gust']").val();
    var checkin = $("input[name='checkin']").val();
    var checkout = $("input[name='checkout']").val();
    var nextbt2 = document.getElementById("nextbt2");
    var nextbt3 = document.getElementById("nextbt3");
    var first = document.getElementById("firsttab");
    var firstr = document.getElementById("round1");
    var thrrr = document.getElementById("round3");
    var fbar = document.getElementById("barleng");
    var secndr = document.getElementById("round2");
    var secnd = document.getElementById("secndtab");
    var thrd = document.getElementById("tabtest3");
    var four = document.getElementById("tabz4");
    var roundfor = document.getElementById("round4");
    var nextbt = document.getElementById("nextbt");
    var back1 = document.getElementById("back1");
    var roomtyp = document.getElementById("roomtyp");
    var roomtypval = roomtyp.value;
    var avail = $("input[name='avail']").val();
    // if (gust == "------") {
    //     $("#gust-error").text("Select a Gust.");
    //     $("select[name='gust']").focus();
    // } else 
    if (checkin == "") {
        $("#checkin-error").text("checkin date is required.");
        $("input[name='checkin']").focus();
    } else if (checkout == "") {
        $("#checkout-error").text("checkout date is required.");
        $("input[name='checkout']").focus();
    } else if (checkout < checkin) {
        $("#checkout-error").text("Check Out Must be greater than Check In.");
        $("input[name='checkout']").focus();
    } else if (roomtypval == '----') {
        $("#roomtyp-error").text("Select a room Type.");
        $("select[name='roomtyp']").focus();
    } 
    else if (avail == '---' || avail == '' || avail == '0') {
        $("select[name='room']").focus();
    } else {
        first.classList.remove("active");
        firstr.classList.remove("active");
        firstr.classList.add("done");
        fbar.classList.add("custlengths");
        secndr.classList.add("active");
        secnd.classList.add("active");
        nextbt.classList.add("nextbtnhid");
        nextbt2.classList.remove("nextbtnhid");
        back1.classList.remove("nextbtnhid");
    }
}

function validationFun2() {
    var avail = $("input[name='avail']").val();
    var countofadult = $("input[name='adunum']").val();
    var countofkid = $("input[name='kidnum']").val();
    var gustdet = $("select[name='gust_detail']").val();
    var first = document.getElementById("firsttab");
    var firstr = document.getElementById("round1");
    var thrrr = document.getElementById("round3");
    var fbar = document.getElementById("barleng");
    var secndr = document.getElementById("round2");
    var secnd = document.getElementById("secndtab");
    var thrd = document.getElementById("tabtest3");
    var four = document.getElementById("tabz4");
    var roundfor = document.getElementById("round4");
    var nextbt = document.getElementById("nextbt");
    var nextbt2 = document.getElementById("nextbt2");
    var nextbt3 = document.getElementById("nextbt3");
    var back1 = document.getElementById("back1");
    var back2 = document.getElementById("back2");
    var roomtyp = document.getElementById("roomtyp");
    var roomtypval = roomtyp.value;
    var gust = $("select[name='gust']").val();


    for ($i = 1; $i <= countofadult; $i++) {
        var adnm$i = document.getElementById('adname' + $i);
        var adid$i = document.getElementById('adltid' + $i);
        var name$i = adnm$i.value;
        var id$i = adid$i.value;
        if (name$i == "" && countofadult != '') {
          // alert(countofadult)
            $("#adname" + $i + "-error").text("Name" + $i + " is Required.");
            document.getElementById('adname' + $i).focus();
        } else if (id$i == "" && countofadult != '') {
            $("#adid" + $i + "-error").text("ID" + $i + " is Required.");
            document.getElementById('adltid' + $i).focus();
        }

    }
    for ($j = 1; $j <= countofkid; $j++) {
        var kidnam$j = document.getElementById('kidname' + $j);
        var kidid$j = document.getElementById('kidid' + $j);
        var kidnamee$j = kidnam$j.value;
        var kidids$j = kidid$j.value;
        if (kidnamee$j == "") {
            $("#kidname" + $j + "-error").text("Name" + $j + " is Required.");
            document.getElementById('kidname' + $j).focus();
        } else if (kidids$j == "") {
            $("#kidid" + $j + "-error").text("ID" + $j + " is Required.");
            document.getElementById('kidid' + $j).focus();
        }

    }
     if (gustdet == '5') {
        $("#gusts-error").text("Gust Detail is required.");
        $("select[name='gust_detail']").focus();
    } else if (gustdet != '5') {
   
    }
 if (gust == "------") {
        $("#gust-error").text("Select a Gust.");
        $("select[name='gust']").focus();
    }
else if (gust != "------"){

            secnd.classList.remove("active");
            secndr.classList.remove("active");
            secndr.classList.add("done");
            secndr.classList.remove("custlengths");
            fbar.classList.add("custlengththrd");
            thrrr.classList.add("active");
            thrd.classList.add("active");
            nextbt2.classList.add("nextbtnhid");
            back1.classList.add("nextbtnhid");
            nextbt3.classList.remove("nextbtnhid");
            back2.classList.remove("nextbtnhid");
    }

}

function validationFun3() {
    var modp = $("select[name='modpay']").val();
    var fbar = document.getElementById("barleng");
    var secndr = document.getElementById("round2");
    var secnd = document.getElementById("secndtab");
    var thrd = document.getElementById("tabtest3");
    var four = document.getElementById("tabz4");
    var roundfor = document.getElementById("round4");
    var nextbt = document.getElementById("nextbt");
    var nextbt2 = document.getElementById("nextbt2");
    var nextbt3 = document.getElementById("nextbt3");
    var thrrr = document.getElementById("round3");
    var fisubmit = document.getElementById("finalsubmit");
    var back2 = document.getElementById("back2");
    var back3 = document.getElementById("back3");
    if (modp == '5') {
        $("#modpay-error").text("Select a Mode of payment.");
        $("select[name='modpay']").focus();

    } else if (modp != '5') {
        var roomtyppricee = $("input[name='roomtypseasonprice']").val();
        var pricetyp = $("input[name='priceselction']").val();
        var romamount = $("input[name='baseprice']").val();
        var roomtypid = $("input[name='roomtypid']").val();
        var typsun = $("input[name='typsun']").val();
        var typmon = $("input[name='typmon']").val();
        var typtu = $("input[name='typtu']").val();
        var typwe = $("input[name='typwe']").val();
        var typth = $("input[name='typth']").val();
        var typfri = $("input[name='typfri']").val();
        var typsat = $("input[name='typsat']").val();
         var c = document.getElementById("checkin");
         var o = document.getElementById("checkout");
         var checkin = c.value;
         var checkout = o.value;
        var person = $("input[name='addipersonprice']").val();
        var kid = $("input[name='addikidprice']").val();
        var adunum = $("input[name='adunum']").val();
        var kidnum = $("input[name='kidnum']").val();
        var personamount =0;
        var kidamount =0;

        
       
        var calcramoun =0;
        if (pricetyp =='1') {
             calcramoun = +(1 * romamount);
             $("#roomamounttz").val(calcramoun)
        }else if (pricetyp =='2') {
              var start = new Date(checkin);
              var finish = new Date(checkout);
              var dayMilliseconds = 1000 * 60 * 60 * 24;
              var sun = 0;
              var mon = 0;
              var tu = 0;
              var we = 0;
              var th = 0;
              var fri = 0;
              var sat = 0;
              while (start <= finish) {
                var day = start.getDay()
                if (day == 0) {
                  sun++;
                }if (day == 1) {
                  mon++;
                }if (day == 2) {
                  tu++;
                }if (day == 3) {
                  we++;
                }if (day == 4) {
                  th++;
                }if (day == 5) {
                  fri++;
                }if (day == 6) {
                  sat++;
                }
                start = new Date(+start + dayMilliseconds);
              }
              calcramoun = +(sun * typsun) + (mon * typmon) + (tu * typtu) + (we * typwe) + (th * typth) + (fri * typfri) + (sat * typsat);
             $("#roomamounttz").val(calcramoun)
           // var amounttypb = $("input[name='roomtypbaseprice']").val();
           //    calcramoun = +(1 * amounttypb);

        }else if (pricetyp =='3') {
          var seasnfrom = $("input[name='roomtypseasonfrom']").val();
          var seasnto = $("input[name='roomtypseasonto']").val();
          getcalsfrom = getsesonvaluzeinjsFunone(seasnfrom,seasnto,checkin,checkout);
          getcalsto = getsesonvaluzeinjsFuntwo(seasnfrom,seasnto,checkin,checkout);
          getbalfrom1 = getsesonvaluzeinjsFunthree(seasnfrom,seasnto,checkin,checkout);
          getbalto1 = getsesonvaluzeinjsFunfour(seasnfrom,seasnto,checkin,checkout);
          getbalfrom2 = getsesonvaluzeinjsFunfive(seasnfrom,seasnto,checkin,checkout);
          getbalto2 = getsesonvaluzeinjsFunsix(seasnfrom,seasnto,checkin,checkout);
           sdaycount = days_between(getcalsfrom,getcalsto);
           // alert(sdaycount)
           notsdaycount = days_between(checkin,checkout);
              var start = new Date(getbalfrom1);
              var finish = new Date(getbalto1);
              var dayMilliseconds = 1000 * 60 * 60 * 24;
              var sun = 0;
              var mon = 0;
              var tu = 0;
              var we = 0;
              var th = 0;
              var fri = 0;
              var sat = 0;
              while (start <= finish) {
                var day = start.getDay()
                if (day == 0) {
                  sun++;
                }if (day == 1) {
                  mon++;
                }if (day == 2) {
                  tu++;
                }if (day == 3) {
                  we++;
                }if (day == 4) {
                  th++;
                }if (day == 5) {
                  fri++;
                }if (day == 6) {
                  sat++;
                }
                start = new Date(+start + dayMilliseconds);
              }
              var start2 = new Date(getbalfrom2);
              var finish2 = new Date(getbalto2);
              var dayMilliseconds2 = 1000 * 60 * 60 * 24;
              var sun2 = 0;
              var mon2 = 0;
              var tu2 = 0;
              var we2 = 0;
              var th2 = 0;
              var fri2 = 0;
              var sat2 = 0;
              while (start2 <= finish2) {
                var day = start2.getDay()
                if (day == 0) {
                  sun2++;
                }if (day == 1) {
                  mon2++;
                }if (day == 2) {
                  tu2++;
                }if (day == 3) {
                  we2++;
                }if (day == 4) {
                  th2++;
                }if (day == 5) {
                  fri2++;
                }if (day == 6) {
                  sat2++;
                }
                start2 = new Date(+start2 + dayMilliseconds2);
              }
          if (sdaycount !='0') {
     calcramoun = +(sdaycount * roomtyppricee) + (sun * romamount) + (mon * romamount) + (tu * romamount) + (we * romamount) + (th * romamount) + (fri * romamount) + (sat * romamount) + (sun2 * romamount) + (mon2 * romamount) + (tu2 * romamount) + (we2 * romamount) + (th2 * romamount) + (fri2 * romamount) + (sat2 * romamount);
     $("#roomamounttz").val(calcramoun);
   }else{
        calcramoun = +(notsdaycount * roomtyppricee);
     $("#roomamounttz").val(calcramoun);
   }
          
        }else if (pricetyp =='4') {
          var seasnfrom = $("input[name='roomtypseasonfrom']").val();
          var seasnto = $("input[name='roomtypseasonto']").val();
          getcalsfrom = getsesonvaluzeinjsFunone(seasnfrom,seasnto,checkin,checkout);
          getcalsto = getsesonvaluzeinjsFuntwo(seasnfrom,seasnto,checkin,checkout);
          getbalfrom1 = getsesonvaluzeinjsFunthree(seasnfrom,seasnto,checkin,checkout);
          getbalto1 = getsesonvaluzeinjsFunfour(seasnfrom,seasnto,checkin,checkout);
          getbalfrom2 = getsesonvaluzeinjsFunfive(seasnfrom,seasnto,checkin,checkout);
          getbalto2 = getsesonvaluzeinjsFunsix(seasnfrom,seasnto,checkin,checkout);
           sdaycount = days_between(getcalsfrom,getcalsto);
           // alert(sdaycount)
              var start = new Date(getbalfrom1);
              var finish = new Date(getbalto1);
              var dayMilliseconds = 1000 * 60 * 60 * 24;
              var sun = 0;
              var mon = 0;
              var tu = 0;
              var we = 0;
              var th = 0;
              var fri = 0;
              var sat = 0;
              while (start <= finish) {
                var day = start.getDay()
                if (day == 0) {
                  sun++;
                }if (day == 1) {
                  mon++;
                }if (day == 2) {
                  tu++;
                }if (day == 3) {
                  we++;
                }if (day == 4) {
                  th++;
                }if (day == 5) {
                  fri++;
                }if (day == 6) {
                  sat++;
                }
                start = new Date(+start + dayMilliseconds);
              }
              var start2 = new Date(getbalfrom2);
              var finish2 = new Date(getbalto2);
              var dayMilliseconds2 = 1000 * 60 * 60 * 24;
              var sun2 = 0;
              var mon2 = 0;
              var tu2 = 0;
              var we2 = 0;
              var th2 = 0;
              var fri2 = 0;
              var sat2 = 0;
              while (start2 <= finish2) {
                var day = start2.getDay()
                if (day == 0) {
                  sun2++;
                }if (day == 1) {
                  mon2++;
                }if (day == 2) {
                  tu2++;
                }if (day == 3) {
                  we2++;
                }if (day == 4) {
                  th2++;
                }if (day == 5) {
                  fri2++;
                }if (day == 6) {
                  sat2++;
                }
                start2 = new Date(+start2 + dayMilliseconds2);
              }
           if (sdaycount !='0') {
     calcramoun = +(sdaycount * roomtyppricee) + (sun * typsun) + (mon * typmon) + (tu * typtu) + (we * typwe) + (th * typth) + (fri * typfri) + (sat * typsat) + (sun2 * typsun) + (mon2 * typmon) + (tu2 * typtu) + (we2 * typwe) + (th2 * typth) + (fri2 * typfri) + (sat2 * typsat);
     $("#roomamounttz").val(calcramoun);
      }else{
              var start3 = new Date(checkin);
              var finish3 = new Date(checkout);
              var dayMilliseconds = 1000 * 60 * 60 * 24;
              var sun3 = 0;
              var mon3 = 0;
              var tu3 = 0;
              var we3 = 0;
              var th4 = 0;
              var fri3 = 0;
              var sat4 = 0;
              while (start3 <= finish3) {
                var day = start3.getDay()
                if (day == 0) {
                  sun3++;
                }if (day == 1) {
                  mon3++;
                }if (day == 2) {
                  tu3++;
                }if (day == 3) {
                  we3++;
                }if (day == 4) {
                  th4++;
                }if (day == 5) {
                  fri3++;
                }if (day == 6) {
                  sat4++;
                }
                start3 = new Date(+start3 + dayMilliseconds);
              }
        calcramoun = +(notsdaycount * roomtyppricee) + (sun3 * typsun) + (mon3 * typmon) + (tu3 * typtu) + (we3 * typwe) + (th3 * typth) + (fri3 * typfri) + (sat3 * typsat);
        $("#roomamounttz").val(calcramoun);
   }
          
        }


 var servz = $("input[name='servamount']").val();
 var ap = $("input[name='adipersonamount']").val();
 var akid = $("input[name='adikidamount']").val();
 var tr = $("input[name='roomamounttz']").val();
 var subtotalz = +((1 * servz) + (1 *ap) +(1 * akid) +(1 *tr));

$("#subtotalzx").val(subtotalz);
                var divzL = document.createElement('div');
                var toadp = document.createElement('div');
                var totadk = document.createElement('div');
                var romtot = document.createElement('div');
                var subto = document.createElement('div');
                    divzL.className = 'cardvaluepos';
                    toadp.className = 'cardvaluepos';
                    totadk.className = 'cardvaluepos';
                    romtot.className = 'cardvaluepos';
                    subto.className = 'cardvaluepos';
                    divzL.innerHTML += servz;
                    toadp.innerHTML += ap;
                    totadk.innerHTML += akid;
                    romtot.innerHTML += tr;
                    subto.innerHTML += subtotalz;
                    document.getElementById('servam').appendChild(divzL);
                    document.getElementById('toadp').appendChild(toadp);
                    document.getElementById('totadk').appendChild(totadk);
                    document.getElementById('romtot').appendChild(romtot);
                    document.getElementById('subto').appendChild(subto);



        fbar.classList.remove("custlengths");
        fbar.classList.remove("custlengththrd");
        thrd.classList.remove("active");
        fbar.classList.add("custlengfor");
        thrrr.classList.add("done");
        roundfor.classList.add("active");
        four.classList.add("active");
        nextbt3.classList.add("submithide");
        fisubmit.classList.remove("submithide");
        back2.classList.add("nextbtnhid");
        back3.classList.remove("nextbtnhid");
        fisubmit.classList.remove("nextbtnhid");
    }
}
function amountcalculat(){
        var pricetyp = $("input[name='priceselction']").val();
        var romamount = $("input[name='baseprice']").val();
        var roomtypid = $("input[name='roomtypid']").val();
        var typsun = $("input[name='typsun']").val();
        var typmon = $("input[name='typmon']").val();
        var typtu = $("input[name='typtu']").val();
        var typwe = $("input[name='typwe']").val();
        var typth = $("input[name='typth']").val();
        var typfri = $("input[name='typfri']").val();
        var typsat = $("input[name='typsat']").val();
         var c = document.getElementById("checkin");
         var o = document.getElementById("checkout");
         var checkin = c.value;
         var checkout = o.value;
        var person = $("input[name='addipersonprice']").val();
        var kid = $("input[name='addikidprice']").val();
        var adunum = $("input[name='adunum']").val();
        var kidnum = $("input[name='kidnum']").val();
        var personamount =0;
        var kidamount =0;
         if (person !="") {
             personamount = +(person*adunum);
        }
        if (kid !="") {
             kidamount = +(kid*kidnum);
        }
      $("#adipersonamount").val(personamount);
      $("#adikidamount").val(kidamount);






          $.ajax({
              dataType: 'text',
              type: 'post',
              url: base_url + 'booking/getroomtypingamountajax?id='+roomtypid,
              cache: false,
              success: function(data) {
                $.each(JSON.parse(data), function(key, value) {
                        $("#typsun").val(value.sun);
                        $("#typmon").val(value.mon);
                        $("#typtu").val(value.tu);
                        $("#typwe").val(value.we);
                        $("#typth").val(value.th);
                        $("#typfri").val(value.fri);
                        $("#typsat").val(value.sat);
                        $("#roomtypseasonprice").val(value.seasonprice);
                        $("#roomtypseasonfrom").val(value.seasonfrom);
                        $("#roomtypseasonto").val(value.seasonto);
                      });
              }
          });

       



}
function adultnumFU() {
    var adunum = $("input[name='adunum']").val();
    var div = document.createElement('div');
    div.className = 'row';
    for ($i = 1; $i <= adunum; $i++) {

        div.innerHTML +=
            '<div class="row"><div class="col-md-2 col-sm-2 form-group altadlt"  style="margin-left: 85px !important;">\
             <label>Adult ' + $i + ' Name</label><span class="error_star">*</span>\
             <input type="text" name="adname[]" id="adname' + $i + '" class="form-control" required>\
              <span id="adname' + $i + '-error" class="errorbook" for="adname"></span>\
          </div>\
         <div class="col-md-2 col-sm-2 form-group altadlt"  >\
             <label>Adult' + $i + ' ID</label><span class="error_star">*</span>\
             <input type="text" name="adid[]" id="adltid' + $i + '" class="form-control" >\
              <span id="adid' + $i + '-error" class="errorbook" for="adid"></span>\
         </div>\
       <div class="col-md-3 col-sm-3 form-group altadlt"  >\
             <label>Adult' + $i + ' Phone Number</label><span class="error_star">*</span>\
             <input type="number" name="adphn[]" class="form-control">\
              <span id="adphn-error" class="errorbook" for="adphn"></span>\
         </div>\
       <div class="col-md-3 col-sm-3 form-group altadlt"  >\
            <label >Adult' + $i + ' Address</label>\
              <textarea name="aduadd[]" class="form-control"></textarea>\
               </div> </div>';

    }

    document.getElementById('content').appendChild(div);
}

function kidaddnumFU() {
    var kidnum = $("input[name='kidnum']").val();
    var div = document.createElement('div');

    div.className = 'row';
    for ($i = 1; $i <= kidnum; $i++) {

        div.innerHTML +=
            '<div class="row"><div class="col-md-2 col-sm-2 form-group altadlt"  style="margin-left: 85px !important;">\
             <label>Kid ' + $i + ' Name</label><span class="error_star">*</span>\
             <input type="text" name="kidname[]" id="kidname' + $i + '" class="form-control" required>\
              <span id="kidname' + $i + '-error" class="errorbook" for="kidname"></span>\
          </div>\
         <div class="col-md-2 col-sm-2 form-group altadlt"  >\
             <label>Kid' + $i + ' ID</label><span class="error_star">*</span>\
             <input type="text" name="kidid[]" id="kidid' + $i + '" class="form-control" >\
              <span id="kidid' + $i + '-error" class="errorbook" for="kidid"></span>\
         </div>\
       <div class="col-md-3 col-sm-3 form-group altadlt"  >\
             <label>Kid' + $i + ' Phone Number</label><span class="error_star">*</span>\
             <input type="number" name="kidphn[]" class="form-control">\
              <span id="kidphn-error" class="errorbook" for="kidphn"></span>\
         </div>\
       <div class="col-md-3 col-sm-3 form-group altadlt"  >\
            <label >Kid' + $i + ' Address</label>\
              <textarea name="kidaddr[]" class="form-control"></textarea>\
               </div> </div>';

    }

    document.getElementById('content2').appendChild(div);
}

function backFun1() {
    var round1 = document.getElementById("round1");
    var round2 = document.getElementById("round2");
    var bar = document.getElementById("barleng");
    var firsttab = document.getElementById("firsttab");
    var nextbt = document.getElementById("nextbt");
    var nextbt2 = document.getElementById("nextbt2");
    var secndtab = document.getElementById("secndtab");
    var back1 = document.getElementById("back1");
    round1.classList.add("active");
    firsttab.classList.add("active");
    round2.classList.remove("active");
    secndtab.classList.remove("active");
    bar.classList.remove("custlengths");
    nextbt.classList.remove("nextbtnhid");
    round1.classList.remove("done");
    nextbt2.classList.add("nextbtnhid");
    back1.classList.add("nextbtnhid");
}

function backFun2() {
    var round2 = document.getElementById("round2");
    var round3 = document.getElementById("round3");
    var bar = document.getElementById("barleng");
    var secndtab = document.getElementById("secndtab");
    var tab3z = document.getElementById("tabtest3");
    var nextbt3 = document.getElementById("nextbt3");
    var nextbt2 = document.getElementById("nextbt2");
    var back1 = document.getElementById("back1");
    var back2 = document.getElementById("back2");
    round2.classList.remove("done");
    round3.classList.remove("active");
    round2.classList.add("active");
    secndtab.classList.add("active");
    nextbt3.classList.add("nextbtnhid");
    back2.classList.add("nextbtnhid");
    bar.classList.add("custlengths");
    bar.classList.remove("custlengththrd");
    tab3z.classList.remove("active");
    back2.classList.add("nextbtnhid");
    back1.classList.remove("nextbtnhid");
    nextbt2.classList.remove("nextbtnhid");
}

function backFun3() {
    var tabz4 = document.getElementById("tabz4");
    var tabtest3 = document.getElementById("tabtest3");
    var round3 = document.getElementById("round3");
    var round4 = document.getElementById("round4");
    var bar = document.getElementById("barleng");
    var secndtab = document.getElementById("secndtab");
    var finalsubmit = document.getElementById("finalsubmit");
    var back2 = document.getElementById("back2");
    var back3 = document.getElementById("back3");
    var nextbt3 = document.getElementById("nextbt3");
    tabz4.classList.remove("active");
    tabtest3.classList.add("active");
    back3.classList.add("nextbtnhid");
    back2.classList.remove("nextbtnhid");
    round3.classList.remove("done");
    round3.classList.add("active");
    round4.classList.remove("active");
    bar.classList.remove("custlengfor");
    nextbt3.classList.remove("submithide");
    bar.classList.add("custlengththrd");
    finalsubmit.classList.add("nextbtnhid");
}

function roomtypselectedFun() {
    var r = document.getElementById("roomtyp");
    var roomtyp = r.value;
    var trush = document.getElementById("room");
    var length = trush.options.length;
    var lengthc = length + 1;
    for (i = 0; i < lengthc; i++) {
        trush.remove('option');
    }
    $.ajax({
        dataType: 'text',
        type: 'post',
        url: base_url + 'booking/getroomsajax?get=' + roomtyp,
        cache: false,
        success: function(data) {
            $('#room').append($('<option>').text('----').attr('value', '----'));
            $.each(JSON.parse(data), function(key, value) {
                $('#room').append($('<option>').text(value.room_num).attr('value', value.id));
            });
        }
    });
}

function roomavaildFun() {
    document.getElementById("avail").value = "0";
    $("#sroom-error").text("");
    var r = document.getElementById("room");
    var c = document.getElementById("checkin");
    var ou = document.getElementById("checkout");
    var room = r.value;
    var checkin = c.value;
    var out = ou.value;
    if (room == '----') {
        $("#sroom-error").text("Select a room.");
        $("select[name='room']").focus();

    } else {
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url + 'booking/checkingroomavaajax?date=' + checkin + '&&roomid=' + room + '&&out=' + out,
            cache: false,
            success: function(data) {
                if (data.indexOf("booked") > -1) {
                    $("#sroom-error").text("This room Is not available for this date.");
                    $("select[name='room']").focus();
                    document.getElementById("avail").value = "---";
                } else {
                    document.getElementById("avail").value = room;
                }
            }
        });
    }
}

function getservFun() {
 var room = $("select[name='room']").val();
// alert(room)
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url + 'booking/getroomamountajax?id='+room,
            cache: false,
            success: function(data) {
              $.each(JSON.parse(data), function(key, value) {
                      $("#roomtypid").val(value.room_type);
                      $("#baseprice").val(value.baseprice);
                      $("#addipersonprice").val(value.addipersonprice);
                      $("#addikidprice").val(value.addikidprice);
                      $("#priceselction").val(value.priceselction);
                    });
            }
        });






    var avail = $("input[name='avail']").val();
    $.ajax({
        dataType: 'text',
        type: 'post',
        url: base_url + 'booking/getservebyroomajax?id=' + avail,
        cache: false,
        success: function(data) {
            $.ajax({
                dataType: 'text',
                type: 'post',
                url: base_url + 'booking/getservebyroomajaxinservtbl?id=' + data,
                cache: false,
                success: function(data) {
                    // if (!$.trim(data)){   
                    var div = document.createElement('div');
                    div.className = 'row';
                    $.each(JSON.parse(data), function(key, value) {
                        div.innerHTML +=
                            '<div class="col-md-1 col-sm-2 form-group">\
                            <label>' + (value[0].name) + '</label>\
                        </div>\
                        <div class="col-md-1 col-sm-2 form-group">\
                            <label class="switch">\
                              <input type="checkbox" value="' + (value[0].id) + '" id="paidserv' + (key) + '" name="paidserv[]" onChange="changepaidserv(' + (value[0].id) + ',' + key + ')">\
                              <span class="slidertog round"></span>\
                        </div>\
                        <input type="hidden" value="' + (value[0].pricetyp) + '" id="pricetyp' + (value[0].id) + '" name="pricetyp[]">\
                        <input type="hidden" value="' + (value[0].amount) + '" id="amount' + (value[0].id) + '" name="amount[]">';
                    });
                    document.getElementById('paidservzz').appendChild(div);
                }
            });
        }
    });
$.ajax({
     dataType: 'text',
     type: 'post',
     url: base_url + 'booking/getservebyroomajaxfree?id=' + avail,
     cache: false,
     success: function(data) {
         $.ajax({
             dataType: 'text',
             type: 'post',
             url: base_url + 'booking/getservefreeroomajaxinservtbl?id=' + data,
             cache: false,
             success: function(dataz) {

                 var div = document.createElement('div');
                 div.className = 'row';
                 $.each(JSON.parse(dataz), function(key, value) {
                     div.innerHTML +=
                         '<div class="col-md-1 col-sm-2 form-group">\
                            <label>' + (value[0].name) + '</label>\
                        </div>\
                        <div class="col-md-1 col-sm-2 form-group">\
                            <label class="switch">\
                              <input type="checkbox" value="' + (value[0].id) + '" id="freeserv' + (key) + '" name="freeserv[]">\
                              <span class="slidertog round"></span>\
                        </div>';
                 });
                 document.getElementById('freeeservzz').appendChild(div);
             }
         });
     }
 });
}



function changepaidserv(id, key) {
       var p_typ = document.getElementById('pricetyp'+id).value;
       var amount = document.getElementById('amount'+id).value;
       var perpers = document.getElementById('adunum').value;
       var old = document.getElementById("servamount").value;
       var checkin = document.getElementById("checkin").value;
       var checkout = document.getElementById("checkout").value;
       var newam = 0;
    if (document.getElementById('paidserv'+key).checked) {
      if (p_typ == '1') {
           if (perpers !="") {
             newam = +old+(perpers*amount);
        }
      } else if(p_typ == '2'){
            var startDate = Date.parse(checkin);
            var endDate = Date.parse(checkout);
            var timeDiff = endDate - startDate;
            daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            newam = +old+(daysDiff*amount);
      }else if(p_typ == '3'){
            var startDate = Date.parse(checkin);
            var endDate = Date.parse(checkout);
            var timeDiff = endDate - startDate;
            daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            newam = +old+(daysDiff*amount);
      }else if(p_typ == '4'){
            newam = (old * 1)+(1 * amount);
      }
      $("#servamount").val(newam);
  } else {
        if (p_typ == '1') {
           if (perpers !="") {
             newam = old-(perpers*amount);
        }
      }else if(p_typ == '2'){
            var startDate = Date.parse(checkin);
            var endDate = Date.parse(checkout);
            var timeDiff = endDate - startDate;
            daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            newam = old-(daysDiff*amount);

       }else if(p_typ == '3'){
            var startDate = Date.parse(checkin);
            var endDate = Date.parse(checkout);
            var timeDiff = endDate - startDate;
            daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            newam = old-(daysDiff*amount);

       }else if(p_typ == '4'){
            newam = old-amount;
      }
      $("#servamount").val(newam);
      
    }
}


function getsesonvaluzeinjsFunone(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  calsfrom = sf;
              }
             else if (sf < ci && st > co) {
                  calsfrom = ci;
              }
             else if (sf > ci && st > co) {
                  calsfrom = sf;
              }
             else if (sf < ci && st < co) {
                  calsfrom = ci;
              }
             else if ((sf = ci) && (st = co)) {
                  calsfrom = ci;
              }
          }else {
              calsfrom = ci;
          }
  return calsfrom;
}
function getsesonvaluzeinjsFuntwo(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  calsto   = st;
              }
             else if (sf < ci && st > co) {
                  calsto   = co;
              }
             else if (sf > ci && st > co) {
                  calsto   = co;
              }
             else if (sf < ci && st < co) {
                  calsto   = st;
              }
             else if ((sf = ci) && (st = co)) {
                  calsto   = co;
      }
        }else {
                    calsto   = ci;
                }
  return calsto;
}function getsesonvaluzeinjsFunthree(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  balfrom1 = ci;
              }
             else if (sf < ci && st > co) {
                  balfrom1 = '000-00-00';
              }
             else if (sf > ci && st > co) {
                  balfrom1 = ci;
              }
             else if (sf < ci && st < co) {
                  balfrom1 = st;
              }
             else if ((sf = ci) && (st = co)) {
                  balfrom1 = '000-00-00';

      }
  }else {
              balfrom1 = '000-00-00';
            
          }
  return balfrom1;
}
function getsesonvaluzeinjsFunfour(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  balto1 =  sf;
              }
             else if (sf < ci && st > co) {
                  balto1 =  '000-00-00';
              }
             else if (sf > ci && st > co) {
                  balto1 =  sf;
              }
             else if (sf < ci && st < co) {
                  balto1 =  co;
              }
             else if ((sf = ci) && (st = co)) {
                  balto1 =  '000-00-00';
      }
  }else {
              balto1 =  '000-00-00';
             
          }
  return balto1;
}
function getsesonvaluzeinjsFunfive(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  balfrom2 = st;
              }
             else if (sf < ci && st > co) {
                  
                  balfrom2 = '000-00-00';
              }
             else if (sf > ci && st > co) {
                  balfrom2 = '000-00-00';
              }
             else if (sf < ci && st < co) {
                  balfrom2 = '000-00-00';
              }
             else if ((sf = ci) && (st = co)) {
                  balfrom2 = '000-00-00';
      }
  }else {
              balfrom2 = '000-00-00';
          }
  return balfrom2;
}
function getsesonvaluzeinjsFunsix(sf,st,ci,co){
       if ((sf <= ci) && (st >= ci) || (sf <= co) && (st >= co) || (sf >= ci) && (st <= co)   ) {
              if ((sf > ci) && (st < co)) {
                  balto2 = co;
              }
             else if (sf < ci && st > co) {
                  balto2 = '000-00-00';
              }
             else if (sf > ci && st > co) {
                  balto2 = '000-00-00';
              }
             else if (sf < ci && st < co) {
                  balto2 = '000-00-00';
              }
             else if ((sf = ci) && (st = co)) {
                  balto2 = '000-00-00';

      }
  }else {
              balto2 = '000-00-00';
          }
  return balto2;
}

    var days_between = function(date1, date2) {
dt1 = new Date(date1);
dt2 = new Date(date2);
return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
}


