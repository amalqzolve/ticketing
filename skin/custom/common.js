$(document).ready(function() {

	/***************************************************
	* Detail : Admin Details Submit                    *
	* Date   : 20-02-2020                              *
	***************************************************/
   $("#usersubmit_btn").click(function() {
        var flag         = 0;
        var logid        = $("input[name='id']").val();
        var admin_catg   = $("#admin").val();
        var branch       = $("#admin_branch").val();
        var departmnt    = $("#admin_dept").val();
        var employ       = $("#admin_employ").val();
        var Username     = $("input[name='Email']").val();
        var Password     = $("input[name='Password']").val();
        /*var Email        = $("input[name='Email']").val();
        var emailformat  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;*/
        $(".error").text("");
        if (admin_catg == "") {
            $("#admin_catgerror").text("This field is required.");
            flag = 1;
        }
        else if ((admin_catg == 2 && branch == "") || (admin_catg == 3 && branch == "")) {
            $("#admin_branch-error").text("This field is required.");
            flag = 1;
        }
        else if (admin_catg == 3 && departmnt == "") {
            $("#admin_dept-error").text("This field is required.");
            flag = 1;
        }
        else if ((admin_catg == 2 && employ == "") || (admin_catg == 3 && employ == "")) {
            $("#admin_employ-error").text("This field is required.");
            flag = 1;
        }
        else if (Username=="") {
            $("#email-error").text("This field is required.");
            $("input[name='Email']").focus();flag=1;
        }
        /*  if (!emailformat.test(Email)) {
             $("#email-error").text("Invalid mail format.");
             $("input[name='Email']").focus();flag=1;
        }else{
             $("#email-error").text("");
          }*/
        else if (Password=="") {
            $("#Password-error").text("This field is required.");
            $("input[name='Password']").focus();flag=1;
        }

        if(flag == 0){
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { username : Username, logid : logid },
                url: base_url+'home/username_check',
                success: function(data) {
                    if (data > 0) {
                        $("#email-error").text("Username Already exists.");
                    }
                    else {
                        $("#userForm").attr("action",base_url+"home/usersubmit");
                        $("#userForm").submit();
                    }
                }
            });
        }
    });

   /********************************************************
    * Detail : Branch Submit                                *
    ********************************************************/
    $("#branchsubmit_btn").click(function() {
        var flag          = 0;
        var id            = $("#branchId").val();
        var branchname    = $("input[name='branchname']").val();
        var Email         = $("input[name='Email']").val();
        var phone         = $("input[name='phno1']").val();
        var emailformat   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        
        if (branchname == "") {
            $("#brname-error").text("This field is required.");
            $("input[name='branchname']").focus();flag=1;
        } else {
            $("#brname-error").text("");
        } 
        if (Email == "") {
            $("#Email-error").text("This field is required.");
            $("input[name='Email']").focus();flag=1;
        } 
        else if (!emailformat.test(Email)) {
            $("#Email-error").text("Invalid mail format.");
            $("input[name='Email']").focus();flag=1;
        } else{
            $("#Email-error").text("");
        } 
        if (phone == "") {
            $("#phone-error").text("This field is required.");
            $("input[name='phno1']").focus();flag=1;
        } 
        // else if(phone.length != 10) 
        // {
        //     $("#phone-error").text("phone number contains 10 digits.");
        //     $("input[name='phno1']").focus();flag=1;      
        // }
        // else if(isNaN(phone)) 
        // {
        //     $("#phone-error").text("phone number contains numbers only.");
        //     $("input[name='phno1']").focus();flag=1;      
        // }
        else
        {
            $("#phone-error").text("");
        }

        if(flag == 0)
        {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_branch', field : 'id', condition : 'branch_name="'+branchname.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#brname-error").text("This Branch Already Exist.");
                            $("#brname-error").focus();
                            return false;
                        }
                        else {
                            $("#branchForm").attr("action",base_url+"home/branchsubmit");
                            $("#branchForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_branch', field : 'id', condition : 'branch_name="'+branchname.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#brname-error").text("This Branch Already Exist.");
                            $("#brname-error").focus();
                            return false;
                        }
                        else {
                            $("#branchForm").attr("action",base_url+"home/branchsubmit");
                            $("#branchForm").submit();
                        }
                    }
                });
            }
        }
    });

    /*******************************************************
    * Department Submit                                    *
    *******************************************************/
    $("#deptsubmit_btn").click(function() {
        var flag=0;
        
        var id           = $("#departmentId").val();
        var branch       = $("select[name='deptbranch']").val();
        var dept_name    = $("input[name='dept_name']").val();
        var phone_no1    = $("input[name='deptphone_no1']").val();
        var email        = $("input[name='deptemail']").val();
        var emailformat  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (branch == "") {
                $("#branch-error").text("Please select a branch.");
                $("input[name='deptbranch']").focus();flag=1;
            } else{
                $("#branch-error").text("");
            }
            if (dept_name == "") {
                $("#dept_name-error").text("This field is required.");
                $("input[name='dept_name']").focus();flag=1;
            } else {
                $("#dept_name-error").text("");
            }
            if (email == "") {
                $("#email-error").text("This field is required.");
                $("input[name='deptemail']").focus();flag=1;
            } else {
                $("#email-error").text("");
            }
            if (!emailformat.test(email)) {
                $("#email-error").text("Invalid mail format.");
                $("input[name='deptemail']").focus();flag=1;
            } else{
                $("#email-error").text("");
            } 
            if (phone_no1 == "") {
                $("#phone_no1-error").text("This field is required.");
                $("input[name='deptphone_no1']").focus();flag=1;
            } else{
                $("#phone_no1-error").text("");
            }
            if(flag == 0){
                if (id == '') {
                    $.ajax({
                        dataType: 'text',
                        type: 'post',
                        data: { table : 'qzolvehrm_department', field : 'id', condition : 'branch_id="'+branch+'" AND dept_name="'+dept_name.trim()+'"' },
                        url: base_url+'home/check_data_exist',
                        success: function(data) {
                            if (data > 0) {
                                $("#dept_name-error").text("This Department Already Exist.");
                                $("#dept_name-error").focus();
                                return false;
                            }
                            else {
                                $("#deptForm").attr("action",base_url+"home/deptsubmit");
                                $("#deptForm").submit();
                            }
                        }
                    });
                }
                else {
                    $.ajax({
                        dataType: 'text',
                        type: 'post',
                        data: { table : 'qzolvehrm_department', field : 'id', condition : 'branch_id="'+branch+'" AND dept_name="'+dept_name.trim()+'" AND id != '+id+'' },
                        url: base_url+'home/check_data_exist',
                        success: function(data) {
                            if (data > 0) {
                                $("#dept_name-error").text("This Department Already Exist.");
                                $("#dept_name-error").focus();
                                return false;
                            }
                            else {
                                $("#deptForm").attr("action",base_url+"home/deptsubmit");
                                $("#deptForm").submit();
                            }
                        }
                    });
                }

            } 
        });

    /*******************************************************
    * Designation Submit                                   *
    *******************************************************/
    $("#designationsubmit_btn").click(function() { 
        var flag        = 0;

        var id          = $("#designationId").val();
        // var name        = $("select[name='branchname']").val();
        // var Department  = $("select[name='dep']").val();
        var Designation = $("input[name='desgn']").val();

        if (Designation == "") {
            $("#designation-error").text("This field is required.");
            $("input[name='desgn']").focus();flag=1;
        }else {
            $("#designation-error").text("");
        }   
        if(flag == 0)
        {  
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_designation', field : 'id', condition : 'designation_name="'+Designation.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#designation-error").text("This Designation Already Exist.");
                            $("#designation-error").focus();
                            return false;
                        }
                        else {
                            $("#designationForm").attr("action",base_url+"home/designationsubmit");
                            $("#designationForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_designation', field : 'id', condition : 'designation_name="'+Designation.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#designation-error").text("This Designation Already Exist.");
                            $("#designation-error").focus();
                            return false;
                        }
                        else {
                            $("#designationForm").attr("action",base_url+"home/designationsubmit");
                            $("#designationForm").submit();
                        }
                    }
                });
            }
        }
    });
    
    /***************************************************
    * Detail : Employee Submit                         * 
    ***************************************************/
  
    $(".employeesubmit_btn").click(function() {
        $("#employeeForm").attr("action",base_url+"home/employeesubmit");
        $("#employeeForm").submit();
    });

    $('.btnNext').click(function() {
        $('.li_active').next('li').find('a').trigger('click');
        $('.li_active').next('li').addClass('li_active');
        $('.li_active').prev('li').removeClass('li_active');
    });

    $('.btnPrevious').click(function() {
        $('.li_active').prev('li').find('a').trigger('click');
        $('.li_active').prev('li').addClass('li_active');
        $('.li_active').next('li').removeClass('li_active');
    });

    /*******************************************
    * Detail : Family Information Submit       *
    *******************************************/
    $("#familysubmit_btn").click(function() {
        var family_name    = $("input[name ='family_name']").val();
        var name_error     = $("input[name ='name_error_msg']").val();

        // var location       = $("input[name ='location']").val();
        // var location_error = $("input[name ='location_error_msg']").val();

        if(family_name == "" || family_name == "Not Available"){
            $("#name_error").text(name_error);
            $("input[name='family_name']").focus();
        } 
        /*else if(location == "" || location == "Not Available"){
            $("#location_error").text(location_error);
            $("input[name='location']").focus();
        }*/ 
        else {
            $("#familyForm").attr("action",base_url+"home/familysubmit");
            $("#familyForm").submit();
        }
    });

    /*********************************************
    * Relational Info Submit                     *
    *********************************************/
    $("#relationalsubmit_btn").click(function() {
        var spouse_name = $("input[name ='spouse_name']").val();
        var name_error = $("input[name ='name_error_msg']").val();

        var email = $("input[name ='email']").val();
        var email_error = $("input[name ='email_error_msg']").val();

        var ph = $("input[name ='ph']").val();
        var phone_error = $("input[name ='phone_error_msg']").val();

        var emailformat   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if(spouse_name == "" || spouse_name == "Not Available"){
            $("#name_error").text(name_error);
            $("input[name='spouse_name']").focus();
        }
        else if((email != '') && (!emailformat.test(email))){
            $("#mail_error").text(email_error);
            $("input[name='email']").focus();
        }
        /*else if(ph == "" || ph == "Not Available"){
            $("#phone_error").text(phone_error);
            $("input[name='ph']").focus();
        }*/
        else {
            $("#relationalForm").attr("action",base_url+"home/relationalsubmit");
            $("#relationalForm").submit();
        }
    });

    /********************************************
    * Ethnic Info Submit                        *
    ********************************************/
    $("#ethnicinformationsubmit_btn").click(function() {
        var religion   = $("#relgn").val();
        var name_error = $("input[name ='name_error_msg']").val();

        if(religion == ""){
            $("#name_error").text(name_error);
            $("input[name='religion']").focus();
        } 
        else {
            $("#ethnicinformationForm").attr("action",base_url+"home/ethnicinformationsubmit");
            $("#ethnicinformationForm").submit();
        }
    });

    /********************************************
    * Social Info Submit                        *
    ********************************************/
    $("#socialinfosubmit_btn").click(function() {
        var fb_id         = $("input[name ='fb_id']").val();
        var name_error    = $("input[name ='name_error_msg']").val();
          
        var whatsap       = $("input[name ='whatsap']").val();
        var whatsap_error = $("input[name ='whats_error_msg']").val();

        /*if(fb_id == "" || fb_id == "Not Available"){
            $("#name_error").text(name_error);
            $("input[name='fb_id']").focus();
        } 
        else if(whatsap == "" || whatsap == "Not Available"){
            $("#watsap_error").text(whatsap_error);
            $("input[name='whatsap']").focus();
        } 
        else {*/
            $("#socialinfoForm").attr("action",base_url+"home/socialinfosubmit");
            $("#socialinfoForm").submit();
        // }
    });

    /***********************************
    * Detail : Office Info Submit      *
    ***********************************/
    $("#officeinfosubmit_btn").click(function() {
        /*var position_at = $("input[name ='position_at']").val();
        var position_error = $("input[name ='position_error_msg']").val();

        if(position_at == "" || position_at == "Not Available"){
            $("#position_error").text(position_error);
            $("input[name='position_at']").focus();
        }
        else {*/
            $("#officeinfoForm").attr("action",base_url+"home/officeinfosubmit");
            $("#officeinfoForm").submit();
        // }
    });

    /************************************
    * Detail : ID Details Submit        *
    ************************************/
    $("#iddetailssubmit_btn").click(function() {
        var idctg      = $("#id_category").val();

        var number     = $("input[name ='number']").val();
        var id_error   = $("input[name ='id_error_msg']").val(); 
          
        var valid_from = $("input[name ='valid_from']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 

        var valid_till = $("input[name ='valid_till']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name = 'iddet_remdr']").val();
        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }

        if (idctg == "" || idctg == 0) {
            $("#idcatg_error").text(id_error);
        }
        else if(number == "" || number == "Not Available"){
            $("#idnum_error").text(id_error);
            $("input[name='number']").focus();
        } 
        else if(valid_from == ""){
            $("#from_error").text(from_error);
            $("input[name='valid_from']").focus();
        } 
        else if(valid_till == ""){
            $("#to_error").text(till_error);
            $("input[name='valid_till']").focus();
        }
        else {
            $("#iddetailsForm").attr("action",base_url+"home/iddetailssubmit?aldate="+alertdate);
            $("#iddetailsForm").submit();
        }
    });

    /*************************************
    * Detail : Badge Info Submit         *
    *************************************/
    $("#badgedetailssubmit_btn").click(function() {
        var badgectg   = $("#badge_category").val();
        
        var number     = $("input[name ='badge_number']").val();
        var id_error   = $("input[name ='id_error_msg']").val(); 
          
        var valid_from = $("input[name ='badgvalid_from']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 

        var valid_till = $("input[name ='badgvalid_till']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='badg_remdr']").val();
        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }

        if (badgectg == "" || badgectg == 0) {
            $("#badgcatg_error").text(id_error);
        }
        else if(number == "" || number == "Not Available"){
            $("#badgnum_error").text(id_error);
            $("input[name='number']").focus();
        } 
        else if(valid_from == ""){
            $("#badgfrom_error").text(from_error);
            $("input[name='badgvalid_from']").focus();
        } 
        else if(valid_till == ""){
            $("#badgvalid_till_error").text(till_error);
            $("input[name='badgvalid_till']").focus();
        }
        else {
            $("#badgedetailsForm").attr("action",base_url+"home/badgedetailssubmit?aldate="+alertdate);
            $("#badgedetailsForm").submit();
        }
    });

    /******************************************
    * Insurance Info Insurance Provider Submit*
    ******************************************/
    $('#insurance_provider_submit').click(function(e) 
    {
        e.preventDefault();
        var id               = $("#insurance_providersId").val();
        var ins_company_name = $('#insurance_company_name').val();
        var ins_company_phno = $('#insurance_company_phno').val();
        var ins_company_adrs = $('#insurance_company_adrs').val();
        
        var ins_com_con_per  = $("input[name='ins_company_contact_person[]']").map(function(){return $(this).val();}).get();

        if(ins_company_name == "")
        {
            $('#insurance_company-error').text("This field is required");
            $("input[name='insurance_company_name']").focus();
        }
        else
        {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_insurance_provider', field : 'id', condition : 'company_name="'+ins_company_name.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $('#insurance_company-error').text("This Insurance Provider Already Exist.");
                            $("input[name='insurance_company_name']").focus();
                            return false;
                        }
                        else {
                            $("#insurance_provider_form").attr("action",base_url+"home/insurance_company_provider");
                            $("#insurance_provider_form").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_insurance_provider', field : 'id', condition : 'company_name="'+ins_company_name.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $('#insurance_company-error').text("This Insurance Provider Already Exist.");
                            $("input[name='insurance_company_name']").focus();
                            return false;
                        }
                        else {
                            $("#insurance_provider_form").attr("action",base_url+"home/insurance_company_provider");
                            $("#insurance_provider_form").submit();
                        }
                    }
                });
            }
            
        }
    });

    /******************************************
    * Insurance Info Insurance Category Submit*
    ******************************************/
    $('#insurance_category_submit').click(function(e) 
    {
        e.preventDefault();
        var ins_cat_name = $('#insurance_category_name').val();
        var ins_cat_desc = $('#insurance_category_desc').val();

        if(ins_cat_name == "")
        {
            $('#insurance_category_name-error').text("This field is required.");
            $("input[name='insurance_category_name']").focus();
        }
        else {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_insurance_category', field : 'id', condition : 'category_name="'+ins_cat_name.trim()+'"' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    
                    if (data > 0) {
                        $('#insurance_category_name-error').text("This Insurance Category Already Exist.");
                        $("input[name='insurance_category_name']").focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            type: "POST",
                            data: {ins_cat_name:ins_cat_name,ins_cat_desc:ins_cat_desc},
                            url: base_url+'home/insurance_category',
                            success: function(msg)
                            {
                                var object = JSON.parse(msg);

                                $("#insurance_category option:last").before("<option value="+object.id+">"+object.category_name+"</option>");
                            }
                        });

                        $('#insurance_category_name').val("");
                        $('#insurance_category_desc').val("");
                        $('#insurance_category').val("").trigger('change');
                        $("#insurance_category_btn").modal('hide');
                    }
                }
            });
        } // End Else
    }); 

    /**************************************
    * Insurance Info Insurance Type Submit*
    **************************************/
    $('#insurance_type_submit').click(function(e) 
    {
        e.preventDefault();
        var ins_type_name = $('#insurance_type_name').val();
        var ins_type_desc = $('#insurance_type_desc').val();

        if(ins_type_name == "")
        {
            $('#insurance_type_name-error').text("This field is required.");
            $("input[name='insurance_type_name']").focus();
        }
        else
        {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_insurance_type', field : 'id', condition : 'type_name="'+ins_type_name.trim()+'"' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    
                    if (data > 0) {
                        $('#insurance_type_name-error').text("This Insurance Type Already Exist.");
                        $("input[name='insurance_type_name']").focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            type: "POST",
                            data: {ins_type_name:ins_type_name,ins_type_desc:ins_type_desc},
                            url: base_url+'home/insurance_type',
                            success: function(msg)
                            {
                                var object = JSON.parse(msg);

                                $("#insurance_type option:last").before("<option value="+object.id+">"+object.type_name+"</option>");
                            }
                        });

                        $('#insurance_type_name').val("");
                        $('#insurance_type_desc').val("");
                        $('#insurance_type').val("").trigger('change');
                        $("#insurance_type_btn").modal('hide');
                    }
                }
            });
        } // End Else
    });

    /***************************************
    * Insurance Info Insurance Class Submit*
    ***************************************/
    $('#insurance_class_submit').click(function(e) 
    {
        e.preventDefault();
        var ins_class_name = $('#insurance_class_name').val();
        var ins_class_desc = $('#insurance_class_desc').val();

        if(ins_class_name == "")
        {
            $('#insurance_class_name-error').text("This field is required.");
            $("input[name='insurance_class_name']").focus();
        }
        else
        {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_insurance_class', field : 'id', condition : 'class_name="'+ins_class_name.trim()+'"' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    
                    if (data > 0) {
                        $('#insurance_class_name-error').text("This Insurance Class Already Exist.");
                        $("input[name='nsurance_class_name']").focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            type: "POST",
                            data: {ins_class_name:ins_class_name,ins_class_desc:ins_class_desc},
                            url: base_url+'home/insurance_class',
                            success: function(msg)
                            {
                                var object = JSON.parse(msg);

                                $("#insurance_class option:last").before("<option value="+object.id+">"+object.class_name+"</option>");
                            }
                        });

                        $('#insurance_class_name').val("");
                        $('#insurance_class_desc').val("");
                        $('#insurance_class').val("").trigger('change');
                        $("#insurance_class_btn").modal('hide');
                    }
                }
            });
        } // End  Else
    });

    /*******************************
    * Insurance Info Submit        *
    *******************************/
    $('#insurance_details_submit').click(function() 
    {
        var flag   = 0;
        var insurance_provider    = $('#insurance_provider').val();
        var insurance_category    = $('#insurance_category').val();
        var insurance_type        = $('#insurance_type').val();
        var insurance_coverage    = $('#insurance_coverage').val();
        var insurance_policy      = $('#insurance_policy').val();
        var insurance_term        = $('#insurance_term').val();
        var insurance_class       = $('#insurance_class').val();
        var insurance_num         = $('#insurance_number').val();
        var insurance_premium     = $('#insurance_premium').val();
        var insurance_valid_from  = $('#insurance_valid_from').val();
        var insurance_valid_till  = $('#insurance_valid_till').val();
        var insurance_reminder    = $('#insurance_reminder').val();
        var alertdate  = '';

        if (insurance_valid_till != "") {
            var validtill_dtarr = insurance_valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - insurance_reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }

        if(insurance_provider == "")
        {
            $('#insurance_provider-error').text("This field is required.");
            $("input[name='insurance_provider']").focus();
             flag   = 1;
        }
        else
        {
            $("#insurance_provider-error").text("");
        }
        /*if(insurance_category == "")
        {
            $('#insurance_category-error').text("This field is required.");
            $("input[name='insurance_category']").focus();
            flag   = 1;
        }
        else
        {
            $("#insurance_category-error").text("");
        }*/
        if(insurance_type == "")
        {
            $('#insurance_type-error').text("This field is required.");
            $("input[name='insurance_type']").focus();
            flag   = 1;
        }
        else
        {
            $("#insurance_type-error").text("");
        }
        /*if(insurance_policy == "")
        {
            $('#insurance_policy-error').text("This field is required.");
            $("input[name='insurance_policy']").focus();
            flag   = 1;
        }
        else
        {
             $("#insurance_policy-error").text("");
        }*/
        if(insurance_class == "")
        {
            $('#insurance_class-error').text("This field is required.");
            $("input[name='insurance_class']").focus();
            flag   = 1;
        }
        else {
            $('#insurance_class-error').text("");
        }
        /*if(insurance_num == "")
        {
            $('#insurance_number-error').text("This field is required.");
            $("input[name='insurance_number']").focus();
            flag   = 1;
        }
        else {
            $('insurance_number-error').text("");
        }*/
        if(insurance_valid_from == "")
        {
            $('#insurance_valid_from-error').text("This field is required.");
            flag   = 1;
        }
        else {
            $('#insurance_valid_from-error').text("");
        }
        if(insurance_valid_till == "")
        {
            $('#insurance_valid_till-error').text("This field is required.");
            flag   = 1;
        }
        else {
            $('#insurance_valid_till-error').text("");
        }
        if(flag == 0)
        {
            $("#insurance_details_form").attr("action",base_url+"home/insurance_details?aldate="+alertdate);
            $("#insurance_details_form").submit();
        }
    });

    /**************************************
    * Detail : Group Insurance 
                Insurance Provider Submit *
    * Date   : 04-03-2021                 *
    **************************************/
    $('#gpinsrc_provider_submit').click(function(e) 
    {
        e.preventDefault();
        var id               = $("#gpinsrc_providersId").val();
        var ins_company_name = $('#gpinsrc_company_name').val();
        var ins_company_phno = $('#gpinsrc_company_phno').val();
        var ins_company_adrs = $('#gpinsrc_company_adrs').val();
        
        // var ins_com_con_per  = $("input[name='ins_company_contact_person[]']").map(function(){return $(this).val();}).get();

        if(ins_company_name == "")
        {
            $('#gpinsrc_company-error').text("This field is required");
            $("input[name='insurance_company_name']").focus();
        }
        else
        {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_insurance_provider', field : 'id', condition : 'company_name="'+ins_company_name.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $('#gpinsrc_company-error').text("This Insurance Provider Already Exist.");
                            $("input[name='insurance_company_name']").focus();
                            return false;
                        }
                        else {
                            $("#gpinsrc_provider_form").attr("action",base_url+"home/insurance_company_provider");
                            $("#gpinsrc_provider_form").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_insurance_provider', field : 'id', condition : 'company_name="'+ins_company_name.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $('#gpinsrc_company-error').text("This Insurance Provider Already Exist.");
                            $("input[name='insurance_company_name']").focus();
                            return false;
                        }
                        else {
                            $("#gpinsrc_provider_form").attr("action",base_url+"home/insurance_company_provider");
                            $("#gpinsrc_provider_form").submit();
                        }
                    }
                });
            }
            
        }
    });

    /***************************************
    * Detail : Group Insurance             * 
                Insurance Category Submit  *
    * Date   : 04-03-2021                  *
    ***************************************/
    $('#gpinsrc_category_submit').click(function(e) 
    {
        e.preventDefault();
        var ins_cat_name = $('#gpinsrc_category_name').val();
        var ins_cat_desc = $('#gpinsrc_category_desc').val();
        
        if(ins_cat_name == "")
        {
            $('#gpinsrc_category_name-error').text("This field is required.");
            $("input[name='insurance_category_name']").focus();
        }
        else {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_insurance_category', field : 'id', condition : 'category_name="'+ins_cat_name.trim()+'"' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    
                    if (data > 0) {
                        $('#gpinsrc_category_name-error').text("This Insurance Category Already Exist.");
                        $("input[name='insurance_category_name']").focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            type: "POST",
                            data: {ins_cat_name:ins_cat_name,ins_cat_desc:ins_cat_desc},
                            url: base_url+'home/insurance_category',
                            success: function(msg)
                            {
                                var object = JSON.parse(msg);

                                $("#gpinsrc_category option:last").before("<option value="+object.id+">"+object.category_name+"</option>");
                            }
                        });

                        $('#gpinsrc_category_name').val("");
                        $('#gpinsrc_category_desc').val("");
                        $('#gpinsrc_category').val("").trigger('change');
                        $("#gpinsurance_category_btn").modal('hide');
                    }

                }
            });
        } // End  Else
    });

    /**************************************
    * Detail : Group Insurance            *
                 Insurance Type Submit    *
    * Date   : 04-03-2021                 *
    **************************************/
    $('#gpinsrc_type_submit').click(function(e) 
    {
        e.preventDefault();
        var ins_type_name = $('#gpinsrc_type_name').val();
        var ins_type_desc = $('#gpinsrc_type_desc').val();

        if(ins_type_name == "")
        {
            $('#gpinsrc_type_name-error').text("This field is required.");
            $("input[name='insurance_type_name']").focus();
        }
        else
        {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_insurance_type', field : 'id', condition : 'type_name="'+ins_type_name.trim()+'"' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    
                    if (data > 0) {
                        $('#gpinsrc_type_name-error').text("This Insurance Type Already Exist.");
                        $("input[name='insurance_type_name']").focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            type: "POST",
                            data: {ins_type_name:ins_type_name,ins_type_desc:ins_type_desc},
                            url: base_url+'home/insurance_type',
                            success: function(msg)
                            {
                                var object = JSON.parse(msg);

                                $("#gpinsrc_type option:last").before("<option value="+object.id+">"+object.type_name+"</option>");
                            }
                        });

                        $('#gpinsrc_type_name').val("");
                        $('#gpinsrc_type_desc').val("");
                        $('#gpinsrc_type').val("").trigger('change');
                        $("#gpinsrc_type_btn").modal('hide');
                    }
                }
            });
        } // End  Else
    });

    /**********************************
    * Detail : Group Insurance Submit *
    * Date   : 05-03-2021             *
    **********************************/
    $('#groupinsrc_submit').click(function() 
    {
        var flag   = 0;
        var id                 = $("input[name='id']").val();
        var insurance_provider = $('#gpinsrc_provider').val();
        var insurance_type     = $('#gpinsrc_type').val();
        var sponsor            = $('#gpinsrc_sponsor').val();
        var valid_from         = $('#gpinsrc_valid_from').val();
        var valid_till         = $('#gpinsrc_valid_till').val();

        if(insurance_provider == "")
        {
            $('#gpinsrc_provider-error').text("This field is required.");
             flag   = 1;
        }
        else
        {
            $("#gpinsrc_provider-error").text("");
        }

        if(insurance_type == "")
        {
            $('#gpinsrc_type-error').text("This field is required.");
             flag   = 1;
        }
        else
        {
            $("#gpinsrc_type-error").text("");
        }

        if(sponsor == "")
        {
            $('#gpinsrc_sponsor-error').text("This field is required.");
            flag   = 1;
        }
        else
        {
            $("#gpinsrc_sponsor-error").text("");
        }

        if(valid_from == "")
        {
            $('#gpinsrc_valid_from-error').text("This field is required.");
            flag   = 1;
        }
        else
        {
            $("#gpinsrc_valid_from-error").text("");
        }

        if(valid_till == "")
        {
            $('#gpinsrc_valid_till-error').text("This field is required.");
            flag   = 1;
        }
        else
        {
            $("#gpinsrc_valid_till-error").text("");
        }
        
        
        if(flag == 0)
        {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_groupinsurance', field : 'id', condition : 'sponsor_id="'+sponsor+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#gpinsrc_sponsor-error").text("This Sponsor Entry Already Exist.");
                            return false;
                        }
                        else {
                            $("#gpinsurance_form").attr("action",base_url+"home/grpinsurance_submit");
                            $("#gpinsurance_form").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_groupinsurance', field : 'id', condition : 'sponsor_id="'+sponsor+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#gpinsrc_sponsor-error").text("This Sponsor Entry Already Exist.");
                            return false;
                        }
                        else {
                            $("#gpinsurance_form").attr("action",base_url+"home/grpinsurance_submit");
                            $("#gpinsurance_form").submit();
                        }
                    }
                });
            }
        }
    });

    /******************************************
    * Detail : Bank info Submit               *
    ******************************************/
    $("#bankinfosubmit_btn").click(function() {
          var bank_name      = $("#bank_name").val();
          var name_error     = $("input[name ='name_error_msg']").val();

          var account_name   = $("input[name ='account_name']").val();

          var account_number = $("input[name ='account_number']").val();

          var iban_number    = $("input[name ='iban_number']").val();

          if(bank_name == "" || bank_name == "Not Available"){
            $("#name_error").text(name_error);
          } 
          /*else if(account_name == "" || account_name == "Not Available"){
            $("#acntname_error").text(name_error);
            $("input[name='account_name']").focus();
          }*/ 
          else if(account_number == "" || account_number == "Not Available"){
            $("#acntnum_error").text(name_error);
            $("input[name='account_number']").focus();
          } 
          /*else if(iban_number == "" || iban_number == "Not Available"){
            $("#iban_error").text(name_error);
            $("input[name='iban_number']").focus();
          }*/ 
          else {
            $("#bankinfoForm").attr("action",base_url+"home/bankinfosubmit");
            $("#bankinfoForm").submit();
          }
    });

    /******************************************
    * Detail : Driving License Submit         *
    ******************************************/
    $("#licensesubmit_btn").click(function() {
        var license_number = $("input[name ='license_number']").val();
        var num_error      = $("input[name ='name_error_msg']").val();

        var valid_from     = $("input[name ='valid_from']").val();

        var valid_till     = $("input[name ='valid_till']").val();
        var reminder       = $("input[name ='drv_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }

           if(license_number == "" || license_number == "Not Available"){
            $("#num_error").text(num_error);
            $("input[name='license_number']").focus();
          } 
          else if(valid_from == ""){
            $("#from_error").text(num_error);
            $("input[name='valid_from']").focus();
          } 
          else if(valid_till == ""){
            $("#till_error").text(num_error);
            $("input[name='valid_till']").focus();
          } 
          else {
            $("#licenseForm").attr("action",base_url+"home/licensesubmit?aldate="+alertdate);
            $("#licenseForm").submit();
          }
    });

    /***********************************
    * Detail : Passport Detail Submit  *
    ***********************************/
    $("#passportsubmit_btn").click(function() {
           
        var passport_number = $("input[name ='passport_number']").val();
        var num_error       = $("input[name ='name_error_msg']").val();

        var valid_from      = $("input[name ='passport_validfrom']").val();

        var valid_till      = $("input[name ='passport_validtill']").val();
        var reminder        = $("input[name ='passprt_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }

        if(passport_number == ""){
            $("#pass_error").text(num_error);
            $("input[name='passport_number']").focus();
        } 

        else if(valid_from == ""){
            $("#pprtfrom_error").text(num_error);
            $("input[name='passport_validfrom']").focus();
        } 

        else if(valid_till == ""){
            $("#pprttill_error").text(num_error);
            $("input[name='passport_validtill']").focus();
        } 
        else{
            $("#passportForm").attr("action",base_url+"home/passportsubmit?aldate="+alertdate);
            $("#passportForm").submit();
        }
    });

    /**********************************
    * Detail : Work License Submit    *
    **********************************/
    $("#worklicensesubmit_btn").click(function() {
        var license_number = $("input[name ='wl_license_number']").val();
        var num_error      = $("input[name ='name_error_msg']").val();
        var valid_from     = $("input[name ='wl_valid_from']").val();
        var valid_till     = $("input[name ='wl_valid_till']").val();
        var reminder       = $("input[name ='wl_remdr']").val();
        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }

        if(license_number == "" || license_number == "Not Available"){
            $("#wlnum_error").text(num_error);
            $("input[name='wl_license_number']").focus();
        } 
        else if(valid_from == ""){
            $("#wl_from_error").text(num_error);
            $("input[name='wl_valid_from']").focus();
        } 
        else if(valid_till == ""){
            $("#wl_till_error").text(num_error);
            $("input[name='wl_valid_till']").focus();
        } 
        else {
            $("#worklicenseForm").attr("action",base_url+"home/worklicensesubmit?aldate="+alertdate);
            $("#worklicenseForm").submit();
        }
    });

    /***********************************
    * Detail : Educational Info Submit *
    ***********************************/
    $("#educationalsubmit_btn").click(function() {
        $("#educationalForm").attr("action",base_url+"home/educationalsubmit");
        $("#educationalForm").submit();
    });

    /*************************************
    * Detail : Certifications Submit     *
    *************************************/
    $("#certificationssubmit_button").click(function() {
        var crtfcte       = [];
        var crtfcte_name  = [];
        var yr_o_j        = [];
        var yr_o_p        = [];
        var dcp           = [];
        var crtfcte       = $("input[name='certif[]']").map(function(){return $(this).val();}).get();
        var crtfcte_name  = $("input[name='certificate_name[]']").map(function(){return $(this).val();}).get();
        var yr_o_j        = $("input[name='yoj[]']").map(function(){return $(this).val();}).get();
        var yr_o_p        = $("input[name='yop[]']").map(function(){return $(this).val();}).get();
        var dcp           = $("input[name='dcp[]']").map(function(){return $ (this).val();}).get();

        if(crtfcte.length === 0){
            return false;
        } 
        else if(crtfcte_name.length === 0){
            return false;
        }
        else if(yr_o_j.length === 0){
            return false;
        }
        else if(yr_o_p.length === 0){
            return false;
        }
        else{
          $("#certificationsForm").attr("action",base_url+"home/certificatesubmit");
          $("#certificationsForm").submit();
        }
    });

    /*************************************
    * Detail : Refferal Submit           *
    *************************************/
    $("#referalsubmit_btn").click(function() {
        var flag = 0;
        var referal_from    = $("#referal_from").val();

        if (referal_from == 1) {
            var reffered_by = $("#reffered_by").val();
        }
        else {
            var reffered_by = $("input[name ='reffered_by']").val();
        }
        // var refferal_reason = $("#refferal_reason").val();
        var reffered_on     = $("input[name ='reffered_on']").val();

        var num_error       = $("input[name ='name_error_msg']").val();

        if(referal_from == ""){
            $("#reffrom_error").text(num_error);
            $("input[name='referal_from']").focus();
            flag = 1;
        }
        else {
            $("#reffrom_error").text('');
        } 
        if(reffered_on == ""){
            $("#refon_error").text(num_error);
            flag = 1;
        } 
        else {
            $("#refon_error").text('');
        }
        if(reffered_by == ""){
            if (referal_from == 1) {
                $("#refby_error").text(num_error);
                flag = 1;
            }
            else if (referal_from == 2) {
                $("#refby_error").text(num_error);
                $("input[name='reffered_by']").focus();
                flag = 1;
            }
        }
        else {
            $("#refby_error").text('');
        }
        if (flag == 0) {
            $("#referalForm").attr("action",base_url+"home/referalsubmit");
            $("#referalForm").submit();
        }
    });

    /*********************************************
    * Previous Details Tab (tab_5_1) Next        *
    *********************************************/
    $('.btnNext_previousemployers').click(function() {
        var comname      = $('#company_name').val();
        var commail      = $("input[name='company_mail']").val();
        var designation  = $('#designation').val();
        var from         = $('#from').val();
        var to           = $('#to').val();
        var emailformat  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var flag         = 0;

            if (comname == "") 
            {
                $("#cname-error").text("Please select a company.");
                $('#company_name').focus();
                flag = 1;
            }
            else 
            {
                $("#cname-error").text("");
            }
            if ((commail != '') && (!emailformat.test(commail))) {
                $("#email-error").text("Invalid mail format.");
                $("input[name='company_mail']").focus();
                flag = 1;
            }
            else{
                $("#email-error").text("");
            }
           if (designation == "") 
           {
             $("#designation-error").text("This field is required.");
             $('#designation').focus();
                flag = 1;
           }
            else 
            {
                $("#designation-error").text("");
            }
            if (from == "") 
            {
                $("#period_from-error").text("This field is required.");
                // $('#from').focus();
                flag = 1;
            }
            else 
            {
                $("#period_from-error").text("");
            }
            if (to == "") 
            {
                $("#period_to-error").text("This field is required.");
                // $('#to').focus();
                flag = 1;
            }
            else 
            {
                $("#period_to-error").text("");
            }
            if (flag == 0) {
                $('.li_active').next('li').find('a').trigger('click');
                $('.li_active').next('li').addClass('li_active');
                $('.li_active').prev('li').removeClass('li_active');
            }
    });

    /****************************************
    * Previous Details Tab (tab_5_2) Next   *
    ****************************************/
    $('.btnNext_professionaldetail').click(function() {
        var funarea      = $('#functional_area').val();
        var jobprofile   = $('#job_profile').val();
        var jobtype      = $('#jobtype').val();
        var reason       = $('#reason').val();
        var flag         = 0;

        if (funarea == "") 
        {
            $("#functional_area-error").text("This field is required.");
            $('#functional_area').focus();
            flag = 1;
        }
        else 
        {
            $("#functional_area-error").text("");
        }
        if (jobprofile == "") 
        {
            $("#job_profile-error").text("This field is required.");
            $('#job_profile').focus();
            flag = 1;
        }
        else 
        {
            $("#job_profile-error").text("");
        }
        if (jobtype == "") 
        {
            $("#jobtype-error").text("Please select a job type.");
            $('#jobtype').focus();
            flag = 1;
        }
        else 
        {
            $("#jobtype-error").text("");
        }
        if (reason == "") 
        {
            $("#reasonfor_change-error").text("This field is required.");
            $('#reason').focus();
            flag = 1;
        }
        else 
        {
            $("#reasonfor_change-error").text("");
        }
        if (flag == 0) {
            $('.li_active').next('li').find('a').trigger('click');
            $('.li_active').next('li').addClass('li_active');
            $('.li_active').prev('li').removeClass('li_active');
        }
    });


    /**************************************
    * Previous Details Tab (tab_5_3) Next *
    **************************************/
    $('.btnNext_salarypackage').click(function() {
        var msalary      = $('#msalary').val();
        var asalary      = $('#asalary').val();
        /*var flag         = 0;

        if (msalary == "") 
        {
            $("#msalary-error").text("This field is required.");
            $('#msalary').focus();
            flag = 1;
        }
        else 
        {
            $("#msalary-error").text("");
        }
        if (asalary == "") 
        {
            $("#asalary-error").text("This field is required.");
            $('#asalary').focus();
            flag = 1;
        }
        else 
        {
            $("#asalary-error").text("");
        }
        if (flag == 0) {*/
            $('.li_active').next('li').find('a').trigger('click');
            $('.li_active').next('li').addClass('li_active');
            $('.li_active').prev('li').removeClass('li_active');
        // }
    });

    /***************************************
    * Previous Details Tab (tab_5_4) Submit*
    ***************************************/
    $("#prev_companydetails_submit").click(function() 
    {
        var bname    = [];
        var bamount  = [];
        var bdesc    = [];

        var msalary  = $('#msalary').val();
        var asalary  = $('#asalary').val();
        var overtime = $('#ot').val();

        bname        = $("input[name='bname[]']").map(function(){return $(this).val();}).get();
        bamount      = $("input[name='bamount[]']").map(function(){return $(this).val();}).get();
        bdesc        = $("textarea[name='bdescription[]']").map(function(){return $(this).val();}).get();

        $("#previousdet_benefits").val(JSON.stringify(bname));
        $("#previousdet_amt").val(JSON.stringify(bamount));
        $("#previousdet_descp").val(JSON.stringify(bdesc));

        $("#previous_companydetails").attr("action",base_url+"home/previous_detailsubmit");
        $("#previous_companydetails").submit();
    });

/************************************
* Detail : Achievement Submit       *
************************************/
$("#achievementssubmit_btn").click(function() {
    $("#achievementsForm").attr("action",base_url+"home/achievementssubmit");
    $("#achievementsForm").submit();
});

/************************************
* Detail : Key Skill Submit         *
************************************/
$("#keyskillsubmit_button").click(function() {
    var skills       = [];
    var extra_skills = [];
    
    var skills       = $("input[name='skills[]']").map(function(){return $(this).val();}).get();
    var extra_skills = $("input[name='extra_curricular[]']").map(function(){return $(this).val();}).get();
   
    if(skills.length === 0){
        $("#skill_error").text('This field is required.');
        return false;
    } 
    else if(extra_skills.length === 0){
        return false;
    }
    else{
      $("#keyskillForm").attr("action",base_url+"home/keyskillsubmit");
      $("#keyskillForm").submit();
    }
});

/****************************************
* Detail : Language Proficiency Submit  *
****************************************/
$("#languagesubmit_btn").click(function() {
    var ch_read  = [];
    var ch_write = [];
    var ch_speak = [];
    var lang_na  = $("input[name='langug[]']").map(function(){return $(this).val();}).get();

    var lang_err = $("input[name ='name_error_msg']").val(); 

    ch_read      = $("#lg_profcdet #r_check").map(function () {
                        if ($(this).prop("checked") == true) {
                            return $(this).val();
                        }
                        else if ($(this).prop("checked") == false) {
                            return 2;
                        }
                   }).get();
    ch_write     = $("#lg_profcdet #w_check").map(function () {
                        if ($(this).prop("checked") == true) {
                            return $(this).val();
                        }
                        else if ($(this).prop("checked") == false) {
                            return 2;
                        }
                   }).get();
    ch_speak     = $("#lg_profcdet #s_check").map(function () {
                        if ($(this).prop("checked") == true) {
                            return $(this).val();
                        }
                        else if ($(this).prop("checked") == false) {
                            return 2;
                        }
                   }).get();

    if(lang_na.length === 0){
        $("#lang_error").text(lang_err);
        return false;
    } 
    else if(ch_read.length === 0){
        return false;
    }
    else if(ch_write.length === 0){
        return false;
    }
    else if(ch_speak.length === 0){
        return false;
    }
    else{
        $("#languageForm").attr("action",base_url+"home/languagesubmit?readarr="+ch_read+"&&writearr="+ch_write+"&&speakarr="+ch_speak);
        $("#languageForm").submit();
        $("#lang_error").text('');
    }
});

/***************************************
* Detail : Desired Job Position Submit *
***************************************/
$("#jobpositionubmit_btn").click(function() {
    var designId     = $("input[name ='desgn_Id[]']").map(function(){return $(this).val();}).get();

    var jobpos_err   = $("input[name ='tbl_error_msg']").val();
    // if(designId.length === 0){
    //     $("#jp_tbl_error").text(jobpos_err);
    // } 
    // else{
        $("#jobpositionForm").attr("action",base_url+"home/jobpositionsubmit");
        $("#jobpositionForm").submit();
    // }   
});

/****************************************
* Detail : Employment Milestone Submit  *
* Date   : 12-02-2020                   *
****************************************/
$("#emp_milestnsubmit_btn").click(function() {
    var employment_status = $("#jp_employ_status").val();
    var num_error         = $("input[name ='name_error_msg']").val();

    if(employment_status == ""){
        $("#empstat_error").text(num_error);
        $("input[name='employment_status']").focus();
    } 
    else{
        $("#empmilestnForm").attr("action",base_url+"home/emp_milestnsubmit");
        $("#empmilestnForm").submit();
    }
});

/*************************************
* Detail : Hiring Info Submit        *
*************************************/
$("#hiringsubmit_btn").click(function() {
    var date_interview  = $("input[name ='date_interview']").val();
    var date_appoinment = $("input[name ='date_appoinment']").val();
    var date_joining    = $("input[name ='date_joining']").val();

    var num_error       = $("input[name ='name_error_msg']").val();

    if(date_joining == ""){
        $("#join_error").text(num_error);
        $("input[name='date_joining']").focus();
    } 
    else{
        $("#hiringForm").attr("action",base_url+"home/hiringsubmit");
        $("#hiringForm").submit();
    }  
});

/****************************************
* Detail : Labour Information Submit    *
****************************************/
$("#laborsubmit_btn").click(function() {
    var labobourlaw_signdate      = $("input[name ='laborlawsign_date']").val();
    var labobourcontract_signdate = $("input[name ='laborcontractsign_date']").val();
    var companycontract_signdate  = $("input[name ='cmpnycontractsign_date']").val();
    var num_error                 = $("input[name ='name_error_msg']").val();

    // if(cmpny_contract == ""){
    //     $("#cmpnycontract_error").text(num_error);
    //     $("input[name='company_contract']").focus();
    // }
    // else {
        /*$("#laborForm").attr("action",base_url+"home/laborsubmit");
        $("#laborForm").submit();*/
    // }

    var labourlaw_expirydt       = $("#laborlaw_expiry").val();
    var labourlaw_reminder       = $("#laborlaw_reminder").val();
    var labourlaw_alert          = '';

    var labourcontract_expirydt  = $("#laborcontract_expiry").val();
    var labourcontract_reminder  = $("#laborcontract_remdr").val();
    var labourcontract_alert     = '';

    var companycontract_expirydt = $("#companycontract_expiry").val();
    var companycontract_reminder = $("#companycontract_remdr").val();
    var companycontract_alert    = '';

    if (labourlaw_expirydt != "") {
        var laborlawsign_dtarr = labourlaw_expirydt.split("-");
        var laborlawsign_dt = new Date(+laborlawsign_dtarr[2], laborlawsign_dtarr[1] - 1, +laborlawsign_dtarr[0]);
        laborlawsign_dt.setDate( laborlawsign_dt.getDate() - labourlaw_reminder);
        labourlaw_alert = custom_formatDate(laborlawsign_dt);

        if (labobourlaw_signdate == '') {
            $("#laborlawsign_date_error").text(num_error);
            return false;
        }
    }
    
    if (labourcontract_expirydt != "") {
        var laborcontractsign_dtarr = labourcontract_expirydt.split("-");
        var laborcontractsign_dt = new Date(+laborcontractsign_dtarr[2], laborcontractsign_dtarr[1] - 1, +laborcontractsign_dtarr[0]);
        laborcontractsign_dt.setDate( laborcontractsign_dt.getDate() - labourcontract_reminder);
        labourcontract_alert = custom_formatDate(laborcontractsign_dt);

        if (labobourcontract_signdate == '') {
            $("#laborcontractsign_date_error").text(num_error);
            return false;
        }
    }

    if (companycontract_expirydt != "") {
        var companycontract_dtarr = companycontract_expirydt.split("-");
        var companycontract_dt = new Date(+companycontract_dtarr[2], companycontract_dtarr[1] - 1, +companycontract_dtarr[0]);
        companycontract_dt.setDate( companycontract_dt.getDate() - companycontract_reminder);
        companycontract_alert = custom_formatDate(companycontract_dt);

        if (companycontract_signdate == '') {
            $("#cmpnycontract_sign_error").text(num_error);
            return false;
        }
    }

    $("#laborlaw_alertdt").val(labourlaw_alert);
    $("#laborcontract_alertdt").val(labourcontract_alert);
    $("#companycontract_alertdt").val(companycontract_alert);

    $("#laborForm").attr("action",base_url+"home/laborsubmit");
    $("#laborForm").submit();

});

    /************************************
    * Detail : Work Information Submit  *
    ************************************/
    $("#workinfosubmit_btn").click(function() {
        var work_location    = $("input[name ='work_location']").val();

        var name_error     = $("input[name ='name_error_msg']").val();

        if(work_location == ""){
            $("#work_location_error").text(name_error);
            $("input[name='work_location']").focus();
        } 
        else {
            $("#workinfo_Form").attr("action",base_url+"home/workinformationsubmit");
            $("#workinfo_Form").submit();
        }
    });

    /***************************************
    * Detail : Iqama/Bitaqa Details Submit *
    ***************************************/
    $("#iqamasubmit_btn").click(function() {
        var flag                = 0;

        var iqama_id            = $("input[name ='iqama_id']").val();
        var iqama_issuedt       = $("input[name ='iqama_issuedate']").val();
        var iqama_expirydt      = $("input[name ='iqama_expirydate']").val();
        var iqama_reminder      = $("input[name ='iqama_reminder']").val();
        // var muqeem_issuedt      = $("input[name ='muqeem_issuedate']").val();
        // var muqeem_expirydt     = $("input[name ='muqeem_expirydate']").val();
        // var muqeem_reminder     = $("input[name ='muqeem_reminder']").val();

        var name_error          = $("input[name ='name_error_msg']").val();

        var iqama_date_to_alert = '';
        // var muqeem_date_to_alert= '';

        if (iqama_expirydt != "") {
            var iqamadt_arr     = iqama_expirydt.split("-");
            var iqama_dt        = new Date(+iqamadt_arr[2], iqamadt_arr[1] - 1, +iqamadt_arr[0]);
            iqama_dt.setDate( iqama_dt.getDate() - iqama_reminder);
            iqama_date_to_alert = custom_formatDate2(iqama_dt);
        }

        
        /*if (muqeem_expirydt != "") {
            var muqeemdt_arr     = muqeem_expirydt.split("-");
            var muqeem_dt        = new Date(+muqeemdt_arr[2], muqeemdt_arr[1] - 1, +muqeemdt_arr[0]);
            muqeem_dt.setDate( muqeem_dt.getDate() - muqeem_reminder);
            muqeem_date_to_alert = custom_formatDate2(muqeem_dt);
        }*/

        $("#iqama_alertdate").val(iqama_date_to_alert);
        // $("#muqeem_alertdate").val(muqeem_date_to_alert);

        if(iqama_id == ""){
            $("#iqama_id_error").text(name_error);
            $("input[name='iqama_id']").focus();
            flag = 1;
        }
        else {
            $("#iqama_id_error").text('');
        }
        if(iqama_issuedt == ""){
            $("#iqama_issuedate_error").text(name_error);
            flag = 1;
        }
        else {
            $("#iqama_issuedate_error").text('');
        }
        if (iqama_expirydt == "") {
            $("#iqama_expirydate_error").text(name_error);
            flag = 1;
        }
        else {
            $("#iqama_expirydate_error").text('');
        }

        if (flag == 0) {
            $("#iqamaForm").attr("action",base_url+"home/iqama_bitaqasubmit");
            $("#iqamaForm").submit();
        }
    });

    /*****************************************
    * Detail : Benefit Settings Modal Submit *
    *****************************************/
    $("#benefitsettings_submit").click(function(e) {
        e.preventDefault();
        var benefitsetting_arr      = {};
        var settingbtnId            = $("#settingbtn_id").val();
        var benefit_criteria        = $("#benefitset_benefitcriteria").val();
        var benefit_reoccuring      = $("input[name='benefit_reoccur']").val();
        var benefit_carryforward    = $("input[name='benefit_carryfwd']:checked").val();
        var benefitcalc_withpayroll = $("input[name='benefitcalc_payroll']:checked").val();
        var benefit_reimbursement   = $("input[name='benefit_reimbursement']:checked").val();
        
        if(benefit_reoccuring == undefined)
        {
            benefit_reoccuring = "";
        }
        
        benefitsetting_arr['benefits_criteria']        = benefit_criteria;
        benefitsetting_arr['benefits_reoccur']         = benefit_reoccuring;
        benefitsetting_arr['benefits_carryfwd']        = benefit_carryforward;
        benefitsetting_arr['benefits_calcwithpayroll'] = benefitcalc_withpayroll;
        benefitsetting_arr['benefits_reimbursement']   = benefit_reimbursement;

        $("#benefit_setting"+settingbtnId+"").val(JSON.stringify(benefitsetting_arr));
        
        $("#benefit_settingsModal").modal('toggle');
    });

    /*****************************************
    * Detail : Benefit Activation Submit     *
    *****************************************/
    $("#benefitactivation_submit").click(function() {
        $("#benefitactivation_Form").attr("action",base_url+"home/benefit_activation_submit");
        $("#benefitactivation_Form").submit();
    });

    /*****************************************
    * Employee Dependent Submit              *
    *****************************************/
    $("#dependentsubmit_btn").click(function() {
        var flag              = 0;

        var id                = $("input[name='id']").val();
        var empid             = $("input[name='dependant_empid']").val();
        var name              = $("input[name='emp_dependentname']").val();
        var employee_relation = $("input[name='relation_with_dependent']").val();
        var iqama_expirydt    = $("input[name ='dependentiqama_expirydate']").val();
        var iqama_reminder    = $("input[name ='dependentiqama_reminder']").val();
        var dob               = $("input[name ='dependent_dob']").val();

        var iqama_date_to_alert = '';

        if (iqama_expirydt != "") {
            var dep_iqamadtarr  = iqama_expirydt.split("-");
            var iqama_dt        = new Date(+dep_iqamadtarr[2], dep_iqamadtarr[1] - 1, +dep_iqamadtarr[0]);
            iqama_dt.setDate( iqama_dt.getDate() - iqama_reminder);
            iqama_date_to_alert = custom_formatDate(iqama_dt);
        }

        $("#iqama_alertdate").val(iqama_date_to_alert);

        if(name == ""){
            $("#emp_dependentname-error").text("This field is required");
            $("input[name='emp_dependentname']").focus();
            flag = 1;
        }
        else {
            $("#emp_dependentname-error").text('');
        }

        // begin :: Added on 07-04-2021
        /*if(dob == ""){
            $("#emp_dependentdob-error").text("This field is required");
            flag = 1;
        }
        else {
            $("#emp_dependentdob-error").text('');
        }*/
        // end :: Added on 07-04-2021

        if(employee_relation == ""){
            $("#relation_with_dependent-error").text("This field is required");
            $("input[name='relation_with_dependent']").focus();
            flag = 1;
        }
        else {
            $("#relation_with_dependent-error").text('');
        }
        if (flag == 0) {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_employee_dependent', field : 'id', condition : 'dependant_name="'+name.trim()+'" AND employee_id="'+empid+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#emp_dependentname-error").text("This Dependent Already Exist.");
                            $("input[name='emp_dependentname']").focus();
                            return false;
                        }
                        else {
                            $("#dependentForm").attr("action",base_url+"home/dependentsubmit");
                            $("#dependentForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_employee_dependent', field : 'id', condition : 'dependant_name="'+name.trim()+'"  AND employee_id="'+empid+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#emp_dependentname-error").text("This Dependent Already Exist.");
                            $("input[name='emp_dependentname']").focus();
                            return false;
                        }
                        else {
                            $("#dependentForm").attr("action",base_url+"home/dependentsubmit");
                            $("#dependentForm").submit();
                        }
                    }
                });
            }
        }
    });

    /***************************************************
    * Detail : Dependant Benefit Settings Modal Submit *
    ***************************************************/
    $("#dep_benefitsettings_submit").click(function(e) {
        e.preventDefault();
        var benefitsetting_arr      = {};
        var settingbtnId            = $("#dependantsettingbtn_id").val();
        var benefit_criteria        = $("#dep_benefitset_benefitcriteria").val();
        var benefit_reoccuring      = $("input[name='dep_benefit_reoccur']").val();
        var benefit_carryforward    = $("input[name='dep_benefit_carryfwd']:checked").val();
        var benefitcalc_withpayroll = $("input[name='dep_benefitcalc_payroll']:checked").val();
        var benefit_reimbursement   = $("input[name='dep_benefit_reimbursement']:checked").val();
        
        if(benefit_reoccuring == undefined)
        {
            benefit_reoccuring = "";
        }
        
        benefitsetting_arr['benefits_criteria']        = benefit_criteria;
        benefitsetting_arr['benefits_reoccur']         = benefit_reoccuring;
        benefitsetting_arr['benefits_carryfwd']        = benefit_carryforward;
        benefitsetting_arr['benefits_calcwithpayroll'] = benefitcalc_withpayroll;
        benefitsetting_arr['benefits_reimbursement']   = benefit_reimbursement;

        $("#dependantbenefit_setting"+settingbtnId+"").val(JSON.stringify(benefitsetting_arr));
        
        $("#dependantbenefit_settingsModal").modal('toggle');
    });

    /***********************************************
    * Detail : Dependant Benefit Activation Submit *
    ***********************************************/
    $("#dep_benefitactivation_submit").click(function() {
        $("#dependantbenefitactivation_Form").attr("action",base_url+"home/dependant_benefitactivation_submit");
        $("#dependantbenefitactivation_Form").submit();
    });

    /************************************
    * Detail : Employee Events Submit   *
    ************************************/
    $("#employee_eventsubmit_btn").click(function() {
        var flag              = 0;

        var event_type     = $("#emp_eventtype").val();
        var event_date     = $("input[name ='emp_eventdate']").val();
        var event_reminder = $("input[name ='event_reminder']").val();

        var event_date_to_alert = '';

        if (event_date != "") {
            var event_dtarr = event_date.split("-");
            var event_dt = new Date(+event_dtarr[2], event_dtarr[1] - 1, +event_dtarr[0]);
            event_dt.setDate( event_dt.getDate() - event_reminder);
            event_date_to_alert = custom_formatDate(event_dt);
        }

        $("#event_alertdate").val(event_date_to_alert);

        if(event_type == ""){
            $("#eventtype_error").text("This field is required");
            flag = 1;
        }
        else {
            $("#eventtype_error").text('');
        }
        if(event_date == ""){
            $("#eventdate_error").text("This field is required");
            flag = 1;
        }
        else {
            $("#eventdate_error").text('');
        }
        if (flag == 0) {
            $("#employee_EventsForm").attr("action",base_url+"home/employee_eventsubmit");
            $("#employee_EventsForm").submit();
        }
    });

    /**************************************
    * Details : Document Controller Submit*
    * Date    : 25-02-2021                *
    **************************************/
    $("#document_submit").click(function(e) {
        e.preventDefault();

        var id              = $("input[name='id']").val();
        var document_name   = $("input[name='document_name']").val();
        var generated_date  = $("input[name='generated_date']").val();
        // var fileData        = $('#fileData').val();       

        if (document_name=="") 
        {   
            $("input[name='document_name']").addClass('is-invalid');
            $("input[name='document_name']").focus();
            return false;
        } 
        else 
        {
            $("input[name='document_name']").removeClass('is-invalid');
        }
        
        if (generated_date=="") 
        {   
            $("input[name='generated_date']").addClass('is-invalid');
            $("input[name='generated_date']").focus();
            return false;
        } 
        else 
        {
            $("input[name='generated_date']").removeClass('is-invalid');
        }
        
        $("#DocumentForm").attr("action",base_url+"Common/db_add_update");
        $("#DocumentForm").submit();
    });

    /************************************
    * Detail : Employee Transfer Submit *
    * Date   : 12-04-2021               *
    ************************************/
    $("#emptransfersubmit_btn").click(function() {
        var branch      = $("#tr_branch").val();
        var department  = $("#tr_dept").val();
        var designation = $("#tr_desg").val();
        var name_error  = "This field is required";

        if(branch == ""){
            $("#tr_branch_error").text(name_error);
            return false;
        }
        else {
            $("#tr_branch_error").text('');
        }
        if(department == ""){
            $("#tr_dept_error").text(name_error);
            return false;
        }
        else {
            $("#tr_dept_error").text('');
        }
        if(designation == ""){
            $("#tr_desg_error").text(name_error);
            return false;
        }
        else {
            $("#tr_desg_error").text('');
        }

        $("#emptransferForm").attr("action",base_url+"home/employtransfer_submit");
        $("#emptransferForm").submit();

    });

