/**
     *Datatable for sales man table
*/
  var salesmanroute_list_table = $('#salesmanroute_list').DataTable({
      processing: true,
      serverSide: true,
      scrollX: true,
      pagingType: "full_numbers",
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],

      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '2%',  '25%', '25%', '25%', 
                                                           '25%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3,4]
              }
          }
      ],

      ajax: {
          "url": 'salesmanroutesettings',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'routename', name: 'routename' },
          { data: 'startpalce', name: 'startpalce' },
          { data: 'endplace',name: 'endplace'},
          { data: 'totalkm',name: 'totalkm'},

          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_11"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-edit"></i>\
                        <span class="kt-nav__link-text salesmanroutedetail_update" data-id="' + row.id + '" >Edit</span>\
                        </span></li></a>\
                        <li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon2-trash"></i>\
                        <span class="kt-nav__link-text kt_del_salesmanrouteinformation" id=' + row.id + ' data-id=' + row.id + '>Delete</span></span></li>\
                       </ul></div></div></span>\
                       ';
              }
          },

      ]
  });
  /**
   *salesman route details DataTable Export
*/
  $("#salesmanroutedetails_list_print").on("click", function() {
      salesmanroute_list_table.button('.buttons-print').trigger();
  });
  $("#salesmanroutedetails_list_copy").on("click", function() {
      salesmanroute_list_table.button('.buttons-copy').trigger();
  });
  $("#salesmanroutedetails_list_csv").on("click", function() {
      salesmanroute_list_table.button('.buttons-csv').trigger();
  });
  $("#salesmanroutedetails_list_pdf").on("click", function() {
      salesmanroute_list_table.button('.buttons-pdf').trigger();
  });
    /**
     *Datatable for sales man trash table
     */
 
  var salesmanroutesettingstrash_table = $('#salesmanroutesettingstrash').DataTable({
      processing: true,
      serverSide: true,
      pagingType: "full_numbers",
      dom: 'Blfrtip',
      lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
      ],

      buttons: [{
              extend: 'copy',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'csv',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'excel',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          },
          {
              extend: 'pdf',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              },
              pageSize: 'A4',
              orientation: 'landscape',
              customize: function (doc) {
            doc.defaultStyle.fontSize = 8; //2, 3, 4,etc
            doc.styles.tableHeader.fontSize = 10; //2, 3, 4, etc
            doc.content[1].table.widths = [ '2%',  '25%', '25%', '25%'];
                       }
          },
          {
              extend: 'print',
              className: "hidden",
              exportOptions: {
                  columns: [0, 1, 2, 3]
              }
          }
      ],

      ajax: {
          "url": 'salesmanroutetrashshows',
          "type": "POST",
          "data": function(data) {
              data._token = $('#token').val()
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'routename', name: 'routename' },
          { data: 'startpalce', name: 'startpalce' },
          { data: 'endplace',name: 'endplace'},
          { data: 'totalkm',name: 'totalkm'},
          
          {
              data: 'action',
              name: 'action',
              render: function(data, type, row) {
                  return '<span style="overflow: visible; position: relative; width: 80px;">\
            <div class="dropdown"><a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-md">\
                        <i class="fa fa-cog"></i></a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                        <ul class="kt-nav">\
                        <a href="#?id=' + row.id + '" data-type="edit" data-toggle="modal" data-target="#kt_modal_4_5"><li class="kt-nav__item">\
                        <span class="kt-nav__link">\
                        <i class="kt-nav__link-icon flaticon-upload-1"></i>\
                        <span class="kt-nav__link-text salesmanroutrestore" id=' + row.id + ' data-id="' + row.id + '" >Restore</span>\
                        </span></li></a>\
                       </ul></div></div></span>';
              }
          },

      ]
  });

$(document).on('click', '.salesmanroutrestore', function () {
     var id = $(this).attr('id');
   
       swal.fire({
        title: "Are you sure?",
        text: "You will be able to recover this Salesman Route Settings Entry !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, Restore it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {

        $.ajax({
              type: "POST",
              url : 'salesmanrouteTrashRestore',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {

                  swal.fire("Restored!", "Your Salesman Route Settings Entry has been restored.", "success");
                window.location.href="salesmanroutesettings";

             }
          });
          } else {
            swal.fire("Cancelled", "Your Salesman Route Settings Entry is not safe :)", "error");

          }
        })
     });

