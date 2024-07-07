$(document).ready(function() {
    $("#employee_group_edit").click(function(e){
       e.preventDefault();
        var ledger_id           = $("#ledger_id").val();
        var reimbursement_ledger           = $("#reimbursement_ledger").val();
        var expense_ledger           = $("#expense_ledger").val();
        var loan_ledger           = $("#loan_ledger").val();

         if (ledger_id=="") {
         $('#ledger_id').addClass('is-invalid');
         return false;
         } 
         else{
            $('#ledger_id').removeClass('is-invalid');
         } 

           if (reimbursement_ledger=="") {
         $('#reimbursement_ledger').addClass('is-invalid');
         return false;
         } 
         else{
            $('#reimbursement_ledger').removeClass('is-invalid');
         } 


           if (expense_ledger=="") {
         $('#expense_ledger').addClass('is-invalid');
         return false;
         } 
         else{
            $('#expense_ledger').removeClass('is-invalid');
         } 


              if (loan_ledger=="") {
         $('#loan_ledger').addClass('is-invalid');
         return false;
         } 
         else{
            $('#loan_ledger').removeClass('is-invalid');
         } 


         
        $('#form_group_name_edit').attr("action",base_url+"common/db_add_update");
        $('#form_group_name_edit').submit();
    

    }); 

});

   

      