/*************************************
* Detail : User Role Submit          *
* Date   : 05-02-2020                *
*************************************/
$("#u_rolesubmit_btn").click(function() { 
    var u_role    = $("input[name='usr_role']").val();
    var urole_val = $("input[name='usrrole_val']").val();

    var error     = $("input[name ='role_error_msg']").val();
    var flag      = 0;

    if (u_role == '') {
        $("#urole-error").text(error);
        $("input[name='usr_role']").focus();
        flag = 1;
    }
    else {
        $("#urole-error").text('');
    }
    if (urole_val == '') {
        $("#roleval-error").text(error);
        flag = 1;
    }
    else {
        $("#roleval-error").text('');
    }
    if (flag == 0) {
        $("#userrole_Form").attr("action",base_url+"home/urole_submit");
        $("#userrole_Form").submit();
    }
});

/*****************************************
* Detail : Sponsor Submit (HRM Settings) *
* Date   : 14-05-2020                    *
*****************************************/
$("#setting_sponsorsubmit_btn").click(function() {
    var id    = $("#sponsor_Id").val();
    var name  = $("input[name='sponsor_name']").val();
    var phone = $("input[name='sponsor_phoneno']").val();

    var error     = $("input[name ='name_error_msg']").val();
    var flag      = 0;

    if (name == '') {
        $("#sponsorname_error").text(error);
        $("input[name='sponsor_name']").focus();
        flag = 1;
    }
    else {
        $("#sponsorname_error").text('');
    }
    if (phone == '') {
        $("#sponsorphone_error").text(error);
        $("input[name='sponsor_phoneno']").focus();
        flag = 1;
    }
    else {
        $("#sponsorphone_error").text('');
    }
    if (flag == 0) {
        if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_sponsors', field : 'id', condition : 'sponsors_name="'+name.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#sponsorname_error").text("This Sponsor Already Exist.");
                            $("#sponsor_name").focus();
                            return false;
                        }
                        else {
                            $("#setting_sponsorForm").attr("action",base_url+"home/settingsponsor_submit");
                            $("#setting_sponsorForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_sponsors', field : 'id', condition : 'sponsors_name="'+name.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#sponsorname_error").text("This Sponsor Already Exist.");
                            $("#sponsor_name").focus();
                            return false;
                        }
                        else {
                            $("#setting_sponsorForm").attr("action",base_url+"home/settingsponsor_submit");
                            $("#setting_sponsorForm").submit();
                        }
                    }
                });
            }
        
    }
});