$(document).on('click', '#salesmanroute_submit', function(e){
 e.preventDefault();  
                        routename        = $('#routename').val();
                        startpalce       = $('#startpalce').val();
                        endplace         = $('#endplace').val();
                        totalkm          = $('#totalkm').val();

        if (routename == "") {
         $('#routename').addClass('is-invalid');
         return false;
         } 
         else{
            $('#routename').removeClass('is-invalid');
         } 

         if (startpalce == "") {
         $('#startpalce').addClass('is-invalid');
         return false;
         } 
         else{
            $('#startpalce').removeClass('is-invalid');
         }

          if (endplace == "") {
         $('#endplace').addClass('is-invalid');
         return false;
         } 
         else{
            $('#endplace').removeClass('is-invalid');
         }

         if (totalkm == "") {
         $('#totalkm').addClass('is-invalid');
         return false;
         } 
         else{
            $('#totalkm').removeClass('is-invalid');
         }
        $(this).addClass('kt-spinner');
        $(this).prop("disabled", true);
        if($('#id').val()){
        var sucess_msg ='Updated';
        } else{
        var sucess_msg ='Created';
        }
        $.ajax({
            type : "POST",
            url  : "salesmanrouteSubmit",
            dataType  : "json",
            data : {
                        _token           : $('#token').val(),
                        cust_id          : $('#id').val(),
                        routename        : $('#routename').val(),
                        startpalce       : $('#startpalce').val(),
                        endplace         : $('#endplace').val(),
                        totalkm          : $('#totalkm').val(),
                        branch           : $('#branch').val()
                    },
                    success: function(data){
          if(data == false)
          {
            $('#salesmanroute_submit').removeClass('kt-spinner');
            $('#salesmanroute_submit').prop("disabled", false);
             toastr.warning('Route Name Already Exist');

          }
          else
          {
                  $('#salesmanroute_submit').removeClass('kt-spinner');
                  $('#salesmanroute_submit').prop("disabled", false);
                  window.location.href="salesmanroutesettings";
                  toastr.success('Salesman Route Details '+sucess_msg+' Successfuly');
          }
                },
            error   : function ( jqXhr, json, errorThrown )
            {
               console.log('Error !!');
            }
                    });

    });
  
function closeModel(){

      $("#kt_modal_4_11").modal("hide");

      $('#routename').val("");
      ('#startpalce').val("");
      ('#endplace').val("");
      ('#totalkm').val("");
      $('#id').val("");
   }

  $(document).on('click', '.close,.closeBtn', function(){
     closeModel();
  });

$(document).on('click', '.salesmanroutedetail_update', function(){
           var cust_id = $(this).attr("data-id");
           $.ajax({
                url       : "getsalesmanroutesettings",
                method    : "POST",
                data      : {
              _token      : $('#token').val(),
              cust_id     : cust_id
                    },
                dataType  : "json",
                success:function(data)
                {
                    $('#routename').val(data['users'].routename);
                    $('#startpalce').val(data['users'].startpalce);
                    $('#endplace').val(data['users'].endplace);
                     $('#totalkm').val(data['users'].totalkm);
                     $('#id').val(cust_id);
                     $("##kt_modal_4_11").modal("hide");
                    }
           })
      });


var i=1;

$('#add-more').click(function(){
   i++;
   $('#table-more').append('<tr id="row'+i+'" class="dynamic-added addmore subadmore">\
    <td>\
    <input type="text"  name="skill['+i+']" placeholder="Skill" class="skill form-control name_list" />\
    </td>\
    <td>\
    <input type="text"  name="skillValue['+i+']" placeholder="Value" class="skillValue form-control name_list" />\
    </td>\
    <td>\
    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
    </td>\
    </tr>');
});

$(document).on('click', '.btn_remove', function(){
     var button_id = $(this).attr("id");
     $('#row'+button_id+'').remove();
});



$(document).on('click', '.kt_del_salesmanrouteinformation', function () {
     var id = $(this).attr('id');
       swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover Sales Route Details!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel it!" }).then(result => {
        if (result.value) {
        $.ajax({
              type: "POST",
              url : 'deletesalesmanrouteInfo',
              data: {
                     _token : $('#token').val(),
                     id     : id
                    },
              success: function(data) {
               // table.ajax.reload();
               swal.fire("Deleted!", "Your Sales Route Details has been deleted.", "success");
               location.reload();
             }
          });
          } else {
            swal.fire("Cancelled", "Your Sales Route Details is safe :)", "error");
          }
        })
       });
