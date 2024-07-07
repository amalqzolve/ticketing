$(document).ready(function() {
 $('select[name="e_branch"]').trigger('change');
 $('select[name="e_department"]').trigger('change');
 $('select[name="e_designation"]').trigger('change');

    $("#letter_edit").click(function(e){
      
        e.preventDefault();
        var branch           = $("#e_branch").val();
        var department          = $('#e_department').val();
        var designation           = $("#e_designation").val();
        var employee          = $('#e_employee').val();
        var templete_id           = $("#e_templete_id").val();
        var url           = $("#url").val();
       
       
        if (branch=="") {
          $('#e_branch').addClass('is-invalid');
          return false;
        } else{
          $('#e_branch').removeClass('is-invalid');
        }

        if (department=="") {
          $('#e_department').addClass('is-invalid');
          return false;
        } else{
          $('#e_department').removeClass('is-invalid');
        }

        if (designation=="") {
          $('#e_designation').addClass('is-invalid');
          return false;
        } else{
          $('#e_designation').removeClass('is-invalid');
        }

        if (employee=="") {
          $('#e_employee').addClass('is-invalid');
          return false;
        } else{
          $('#e_employee').removeClass('is-invalid');
        }
        if (templete_id=="") {
          $('#e_templete_id').addClass('is-invalid');
          return false;
        } else{
          $('#e_templete_id').removeClass('is-invalid');
        }

        $('#form_employee_letter_edit').attr("action",base_url+"common/db_add_update");
        $('#form_employee_letter_edit').submit();



    }); 
});

$(document).ready(function() {

        $('select[name="e_branch"]').on('change', function() {
            var branch = $(this).val();
            

            if(branch) {
                $.ajax({
                    url:base_url+'pipeline_assign/getdynamicdepartment',
                    type: "POST",
                    data : {branch_id:branch},
                    dataType: "json",
                    success:function(data) {
                        $('select[name="e_designation"]').val(null).trigger("change")

                        $('select[name="e_department"]').empty();
                        //$('select[name="e_employee[]"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="e_department"]').append('<option value="'+ value.id +'">'+ value.dept_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="e_department"]').empty();
            }
        });
         $('select[name="e_department"]').on('change', function() {
             //$('select[name="e_employee[]"]').empty();
        }); 
    });




 // $(document).ready(function() {

 //        $('select[name="e_designation"]').on('change', function() {
             
 //            var branch     = $("#e_branch").val();
             
 //            var department = $("#e_department").val();
            
 //            if(branch && department) {
 //                $.ajax({
 //                    url:base_url+'pipeline_assign/getdynamicemployee',
 //                    type: "POST",
 //                    data : {branch_id:branch,
 //                            department_id : department,
 //                       },
 //                    dataType: "json",
 //                    success:function(data) {
 //                        $('select[name="e_employee[]"]').empty();
 //                        $.each(data, function(key, value) {
 //                          var data = {id:value.id,text:value.f_name};
 //                          var newOption = new Option(data.text, data.id, false, false);
 //                          $('#e_employee').append(newOption).trigger('change');
 //                          });
 //                    }
 //                });
 //            }else{
 //                $('select[name="e_employee[]"]').empty();
 //            }
 //        });
 //    });