/**************************************************
* Detail : VISA Professions Submit (HRM Settings) *
* Date   : 14-05-2020                             *
**************************************************/
$("#setting_visaprofessionsubmit_btn").click(function() {
    var id               = $("#visaprofessionId").val();
    var visa_profession  = $("input[name='visa_profession']").val();
    var code             = $("input[name='visaprofession_code']").val();

    var error = $("input[name ='name_error_msg']").val();
    var flag  = 0;

    if (visa_profession == '') {
        $("#visa_profession_error").text(error);
        $("input[name='visa_profession']").focus();
        flag = 1;
    }
    else {
        $("#visa_profession_error").text('');
    }
    if (code == '') {
        $("#visaprofession_code_error").text(error);
        $("input[name='visaprofession_code']").focus();
        flag = 1;
    }
    else {
        $("#visaprofession_code_error").text('');
    }
    if (flag == 0) {
        if (visa_profession != '') {
            $.ajax({
                dataType: 'text',
                type: 'post',
                data: { table : 'qzolvehrm_visaprofessions', field : 'id', condition : 'visa_profession="'+visa_profession.trim()+'" AND id != '+id+'' },
                url: base_url+'home/check_data_exist',
                success: function(data) {
                    if (data > 0) {
                        $("#visa_profession_error").text("This Profession Already Exist.");
                        $("input[name='visa_profession']").focus();
                        return false;
                    }
                    else {
                        $("#visa_profession_error").text('');
                        if (code != '') {
                            $.ajax({
                                dataType: 'text',
                                type: 'post',
                                data: { table : 'qzolvehrm_visaprofessions', field : 'id', condition : 'code="'+code.trim()+'" AND id != '+id+'' },
                                url: base_url+'home/check_data_exist',
                                success: function(data) {
                                    if (data > 0) {
                                        $("#visaprofession_code_error").text("This Code Already Exist.");
                                        $("input[name='visaprofession_code']").focus();
                                        return false;
                                    }
                                    else {
                                        $("#visaprofession_code_error").text('');
                                        $("#setting_visaprofessionForm").attr("action",base_url+"home/settingvisaprofession_submit");
                                        $("#setting_visaprofessionForm").submit();
                                    }
                                }
                            });
                        }
                        
                    }
                }
            });
        }
        
    }
});

/*****************************************
* Detail : Hospital Submit (HRM Settings)*
* Date   : 14-05-2020                    *
*****************************************/
$("#setting_hospitalsubmit_btn").click(function() {
    var id    = $("#hospital_Id").val();
    var name  = $("input[name='hospital_name']").val();
    var phone = $("input[name='hospital_phoneno']").val();

    var error     = $("input[name ='name_error_msg']").val();
    var flag      = 0;

    if (name == '') {
        $("#hospitalname_error").text(error);
        $("input[name='hospital_name']").focus();
        flag = 1;
    }
    else {
        $("#hospitalname_error").text('');
    }
    if (phone == '') {
        $("#hospitalphone_error").text(error);
        $("input[name='hospital_phoneno']").focus();
        flag = 1;
    }
    else {
        $("#hospitalphone_error").text('');
    }
    if (flag == 0) {
        if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_hospitals', field : 'id', condition : 'hospital_name="'+name.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#hospitalname_error").text("This Hospital Already Exist.");
                            $("input[name='hospital_name']").focus();
                            return false;
                        }
                        else {
                            $("#setting_hospitalForm").attr("action",base_url+"home/settinghospital_submit");
                            $("#setting_hospitalForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_hospitals', field : 'id', condition : 'hospital_name="'+name.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#hospitalname_error").text("This Hospital Already Exist.");
                            $("input[name='hospital_name']").focus();
                            return false;
                        }
                        else {
                            $("#setting_hospitalForm").attr("action",base_url+"home/settinghospital_submit");
                            $("#setting_hospitalForm").submit();
                        }
                    }
                });
            }
    }
});


/**************************************
* Termination Reason Submit             *
**************************************/
$("#termination_reason_submit_btn").click(function() { 

    var terminate_reason    = $("input[name='reason_name']").val();

    var error     = $("input[name ='reason_name_error']").val();
    var flag      = 0;

    if (terminate_reason == '') {
        $("#reason_name_error").text(error);
        $("input[name='reason_name']").focus();
        flag = 1;
    }
    else {
        $("#reason_name_error").text('');
    }
    if (flag == 0) {
        $("#termination_reasonForm").attr("action",base_url+"home/terminate_reason_submit");
        $("#termination_reasonForm").submit();
    }
});

/**************************************
* Employee Relation Submit             *
**************************************/
$("#relation_submit_btn").click(function() { 

    var employee_relation    = $("input[name='relation_name']").val();

    var error     = $("input[name ='relation_name_error']").val();
    var flag      = 0;

    if (employee_relation == '') {
        $("#relation_name_error").text(error);
        $("input[name='relation_name']").focus();
        flag = 1;
    }
    else {
        $("#relation_name_error").text('');
    }
    if (flag == 0) {
        $("#employee_relationForm").attr("action",base_url+"home/employee_relation_submit");
        $("#employee_relationForm").submit();
    }
});

/**************************************
* Benefit Category Submit             *
**************************************/
$("#benefitcategorysubmit_btn").click(function() {
    var id             = $("#benefit_categoryId").val();
    var benefit_ctg    = $("input[name='benefit_category']").val();

    var error     = $("input[name ='name_error_msg']").val();
    var flag      = 0;

    if (benefit_ctg == '') {
        $("#benefit_catg_error").text(error);
        $("input[name='benefit_category']").focus();
        flag = 1;
    }
    else {
        $("#benefit_catg_error").text('');
    }
    if (flag == 0) {
        if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_benefitcategory', field : 'id', condition : 'benefit_category="'+benefit_ctg.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#benefit_catg_error").text("This Category Already Exist.");
                            $("input[name='benefit_category']").focus();
                            return false;
                        }
                        else {
                            $("#benefit_categoryForm").attr("action",base_url+"home/benefitcategory_submit");
                            $("#benefit_categoryForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_benefitcategory', field : 'id', condition : 'benefit_category="'+benefit_ctg.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#benefit_catg_error").text("This Category Already Exist.");
                            $("input[name='benefit_category']").focus();
                            return false;
                        }
                        else {
                            $("#benefit_categoryForm").attr("action",base_url+"home/benefitcategory_submit");
                            $("#benefit_categoryForm").submit();
                        }
                    }
                });
            }
    }
});

    /**************************************
    * Employee Benefit Submit             *
    **************************************/
    $("#employbenefitsubmit_btn").click(function() {
        var id            = $("#benefitId").val();
        var benefit_ctg   = $("#emp_benefitcategory").val();
        var benefit_name  = $("input[name ='emp_benefitname']").val();
        var benefit_type  = $("#emp_benefittype").val();
        // var benefit_value = $("input[name ='emp_benefitvalue']").val();

        var error     = $("input[name ='name_error_msg']").val();
        var flag      = 0;

        if (benefit_ctg == '') {
            $("#emp_benefitcategory_error").text(error);
            flag = 1;
        }
        else {
            $("#emp_benefitcategory_error").text('');
        }
        if (benefit_name == '') {
            $("#emp_benefitname_error").text(error);
            $("input[name='emp_benefitname']").focus();
            flag = 1;
        }
        else {
            $("#emp_benefitname_error").text('');
        }
        if (benefit_type == '') {
            $("#emp_benefittype_error").text(error);
            flag = 1;
        }
        else {
            $("#emp_benefittype_error").text('');
        }
        /*if (benefit_value == '') {
            $("#emp_benefitvalue_error").text(error);
            $("input[name='emp_benefitvalue']").focus();
            flag = 1;
        }
        else {
            $("#emp_benefitvalue_error").text('');
        }*/
        if (flag == 0) {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_employee_benefits', field : 'id', condition : 'benefit_category_id="'+benefit_ctg+'" AND benefit_name="'+benefit_name.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#emp_benefitname_error").text("This Benefit Already Exist.");
                            $("input[name='emp_benefitname']").focus();
                            return false;
                        }
                        else {
                            $("#employeebenefit_Form").attr("action",base_url+"home/employeebenefit_submit");
                            $("#employeebenefit_Form").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_employee_benefits', field : 'id', condition : 'benefit_category_id="'+benefit_ctg+'" AND benefit_name="'+benefit_name.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#emp_benefitname_error").text("This Benefit Already Exist.");
                            $("input[name='emp_benefitname']").focus();
                            return false;
                        }
                        else {
                            $("#employeebenefit_Form").attr("action",base_url+"home/employeebenefit_submit");
                            $("#employeebenefit_Form").submit();
                        }
                    }
                });
            }
            
        }
    });

    /*****************************************
    * Detail : Event Submit (HRM Settings)   *
    * Date   : 28-05-2020                    *
    *****************************************/
    $("#setting_eventsubmit_btn").click(function() { 
        var id        = $('#event_Id').val();
        var eventname = $("input[name='events_name']").val();

        var error     = $("input[name ='name_error_msg']").val();
        var flag      = 0;

        if (eventname == '') {
            $("#eventname_error").text(error);
            $("input[name='events_name']").focus();
            flag = 1;
        }
        else {
            $("#eventname_error").text('');
        }
        if (flag == 0) {
            if (id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_events', field : 'id', condition : 'event_name="'+eventname.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#eventname_error").text("This Event Already Exist.");
                            $("input[name='events_name']").focus();
                            return false;
                        }
                        else {
                            $("#setting_eventForm").attr("action",base_url+"home/settingevent_submit");
                            $("#setting_eventForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_events', field : 'id', condition : 'event_name="'+eventname.trim()+'" AND id != '+id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#eventname_error").text("This Event Already Exist.");
                            $("input[name='events_name']").focus();
                            return false;
                        }
                        else {
                            $("#setting_eventForm").attr("action",base_url+"home/settingevent_submit");
                            $("#setting_eventForm").submit();
                        }
                    }
                });
            }
            
        }
    });
   
});//Document ready End

    /****************************************
    * Insurance Info Contact Preson Details *
        On Add More Button click            *
    *****************************************/
    function ins_provider_contact_details()
    {
        var ins_company_contact_person      = $('#insurance_company_contact_person').val();
        var ins_company_contact_person_phno = $('#insurance_company_contact_person_phno').val();
        var ins_company_contact_person_mail = $('#insurance_company_contact_person_email').val();

        var emailformat   = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var sl_row  = document.getElementById("insurance_provider_contact_details").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        var tr_id   = sl_row;
            
        if (ins_company_contact_person == "") {
            $('#insrc_cperson_name-error').text("Required field");
            $("input[name='insurance_company_contact_person']").focus();
        }
        else if ((ins_company_contact_person_mail != "") && (!emailformat.test(ins_company_contact_person_mail))) {
            $('#insrc_cperson_email-error').text("Invalid Email Format");
            $("input[name='insurance_company_contact_person_email']").focus();
        }
        else {
            var tr  =  '<tr id="tr'+tr_id+'" class="inite">\
                            <td class="sl_id">'+tr_id+'</td>\
                            <td><input type="hidden" name="ins_company_contact_person[]" id="ins_company_contact_person" value="'+ins_company_contact_person+'">'+ins_company_contact_person+'</td>\
                            <td><input type="hidden" name="ins_company_contact_person_phno[]" id="ins_company_contact_person_phno" value="'+ins_company_contact_person_phno+'">'+ins_company_contact_person_phno+'</td>\
                            <td><input type="hidden" name="ins_company_contact_person_mail[]" id="ins_company_contact_person_mail" value="'+ins_company_contact_person_mail+'">'+ins_company_contact_person_mail+'</td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_insrc_cperson('+sl_row+')" title="Remove Insurance"><i class="la la-trash-o"></i>Delete</button>\
                            </td>\
                        </tr>';
            $("#insurance_provider_contact_details > tbody:last-child").append(tr);

            $('#insurance_company_contact_person').val("");
            $('#insurance_company_contact_person_phno').val("");
            $('#insurance_company_contact_person_email').val("");
            }
    }

    /*****************************************
    * Insurance Info Contact Preson Details  *
       On Remove Row                         *
    *****************************************/
    function remove_insrc_cperson(itm_id)
    {
        $("#tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /******************************************
    * Detail : Educational Info               *
    * Date   : 23-01-2020                     *
    ******************************************/
    function add_eduinfo()
    {
        var flag          = 0;
        var qly_level     = $("#qlevel_name").val();
        var qly_lvlna     = $("#qlevel_name option:selected").text();
        var qualificn     = $("input[name='qualf_name']").val();
        var coursetype    = $("#edu_coursetype").val();
        var coursetype_na = $("#edu_coursetype option:selected").text();
        var year_join     = $("input[name='edu_join_yr']").val();
        var year_pass     = $("input[name='edu_passout_yr']").val();
        var course_name   = $("input[name='course_name']").val();

        var qlvl_error    = $("input[name ='name_error_msg']").val();
        var qlf_error     = $("input[name ='name_error_msg']").val();
        var course_error  = $("input[name ='name_error_msg']").val();
        var join_yrerror  = $("input[name ='year_error_msg']").val();
        var pass_yrerror  = $("input[name ='year_error_msg']").val();

        var sl_row  = document.getElementById("eduinfo_det").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        var tr_id   = sl_row+1;
        if (qly_level == "") {
            $("#qlevel_error").text(qlvl_error);
            flag = 1;
        }
        else {
            $("#qlevel_error").text('');
        }
        if (qualificn == "") {
            $("#qly_error").text(qlf_error);
            $("input[name='qualf_name']").focus();
            flag = 1;
        }
        else {
            $("#qly_error").text('');
        }
        if (coursetype == "") {
            $("#coursetype_error").text(course_error);
            flag = 1;
        }
        else {
            $("#coursetype_error").text('');
        }
        if (year_join == "" || year_join == "0000") {
            $("#edujoin_error").text(join_yrerror);
            flag = 1;
        }
        else {
            $("#edujoin_error").text('');
        }
        if (year_pass == "" || year_pass == "0000") {
            $("#edupassout_error").text(pass_yrerror);
            flag = 1;
        }
        else {
            $("#edupassout_error").text('');
        }
        if (flag == 0) {
            var tr  =  '<tr id="tr'+tr_id+'" class="edu_inite">\
                            <td class="sl_id">'+tr_id+'</td>\
                            <td><input type="hidden" name="qlfy_lvl[]" id="qlfy_lvl" value="'+qly_level+'">'+qly_lvlna+'</td>\
                            <td><input type="hidden" name="qualifn[]" id="qualifn" value="'+qualificn+'">'+qualificn+'</td>\
                            <td><input type="hidden" name="coursename[]" id="coursename" value="'+course_name+'">'+course_name+'</td>\
                            <td><input type="hidden" name="ctype_name[]" id="ctype_name" value="'+coursetype+'">'+coursetype_na+'</td>\
                            <td><input type="hidden" name="yr_join[]" id="yr_join" value="'+year_join+'">'+year_join+'</td>\
                            <td><input type="hidden" name="yr_pass[]" id="yr_pass" value="'+year_pass+'">'+year_pass+'</td>\
                            <td><button type="button" class="btn btn-outline-danger btn-elevate btn-sm btn-icon" onclick="remove_edurow('+tr_id+')" title="Remove Education"><i class="la la-trash-o"></i></button>\
                            </td>\
                        </tr>';
            $("#eduinfo_det > tbody:last-child").append(tr);

            $("#qlevel_name").val("").trigger('change');
            $("input[name='qualf_name']").val("");
            $("input[name='course_name']").val("");
            $("#edu_coursetype").val("").trigger('change');
            $("input[name='edu_join_yr']").val("");
            $("input[name='edu_passout_yr']").val("");
        }
    }

    /*********************************
    * Detail : Remove Education      *
    *********************************/
    function remove_edurow(itm_id)
    {
        $("#tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /***********************************
    * Detail : Certifications Add More *
    ***********************************/
    function add_certifications()
    {
        var certificate_name = $("input[name='ct_certificate_name']").val();
        var yoj              = $("input[name='ct_year_ofjoining']").val();
        var yop              = $("input[name='ct_year_ofpassout']").val();
        var dcp              = $('#ct_description').val();
        var error            = $("input[name='name_error_msg']").val();

        if(certificate_name == '')
        {
            $("#certifname_error").text(error);
            $("input[name='ct_certificate_name']").focus();
        } 
        else
        {
            var sl_row  = document.getElementById("certifications").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            var tr_id   = sl_row+1;
            if (certificate_name != "") {
                var tr  =  '<tr id="tr'+tr_id+'" class="cert_inite">\
                                <td class="sl_id">'+tr_id+'</td>\
                                <td class="certfId"><input type="hidden" name="certft_id[]" id="certft_id" value="'+0+'"></td>\
                                <td><input type="file" name="certif[]" id="certif" ></td>\
                                <td><input type="hidden" name="certificate_name[]" id="certificate_name" value="'+certificate_name+'">'+certificate_name+'</td>\
                                <td><input type="hidden" name="yoj[]" id="yoj" value="'+yoj+'">'+yoj+'</td>\
                                <td><input type="hidden" name="yop[]" id="yop" value="'+yop+'">'+yop+'</td>\
                                <td><input type="hidden" name="dcp[]" id ="dcp" value="'+dcp+'">'+dcp+'</td>\
                                <td><button type="button" class="btn btn-outline-danger btn-elevate btn-sm btn-icon" onclick="remove_crow('+tr_id+')" title="Remove Certificate"><i class="la la-trash-o"></i></button>\
                                </td>\
                            </tr>';
                $("#certifications > tbody:last-child").append(tr);
                $("input[name='ct_certificate_name']").val("");
                $("input[name='ct_year_ofjoining']").val("");
                $("input[name='ct_year_ofpassout']").val("");
                $("#ct_description").val("");
                $("#certifname_error").text('');
            }
        }
    }

    /***********************************
    * Detail : Remove Certificates     * 
    * Date   : 29-02-2020              *
    ***********************************/
    function remove_crow(itm_id)
    {
        var k = 0;
        $("#tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
            k = i+1;
          $(this).text(k);
        });
        
        $('#certifications > tbody tr').each(function (j) {
            $(this).attr('id', 'tr' + (j + 1)); // use $(this) as a reference to current tr object
        });
    }

    /****************************************************
    * Previous Details get Previous Employers Details   *
    * on Company change                                 *
    ****************************************************/
    function company_change()
    {
        var coname = $('#company_name').val();
        $.ajax({
                type: "POST",
                dataType:'json',
                data: {id:coname},
                url: base_url+'home/get_company_details',
                success: function(msg)
                {
                    $.each(msg, function(key, value){ 
                        $('#company_phone').val(value.company_phone);
                        $('#company_mail').val(value.company_mail);
                        $('#company_address').val(value.company_address);
                        $('#designation').val(value.designation);
                        $('#from').val(value.period_from);
                        $('#to').val(value.period_to);
                        $('#contact_person').val(value.contact_person);
                        $('#contact_person_number').val(value.contact_person_number);
                    });
                }
        });
    }

    /****************************************************
    * Previous Details get Previous Professional Details*
    * on Company change                                 *
    ****************************************************/
    function pre_profesional_change()
    {
        var coname = $('#pre_company_name').val();
        $.ajax({
                type: "POST",
                dataType:'json',
                data: {id:coname},
                url: base_url+'home/get_pre_prof_details',
                success: function(msg)
                {
                    $.each(msg, function(key, value){
                        $('#functional_area').val(value.functional_area);
                        $('#role').val(value.role);
                        $('#job_profile').val(value.job_profile);
                        $('#area').val(value.area_of_expertise);
                        $('#jobtype').val(value.job_type).trigger('change');
                        $('#reason').val(value.reason_for_change);
                        $('#manager').val(value.manager);
                        $('#project_head').val(value.project_head);
                        $('#supervisor').val(value.supervisor);
                    });
                }
            });
    }

    /****************************************************
    * Previous Details get Previous Salary Package      *
    * on Company change                                 *
    ****************************************************/
    function pre_sal_package_change()
    {
        $("#other_benefits").find("tr:gt(1)").remove();
        $('#bname').val("");
        $('#bamount').val("");
        $('#bdescription').val("");

        var coname      = $('#pre_company_name1').val();
        var benefit_arr = [];
        var amount_arr  = [];
        var descrpn_arr = [];

        $.ajax({
                type: "POST",
                dataType:'json',
                data: {id:coname},
                url: base_url+'home/get_pre_sal_package_details',
                success: function(msg)
                {
                    $.each(msg, function(key, value){
                        var benft_amount  = '';
                        var benft_descrpn = '';
                        benefit_arr = JSON.parse(value.benefits_name);
                        amount_arr  = JSON.parse(value.benefits_amount);
                        descrpn_arr = JSON.parse(value.benefits_description);
                        
                        $('#msalary').val(value.monthly_salary);
                        $('#asalary').val(value.annual_salary);
                        $('#ot').val(value.overtime_package_amount);
                        $.each(benefit_arr, function(k1, benft_name){
                            var tr_id    = k1 + 1;
                            if (k1 == 0) {
                                $('#bname').val(benft_name);
                                if(typeof(amount_arr[k1]) != "undefined" && amount_arr[k1] !== null) {
                                    $('#bamount').val(amount_arr[k1]);
                                }
                                if(typeof(descrpn_arr[k1]) != "undefined" && descrpn_arr[k1] !== null) {
                                    $('#bdescription').val(descrpn_arr[k1]);
                                }
                            }
                            if (k1 > 0) {
                                if(typeof(amount_arr[k1]) != "undefined" && amount_arr[k1] !== null) {
                                    benft_amount  = amount_arr[k1];
                                }
                                if(typeof(descrpn_arr[k1]) != "undefined" && descrpn_arr[k1] !== null) {
                                    benft_descrpn = descrpn_arr[k1];
                                }
                                 
                                $('#other_benefits tr:last').after('<tr id="tr_'+tr_id+'">\
                                                <td class="prevsl_id">'+tr_id+'</td>\
                                                <td>\
                                                    <input class="form-control" type="text" name="bname[]" id="bname" value="'+benft_name+'">\
                                                </td>\
                                                <td>\
                                                    <input class="form-control" type="text" name="bamount[]" id="bamount" value="'+benft_amount+'">\
                                                </td>\
                                                <td>\
                                                    <textarea class="form-control" name="bdescription[]" id="bdescription">'+benft_descrpn+'</textarea>\
                                                </td>\
                                                <td>\
                                                    <button type="button" class="btn btn-danger btn-icon rem_row btnDelete" onclick="remove_benefit('+tr_id+')" title="Remove Benefit"><i class="fa fa-minus"></i></button>\
                                                </td>\
                                            </tr>'); 
                            }
                        });
                    });
                }
        });
    }

    /**********************************
    * Previous Details Add Benefits   *
    **********************************/
    function addbenefits_row()
    {
        var tr_str = '';
        var row_num  = document.getElementById("other_benefits").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        var tr_id    = row_num + 1;

        tr_str       =  '<tr id="tr_'+tr_id+'">\
                           <td class="prevsl_id">'+tr_id+'</td>\
                           <td>\
                              <input class="form-control" type="text" name="bname[]" id="bname" value="">\
                           </td>\
                           <td>\
                              <input class="form-control" type="number" name="bamount[]" id="bamount" value="">\
                           </td>\
                           <td>\
                              <textarea class="form-control" name="bdescription[]" id="bdescription"></textarea>\
                           </td>\
                           <td>\
                                <button type="button" class="btn btn-danger btn-icon rem_row btnDelete" onclick="remove_benefit('+tr_id+')" title="Remove Benefit"><i class="fa fa-minus"></i></button>\
                           </td>\
                        </tr>';
        $("#other_benefits > tbody:last-child").append(tr_str);
    }

    /****************************************************
    * Previous Details get Previous Salary Package      *
    * on Company change                                 *
    ****************************************************/
    function pre_sal_certifict_change()
    {
        var coname = $('#pre_company_name2').val();
        $.ajax({
                type: "POST",
                dataType:'json',
                data: {id:coname},
                url: base_url+'home/get_presalary_certifct',
                success: function(msg)
                {
                    var salarycertif_upload = [];
                    var salarycertificate   = '';
                    $.each(msg, function(key, value){
                        if (typeof(value.certificate) != "undefined" && value.certificate !== null) {
                            salarycertif_upload = value.certificate;
                            salarycertificate   = salarycertif_upload.split('/');
                            $(".salry_certfct").html(salarycertificate[3]);
                        }
                        else {
                            $(".salry_certfct").html("Choose file");
                        }
                    });
                }
            });
    }

    /************************************
    * Previous Details Delete Benefits  *
    ************************************/
    function remove_benefit(itm_id)
    {
        var k = 0;
        $("#tr_" + itm_id).remove();
        $(".prevsl_id").each(function(i) {
            k = i+1;
          $(this).text(k);
        });
        
        $('#other_benefits > tbody tr').each(function (j) {
            $(this).attr('id', 'tr_' + (j + 1)); // use $(this) as a reference to current tr object
        });
    }

    /**************************************
    * Detail : Employee Achievements      *
    * Date   : 24-01-2020                 *
    **************************************/
    function clear_achvmnt()
    {
        $('#achievementsForm input[name="ach_title"]').val('');
        $('#achievementsForm #ach_descp').val('');
    }

    /*************************************
    * Achievements Add More              *
    *************************************/
    function add_achivmnt()
    {
        var acv_ctg    = $('#ach_catg').val();
        var acv_title  = $("input[name='ach_title']").val();
        var acv_descp  = $('#ach_descp').val();

        var acvctg_err = $("input[name ='name_error_msg']").val();
        var acvtitl_err= $("input[name ='name_error_msg']").val();
        var sl_row1    = 0; 
        var sl_row2    = 0; 
        var sl_row3    = 0; 

        var tr_id1     = 0; 
        var tr_id2     = 0; 
        var tr_id3     = 0; 

        var tr1        = ''; 
        var tr2        = ''; 
        var tr3        = ''; 
        if (acv_ctg == "") {
            $("#ach_ctg_error").text(acvctg_err);
        }
        else if (acv_title == "") {
            $("#ach_title_error").text(acvtitl_err);
            $("input[name='ach_title']").focus();
        }
        else{
            if (acv_ctg == 1) {
                sl_row1  = document.getElementById("achv_dets").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                tr_id1   = sl_row1 + 1;
                tr1  =  '<tr id="ach_tr'+tr_id1+'" class="achv_inite">\
                            <td class="achsl_id">'+tr_id1+'</td>\
                            <td class="achvID"><input type="hidden" name="achv_Id[]" id="achv_Id" value="0"></td>\
                            <td><input type="hidden" name="achm_title[]" id="achm_title" value="'+acv_title+'">'+acv_title+'</td>\
                            <td><input type="hidden" name="achm_desp[]" id="achm_desp" value="'+acv_descp+'">'+acv_descp+'</td>\
                            <td><input type="file" name="achm_upload[]" id="achm_upload" value=""></td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm btnDelete" onclick="remove_achrow('+tr_id1+')" title="Remove Achievement"><i class="la la-trash-o"></i> Delete</button>\
                            </td>\
                        </tr>';
            $("#achv_dets > tbody:last-child").append(tr1);
            }
            else if (acv_ctg == 2) {
                sl_row2  = document.getElementById("award_det").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                tr_id2   = sl_row2 + 1;
                tr2  =  '<tr id="awd_tr'+tr_id2+'" class="award_inite">\
                            <td class="awsl_id">'+tr_id2+'</td>\
                            <td class="achvID"><input type="hidden" name="award_Id[]" id="award_Id" value="0"></td>\
                            <td><input type="hidden" name="aw_title[]" id="aw_title" value="'+acv_title+'">'+acv_title+'</td>\
                            <td><input type="hidden" name="aw_desp[]" id="aw_desp" value="'+acv_descp+'">'+acv_descp+'</td>\
                            <td><input type="file" name="aw_upload[]" id="aw_upload" value=""></td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm btnDelete" onclick="remove_awdrow('+tr_id2+')" title="Remove Award"><i class="la la-trash-o"></i> Delete</button>\
                            </td>\
                        </tr>';
                $("#award_det > tbody:last-child").append(tr2);
            }
            else if (acv_ctg == 3) {
                sl_row3  = document.getElementById("certifct_det").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
                tr_id3   = sl_row3 + 1;
                tr3  =  '<tr id="crtf_tr'+tr_id3+'" class="certfct_inite">\
                            <td class="certfsl_id">'+tr_id3+'</td>\
                            <td class="achvID"><input type="hidden" name="crtf_Id[]" id="crtf_Id" value="0"></td>\
                            <td><input type="hidden" name="crtf_title[]" id="crtf_title" value="'+acv_title+'">'+acv_title+'</td>\
                            <td><input type="hidden" name="crtf_desp[]" id="crtf_desp" value="'+acv_descp+'">'+acv_descp+'</td>\
                            <td><input type="file" name="crtf_upload[]" id="crtf_upload" value=""></td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm btnDelete" onclick="remove_crtfrow('+tr_id3+')" title="Remove Certificate"><i class="la la-trash-o"></i> Delete</button>\
                            </td>\
                        </tr>';
                $("#certifct_det > tbody:last-child").append(tr3);
            }
        }
        $('#achievementsForm #ach_catg').val('').trigger('change');
        $('#achievementsForm input[name="ach_title"]').val('');
        $('#achievementsForm #ach_descp').val('');
    }

    /****************************************
    * Detail : Remove Achievement           *
    * Date   : 29-01-2020                   *
    ****************************************/
    function remove_achrow(itm_id)
    {
        $("#ach_tr" + itm_id).remove();
        $(".achsl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /****************************************
    * Detail : Remove Award                 *
    * Date   : 29-01-2020                   *
    ****************************************/
    function remove_awdrow(itm_id)
    {
        $("#awd_tr" + itm_id).remove();
        $(".awsl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /*****************************************
    * Detail : Remove Certificate            *
    * Date   : 29-01-2020                    *
    *****************************************/
    function remove_crtfrow(itm_id)
    {
        $("#crtf_tr" + itm_id).remove();
        $(".certfsl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /********************************************
    * Employee Key Skills Add More              *
    ********************************************/
    function add_keyskills()
    {
        var skills       = $("input[name='skills']").val();
        var extra_skills = $("input[name='extra_curricular']").val();
     
        var sl_row  = document.getElementById("skills_list").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        var tr_id   = sl_row + 1;
        if (skills != "") {
            var tr  =  '<tr id="tr'+tr_id+'" class="key_skill">\
                            <td class="sl_id">'+tr_id+'</td>\
                            <td><input type="hidden" name="skills[]" id="skills" value="'+skills+'">'+skills+'</td>\
                            <td><input type="hidden" name="extra_curricular[]" id="extra_skills" value="'+extra_skills+'">'+extra_skills+'</td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm keyskill" title="Remove Key Skill"><i class="la la-trash-o"></i></button>\
                            </td>\
                        </tr>';
            $("#skills_list > tbody:last-child").append(tr);
            $('#skills').val("");
            $('#extra_curricular').val("");
            $("#skill_error").text('');
        }
        else {
            $("#skill_error").text('This field is required.');
        }
    } 

    /********************************************
    * Remove Employee Key Skills                *
    ********************************************/
    $(document).on('click','.keyskill',function() {
        $(this).closest("tr.key_skill").remove();

        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });
    });



    /***************************************
    * Detail : Language Proficiency        *
    * Date   : 22-01-2020                  *
    ***************************************/
    function add_langprofc()
    {
        var languge   = $('#lang_prof').val();
        var languge1  = $('#lang_prof option:selected').text();
        var lang_err  = $("input[name ='name_error_msg']").val();

        if (languge == '') {
            $("#lang_error").text(lang_err);
            $("#lang_prof").focus();
        }
        else {
            var sl_row  = document.getElementById("lg_profcdet").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            var tr_id   = sl_row+1;

            if (sl_row != 0) {
                if($('#lg_profcdet td:contains('+languge1+')').length){ 
                    $("#lang_error").text("This Language Already Exist.");
                    return false; 
                }
                else{
                    $("#lang_error").text("");
                }
            }

            if (languge != "") {
                var tr  =  '<tr id="tr'+tr_id+'" class="lang_proficiency">\
                                <td class="sl_id">'+tr_id+'</td>\
                                <td><input type="hidden" name="langug[]" id="langug" value="'+languge1+'" />'+languge1+'</td>\
                                <td>\
                                    <label class="kt-checkbox kt-checkbox--brand">\
                                    <input type="checkbox" name="r_check[]" id="r_check" value="1"><span></span>\
                                    </label>\
                                </td>\
                                <td>\
                                    <label class="kt-checkbox kt-checkbox--brand">\
                                    <input type="checkbox" name="w_check[]" id="w_check" value="1"><span></span>\
                                    </label>\
                                </td>\
                                <td>\
                                    <label class="kt-checkbox kt-checkbox--brand">\
                                    <input type="checkbox" name="s_check[]" id="s_check" value="1"><span></span>\
                                    </label>\
                                </td>\
                                <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_lrow('+tr_id+')" title="Remove Language"><i class="la la-trash-o"></i></button>\
                                </td>\
                            </tr>';
                $("#lg_profcdet > tbody:last-child").append(tr);
                $("#lang_prof").val("").trigger('change');
                $("#lang_error").text('');
            }
        }
    }

    /***************************************
    * Remove Language                      *
    ***************************************/
    function remove_lrow(itm_id)
    {
        $(this).closest("tr.lang_proficiency").remove();

        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /*****************************************
    * Detail : Desired Job Position          *
    * Date   : 24-01-2020                    *
    *****************************************/
    function add_jobpos()
    {
        var desgnId      = $('#jobpos_desgn').val();
        var desgnation   = $('#jobpos_desgn option:selected').text();
        var reason       = $('#jobpos_reason').val();

        var jobpos_err   = $("input[name ='name_error_msg']").val();
        var sl_row       = 0; 
        var tr_id        = 0; 
        var tr           = '';
        if (desgnId == "") {
            $("#jp_desgn_error").text(jobpos_err);
        }
        else {
            sl_row  = document.getElementById("jobpos_det").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            tr_id   = sl_row+1;
                tr  =  '<tr id="jobpos_tr'+tr_id+'" class="jobp_inite">\
                            <td class="jpsl_id">'+tr_id+'</td>\
                            <td class="desgnID"><input type="hidden" name="desgn_Id[]" id="desgn_Id" value="'+desgnId+'"></td>\
                            <td>'+desgnation+'</td>\
                            <td><textarea name="tbl_reason[]" id="tbl_reason" class="form-control desgnID">'+reason+'</textarea>'+reason+'</td>\
                            <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_jobpos_row('+tr_id+','+desgnId+',\''+desgnation+'\')" title="Remove Job Position"><i class="la la-trash-o"></i></button>\
                            </td>\
                        </tr>';
            $("#jobpos_det > tbody:last-child").append(tr);

            $("#jobpos_desgn option:selected").remove();
            $("#jobpos_reason").val('');
        }
    }

    /********************************************
    * Detail : Desired Job Position Remove Rows *
    * Date   : 12-02-2020                       *
    ********************************************/
    function remove_jobpos_row(itm_id,desgnId,desgnation)
    {
        $("#jobpos_tr" + itm_id).remove();
        $(".jpsl_id").each(function(i) {
          $(this).text(i+1);
        });

        $("#jobpos_desgn").append(`<option value="${desgnId}">${desgnation}</option>`);
    }

    /**************************************************
    * Detail : Add More Benefits in Benefit Activation*
    * Date   : 19-05-2020                             *
    **************************************************/
    $(document).on('click', '.benefit_actv_addmore', function () {
        var benefitcategoryId = $("#benefitactivn_benefitctg").val();
        var benefit_category  = $("#benefitactivn_benefitctg option:selected").text();
        var benefitId         = $("#benefitactivn_benefit").val();
        var benefit           = $("#benefitactivn_benefit option:selected").text();

        var tr_id             = document.getElementById("benefitactivation").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;

        var sl_no        = tr_id + 1;
        var benefit_arr1 = [];
        var benefit_arr2 = '';
        var benefit_type = '';

        var service      = '';
        var amount       = '';

        if (benefitcategoryId == "") {
            $('#benefitactivn_benefitctg-error').text("Required field");
        }
        else if (benefitId == "") {
            $('#benefitactivn_benefit-error').text("Required field");
        }
        else {
            $('#benefitactivn_benefitctg-error').text("");
            $('#benefitactivn_benefit-error').text("");

            $.getScript(back_skin+'assets/js/pages/crud/forms/widgets/bootstrap-switch.js', function(){});

            benefit_arr1 = benefitId;
            benefit_arr2 = benefit_arr1.split('|');
            benefit_type = benefit_arr2[1];

            if (benefit_type == 1) {
                service = '<input type="text" class="form-control" name="services[]" id="services'+tr_id+'" value="">';
            }
            else {
                service = '<input type="hidden" class="form-control" name="services[]" id="services'+tr_id+'" value="" readonly>';
            }
            if (benefit_type == 2) {
                amount = '<input type="number" class="form-control" name="amounts[]" id="amounts'+tr_id+'" value="">';
            }
            else {
                amount = '<input type="hidden" class="form-control" name="amounts[]" id="amounts'+tr_id+'" value="" readonly>';
            }

            if (tr_id != 0) {
                if($('#benefitactivation td:contains('+benefit+')').length){ 
                    $('#benefitactivn_benefit-error').text("This Benefit Already Exist.");
                    return false; 
                }
                else{
                    $('#benefitactivn_benefit-error').text("");
                }
            }

            var tr = '<tr id="benefit_tr'+tr_id+'">\
                        <td class="sl_id">'+sl_no+'</td>\
                        <td class="activationID"><input type="hidden" name="benefitactvId[]" id="benefitactvId'+tr_id+'" value=""/></td>\
                        <td><input type="hidden" name="benefits[]" id="benefits'+tr_id+'" value="'+benefit_arr2[0]+'"/>'+benefit+'</td>\
                        <td>'+service+'</td>\
                        <td>'+amount+'</td>\
                        <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_benefitrow('+tr_id+')" title="Remove Benefit" ><i class="la la-trash-o"></i>Delete</button></td>\
                        <td><input name="benefitactivation[]" class="benefitactv" data-switch="true" type="checkbox" data-on-color="success" data-off-color="warning" value="'+tr_id+'"></td>\
                        <td><a href="#benefit_settingsModal" class="btn btn-label-info btn-pill benefitset" data-target="#benefit_settingsModal" data-toggle="modal" data-id="'+tr_id+'">Benefit Settings</a><input type="hidden" name="benefit_setting[]" id="benefit_setting'+tr_id+'" /></td>\
                     </tr>';
            $("#benefitactivation > tbody:last-child").append(tr);
        }
    });
    
    //On Click Benefit Settings Button of Benefit Activation
    $(document).on('click', '.benefitset', function () {
        var benefitsetbtn_id   = '';
        var setting_editdetail = '';
        var editdetail_arr     = [];

        benefitsetbtn_id       = $(this).data("id");

        setting_editdetail     = $("#benefit_setting"+benefitsetbtn_id).val();

        if (setting_editdetail != undefined && setting_editdetail != '') {
            editdetail_arr = JSON.parse(setting_editdetail);
        }

        if (editdetail_arr.length == 0) {
            $("#benefitset_benefitcriteria").val('').trigger('change');
        }
        else {
            var selectcriteria = editdetail_arr['benefits_criteria'];
            var reoccurdays    = editdetail_arr['benefits_reoccur'];
            
            $("#benefitset_benefitcriteria").val(selectcriteria).trigger('change', reoccurdays);

            if (typeof(editdetail_arr.benefits_carryfwd) != "undefined" && editdetail_arr.benefits_carryfwd == 1) {
                $("#benefit_carryfwd_yes").prop("checked", "checked");
            }
            else {
                $("#benefit_carryfwd_no").prop("checked", "checked");
            }

            if (typeof(editdetail_arr.benefits_calcwithpayroll) != "undefined" && editdetail_arr.benefits_calcwithpayroll == 1) {
                $("#benefitcalc_payroll_yes").prop("checked", "checked");
            }
            else {
                $("#benefitcalc_payroll_no").prop("checked", "checked");
            }

            if (typeof(editdetail_arr.benefits_reimbursement) != "undefined" && editdetail_arr.benefits_reimbursement == 1) {
                $("#benefit_reimbursement_yes").prop("checked", "checked");
            }
            else {
                $("#benefit_reimbursement_no").prop("checked", "checked");
            }
        }

        $('#settingbtn_id').val(benefitsetbtn_id);
    });

    /***************************************
    * Remove Benefit in Benefit Activation *
    ***************************************/
    function remove_benefitrow(itm_id)
    {
        $("#benefit_tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });

        $('#benefitactivation > tbody tr').each(function (j) {
            $(this).attr('id', 'benefit_tr' + (j + 1)); // use $(this) as a reference to current tr object
        });
    }

    /*******************************************
    * Detail : Add More Benefits in Dependant  *
                Benefit Activation             *
    * Date   : 21-05-2020                      *
    *******************************************/
    $(document).on('click', '.dep_benefit_actv_addmore', function () {
        var benefitcategoryId = $("#dep_benefitactivn_benefitctg").val();
        var benefit_category  = $("#dep_benefitactivn_benefitctg option:selected").text();
        var benefitId         = $("#dep_benefitactivn_benefit").val();
        var benefit           = $("#dep_benefitactivn_benefit option:selected").text();

        var tr_id        = document.getElementById("dependent_benefitactivation").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
        var sl_no        = tr_id + 1;
        
        var benefit_arr1 = [];
        var benefit_arr2 = '';
        var benefit_type = '';

        var service      = '';
        var amount       = '';

        if (benefitcategoryId == "") {
            $('#dep_benefitactivn_benefitctg-error').text("Required field");
        }
        else if (benefitId == "") {
            $('#dep_benefitactivn_benefit-error').text("Required field");
        }
        else {
            $('#dep_benefitactivn_benefitctg-error').text("");
            $('#dep_benefitactivn_benefit-error').text("");

            $.getScript(back_skin+'assets/js/pages/crud/forms/widgets/bootstrap-switch.js', function(){});

            benefit_arr1 = benefitId;
            benefit_arr2 = benefit_arr1.split('|');
            benefit_type = benefit_arr2[1];

            if (benefit_type == 1) {
                service = '<input type="text" class="form-control" name="dependant_services[]" id="dependant_services'+tr_id+'" value="">';
            }
            else {
                service = '<input type="hidden" class="form-control" name="dependant_services[]" id="dependant_services'+tr_id+'" value="" readonly>';
            }
            if (benefit_type == 2) {
                amount = '<input type="number" class="form-control" name="dependant_amounts[]" id="dependant_amounts'+tr_id+'" value="">';
            }
            else {
                amount = '<input type="hidden" class="form-control" name="dependant_amounts[]" id="dependant_amounts'+tr_id+'" value="" readonly>';
            }

            if (tr_id != 0) {
                if($('#dependent_benefitactivation td:contains('+benefit+')').length){ 
                    $('#dep_benefitactivn_benefit-error').text("This Benefit Already Exist.");
                    return false; 
                }
                else{
                    $('#dep_benefitactivn_benefit-error').text("");
                }
            }

            var tr = '<tr id="dep_benefit_tr'+tr_id+'">\
                        <td class="sl_id">'+sl_no+'</td>\
                        <td class="dep_activationID"><input type="hidden" name="dependant_benefitactvId[]" id="dependant_benefitactvId'+tr_id+'" value=""/></td>\
                        <td><input type="hidden" name="dependant_benefits[]" id="dependant_benefits'+tr_id+'" value="'+benefit_arr2[0]+'"/>'+benefit+'</td>\
                        <td>'+service+'</td>\
                        <td>'+amount+'</td>\
                        <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="remove_dep_benefitrow('+tr_id+')" title="Remove Benefit" ><i class="la la-trash-o"></i>Delete</button></td>\
                        <td><input name="dep_benefitactivation[]" class="dep_benefitactv" data-switch="true" type="checkbox" data-on-color="success" data-off-color="warning" value="'+tr_id+'"></td>\
                        <td><a href="#dep_benefit_settingsModal" class="btn btn-label-info btn-pill dep_benefitset" data-target="#dependantbenefit_settingsModal" data-toggle="modal" data-id="'+tr_id+'">Benefit Settings</a><input type="hidden" name="dependantbenefit_setting[]" id="dependantbenefit_setting'+tr_id+'" /></td>\
                     </tr>';
            $("#dependent_benefitactivation > tbody:last-child").append(tr);
        }
    });

    //On Click Benefit Settings Button of Dependant Benefit Activation
    $(document).on('click', '.dep_benefitset', function () {
        var benefitsetbtn_id   = '';
        var setting_editdetail = '';
        var editdetail_arr     = [];

        benefitsetbtn_id       = $(this).data("id");
        
        setting_editdetail     = $("#dependantbenefit_setting"+benefitsetbtn_id).val();

        if (setting_editdetail != undefined && setting_editdetail != '') {
            editdetail_arr = JSON.parse(setting_editdetail);
        }

        if (editdetail_arr.length == 0) {
            $("#dep_benefitset_benefitcriteria").val('');
        }
        else {
            var selectcriteria = editdetail_arr['benefits_criteria'];
            var reoccurdays    = editdetail_arr['benefits_reoccur'];
            
            $("#dep_benefitset_benefitcriteria").val(selectcriteria).trigger('change', reoccurdays);

            if (typeof(editdetail_arr.benefits_carryfwd) != "undefined" && editdetail_arr.benefits_carryfwd == 1) {
                $("#dep_benefit_carryfwd_yes").prop("checked", "checked");
            }
            else {
                $("#dep_benefit_carryfwd_no").prop("checked", "checked");
            }

            if (typeof(editdetail_arr.benefits_calcwithpayroll) != "undefined" && editdetail_arr.benefits_calcwithpayroll == 1) {
                $("#dep_benefitcalc_payroll_yes").prop("checked", "checked");
            }
            else {
                $("#dep_benefitcalc_payroll_no").prop("checked", "checked");
            }

            if (typeof(editdetail_arr.benefits_reimbursement) != "undefined" && editdetail_arr.benefits_reimbursement == 1) {
                $("#dep_benefit_reimbursement_yes").prop("checked", "checked");
            }
            else {
                $("#dep_benefit_reimbursement_no").prop("checked", "checked");
            }
        }

        $('#dependantsettingbtn_id').val(benefitsetbtn_id);
    });

    /*************************************************
    * Remove Benefit in Dependant Benefit Activation *
    *************************************************/
    function remove_dep_benefitrow(itm_id)
    {
        $("#dep_benefit_tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });

        $('#dependent_benefitactivation > tbody tr').each(function (j) {
            $(this).attr('id', 'dep_benefit_tr' + (j + 1)); // use $(this) as a reference to current tr object
        });
    }

    /********************************************
    * Select all Benefits in Benefit Activation *
    ********************************************/
    $('#activateall_benefit').on('switchChange.bootstrapSwitch', function (event, state) {
        $(".benefitactv").bootstrapSwitch('state', state);
    });

    /******************************************************
    * Select all Benefits in Dependant Benefit Activation *
    ******************************************************/
    $('#dep_activateall_benefit').on('switchChange.bootstrapSwitch', function (event, state) {
        $(".dep_benefitactv").bootstrapSwitch('state', state);
    });


	/****************************************
	* Detail : Add Admin                    *
	* Date   : 20-02-2020                   *
	****************************************/
    function deptadmin(){
        var adminctg_id = $("select[name='admin']").val();
        $('#adminDept').find('option').not(':first').remove();
        $('#adminEmploy').find('option').not(':first').remove();

        if (adminctg_id == '') {
            $('#adminBranch').hide();
            $('#adminDept').hide();
            $('#adminEmploy').hide();
        }
        else if (adminctg_id==2) {
            $('#admin_branch').val('').trigger('change');
            $('#adminDept').find('option').not(':first').remove();
            $('#adminEmploy').find('option').not(':first').remove();
            $('#adminBranch').show();
            $('#adminDept').hide();
            $('#adminEmploy').show();
        } 
        else if(adminctg_id==3) {
            $('#admin_branch').val('').trigger('change');
            $('#adminDept').find('option').not(':first').remove();
            $('#adminEmploy').find('option').not(':first').remove();
            $('#adminBranch').show();
            $('#adminDept').show();
            $('#adminEmploy').show();
        }
        else if (adminctg_id == 4) {
            $('#adminDept').find('option').not(':first').remove();
            $('#adminEmploy').find('option').not(':first').remove();
            $('#custom_admin').show();

            $.ajax({
                dataType: 'text',
                type    : 'post',
                url     : base_url+'home/get_employeeajax',
                cache   : false,
                  success: function (data) {
                    
                    $.each(JSON.parse(data), function(key, value){
                        $('#ctm_admin').append($('<option>').text(value.f_name+' '+value.l_name+' ('+value.employee_code+')').attr('value', value.id));
                    });
                  }
        	});
        }
    	else
     	{
       		$('#ctm_admin').find('option').not(':first').remove();
     	}      
	}

	/************************************
	* Detail :Admin Add Form            *
	* Date   : 21-02-2020               *
	************************************/
	$('#admin_branch').on('change', function (e) {
	    var admin_ctg = $('#admin').val();
	    var branch_id = 0;
	    $('#admin_employ').find('option').not(':first').remove();

	    if (admin_ctg == 2) {
	        var bflag = 0;
	        branch_id = $('#admin_branch').val();
            if (branch_id != '') {
                $.ajax({
                    dataType: 'text',
                    type    : 'post',
                    data    : { branchid: branch_id},
                    url     : base_url+'home/check_branchadmin',
                    cache   : false,
                    success : function (data) {
                        if(data > 0)
                        {
                            $("#b_admin-error").text("Branch has an Admin.");
                        }
                        else {
                            $("#b_admin-error").text("");
                            branchAjaxCall(branch_id);
                        }
                    }
                });
            }
            else {
                $("#b_admin-error").text("");
            }
	    }
	    else if (admin_ctg == 3) {
	        branch_id = $('#admin_branch').val();
	        $.ajax({
	            dataType: 'json',
	            type    : 'post',
	            data    : { branchid: branch_id},
	            url     : base_url+'home/deptmnt_ajax',
	            cache   : false,
	            success : function (data) {
	                $('#admin_dept').find('option').not(':first').remove();
	                $.each(data, function(key, value){
	                    $('#admin_dept').append($('<option>').text(value.dept_name).attr('value', value.id));
	                });
	            }
	        });
	    }
	});

	function branchAjaxCall(branch_id)
	{
	    $.ajax({
	        dataType: 'json',
	        type    : 'post',
	        data    : { branchid: branch_id},
	        url     : base_url+'home/branch_employ',
	        cache   : false,
	        success : function (data) {
	            
	            $.each(data, function(key, value){
	                $('#admin_employ').append($('<option>').text(value.f_name+' '+value.l_name+' ('+value.employee_code+')').attr('value', value.id));
	            });
	        }
	    });
	}

	/***********************************
	* Detail : Admin Add Form          *
	* Date   : 21-02-2020              *
	***********************************/
	$('#admin_dept').on('change', function (e) {
	    var deptid = $('#admin_dept').val();

	    $.ajax({
	            dataType: 'text',
	            type    : 'post',
	            data    : { dept_id: deptid},
	            url     : base_url+'home/check_deptadmin',
	            cache   : false,
	            success : function (data) {
	                if(data > 0)
	                {
	                    $("#d_admin-error").text("Department has Admin.");
	                }
	                else {
	                    $("#d_admin-error").text("");
	                    deptAjaxCall(deptid);
	                }
	            }
	        });
	});

	function deptAjaxCall(deptid)
	{
	    $.ajax({
	        dataType: 'json',
	        type    : 'post',
	        data    : { dept_id: deptid},
	        url     : base_url+'home/dept_employ',
	        cache   : false,
	        success : function (data) {
	            $('#admin_employ').find('option').not(':first').remove();
	            $.each(data, function(key, value){
	                $('#admin_employ').append($('<option>').text(value.f_name+' '+value.l_name+' ('+value.employee_code+')').attr('value', value.id));
	            });
	        }
	    });
	}

    /***************************************************************
    * Detail : Getting State names for corresponding Country       *
    * Date   : 10-02-2020                                          *
    ***************************************************************/
    function getcntry_stt(){
        $('#fmly_state').find('option').not(':first').remove();

        var cntryid = $("select[name='country']").val();
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getstateforajax?id='+cntryid,
            cache: false,
              success: function (data) {

                $.each(JSON.parse(data), function(key, value){   
                  $('#fmly_state').append($('<option>').text(value.state_name).attr('value', value.id));
                    });
              }
        });
    }

    /*********************************************************
    * Detail : Getting State names for corresponding Country *
    * Date   : 10-02-2020                                    *
    *********************************************************/
    function getcntry_stt(){
        $('#fmly_state').find('option').not(':first').remove();

        var cntryid = $("select[name='country']").val();
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getstateforajax?id='+cntryid,
            cache: false,
              success: function (data) {

                $.each(JSON.parse(data), function(key, value){   
                  $('#fmly_state').append($('<option>').text(value.state_name).attr('value', value.id));
                    });
              }
        });
    }

    /***************************************
    * Detail : State Ajax for branch add   *
    * Date   : 25-02-2020                  *
    ***************************************/
    $('#branch_cntry').on('change', function (e) {
        $('#branch_state').find('option').not(':first').remove();

        var cntryid = $("select[name='country']").val();
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getstateforajax?id='+cntryid,
            cache: false,
              success: function (data) {

                $.each(JSON.parse(data), function(key, value){   
                  $('#branch_state').append($('<option>').text(value.state_name).attr('value', value.id));
                    });
              }
        });
    });

    /****************************************
    * Detail : Location Ajax for branch add *
    * Date   : 25-02-2020                   *
    ****************************************/
    $('#branch_state').on('change', function (e) {
        $('#branch_loc').find('option').not(':first').remove();
        var stateid = $("select[name='state']").val();
        $.ajax({
            dataType: 'text',
            type: 'post',
            url: base_url+'home/getlocnforajax?id='+stateid,
            cache: false,
              success: function (data) {

                $.each(JSON.parse(data), function(key, value){   
                  $('#branch_loc').append($('<option>').text(value.loc_name).attr('value', value.id));
                    });
              }
        });
    });

    /**************************************************
    * Detail : Ajax of Floor Dropdown for Office Info *
    * Date   : 15-02-2020                             *
    **************************************************/
    $('#offc_info_bldng').on('change', function (e) {
      $('#offc_info_flr').find('option').not(':first').remove();
      $('#offc_info_roomno').find('option').not(':first').remove();
        var buildgid = $("#offc_info_bldng").val();
        $.ajax({
            dataType: 'text',
            type    : 'post',
            data    : { buildgid : buildgid},
            url     : base_url+'home/getfloor_forajax',
            cache   : false,
              success: function (data) {
                $.each(JSON.parse(data), function(key, value){
                    $('#offc_info_flr').append($('<option>').text(value.floor_no).attr('value', value.id));
                });
              }
        });
    });

    /***************************************************
    * Detail : Ajax of Room No Dropdown for Office Info*
    * Date   : 15-02-2020                              *
    ***************************************************/
    $('#offc_info_flr').on('change', function (e) {
      $('#offc_info_roomno').find('option').not(':first').remove();
        var flr_id = $("#offc_info_flr").val();
        $.ajax({
            dataType: 'text',
            type    : 'post',
            data    : { flr_id : flr_id},
            url     : base_url+'home/getroomNo_forajax',
            cache   : false,
              success: function (data) {
                $.each(JSON.parse(data), function(key, value){
                    $('#offc_info_roomno').append($('<option>').text(value.room_no).attr('value', value.id));
                });
              }
        });
    });

    /***************************************
    * Detail : On change Benefit Type      *
               of Employee Benefits        *
    * Date   : 18-05-2020                  *
    ***************************************/
    /*$('#emp_benefittype').on('change', function (e) {
        var html_str = '';
        var type     = $('#emp_benefittype').val();

        if (type == 1) {
            html_str = '<label for="benefit_value" class="form-control-label">Benefit Value</label>\
                        <span style="color:red"> *</span>&nbsp;&nbsp;<span id="emp_benefitvalue_error" class="error" for="emp_benefitvalue_error"></span>\
                           <input type="text" class="form-control" name="emp_benefitvalue" id="emp_benefitvalue" value="">';
        }
        else if (type == 2) {
            html_str = '<label for="benefit_value" class="form-control-label">Benefit Value</label>\
                        <span style="color:red"> *</span>&nbsp;&nbsp;<span id="emp_benefitvalue_error" class="error" for="emp_benefitvalue_error"></span>\
                           <input type="number" class="form-control" name="emp_benefitvalue" id="emp_benefitvalue" value="">';
        }
        else {
            html_str = '';
        }
        
        $('.employee_benefitvalue').html(html_str);               
    });*/

    /****************************************
    * Detail : Onchange Benefit Criteria of *
                       Benefit Settings
    * Date   : 19-05-2020                   *
    ****************************************/
    $('#benefitset_benefitcriteria').on('change', function (e) {
        var html_str         = '';
        var benefit_criteria = $('#benefitset_benefitcriteria').val();

        if (benefit_criteria == 1) {
            $('.reoccuring').hide();
        }
        else if (benefit_criteria == 2) {
            html_str = '<label for="benefit_reoccur" class="form-control-label">Re-Occuring (days)</label>\
                        <span id="benefit_reoccur_error" class="error" for="benefit_reoccur_error"></span>\
                           <input type="number" class="form-control" name="benefit_reoccur" id="benefit_reoccur" value="" min="0" step="0.01">';
            $('.reoccuring').html(html_str);
            $('.reoccuring').show();
        }
        else {
            html_str = '';
            $('.reoccuring').html(html_str);
            $('.reoccuring').hide();
        }                
    });

    /****************************************
    * Detail : Onchange Benefit Criteria of *
                 Dependant Benefit Settings *
    * Date   : 21-05-2020                   *
    ****************************************/
    $('#dep_benefitset_benefitcriteria').on('change', function (e, data1) {
        var html_str         = '';
        var benefit_criteria = $('#dep_benefitset_benefitcriteria').val();

        if (benefit_criteria == 1) {
            $('.dep_reoccuring').hide();
        }
        else if (benefit_criteria == 2) {
            html_str = '<label for="dependantbenefit_reoccur" class="form-control-label">Re-Occuring (days)</label>\
                        <span id="dep_benefit_reoccur_error" class="error" for="dep_benefit_reoccur_error"></span>\
                           <input type="number" class="form-control" name="dep_benefit_reoccur" id="dep_benefit_reoccur" value="" min="0" step="0.01">';

            $('.dep_reoccuring').html(html_str);

            if (typeof(data1) != "undefined" && data1 !== null) {
                $("input[name='dep_benefit_reoccur']").val(data1);
            }

            $('.dep_reoccuring').show();
        }
        else {
            html_str = '';
            $('.dep_reoccuring').html(html_str);
            $('.dep_reoccuring').hide();
        }                
    });

    function employee_name_change()
    {
        var emp_id = $('#employee_name').val();
        var al = '';
        var sl = 0;
       $('#employee_notifications').find('tbody').remove();
          $.ajax({
            type    : 'post',
            data    : {emp_id : emp_id},
            url     : base_url+'home/get_employee',
            cache   : false,
              success: function (msg) {
                $.each(JSON.parse(msg), function(key, value)
                {
                    al += '<tr><td>'+(sl+1)+'</td><td>Badge</td><td>'+value.valid_from+'</td><td>'+value.valid_till+'</td><td>'+value.reminder+'</td><td>'+value.alert_date+'</td><td></td></tr>'
                    al += '<tr><td>'+(sl+2)+'</td><td>Insurance</td><td>'+value.ins_valid_from+'</td><td>'+value.ins_valid_till+'</td><td>'+value.ins_reminder+'</td><td>'+value.ins_alert_date+'</td><td></td></tr>'
                    al += '<tr><td>'+(sl+3)+'</td><td>ID</td><td>'+value.id_valid_from+'</td><td>'+value.id_valid_till+'</td><td>'+value.id_reminder+'</td><td>'+value.id_alert_date+'</td><td></td></tr>'
                    al += '<tr><td>'+(sl+4)+'</td><td>Passport</td><td>'+value.p_valid_from+'</td><td>'+value.p_valid_till+'</td><td>'+value.p_reminder+'</td><td>'+value.p_alert_date+'</td><td></td></tr>'
                    al += '<tr><td>'+(sl+5)+'</td><td>Driving License</td><td>'+value.d_valid_from+'</td><td>'+value.d_valid_till+'</td><td>'+value.d_reminder+'</td><td>'+value.d_alert_date+'</td><td></td></tr>'
                    al += '<tr><td>'+(sl+6)+'</td><td>Work License</td><td>'+value.w_valid_from+'</td><td>'+value.w_valid_till+'</td><td>'+value.w_reminder+'</td><td>'+value.w_alert_date+'</td><td></td></tr>'
                    
                    $('#employee_notifications').append(al);
                    // sl = sl+1;
                    //$('#offc_info_roomno').append($('<option>').text(value.room_no).attr('value', value.id));
                });

                /*if(typeof(data1) != "undefined" && data1 !== null)
                {
                  $('#offc_room_floor').val(data1).trigger('change');
                }*/
              }
        });
}


    $(".ach_image").click(function(){
        window.open($(this).attr("src"), "_blank", "menubar=1,resizable=1");
    });
    
    $(".award_image").click(function(){
        window.open($(this).attr("src"), "_blank", "menubar=1,resizable=1");
    });

    $(".certf_image").click(function(){
        window.open($(this).attr("src"), "_blank", "menubar=1,resizable=1");
    }); 

    /*$(".crtfcns_img").click(function(){
        window.open($(this).attr("src"), "_blank", "menubar=1,resizable=1");
    });*/

    
    function remove_lrow(itm_id)
    {
        $("#tr" + itm_id).remove();
        $(".sl_id").each(function(i) {
          $(this).text(i+1);
        });
    }

    /*************************************************
    * Detail : passport notification Details Submit *
    *************************************************/
    $("#passport_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='passport_id']").val();  
        var valid_from = $("input[name ='passport_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='passport_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='passprt_notification_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }
            
       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='passport_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='passport_notification_validtill']").focus();
        }
        else {
            $("#passport_notification_edit").attr("action",base_url+"home/passport_notification_detailssubmit?aldate="+alertdate);
            $("#passport_notification_edit").submit();
        }
    });
     /*********************************************
    * Detail : badge_notification_ Details Submit *
    **********************************************/
    $("#badge_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='badge_id']").val();  
        var valid_from = $("input[name ='badge_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='badge_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='badge_notification_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }
            
       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='badge_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='badge_notification_validtill']").focus();
        }
        else {
            $("#badge_notification_edit").attr("action",base_url+"home/badge_notification_detailssubmit?aldate="+alertdate);
            $("#badge_notification_edit").submit();
        }
    });

    /***********************************************
    * Detail : insurance_notification_ Details Submit*
    *************************************************/
    $("#insurance_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='insurance_id']").val();  
        var valid_from = $("input[name ='insurance_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='insurance_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='insurance_notification_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }
            
       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='insurance_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='insurance_notification_validtill']").focus();
        }
        else {
            $("#insurance_notification_edit").attr("action",base_url+"home/insurance_notification_detailssubmit?aldate="+alertdate);
            $("#insurance_notification_edit").submit();
        }
    });

    
    /*******************************************************
    * Detail : drivinglicense_notification_ Details Submit *
    *******************************************************/
    $("#drivinglicense_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='drivinglicense_id']").val();  
        var valid_from = $("input[name ='drivinglicense_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='drivinglicense_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='drivinglicense_notification_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate2(validtill_dt);
        }

       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='drivinglicense_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='drivinglicense_notification_validtill']").focus();
        }
        else {
            $("#drivinglicense_notification_edit").attr("action",base_url+"home/drivinglicense_notification_detailssubmit?aldate="+alertdate);
            $("#drivinglicense_notification_edit").submit();
        }
    });

    /**************************************************
    * Detail : worklicense_notification Details Submit*
    **************************************************/
    $("#worklicense_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='worklicense_id']").val();  
        var valid_from = $("input[name ='worklicense_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='worklicense_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='worklicense_notification_remdr']").val();

        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }
            
       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='worklicense_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='worklicense_notification_validtill']").focus();
        }
        else {
            $("#worklicense_notification_edit").attr("action",base_url+"home/worklicense_notification_detailssubmit?aldate="+alertdate);
            $("#worklicense_notification_edit").submit();
        }
    });
    
    /******************************************
    * Detail : id_notification Details Submit *
    ******************************************/
     $("#id_notification_detailssubmit_btn").click(function() {
        var id         = $("input[name ='iddetails_id']").val();  
        var valid_from = $("input[name ='id_notification_validfrom']").val();
        var from_error = $("input[name ='from_error_msg']").val(); 
        var valid_till = $("input[name ='id_notification_validtill']").val();
        var till_error = $("input[name ='till_error_msg']").val(); 
        var reminder   = $("input[name ='id_notification_remdr']").val();
        var alertdate  = '';

        if (valid_till != "") {
            var validtill_dtarr = valid_till.split("-");
            var validtill_dt = new Date(+validtill_dtarr[2], validtill_dtarr[1] - 1, +validtill_dtarr[0]);
            validtill_dt.setDate( validtill_dt.getDate() - reminder);
            alertdate = custom_formatDate(validtill_dt);
        }
            
       if(valid_from == ""){
            $("#dateofissue_error").text(from_error);
            $("input[name='id_notification_validfrom']").focus();
        } 
        else if(valid_till == ""){
            $("#dateofexpiry_error").text(till_error);
            $("input[name='id_notification_validtill']").focus();
        }
        else {
            $("#id_notification_edit").attr("action",base_url+"home/id_notification_detailssubmit?aldate="+alertdate);
            $("#id_notification_edit").submit();
        }
    });

    /*********************************************
    * Detail : Iqama/Bitaqa Notifications Submit *
    *********************************************/
    $("#iqama_notificationsubmit_btn").click(function() {
        var flag                = 0;

        var iqama_id            = $("input[name ='iqama_notif_id']").val();
        var iqama_issuedt       = $("input[name ='iqama_notif_issuedate']").val();
        var iqama_expirydt      = $("input[name ='iqama_notif_expirydate']").val();
        var iqama_reminder      = $("input[name ='iqama_notif_reminder']").val();
        // var muqeem_issuedt      = $("input[name ='notif_muqeem_issuedate']").val();
        // var muqeem_expirydt     = $("input[name ='notif_muqeem_expirydate']").val();
        // var muqeem_reminder     = $("input[name ='notif_muqeem_reminder']").val();

        var name_error          = $("input[name ='name_error_msg']").val();

        var iqama_date_to_alert = '';
        // var muqeem_date_to_alert= '';

        if (iqama_expirydt != "") {
            var iqama_dtarr     = iqama_expirydt.split("-");
            var iqama_dt        = new Date(+iqama_dtarr[2], iqama_dtarr[1] - 1, +iqama_dtarr[0]);
            iqama_dt.setDate( iqama_dt.getDate() - iqama_reminder);
            iqama_date_to_alert = custom_formatDate2(iqama_dt);
        }

        /*if (muqeem_expirydt != "") {
            var muqeem_dtarr     = muqeem_expirydt.split("-");
            var muqeem_dt        = new Date(+muqeem_dtarr[2], muqeem_dtarr[1] - 1, +muqeem_dtarr[0]);
            muqeem_dt.setDate( muqeem_dt.getDate() - muqeem_reminder);
            muqeem_date_to_alert = custom_formatDate2(muqeem_dt);
        }*/

        $("#notif_iqama_alertdate").val(iqama_date_to_alert);
        // $("#notif_muqeem_alertdate").val(muqeem_date_to_alert);

        if(iqama_id == ""){
            $("#iqama_notif_id_error").text(name_error);
            $("input[name='iqama_notif_id']").focus();
            flag = 1;
        }
        else {
            $("#iqama_notif_id_error").text('');
        }
        if(iqama_issuedt == ""){
            $("#iqama_issuedate_notif_error").text(name_error);
            flag = 1;
        }
        else {
            $("#iqama_issuedate_notif_error").text('');
        }
        if (iqama_expirydt == "") {
            $("#iqama_notif_expirydate_error").text(name_error);
            flag = 1;
        }
        else {
            $("#iqama_notif_expirydate_error").text('');
        }

        if (flag == 0) {
            $("#iqama_notificationForm").attr("action",base_url+"home/iqamabitaqa_notificationsubmit");
            $("#iqama_notificationForm").submit();
        }
    });

    /******************************************
    * Detail : Labour Law Notification Submit *
    ******************************************/
     $("#laborlaw_notificationsubmit_btn").click(function() {
        var labourlaw_alert = '';

        var id       = $("input[name ='labourlaw_id']").val();  
        var expirydt = $("input[name ='notif_laborlaw_expiry']").val();
        var reminder = $("input[name ='notif_laborlaw_reminder']").val();
        var signeddt = $("input[name ='notif_laborlawsign_date']").val();

        if (expirydt != "") {
            var laborlawexpiry_dtarr = expirydt.split("-");
            var laborlaw_dt = new Date(+laborlawexpiry_dtarr[2], laborlawexpiry_dtarr[1] - 1, +laborlawexpiry_dtarr[0]);
            laborlaw_dt.setDate( laborlaw_dt.getDate() - reminder);
            labourlaw_alert = custom_formatDate(laborlaw_dt);

            if (signeddt == '') {
                $('#notif_laborlawsign_date_error').text('This field is required');
                return false;
            }
        }
        
        $("#notif_laborlaw_alertdt").val(labourlaw_alert);
            
        $("#labour_lawnotification_edit").attr("action",base_url+"home/labourlaw_notificationsubmit");
        $("#labour_lawnotification_edit").submit();
    });

    /***********************************************
    * Detail : Labour Contract Notification Submit *
    ***********************************************/
     $("#laborcontract_notificationsubmit_btn").click(function() {
        var labourcontract_alert = '';

        var id       = $("input[name ='labourcontract_id']").val();  
        var expirydt = $("input[name ='notif_laborcontract_expiry']").val();
        var reminder = $("input[name ='notif_laborcontract_reminder']").val();
        var signeddt = $("input[name ='notif_laborcontractsign_date']").val();

        if (expirydt != "") {
            var laborcontractexpiry_dtarr = expirydt.split("-");
            var laborcontract_dt = new Date(+laborcontractexpiry_dtarr[2], laborcontractexpiry_dtarr[1] - 1, +laborcontractexpiry_dtarr[0]);
            laborcontract_dt.setDate( laborcontract_dt.getDate() - reminder);
            labourcontract_alert = custom_formatDate(laborcontract_dt);

            if (signeddt == '') {
                $('#notif_laborcontractsign_date_error').text('This field is required');
                return false;
            }
        }
        
        $("#notif_laborcontract_alertdt").val(labourcontract_alert);
            
        $("#labour_contractnotification_edit").attr("action",base_url+"home/labourcontract_notificationsubmit");
        $("#labour_contractnotification_edit").submit();
    });

    /*************************************************
    * Detail : Company Conytract Notification Submit *
    *************************************************/
     $("#companycontract_notificationsubmit_btn").click(function() {
        var companycontract_alert = '';

        var id       = $("input[name ='cmpcontract_id']").val();  
        var expirydt = $("input[name ='notif_cmpcontract_expiry']").val();
        var reminder = $("input[name ='notif_cmpcontract_reminder']").val();
        var signeddt = $("input[name ='notif_cmpcontractsign_date']").val();

        if (expirydt != "") {
            var cmpcontractexpiry_dtarr = expirydt.split("-");
            var companycontract_dt = new Date(+cmpcontractexpiry_dtarr[2], cmpcontractexpiry_dtarr[1] - 1, +cmpcontractexpiry_dtarr[0]);
            companycontract_dt.setDate( companycontract_dt.getDate() - reminder);
            companycontract_alert = custom_formatDate(companycontract_dt);

            if (signeddt == '') {
                $('#notif_cmpcontractsign_date_error').text('This field is required');
                return false;
            }
        }
        
        $("#notif_cmpcontract_alertdt").val(companycontract_alert);
            
        $("#cmp_contractnotification_edit").attr("action",base_url+"home/companycontract_notificationsubmit");
        $("#cmp_contractnotification_edit").submit();
    });

    /**************************************
    * Detail : Notification Events Submit *
    **************************************/
    $("#notification_eventsubmit_btn").click(function() {
        var flag              = 0;

        var event_type     = $("#notif_eventtype").val();
        var event_date     = $("input[name ='notif_eventdate']").val();
        var event_reminder = $("input[name ='notif_event_reminder']").val();

        var event_date_to_alert = '';

        if (event_date != "") {
            var event_dtarr = event_date.split("-");
            var event_dt = new Date(+event_dtarr[2], event_dtarr[1] - 1, +event_dtarr[0]);
            event_dt.setDate( event_dt.getDate() - event_reminder);
            event_date_to_alert = custom_formatDate(event_dt);
        }

        $("#notif_event_alertdate").val(event_date_to_alert);

        if(event_type == ""){
            $("#notif_eventtype_error").text("This field is required");
            flag = 1;
        }
        else {
            $("#notif_eventtype_error").text('');
        }
        if(event_date == ""){
            $("#notif_eventdate_error").text("This field is required");
            flag = 1;
        }
        else {
            $("#notif_eventdate_error").text('');
        }
        if (flag == 0) {
            $("#Events_notificationForm").attr("action",base_url+"home/notification_eventsubmit");
            $("#Events_notificationForm").submit();
        }
    });

    /***************************************
    * Office Settings Building Submit      *
    ***************************************/
    $("#add_building").click(function() { 
        var flag        = 0;

        var buildgId    = $("input[name='buildng_id']").val();
        var branchId    = $("#offc_branch").val();
        var buildng     = $("input[name='offc_buildng']").val();
        var build_descp = $("#buildng_desc").val();

        var common_error = $("input[name ='name_error_msg']").val();

        if (branchId == "") {
            $("#offcbranch_error").text(common_error);
            flag = 1;
        }
        else {
            $("#offcbranch_error").text('');
        }
        if (buildng == "") {
            $("#offc_bldg_error").text(common_error);
            $("input[name='offc_buildng']").focus();
            flag = 1;
        }
        else {
            $("#offc_bldg_error").text('');
        }   
        if(flag == 0)
        {
            if (buildgId == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_buildng', field : 'id', condition : 'branch_id="'+branchId+'" AND bldng_name="'+buildng.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_bldg_error").text("This Building Already Exist.");
                            $("#offc_bldg_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_BuildngForm").attr("action",base_url+"home/offc_buildg_submit");
                            $("#offc_BuildngForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_buildng', field : 'id', condition : 'branch_id="'+branchId+'" AND bldng_name="'+buildng.trim()+'" AND id != '+buildgId+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_bldg_error").text("This Building Already Exist.");
                            $("#offc_bldg_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_BuildngForm").attr("action",base_url+"home/offc_buildg_submit");
                            $("#offc_BuildngForm").submit();
                        }
                    }
                });
            } 
        }
    });

    /***************************************
    * Office Settings Floor Submit         *
    ***************************************/
    $("#add_floor").click(function() { 
        var flag     = 0;
        var branchId = $("#offc_flr_branch").val();
        var buildng  = $("#offc_flr_build").val();
        var floorno  = $("input[name='offc_floorno']").val();
        var floor_na = $("input[name='offc_floor']").val();
        var flr_id   = $("input[name='floor_id']").val();
        var flr_desc = $("#floor_desc").val();

        var common_error = $("input[name ='name_error_msg']").val();

        if (branchId == "") {
            $("#flr_branch_error").text(common_error);
            flag = 1;
        }
        else {
            $("#flr_branch_error").text('');
        }
        if (buildng == "") {
            $("#flr_bldg_error").text(common_error);
            flag = 1;
        }
        else {
            $("#flr_bldg_error").text('');
        }
        if (floorno == "") {
            $("#offc_floor_error").text(common_error);
            $("input[name='offc_floorno']").focus();
            flag = 1;
        }
        else {
            $("#offc_floor_error").text('');
        }
        if(flag == 0)
        {
            if (flr_id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_floor', field : 'id', condition : 'branch_id="'+branchId+'" AND buildng_id="'+buildng+'" AND floor_no="'+floorno.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_floor_error").text("This Floor Already Exist.");
                            $("#offc_floor_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_FloorForm").attr("action",base_url+"home/offc_floor_submit");
                            $("#offc_FloorForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_floor', field : 'id', condition : 'branch_id="'+branchId+'" AND buildng_id="'+buildng+'" AND floor_no="'+floorno.trim()+'" AND id != '+flr_id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_floor_error").text("This Floor Already Exist.");
                            $("#offc_floor_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_FloorForm").attr("action",base_url+"home/offc_floor_submit");
                            $("#offc_FloorForm").submit();
                        }
                    }
                });
            }
        }
    });

    /***************************************
    * Office Settings Room Submit          *
    ***************************************/
    $("#add_room_no").click(function() { 
        var flag       = 0;
        var branchId   = $("#offc_room_branch").val();
        var buildngId  = $("#offc_room_build").val();
        var floorId    = $("#offc_room_floor").val();
        var roomno     = $("input[name='offc_roomno']").val();
        var room_na    = $("input[name='offc_room']").val();
        var phno       = $("input[name='offc_phno']").val();
        var descpn     = $("#room_desc").val();
        var room_id    = $("input[name='room_id']").val();
        
        var common_error = $("input[name ='name_error_msg']").val();

        if (branchId == "") {
            $("#room_branch_error").text(common_error);
            flag = 1;
        }
        else {
            $("#room_branch_error").text('');
        }
        if (buildngId == "") {
            $("#room_bldg_error").text(common_error);
            flag = 1;
        }
        else {
            $("#room_bldg_error").text('');
        }
        if (floorId == "") {
            $("#room_flr_error").text(common_error);
            flag = 1;
        }
        else {
            $("#room_flr_error").text('');
        }
        if (roomno == "") {
            $("#offc_room_error").text(common_error);
            $("input[name='offc_roomno']").focus();
            flag = 1;
        }
        else {
            $("#offc_room_error").text('');
        }
        if(flag == 0)
        {
            if (room_id == '') {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_room_no', field : 'id', condition : 'branch_id="'+branchId+'" AND building_id="'+buildngId+'" AND floor_id="'+floorId+'" AND room_no="'+roomno.trim()+'"' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_room_error").text("Room Entry Already Exist.");
                            $("#offc_room_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_RoomForm").attr("action",base_url+"home/offc_roomno_submit");
                            $("#offc_RoomForm").submit();
                        }
                    }
                });
            }
            else {
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    data: { table : 'qzolvehrm_room_no', field : 'id', condition : 'branch_id="'+branchId+'" AND building_id="'+buildngId+'" AND floor_id="'+floorId+'" AND room_no="'+roomno.trim()+'" AND id != '+room_id+'' },
                    url: base_url+'home/check_data_exist',
                    success: function(data) {
                        if (data > 0) {
                            $("#offc_room_error").text("Room Entry Already Exist.");
                            $("#offc_room_error").focus();
                            return false;
                        }
                        else {
                            $("#offc_RoomForm").attr("action",base_url+"home/offc_roomno_submit");
                            $("#offc_RoomForm").submit();
                        }
                    }
                });
            }
        }
    });

/***************************************
* Detail : Onchange VISA Entry dates   *
* DAte   : 15-04-2021                  *
***************************************/
$('#visadeparture_date').on('changeDate change', function(e){
    calculate_days();
});

$('#visaarrival_date').on('changeDate change', function(e){
    calculate_days();
});

/***************************************
* Detail : Calculate Day difference b/w
        Departure and Arrival Date     *
* Date   : 13-04-2021                  *
***************************************/
function calculate_days()
{
  var departure_dt = $("#visadeparture_date").val();
  var arrival_dt   = $("#visaarrival_date").val();

  $("#visa_noofdays").val('');

  if (departure_dt != '' && arrival_dt != '') {
    var depart_dt = moment(departure_dt, "DD-MM-YYYY");
    var arrive_dt = moment(arrival_dt, "DD-MM-YYYY");

    var no_of_days= arrive_dt.diff(depart_dt, 'days');
    $("#visa_noofdays").val(no_of_days);
  }
}

    /***************************************************
    * Detail : Exit and Re-Entry VISA Notification Edit*
    * Date   : 16-04-2021                              *
    ***************************************************/
    $("#visainfo_update").click(function(e){
      
        e.preventDefault();

        var visano      = $("#visa_no").val();
        var departdt    = $("#visadeparture_date").val();
        var arrivaldt   = $("#visaarrival_date").val();
        var m_departdt  = moment(departdt, 'DD-MM-YYYY').format('YYYY-MM-DD');
        var m_arrivaldt = moment(arrivaldt, 'DD-MM-YYYY').format('YYYY-MM-DD');
      
        if (visano=="") {
            $('#visa_no').addClass('is-invalid');
            $('#visa_no').focus();
            return false;
        } 
        else{
            $('#visa_no').removeClass('is-invalid');
        } 

        if (departdt=="") {
            $('#visadeparture_date').addClass('is-invalid');
            $('#visadeparture_date').focus();
            return false;
        } 
        else{
            $('#visadeparture_date').removeClass('is-invalid');
        }

        if (arrivaldt=="") {
            $('#visaarrival_date').addClass('is-invalid');
            $('#visaarrival_date').focus();
            return false;
        } 
        else{
            $('#visaarrival_date').removeClass('is-invalid');
        } 

        if (moment(m_arrivaldt).isAfter(m_departdt) == false) {
            $('#visadeparture_date').addClass('is-invalid');
            $('#visaarrival_date').addClass('is-invalid');
            toastr.error("Departure Date must be Less than Arrival Date");
            return false;
        }
        else{
            $('#visadeparture_date').removeClass('is-invalid');
            $('#visaarrival_date').removeClass('is-invalid');
        }
         
        $('#form_visaedit').attr("action",base_url+"home/visanotif_update");
        $('#form_visaedit').submit();
    
    });

    //status
     $("#employeestatusubmit_btn").click(function() { 
        var status_name   = $("#employee_status_name").val();
        var description   = $("#status_description").val();
        
        var error     = $("input[name ='name_error_msg']").val();
        var flag      = 0;

        if (status_name == '') {
            $("#status_name").text(error);
            flag = 1;
        }
        else {
            $("#status_name").text('');
        }
        
        if (flag == 0) {
            $("#employeestatus_Form").attr("action",base_url+"home/employeestatus_submit");
            $("#employeestatus_Form").submit();
        }
    });
     $("#edit_employeestatusubmit_btn").click(function() {
        var id            = $("#eid").val();
        var status_name   = $("#e_employee_status_name").val();
        var description   = $("#e_status_description").val();
        
        var error     = $("input[name ='name_error_msg']").val();
        var flag      = 0;

        if (status_name == '') {
            $("#e_status_name").text(error);
            flag = 1;
        }
        else {
            $("#e_status_name").text('');
        }
        
        if (flag == 0) {
            $("#edit_employeestatus_Form").attr("action",base_url+"home/edit_employeestatus_submit");
            $("#edit_employeestatus_Form").submit();
        }
    });

    function getdepartmnt1(){
        $('#department1').find('option').not(':first').remove();
        $('#emp1').find('option').not(':first').remove();
        
        var branchid = $("select[name='branch']").val();
         $.ajax({
        dataType: 'text',
        type: 'post',
        url: base_url+'home/getbranchforajax?id='+branchid,
        cache: false,
          success: function (data) {
            $('#department1').find('option').not(':first').remove();
            $.each(JSON.parse(data), function(key, value){   
              $('#department1').append($('<option>').text(value.dept_name).attr('value', value.id));
                });
          }
        });
    }

    /************ Onclick Cancel Button ************/
    function goPrev()
    {
        window.history.back();
    }

    /***********************************************
    * View Employee Profile                        *
    ***********************************************/
    function view_profile(empId)
    {
        window.location.href = base_url+'employee_profile/view_employeeprofile?id='+empId;
    }

    function custom_formatDate(str) {
        var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
        return [day, mnth, date.getFullYear()].join("-");
    }

    // For date format Y-m-d
    function custom_formatDate2(str) {
        var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
        return [date.getFullYear(), mnth, day].join("-");
    }

    /*********************************
    *    DataTable Export Options    *
    *********************************/

    /***********Employee List *******/
    $("#employlist_print").on("click", function() {
        datatable_employee.button( '.buttons-print' ).trigger();
    });

    $("#employlist_copy").on("click", function() {
        datatable_employee.button( '.buttons-copy' ).trigger();
    });

    $("#employlist_excel").on("click", function() {
        datatable_employee.button( '.buttons-excel' ).trigger();
    });
    
    $("#employlist_csv").on("click", function() {
        datatable_employee.button( '.buttons-csv' ).trigger();
    });

    $("#employlist_pdf").on("click", function() {
        datatable_employee.button( '.buttons-pdf' ).trigger();
    });

    /***********Family Info List *******/
    $("#familylist_print").on("click", function() {
        datatable_family.button( '.buttons-print' ).trigger();
    });

    $("#familylist_copy").on("click", function() {
        datatable_family.button( '.buttons-copy' ).trigger();
    });

    $("#familylist_excel").on("click", function() {
        datatable_family.button( '.buttons-excel' ).trigger();
    });
    
    $("#familylist_csv").on("click", function() {
        datatable_family.button( '.buttons-csv' ).trigger();
    });

    $("#familylist_pdf").on("click", function() {
        datatable_family.button( '.buttons-pdf' ).trigger();
    });

    /***********Relational Info List *******/
    $("#relationallist_print").on("click", function() {
        datatable_relational.button( '.buttons-print' ).trigger();
    });

    $("#relationallist_copy").on("click", function() {
        datatable_relational.button( '.buttons-copy' ).trigger();
    });

    $("#relationallist_excel").on("click", function() {
        datatable_relational.button( '.buttons-excel' ).trigger();
    });
    
    $("#relationallist_csv").on("click", function() {
        datatable_relational.button( '.buttons-csv' ).trigger();
    });

    $("#relationallist_pdf").on("click", function() {
        datatable_relational.button( '.buttons-pdf' ).trigger();
    });

    /***********Ethnic Info List *******/
    $("#ethniclist_print").on("click", function() {
        datatable_ethnicinfo.button( '.buttons-print' ).trigger();
    });

    $("#ethniclist_copy").on("click", function() {
        datatable_ethnicinfo.button( '.buttons-copy' ).trigger();
    });

    $("#ethniclist_excel").on("click", function() {
        datatable_ethnicinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#ethniclist_csv").on("click", function() {
        datatable_ethnicinfo.button( '.buttons-csv' ).trigger();
    });

    $("#ethniclist_pdf").on("click", function() {
        datatable_ethnicinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Social Info List *******/
    $("#sociallist_print").on("click", function() {
        datatable_socialinfo.button( '.buttons-print' ).trigger();
    });

    $("#sociallist_copy").on("click", function() {
        datatable_socialinfo.button( '.buttons-copy' ).trigger();
    });

    $("#sociallist_excel").on("click", function() {
        datatable_socialinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#sociallist_csv").on("click", function() {
        datatable_socialinfo.button( '.buttons-csv' ).trigger();
    });

    $("#sociallist_pdf").on("click", function() {
        datatable_socialinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Key Skill Info List *******/
    $("#keyskilllist_print").on("click", function() {
        datatable_keyskill.button( '.buttons-print' ).trigger();
    });

    $("#keyskilllist_copy").on("click", function() {
        datatable_keyskill.button( '.buttons-copy' ).trigger();
    });

    $("#keyskilllist_excel").on("click", function() {
        datatable_keyskill.button( '.buttons-excel' ).trigger();
    });
    
    $("#keyskilllist_csv").on("click", function() {
        datatable_keyskill.button( '.buttons-csv' ).trigger();
    });

    $("#keyskilllist_pdf").on("click", function() {
        datatable_keyskill.button( '.buttons-pdf' ).trigger();
    });

    /***********Language Proficiency Info List *******/
    $("#langproficiencylist_print").on("click", function() {
        datatable_language.button( '.buttons-print' ).trigger();
    });

    $("#langproficiencylist_copy").on("click", function() {
        datatable_language.button( '.buttons-copy' ).trigger();
    });

    $("#langproficiencylist_excel").on("click", function() {
        datatable_language.button( '.buttons-excel' ).trigger();
    });
    
    $("#langproficiencylist_csv").on("click", function() {
        datatable_language.button( '.buttons-csv' ).trigger();
    });

    $("#langproficiencylist_pdf").on("click", function() {
        datatable_language.button( '.buttons-pdf' ).trigger();
    });

    /***********Educational Info List *******/
    $("#educationallist_print").on("click", function() {
        datatable_educational.button( '.buttons-print' ).trigger();
    });

    $("#educationallist_copy").on("click", function() {
        datatable_educational.button( '.buttons-copy' ).trigger();
    });

    $("#educationallist_excel").on("click", function() {
        datatable_educational.button( '.buttons-excel' ).trigger();
    });
    
    $("#educationallist_csv").on("click", function() {
        datatable_educational.button( '.buttons-csv' ).trigger();
    });

    $("#educationallist_pdf").on("click", function() {
        datatable_educational.button( '.buttons-pdf' ).trigger();
    });

    /***********Certifications List *******/
    $("#certificationlist_print").on("click", function() {
        datatable_certifications.button( '.buttons-print' ).trigger();
    });

    $("#certificationlist_copy").on("click", function() {
        datatable_certifications.button( '.buttons-copy' ).trigger();
    });

    $("#certificationlist_excel").on("click", function() {
        datatable_certifications.button( '.buttons-excel' ).trigger();
    });
    
    $("#certificationlist_csv").on("click", function() {
        datatable_certifications.button( '.buttons-csv' ).trigger();
    });

    $("#certificationlist_pdf").on("click", function() {
        datatable_certifications.button( '.buttons-pdf' ).trigger();
    });

    /***********Achievements List *******/
    $("#achievemntlist_print").on("click", function() {
        datatable_achievements.button( '.buttons-print' ).trigger();
    });

    $("#achievemntlist_copy").on("click", function() {
        datatable_achievements.button( '.buttons-copy' ).trigger();
    });

    $("#achievemntlist_excel").on("click", function() {
        datatable_achievements.button( '.buttons-excel' ).trigger();
    });
    
    $("#achievemntlist_csv").on("click", function() {
        datatable_achievements.button( '.buttons-csv' ).trigger();
    });

    $("#achievemntlist_pdf").on("click", function() {
        datatable_achievements.button( '.buttons-pdf' ).trigger();
    });

    /***********ID Details List *******/
    $("#iddetaillist_print").on("click", function() {
        datatable_iddetails.button( '.buttons-print' ).trigger();
    });

    $("#iddetaillist_copy").on("click", function() {
        datatable_iddetails.button( '.buttons-copy' ).trigger();
    });

    $("#iddetaillist_excel").on("click", function() {
        datatable_iddetails.button( '.buttons-excel' ).trigger();
    });
    
    $("#iddetaillist_csv").on("click", function() {
        datatable_iddetails.button( '.buttons-csv' ).trigger();
    });

    $("#iddetaillist_pdf").on("click", function() {
        datatable_iddetails.button( '.buttons-pdf' ).trigger();
    });

    /***********Driving License Details List *******/
    $("#drivingliclist_print").on("click", function() {
        datatable_drivinglicense.button( '.buttons-print' ).trigger();
    });

    $("#drivingliclist_copy").on("click", function() {
        datatable_drivinglicense.button( '.buttons-copy' ).trigger();
    });

    $("#drivingliclist_excel").on("click", function() {
        datatable_drivinglicense.button( '.buttons-excel' ).trigger();
    });
    
    $("#drivingliclist_csv").on("click", function() {
        datatable_drivinglicense.button( '.buttons-csv' ).trigger();
    });

    $("#drivingliclist_pdf").on("click", function() {
        datatable_drivinglicense.button( '.buttons-pdf' ).trigger();
    });

    /***********Passport Details List *******/
    $("#passportlist_print").on("click", function() {
        datatable_passport.button( '.buttons-print' ).trigger();
    });

    $("#passportlist_copy").on("click", function() {
        datatable_passport.button( '.buttons-copy' ).trigger();
    });

    $("#passportlist_excel").on("click", function() {
        datatable_passport.button( '.buttons-excel' ).trigger();
    });
    
    $("#passportlist_csv").on("click", function() {
        datatable_passport.button( '.buttons-csv' ).trigger();
    });

    $("#passportlist_pdf").on("click", function() {
        datatable_passport.button( '.buttons-pdf' ).trigger();
    });

    /***********Bank Info List *******/
    $("#banklist_print").on("click", function() {
        datatable_bankinfo.button( '.buttons-print' ).trigger();
    });

    $("#banklist_copy").on("click", function() {
        datatable_bankinfo.button( '.buttons-copy' ).trigger();
    });

    $("#banklist_excel").on("click", function() {
        datatable_bankinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#banklist_csv").on("click", function() {
        datatable_bankinfo.button( '.buttons-csv' ).trigger();
    });

    $("#banklist_pdf").on("click", function() {
        datatable_bankinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Office Info List *******/
    $("#officeinfolist_print").on("click", function() {
        datatable_officeinfo.button( '.buttons-print' ).trigger();
    });

    $("#officeinfolist_copy").on("click", function() {
        datatable_officeinfo.button( '.buttons-copy' ).trigger();
    });

    $("#officeinfolist_excel").on("click", function() {
        datatable_officeinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#officeinfolist_csv").on("click", function() {
        datatable_officeinfo.button( '.buttons-csv' ).trigger();
    });

    $("#officeinfolist_pdf").on("click", function() {
        datatable_officeinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Badge Info List *******/
    $("#badgelist_print").on("click", function() {
        datatable_badge.button( '.buttons-print' ).trigger();
    });

    $("#badgelist_copy").on("click", function() {
        datatable_badge.button( '.buttons-copy' ).trigger();
    });

    $("#badgelist_excel").on("click", function() {
        datatable_badge.button( '.buttons-excel' ).trigger();
    });
    
    $("#badgelist_csv").on("click", function() {
        datatable_badge.button( '.buttons-csv' ).trigger();
    });

    $("#badgelist_pdf").on("click", function() {
        datatable_badge.button( '.buttons-pdf' ).trigger();
    });

    /***********Insurance Info List *******/
    $("#insuranceinfolist_print").on("click", function() {
        datatable_insuranceinfo.button( '.buttons-print' ).trigger();
    });

    $("#insuranceinfolist_copy").on("click", function() {
        datatable_insuranceinfo.button( '.buttons-copy' ).trigger();
    });

    $("#insuranceinfolist_excel").on("click", function() {
        datatable_insuranceinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#insuranceinfolist_csv").on("click", function() {
        datatable_insuranceinfo.button( '.buttons-csv' ).trigger();
    });

    $("#insuranceinfolist_pdf").on("click", function() {
        datatable_insuranceinfo.button( '.buttons-pdf' ).trigger();
    });

    /*********** Group Insurance List *******/
    $("#gpinsurancelist_print").on("click", function() {
        datatable_gpinsrc.button( '.buttons-print' ).trigger();
    });

    $("#gpinsurancelist_copy").on("click", function() {
        datatable_gpinsrc.button( '.buttons-copy' ).trigger();
    });

    $("#gpinsurancelist_excel").on("click", function() {
        datatable_gpinsrc.button( '.buttons-excel' ).trigger();
    });
    
    $("#gpinsurancelist_csv").on("click", function() {
        datatable_gpinsrc.button( '.buttons-csv' ).trigger();
    });

    $("#gpinsurancelist_pdf").on("click", function() {
        datatable_gpinsrc.button( '.buttons-pdf' ).trigger();
    });

    /***********Work Lic Info List *******/
    $("#workliclist_print").on("click", function() {
        datatable_worklicense.button( '.buttons-print' ).trigger();
    });

    $("#workliclist_copy").on("click", function() {
        datatable_worklicense.button( '.buttons-copy' ).trigger();
    });

    $("#workliclist_excel").on("click", function() {
        datatable_worklicense.button( '.buttons-excel' ).trigger();
    });
    
    $("#workliclist_csv").on("click", function() {
        datatable_worklicense.button( '.buttons-csv' ).trigger();
    });

    $("#workliclist_pdf").on("click", function() {
        datatable_worklicense.button( '.buttons-pdf' ).trigger();
    });

    /***********Hiring Info List *******/
    $("#hiringlist_print").on("click", function() {
        datatable_hiring.button( '.buttons-print' ).trigger();
    });

    $("#hiringlist_copy").on("click", function() {
        datatable_hiring.button( '.buttons-copy' ).trigger();
    });

    $("#hiringlist_excel").on("click", function() {
        datatable_hiring.button( '.buttons-excel' ).trigger();
    });
    
    $("#hiringlist_csv").on("click", function() {
        datatable_hiring.button( '.buttons-csv' ).trigger();
    });

    $("#hiringlist_pdf").on("click", function() {
        datatable_hiring.button( '.buttons-pdf' ).trigger();
    });

    /***********Labour Info List *******/
    $("#labourlist_print").on("click", function() {
        datatable_laborinfo.button( '.buttons-print' ).trigger();
    });

    $("#labourlist_copy").on("click", function() {
        datatable_laborinfo.button( '.buttons-copy' ).trigger();
    });

    $("#labourlist_excel").on("click", function() {
        datatable_laborinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#labourlist_csv").on("click", function() {
        datatable_laborinfo.button( '.buttons-csv' ).trigger();
    });

    $("#labourlist_pdf").on("click", function() {
        datatable_laborinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Referral Info List *******/
    $("#referrallist_print").on("click", function() {
        datatable_referal.button( '.buttons-print' ).trigger();
    });

    $("#referrallist_copy").on("click", function() {
        datatable_referal.button( '.buttons-copy' ).trigger();
    });

    $("#referrallist_excel").on("click", function() {
        datatable_referal.button( '.buttons-excel' ).trigger();
    });
    
    $("#referrallist_csv").on("click", function() {
        datatable_referal.button( '.buttons-csv' ).trigger();
    });

    $("#referrallist_pdf").on("click", function() {
        datatable_referal.button( '.buttons-pdf' ).trigger();
    });

    /***********Previous Details Employee List *******/
    $("#previousdet_employlist_print").on("click", function() {
        datatable_employee_pre.button( '.buttons-print' ).trigger();
    });

    $("#previousdet_employlist_copy").on("click", function() {
        datatable_employee_pre.button( '.buttons-copy' ).trigger();
    });

    $("#previousdet_employlist_excel").on("click", function() {
        datatable_employee_pre.button( '.buttons-excel' ).trigger();
    });
    
    $("#previousdet_employlist_csv").on("click", function() {
        datatable_employee_pre.button( '.buttons-csv' ).trigger();
    });

    $("#previousdet_employlist_pdf").on("click", function() {
        datatable_employee_pre.button( '.buttons-pdf' ).trigger();
    });

    /***********Previous Details Employee Company List *******/
    $("#previousdet_companylist_print").on("click", function() {
        datatable_previousdetail_company.button( '.buttons-print' ).trigger();
    });

    $("#previousdet_companylist_copy").on("click", function() {
        datatable_previousdetail_company.button( '.buttons-copy' ).trigger();
    });

    $("#previousdet_companylist_excel").on("click", function() {
        datatable_previousdetail_company.button( '.buttons-excel' ).trigger();
    });
    
    $("#previousdet_companylist_csv").on("click", function() {
        datatable_previousdetail_company.button( '.buttons-csv' ).trigger();
    });

    $("#previousdet_companylist_pdf").on("click", function() {
        datatable_previousdetail_company.button( '.buttons-pdf' ).trigger();
    });

    /***********Employment Milestone List *******/
    $("#employmentmilestonelist_print").on("click", function() {
        datatable_empmilestone.button( '.buttons-print' ).trigger();
    });

    $("#employmentmilestonelist_copy").on("click", function() {
        datatable_empmilestone.button( '.buttons-copy' ).trigger();
    });

    $("#employmentmilestonelist_excel").on("click", function() {
        datatable_empmilestone.button( '.buttons-excel' ).trigger();
    });
    
    $("#employmentmilestonelist_csv").on("click", function() {
        datatable_empmilestone.button( '.buttons-csv' ).trigger();
    });

    $("#employmentmilestonelist_pdf").on("click", function() {
        datatable_empmilestone.button( '.buttons-pdf' ).trigger();
    });

    /***********Desired Job Position List *******/
    $("#jobpositionlist_print").on("click", function() {
        datatable_jobposition.button( '.buttons-print' ).trigger();
    });

    $("#jobpositionlist_copy").on("click", function() {
        datatable_jobposition.button( '.buttons-copy' ).trigger();
    });

    $("#jobpositionlist_excel").on("click", function() {
        datatable_jobposition.button( '.buttons-excel' ).trigger();
    });
    
    $("#jobpositionlist_csv").on("click", function() {
        datatable_jobposition.button( '.buttons-csv' ).trigger();
    });

    $("#jobpositionlist_pdf").on("click", function() {
        datatable_jobposition.button( '.buttons-pdf' ).trigger();
    });

    /*********** Expiry Notifications *********/

    /***********Passport Notifications *******/
    $("#passportnotiflist_print").on("click", function() {
        datatable_passport_notification.button( '.buttons-print' ).trigger();
    });

    $("#passportnotiflist_copy").on("click", function() {
        datatable_passport_notification.button( '.buttons-copy' ).trigger();
    });

    $("#passportnotiflist_excel").on("click", function() {
        datatable_passport_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#passportnotiflist_csv").on("click", function() {
        datatable_passport_notification.button( '.buttons-csv' ).trigger();
    });

    $("#passportnotiflist_pdf").on("click", function() {
        datatable_passport_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Badge Notifications *******/
    $("#badgenotiflist_print").on("click", function() {
        datatable_badge_notification.button( '.buttons-print' ).trigger();
    });

    $("#badgenotiflist_copy").on("click", function() {
        datatable_badge_notification.button( '.buttons-copy' ).trigger();
    });

    $("#badgenotiflist_excel").on("click", function() {
        datatable_badge_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#badgenotiflist_csv").on("click", function() {
        datatable_badge_notification.button( '.buttons-csv' ).trigger();
    });

    $("#badgenotiflist_pdf").on("click", function() {
        datatable_badge_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Insurance Notifications *******/
    $("#insurancenotiflist_print").on("click", function() {
        datatable_insurance_notification.button( '.buttons-print' ).trigger();
    });

    $("#insurancenotiflist_copy").on("click", function() {
        datatable_insurance_notification.button( '.buttons-copy' ).trigger();
    });

    $("#insurancenotiflist_excel").on("click", function() {
        datatable_insurance_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#insurancenotiflist_csv").on("click", function() {
        datatable_insurance_notification.button( '.buttons-csv' ).trigger();
    });

    $("#insurancenotiflist_pdf").on("click", function() {
        datatable_insurance_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Driving License Notifications *******/
    $("#drivinglicnotiflist_print").on("click", function() {
        datatable_driving_notification.button( '.buttons-print' ).trigger();
    });

    $("#drivinglicnotiflist_copy").on("click", function() {
        datatable_driving_notification.button( '.buttons-copy' ).trigger();
    });

    $("#drivinglicnotiflist_excel").on("click", function() {
        datatable_driving_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#drivinglicnotiflist_csv").on("click", function() {
        datatable_driving_notification.button( '.buttons-csv' ).trigger();
    });

    $("#drivinglicnotiflist_pdf").on("click", function() {
        datatable_driving_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Work License Notifications *******/
    $("#worklicnotiflist_print").on("click", function() {
        datatable_worklicense_notification.button( '.buttons-print' ).trigger();
    });

    $("#worklicnotiflist_copy").on("click", function() {
        datatable_worklicense_notification.button( '.buttons-copy' ).trigger();
    });

    $("#worklicnotiflist_excel").on("click", function() {
        datatable_worklicense_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#worklicnotiflist_csv").on("click", function() {
        datatable_worklicense_notification.button( '.buttons-csv' ).trigger();
    });

    $("#worklicnotiflist_pdf").on("click", function() {
        datatable_worklicense_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********ID Notifications *******/
    $("#idnotiflist_print").on("click", function() {
        datatable_id_notification.button( '.buttons-print' ).trigger();
    });

    $("#idnotiflist_copy").on("click", function() {
        datatable_id_notification.button( '.buttons-copy' ).trigger();
    });

    $("#idnotiflist_excel").on("click", function() {
        datatable_id_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#idnotiflist_csv").on("click", function() {
        datatable_id_notification.button( '.buttons-csv' ).trigger();
    });

    $("#idnotiflist_pdf").on("click", function() {
        datatable_id_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Iqama/Bitaqa Notifications *******/
    $("#iqamanotiflist_print").on("click", function() {
        datatable_iqama_notification.button( '.buttons-print' ).trigger();
    });

    $("#iqamanotiflist_copy").on("click", function() {
        datatable_iqama_notification.button( '.buttons-copy' ).trigger();
    });

    $("#iqamanotiflist_excel").on("click", function() {
        datatable_iqama_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#iqamanotiflist_csv").on("click", function() {
        datatable_iqama_notification.button( '.buttons-csv' ).trigger();
    });

    $("#iqamanotiflist_pdf").on("click", function() {
        datatable_iqama_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Event Notifications *******/
    $("#eventnotiflist_print").on("click", function() {
        datatable_event_notification.button( '.buttons-print' ).trigger();
    });

    $("#eventnotiflist_copy").on("click", function() {
        datatable_event_notification.button( '.buttons-copy' ).trigger();
    });

    $("#eventnotiflist_excel").on("click", function() {
        datatable_event_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#eventnotiflist_csv").on("click", function() {
        datatable_event_notification.button( '.buttons-csv' ).trigger();
    });

    $("#eventnotiflist_pdf").on("click", function() {
        datatable_event_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Work Info List *******/
    $("#workinfolist_print").on("click", function() {
        datatable_workinfo.button( '.buttons-print' ).trigger();
    });

    $("#workinfolist_copy").on("click", function() {
        datatable_workinfo.button( '.buttons-copy' ).trigger();
    });

    $("#workinfolist_excel").on("click", function() {
        datatable_workinfo.button( '.buttons-excel' ).trigger();
    });
    
    $("#workinfolist_csv").on("click", function() {
        datatable_workinfo.button( '.buttons-csv' ).trigger();
    });

    $("#workinfolist_pdf").on("click", function() {
        datatable_workinfo.button( '.buttons-pdf' ).trigger();
    });

    /***********Iqama/Bitaqa Details List *******/
    $("#iqamadetaillist_print").on("click", function() {
        datatable_iqama.button( '.buttons-print' ).trigger();
    });

    $("#iqamadetaillist_copy").on("click", function() {
        datatable_iqama.button( '.buttons-copy' ).trigger();
    });

    $("#iqamadetaillist_excel").on("click", function() {
        datatable_iqama.button( '.buttons-excel' ).trigger();
    });
    
    $("#iqamadetaillist_csv").on("click", function() {
        datatable_iqama.button( '.buttons-csv' ).trigger();
    });

    $("#iqamadetaillist_pdf").on("click", function() {
        datatable_iqama.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Benefit Activation List *******/
    $("#employbenefitactv_print").on("click", function() {
        datatable_benefitactivation.button( '.buttons-print' ).trigger();
    });

    $("#employbenefitactv_copy").on("click", function() {
        datatable_benefitactivation.button( '.buttons-copy' ).trigger();
    });

    $("#employbenefitactv_excel").on("click", function() {
        datatable_benefitactivation.button( '.buttons-excel' ).trigger();
    });
    
    $("#employbenefitactv_csv").on("click", function() {
        datatable_benefitactivation.button( '.buttons-csv' ).trigger();
    });

    $("#employbenefitactv_pdf").on("click", function() {
        datatable_benefitactivation.button( '.buttons-pdf' ).trigger();
    });

    /***********Status Assign List *******/
    $("#statusassign_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#statusassign_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#statusassign_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#statusassign_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#statusassign_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Sponsor Info List *******/
    $("#employsponsor_print").on("click", function() {
        datatable_sponsors.button( '.buttons-print' ).trigger();
    });

    $("#employsponsor_copy").on("click", function() {
        datatable_sponsors.button( '.buttons-copy' ).trigger();
    });

    $("#employsponsor_excel").on("click", function() {
        datatable_sponsors.button( '.buttons-excel' ).trigger();
    });
    
    $("#employsponsor_csv").on("click", function() {
        datatable_sponsors.button( '.buttons-csv' ).trigger();
    });

    $("#employsponsor_pdf").on("click", function() {
        datatable_sponsors.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee VISA Profession Info List *******/
    $("#employvisa_print").on("click", function() {
        datatable_visaprofession.button( '.buttons-print' ).trigger();
    });

    $("#employvisa_copy").on("click", function() {
        datatable_visaprofession.button( '.buttons-copy' ).trigger();
    });

    $("#employvisa_excel").on("click", function() {
        datatable_visaprofession.button( '.buttons-excel' ).trigger();
    });
    
    $("#employvisa_csv").on("click", function() {
        datatable_visaprofession.button( '.buttons-csv' ).trigger();
    });

    $("#employvisa_pdf").on("click", function() {
        datatable_visaprofession.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Hospital Info List *******/
    $("#employhospital_print").on("click", function() {
        datatable_hospitals.button( '.buttons-print' ).trigger();
    });

    $("#employhospital_copy").on("click", function() {
        datatable_hospitals.button( '.buttons-copy' ).trigger();
    });

    $("#employhospital_excel").on("click", function() {
        datatable_hospitals.button( '.buttons-excel' ).trigger();
    });
    
    $("#employhospital_csv").on("click", function() {
        datatable_hospitals.button( '.buttons-csv' ).trigger();
    });

    $("#employhospital_pdf").on("click", function() {
        datatable_hospitals.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Insurance Provider Details *******/
    $("#employinsrcprovider_print").on("click", function() {
        datatable_insuranceproviders.button( '.buttons-print' ).trigger();
    });

    $("#employinsrcprovider_copy").on("click", function() {
        datatable_insuranceproviders.button( '.buttons-copy' ).trigger();
    });

    $("#employinsrcprovider_excel").on("click", function() {
        datatable_insuranceproviders.button( '.buttons-excel' ).trigger();
    });
    
    $("#employinsrcprovider_csv").on("click", function() {
        datatable_insuranceproviders.button( '.buttons-csv' ).trigger();
    });

    $("#employinsrcprovider_pdf").on("click", function() {
        datatable_insuranceproviders.button( '.buttons-pdf' ).trigger();
    });

    /*********** Dependant Employee List *******/
    $("#depemploylist_print").on("click", function() {
        datatable_dependent_employee.button( '.buttons-print' ).trigger();
    });

    $("#depemploylist_copy").on("click", function() {
        datatable_dependent_employee.button( '.buttons-copy' ).trigger();
    });

    $("#depemploylist_excel").on("click", function() {
        datatable_dependent_employee.button( '.buttons-excel' ).trigger();
    });
    
    $("#depemploylist_csv").on("click", function() {
        datatable_dependent_employee.button( '.buttons-csv' ).trigger();
    });

    $("#depemploylist_pdf").on("click", function() {
        datatable_dependent_employee.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Dependants List *******/
    $("#employdependants_print").on("click", function() {
        datatable_employee_dependents.button( '.buttons-print' ).trigger();
    });

    $("#employdependants_copy").on("click", function() {
        datatable_employee_dependents.button( '.buttons-copy' ).trigger();
    });

    $("#employdependants_excel").on("click", function() {
        datatable_employee_dependents.button( '.buttons-excel' ).trigger();
    });
    
    $("#employdependants_csv").on("click", function() {
        datatable_employee_dependents.button( '.buttons-csv' ).trigger();
    });

    $("#employdependants_pdf").on("click", function() {
        datatable_employee_dependents.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Event Info List *******/
    $("#eventemploylist_print").on("click", function() {
        datatable_employee_event.button( '.buttons-print' ).trigger();
    });

    $("#eventemploylist_copy").on("click", function() {
        datatable_employee_event.button( '.buttons-copy' ).trigger();
    });

    $("#eventemploylist_excel").on("click", function() {
        datatable_employee_event.button( '.buttons-excel' ).trigger();
    });
    
    $("#eventemploylist_csv").on("click", function() {
        datatable_employee_event.button( '.buttons-csv' ).trigger();
    });

    $("#eventemploylist_pdf").on("click", function() {
        datatable_employee_event.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Event Info List *******/
    $("#employevents_print").on("click", function() {
        datatable_employevents_event.button( '.buttons-print' ).trigger();
    });

    $("#employevents_copy").on("click", function() {
        datatable_employevents_event.button( '.buttons-copy' ).trigger();
    });

    $("#employevents_excel").on("click", function() {
        datatable_employevents_event.button( '.buttons-excel' ).trigger();
    });
    
    $("#employevents_csv").on("click", function() {
        datatable_employevents_event.button( '.buttons-csv' ).trigger();
    });

    $("#employevents_pdf").on("click", function() {
        datatable_employevents_event.button( '.buttons-pdf' ).trigger();
    });

    /***********Branch List *******/
    $("#branch_print").on("click", function() {
        datatable_branch.button( '.buttons-print' ).trigger();
    });

    $("#branch_copy").on("click", function() {
        datatable_branch.button( '.buttons-copy' ).trigger();
    });

    $("#branch_excel").on("click", function() {
        datatable_branch.button( '.buttons-excel' ).trigger();
    });
    
    $("#branch_csv").on("click", function() {
        datatable_branch.button( '.buttons-csv' ).trigger();
    });

    $("#branch_pdf").on("click", function() {
        datatable_branch.button( '.buttons-pdf' ).trigger();
    });

    /***********Department List *******/
    $("#department_print").on("click", function() {
        datatable_dept.button( '.buttons-print' ).trigger();
    });

    $("#department_copy").on("click", function() {
        datatable_dept.button( '.buttons-copy' ).trigger();
    });

    $("#department_excel").on("click", function() {
        datatable_dept.button( '.buttons-excel' ).trigger();
    });
    
    $("#department_csv").on("click", function() {
        datatable_dept.button( '.buttons-csv' ).trigger();
    });

    $("#department_pdf").on("click", function() {
        datatable_dept.button( '.buttons-pdf' ).trigger();
    });

    /***********Designation List *******/
    $("#designation_print").on("click", function() {
        datatable_designation.button( '.buttons-print' ).trigger();
    });

    $("#designation_copy").on("click", function() {
        datatable_designation.button( '.buttons-copy' ).trigger();
    });

    $("#designation_excel").on("click", function() {
        datatable_designation.button( '.buttons-excel' ).trigger();
    });
    
    $("#designation_csv").on("click", function() {
        datatable_designation.button( '.buttons-csv' ).trigger();
    });

    $("#designation_pdf").on("click", function() {
        datatable_designation.button( '.buttons-pdf' ).trigger();
    });

    /***********Building List *******/
    $("#building_print").on("click", function() {
        datatable_building.button( '.buttons-print' ).trigger();
    });

    $("#building_copy").on("click", function() {
        datatable_building.button( '.buttons-copy' ).trigger();
    });

    $("#building_excel").on("click", function() {
        datatable_building.button( '.buttons-excel' ).trigger();
    });
    
    $("#building_csv").on("click", function() {
        datatable_building.button( '.buttons-csv' ).trigger();
    });

    $("#building_pdf").on("click", function() {
        datatable_building.button( '.buttons-pdf' ).trigger();
    });

    /***********Floor List *******/
    $("#floor_print").on("click", function() {
        datatable_floor.button( '.buttons-print' ).trigger();
    });

    $("#floor_copy").on("click", function() {
        datatable_floor.button( '.buttons-copy' ).trigger();
    });

    $("#floor_excel").on("click", function() {
        datatable_floor.button( '.buttons-excel' ).trigger();
    });
    
    $("#floor_csv").on("click", function() {
        datatable_floor.button( '.buttons-csv' ).trigger();
    });

    $("#floor_pdf").on("click", function() {
        datatable_floor.button( '.buttons-pdf' ).trigger();
    });

    /***********Room List *******/
    $("#room_print").on("click", function() {
        datatable_roomno.button( '.buttons-print' ).trigger();
    });

    $("#room_copy").on("click", function() {
        datatable_roomno.button( '.buttons-copy' ).trigger();
    });

    $("#room_excel").on("click", function() {
        datatable_roomno.button( '.buttons-excel' ).trigger();
    });
    
    $("#room_csv").on("click", function() {
        datatable_roomno.button( '.buttons-csv' ).trigger();
    });

    $("#room_pdf").on("click", function() {
        datatable_roomno.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Status List *******/
    $("#employstatus_print").on("click", function() {
        datatable_employee_status.button( '.buttons-print' ).trigger();
    });

    $("#employstatus_copy").on("click", function() {
        datatable_employee_status.button( '.buttons-copy' ).trigger();
    });

    $("#employstatus_excel").on("click", function() {
        datatable_employee_status.button( '.buttons-excel' ).trigger();
    });
    
    $("#employstatus_csv").on("click", function() {
        datatable_employee_status.button( '.buttons-csv' ).trigger();
    });

    $("#employstatus_pdf").on("click", function() {
        datatable_employee_status.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Category List *******/
    // For In-House
    $("#inhouse_print").on("click", function() {
        datatable_inhouse.button( '.buttons-print' ).trigger();
    });

    $("#inhouse_copy").on("click", function() {
        datatable_inhouse.button( '.buttons-copy' ).trigger();
    });

    $("#inhouse_excel").on("click", function() {
        datatable_inhouse.button( '.buttons-excel' ).trigger();
    });
    
    $("#inhouse_csv").on("click", function() {
        datatable_inhouse.button( '.buttons-csv' ).trigger();
    });

    $("#inhouse_pdf").on("click", function() {
        datatable_inhouse.button( '.buttons-pdf' ).trigger();
    });

    // For Out Sponsorship
    $("#outsponsr_print").on("click", function() {
        datatable_outsponsor.button( '.buttons-print' ).trigger();
    });

    $("#outsponsr_copy").on("click", function() {
        datatable_outsponsor.button( '.buttons-copy' ).trigger();
    });

    $("#outsponsr_excel").on("click", function() {
        datatable_outsponsor.button( '.buttons-excel' ).trigger();
    });
    
    $("#outsponsr_csv").on("click", function() {
        datatable_outsponsor.button( '.buttons-csv' ).trigger();
    });

    $("#outsponsr_pdf").on("click", function() {
        datatable_outsponsor.button( '.buttons-pdf' ).trigger();
    });

    // For OutSource
    $("#outsrc_print").on("click", function() {
        datatable_outsource.button( '.buttons-print' ).trigger();
    });

    $("#outsrc_copy").on("click", function() {
        datatable_outsource.button( '.buttons-copy' ).trigger();
    });

    $("#outsrc_excel").on("click", function() {
        datatable_outsource.button( '.buttons-excel' ).trigger();
    });
    
    $("#outsrc_csv").on("click", function() {
        datatable_outsource.button( '.buttons-csv' ).trigger();
    });

    $("#outsrc_pdf").on("click", function() {
        datatable_outsource.button( '.buttons-pdf' ).trigger();
    });

    // For Saudi National
    $("#saudinat_print").on("click", function() {
        datatable_saudinatl.button( '.buttons-print' ).trigger();
    });

    $("#saudinat_copy").on("click", function() {
        datatable_saudinatl.button( '.buttons-copy' ).trigger();
    });

    $("#saudinat_excel").on("click", function() {
        datatable_saudinatl.button( '.buttons-excel' ).trigger();
    });
    
    $("#saudinat_csv").on("click", function() {
        datatable_saudinatl.button( '.buttons-csv' ).trigger();
    });

    $("#saudinat_pdf").on("click", function() {
        datatable_saudinatl.button( '.buttons-pdf' ).trigger();
    });

    /***********User Role List *******/
    $("#userrole_print").on("click", function() {
        datatable_userrole.button( '.buttons-print' ).trigger();
    });

    $("#userrole_copy").on("click", function() {
        datatable_userrole.button( '.buttons-copy' ).trigger();
    });

    $("#userrole_excel").on("click", function() {
        datatable_userrole.button( '.buttons-excel' ).trigger();
    });
    
    $("#userrole_csv").on("click", function() {
        datatable_userrole.button( '.buttons-csv' ).trigger();
    });

    $("#userrole_pdf").on("click", function() {
        datatable_userrole.button( '.buttons-pdf' ).trigger();
    });

    /***********Sponsor List *******/
    $("#sponsor_print").on("click", function() {
        datatable_setting_sponsors.button( '.buttons-print' ).trigger();
    });

    $("#sponsor_copy").on("click", function() {
        datatable_setting_sponsors.button( '.buttons-copy' ).trigger();
    });

    $("#sponsor_excel").on("click", function() {
        datatable_setting_sponsors.button( '.buttons-excel' ).trigger();
    });
    
    $("#sponsor_csv").on("click", function() {
        datatable_setting_sponsors.button( '.buttons-csv' ).trigger();
    });

    $("#sponsor_pdf").on("click", function() {
        datatable_setting_sponsors.button( '.buttons-pdf' ).trigger();
    });

    /***********VISA Profession List *******/
    $("#visaprof_print").on("click", function() {
        datatable_setting_visaproffession.button( '.buttons-print' ).trigger();
    });

    $("#visaprof_copy").on("click", function() {
        datatable_setting_visaproffession.button( '.buttons-copy' ).trigger();
    });

    $("#visaprof_excel").on("click", function() {
        datatable_setting_visaproffession.button( '.buttons-excel' ).trigger();
    });
    
    $("#visaprof_csv").on("click", function() {
        datatable_setting_visaproffession.button( '.buttons-csv' ).trigger();
    });

    $("#visaprof_pdf").on("click", function() {
        datatable_setting_visaproffession.button( '.buttons-pdf' ).trigger();
    });

    /***********Hospitals List *******/
    $("#hospital_print").on("click", function() {
        datatable_setting_hospital.button( '.buttons-print' ).trigger();
    });

    $("#hospital_copy").on("click", function() {
        datatable_setting_hospital.button( '.buttons-copy' ).trigger();
    });

    $("#hospital_excel").on("click", function() {
        datatable_setting_hospital.button( '.buttons-excel' ).trigger();
    });
    
    $("#hospital_csv").on("click", function() {
        datatable_setting_hospital.button( '.buttons-csv' ).trigger();
    });

    $("#hospital_pdf").on("click", function() {
        datatable_setting_hospital.button( '.buttons-pdf' ).trigger();
    });

    /***********Insurance Providers List *******/
    $("#insrcprovider_print").on("click", function() {
        datatable_setting_insuranceprovider.button( '.buttons-print' ).trigger();
    });

    $("#insrcprovider_copy").on("click", function() {
        datatable_setting_insuranceprovider.button( '.buttons-copy' ).trigger();
    });

    $("#insrcprovider_excel").on("click", function() {
        datatable_setting_insuranceprovider.button( '.buttons-excel' ).trigger();
    });
    
    $("#insrcprovider_csv").on("click", function() {
        datatable_setting_insuranceprovider.button( '.buttons-csv' ).trigger();
    });

    $("#insrcprovider_pdf").on("click", function() {
        datatable_setting_insuranceprovider.button( '.buttons-pdf' ).trigger();
    });

    /***********Benefit Category List *******/
    $("#benefitctg_print").on("click", function() {
        datatable_benefitcategory.button( '.buttons-print' ).trigger();
    });

    $("#benefitctg_copy").on("click", function() {
        datatable_benefitcategory.button( '.buttons-copy' ).trigger();
    });

    $("#benefitctg_excel").on("click", function() {
        datatable_benefitcategory.button( '.buttons-excel' ).trigger();
    });
    
    $("#benefitctg_csv").on("click", function() {
        datatable_benefitcategory.button( '.buttons-csv' ).trigger();
    });

    $("#benefitctg_pdf").on("click", function() {
        datatable_benefitcategory.button( '.buttons-pdf' ).trigger();
    });

    /***********Benefit List *******/
    $("#benefits_print").on("click", function() {
        datatable_benefits.button( '.buttons-print' ).trigger();
    });

    $("#benefits_copy").on("click", function() {
        datatable_benefits.button( '.buttons-copy' ).trigger();
    });

    $("#benefits_excel").on("click", function() {
        datatable_benefits.button( '.buttons-excel' ).trigger();
    });
    
    $("#benefits_csv").on("click", function() {
        datatable_benefits.button( '.buttons-csv' ).trigger();
    });

    $("#benefits_pdf").on("click", function() {
        datatable_benefits.button( '.buttons-pdf' ).trigger();
    });

    /***********Employee Relations List *******/
    $("#employrelations_print").on("click", function() {
        datatable_employee_relation.button( '.buttons-print' ).trigger();
    });

    $("#employrelations_copy").on("click", function() {
        datatable_employee_relation.button( '.buttons-copy' ).trigger();
    });

    $("#employrelations_excel").on("click", function() {
        datatable_employee_relation.button( '.buttons-excel' ).trigger();
    });
    
    $("#employrelations_csv").on("click", function() {
        datatable_employee_relation.button( '.buttons-csv' ).trigger();
    });

    $("#employrelations_pdf").on("click", function() {
        datatable_employee_relation.button( '.buttons-pdf' ).trigger();
    });

    /***********Termination Reason List *******/
    $("#terminationreason_print").on("click", function() {
        datatable_termination_reason.button( '.buttons-print' ).trigger();
    });

    $("#terminationreason_copy").on("click", function() {
        datatable_termination_reason.button( '.buttons-copy' ).trigger();
    });

    $("#terminationreason_excel").on("click", function() {
        datatable_termination_reason.button( '.buttons-excel' ).trigger();
    });
    
    $("#terminationreason_csv").on("click", function() {
        datatable_termination_reason.button( '.buttons-csv' ).trigger();
    });

    $("#terminationreason_pdf").on("click", function() {
        datatable_termination_reason.button( '.buttons-pdf' ).trigger();
    });

    /***********Events List *******/
    $("#events_print").on("click", function() {
        datatable_setting_events.button( '.buttons-print' ).trigger();
    });

    $("#events_copy").on("click", function() {
        datatable_setting_events.button( '.buttons-copy' ).trigger();
    });

    $("#events_excel").on("click", function() {
        datatable_setting_events.button( '.buttons-excel' ).trigger();
    });
    
    $("#events_csv").on("click", function() {
        datatable_setting_events.button( '.buttons-csv' ).trigger();
    });

    $("#events_pdf").on("click", function() {
        datatable_setting_events.button( '.buttons-pdf' ).trigger();
    });

    /***********Letter Template Setting List *******/
    $("#lettertemplate_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#lettertemplate_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#lettertemplate_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#lettertemplate_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#lettertemplate_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Common Pipeline Process List *******/
    $("#commonpipelineprocess_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#commonpipelineprocess_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#commonpipelineprocess_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#commonpipelineprocess_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#commonpipelineprocess_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Letter Pipeline Stages List *******/
    $("#letterpipelinestages_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#letterpipelinestages_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#letterpipelinestages_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#letterpipelinestages_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#letterpipelinestages_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Letter Pipeline List *******/
    $("#letterpipeline_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#letterpipeline_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#letterpipeline_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#letterpipeline_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#letterpipeline_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Issued Letter List *******/
    $("#issuedletter_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $("#issuedletter_copy").on("click", function() {
        table.button( '.buttons-copy' ).trigger();
    });

    $("#issuedletter_excel").on("click", function() {
        table.button( '.buttons-excel' ).trigger();
    });
    
    $("#issuedletter_csv").on("click", function() {
        table.button( '.buttons-csv' ).trigger();
    });

    $("#issuedletter_pdf").on("click", function() {
        table.button( '.buttons-pdf' ).trigger();
    });

    /***********Labour Law List *******/
    $("#laborlawnotiflist_print").on("click", function() {
        datatable_labourlaw_notification.button( '.buttons-print' ).trigger();
    });

    $("#laborlawnotiflist_copy").on("click", function() {
        datatable_labourlaw_notification.button( '.buttons-copy' ).trigger();
    });

    $("#laborlawnotiflist_excel").on("click", function() {
        datatable_labourlaw_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#laborlawnotiflist_csv").on("click", function() {
        datatable_labourlaw_notification.button( '.buttons-csv' ).trigger();
    });

    $("#laborlawnotiflist_pdf").on("click", function() {
        datatable_labourlaw_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Labour Contract List *******/
    $("#laborcontractnotiflist_print").on("click", function() {
        datatable_labourcontract_notification.button( '.buttons-print' ).trigger();
    });

    $("#laborcontractnotiflist_copy").on("click", function() {
        datatable_labourcontract_notification.button( '.buttons-copy' ).trigger();
    });

    $("#laborcontractnotiflist_excel").on("click", function() {
        datatable_labourcontract_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#laborcontractnotiflist_csv").on("click", function() {
        datatable_labourcontract_notification.button( '.buttons-csv' ).trigger();
    });

    $("#laborcontractnotiflist_pdf").on("click", function() {
        datatable_labourcontract_notification.button( '.buttons-pdf' ).trigger();
    });

    /***********Company Contract List *******/
    $("#cmpnycontractnotiflist_print").on("click", function() {
        datatable_companycontract_notification.button( '.buttons-print' ).trigger();
    });

    $("#cmpnycontractnotiflist_copy").on("click", function() {
        datatable_companycontract_notification.button( '.buttons-copy' ).trigger();
    });

    $("#cmpnycontractnotiflist_excel").on("click", function() {
        datatable_companycontract_notification.button( '.buttons-excel' ).trigger();
    });
    
    $("#cmpnycontractnotiflist_csv").on("click", function() {
        datatable_companycontract_notification.button( '.buttons-csv' ).trigger();
    });

    $("#cmpnycontractnotiflist_pdf").on("click", function() {
        datatable_companycontract_notification.button( '.buttons-pdf' ).trigger();
    });
    /************* Company Contract List ********/

    /************ Document Controller List ******/
    $("#documentcontroller_print").on("click", function() {
        datatable_documentcontroller.button( '.buttons-print' ).trigger();
    });

    $("#documentcontroller_copy").on("click", function() {
        datatable_documentcontroller.button( '.buttons-copy' ).trigger();
    });

    $("#documentcontroller_excel").on("click", function() {
        datatable_documentcontroller.button( '.buttons-excel' ).trigger();
    });
    
    $("#documentcontroller_csv").on("click", function() {
        datatable_documentcontroller.button( '.buttons-csv' ).trigger();
    });

    $("#documentcontroller_pdf").on("click", function() {
        datatable_documentcontroller.button( '.buttons-pdf' ).trigger();
    });
    /************ Document Controller List ******/

    /* Employee Gp - Department List (25-03-2021) */
    $("#empgpdept_print").on("click", function() {
        datatable_employgpdept.button( '.buttons-print' ).trigger();
    });

    $("#empgpdept_copy").on("click", function() {
        datatable_employgpdept.button( '.buttons-copy' ).trigger();
    });

    $("#empgpdept_excel").on("click", function() {
        datatable_employgpdept.button( '.buttons-excel' ).trigger();
    });
    
    $("#empgpdept_csv").on("click", function() {
        datatable_employgpdept.button( '.buttons-csv' ).trigger();
    });

    $("#empgpdept_pdf").on("click", function() {
        datatable_employgpdept.button( '.buttons-pdf' ).trigger();
    });
    /* Employee Gp - Department List (25-03-2021) */

    /* Employee Gp - Department Individual Entry List (25-03-2021) */
    $("#empgpdeptindv_print").on("click", function() {
        datatable_employgpdept_indv.button( '.buttons-print' ).trigger();
    });

    $("#empgpdeptindv_copy").on("click", function() {
        datatable_employgpdept_indv.button( '.buttons-copy' ).trigger();
    });

    $("#empgpdeptindv_excel").on("click", function() {
        datatable_employgpdept_indv.button( '.buttons-excel' ).trigger();
    });
    
    $("#empgpdeptindv_csv").on("click", function() {
        datatable_employgpdept_indv.button( '.buttons-csv' ).trigger();
    });

    $("#empgpdeptindv_pdf").on("click", function() {
        datatable_employgpdept_indv.button( '.buttons-pdf' ).trigger();
    });
    /* Employee Gp - Department Individual Entry List (25-03-2021) */

    /* Employee Gp - Designation List (25-03-2021) */
    $("#empgpdesig_print").on("click", function() {
        datatable_employgpdesig.button( '.buttons-print' ).trigger();
    });

    $("#empgpdesig_copy").on("click", function() {
        datatable_employgpdesig.button( '.buttons-copy' ).trigger();
    });

    $("#empgpdesig_excel").on("click", function() {
        datatable_employgpdesig.button( '.buttons-excel' ).trigger();
    });
    
    $("#empgpdesig_csv").on("click", function() {
        datatable_employgpdesig.button( '.buttons-csv' ).trigger();
    });

    $("#empgpdesig_pdf").on("click", function() {
        datatable_employgpdesig.button( '.buttons-pdf' ).trigger();
    });
    /* Employee Gp - Designation List (25-03-2021) */

    /* Employee Gp - Designation Individual Entry List (25-03-2021) */
    $("#empgpdesgindv_print").on("click", function() {
        datatable_employgpdesg_indv.button( '.buttons-print' ).trigger();
    });

    $("#empgpdesgindv_copy").on("click", function() {
        datatable_employgpdesg_indv.button( '.buttons-copy' ).trigger();
    });

    $("#empgpdesgindv_excel").on("click", function() {
        datatable_employgpdesg_indv.button( '.buttons-excel' ).trigger();
    });
    
    $("#empgpdesgindv_csv").on("click", function() {
        datatable_employgpdesg_indv.button( '.buttons-csv' ).trigger();
    });

    $("#empgpdesgindv_pdf").on("click", function() {
        datatable_employgpdesg_indv.button( '.buttons-pdf' ).trigger();
    });
    /* Employee Gp - Designation Individual Entry List (25-03-2021) */

    /* Quick View Individual Dependant Entry List (07-04-2021) */
    $("#qvdepdindv_print").on("click", function() {
        datatable_indivdependant.button( '.buttons-print' ).trigger();
    });

    $("#qvdepdindv_copy").on("click", function() {
        datatable_indivdependant.button( '.buttons-copy' ).trigger();
    });

    $("#qvdepdindv_excel").on("click", function() {
        datatable_indivdependant.button( '.buttons-excel' ).trigger();
    });
    
    $("#qvdepdindv_csv").on("click", function() {
        datatable_indivdependant.button( '.buttons-csv' ).trigger();
    });

    $("#qvdepdindv_pdf").on("click", function() {
        datatable_indivdependant.button( '.buttons-pdf' ).trigger();
    });
    /* Quick View Individual Dependant Entry List (07-04-2021) */

    /* Employee Transfer List (13-04-2021) */
    $("#emptransfrlist_print").on("click", function() {
        datatable_emptrasfer.button( '.buttons-print' ).trigger();
    });

    $("#emptransfrlist_copy").on("click", function() {
        datatable_emptrasfer.button( '.buttons-copy' ).trigger();
    });

    $("#emptransfrlist_excel").on("click", function() {
        datatable_emptrasfer.button( '.buttons-excel' ).trigger();
    });
    
    $("#emptransfrlist_csv").on("click", function() {
        datatable_emptrasfer.button( '.buttons-csv' ).trigger();
    });

    $("#emptransfrlist_pdf").on("click", function() {
        datatable_emptrasfer.button( '.buttons-pdf' ).trigger();
    });
    /* Employee Transfer List (13-04-2021) */
    

/*  Accounting Module JS */
    $(document).ready(function() {
    var id = $("select[name='employee_group']").val();

        $.ajax({
            type:"POST",
            url: base_url+ "payroll_accounts/getLedgerNumber_grp_id?id="+id,
            data: { id }
        }).done(function(data){
            $('#ledger_name').val(data);
        });


});

     function getLedgerNumber() {
        // var id = $("#accounting_parent_group option:selected").val()
        var id = $("select[name='employee_group']").val();

        $.ajax({
            type:"POST",
            url: base_url+ "payroll_accounts/getNextCode?id="+id,
            data: { id }
        }).done(function(msg){
            getLedgerNumber_grp_id();
            $('#ledger_code').val(msg);
        });
    } 
    function getLedgerNumber_grp_id() {
        // var id = $("#accounting_parent_group option:selected").val()
        var id = $("select[name='employee_group']").val();
        $.ajax({
            type:"POST",
            url: base_url+ "payroll_accounts/getLedgerNumber_grp_id?id="+id,
            data: { id }
        }).done(function(data){
            $('#group_id_account').val(data);
        });
    }


   

     $(document).ready(function() {

        $('select[name="employee_group"]').on('change', function() {

            getLedgerNumber();

        });
    });
   
  
                

     function egetLedgerNumber() {

        var id = $("select[name='e_employee_group']").val();

        $.ajax({
            type:"POST",
            url: base_url+ "payroll_accounts/getNextCode?id="+id,
            data: { id }
        }).done(function(msg){
            egetLedgerNumber_grp_id();
          //  $('#e_ledger_code').val(msg);
        });
    } 


    function egetLedgerNumber_grp_id() {
      
        var id = $("select[name='e_employee_group']").val();
        $.ajax({
            type:"POST",
            url: base_url+ "payroll_accounts/getLedgerNumber_grp_id?id="+id,
            data: { id }
        }).done(function(data){
            $('#e_group_id_account').val(data);
        });
    }




    (function() {
      var id = $("select[name='e_employee_group']").val();
            $.ajax({
                type:"POST",
                url: base_url+ "payroll_accounts/getNextCode?id="+id,
                data: { id }
            }).done(function(msg){
                getLedgerNumber_grp_id();
                $('#e_ledger_code').val(msg);
            });
    })();

     $(document).ready(function() {

        $('select[name="e_employee_group"]').on('change', function() {

            egetLedgerNumber();

        });
    });

$("#accounting_csv").on("click", function() {
    employee_accounting_details.button( '.buttons-csv' ).trigger();
});

$("#accounting_copy").on("click", function() {
    employee_accounting_details.button( '.buttons-copy' ).trigger();
});

$("#accounting_pdf").on("click", function() {
    employee_accounting_details.button( '.buttons-pdf' ).trigger();
});

$("#accounting_print").on("click", function() {
    employee_accounting_details.button( '.buttons-print' ).trigger();
});

$("#accounting_excel").on("click", function() {
    employee_accounting_details.button( '.buttons-excel' ).trigger();
});


  
