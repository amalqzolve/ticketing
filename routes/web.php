<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::post('register', 'Auth\RegistersUsers@showRegistrationForm')->name('register');
Route::group(['middleware' => ['language', 'auth']], function () {

    Route::any('logout', 'Auth\LoginController@logout')->name('logout');

    Route::any('branch-settings', 'settings\BranchSettingsController@index')->name('branch-settings');
    Route::any('accounting-db-connection', 'settings\BranchSettingsController@configureAccountingDBConnection')->name('accounting-db-connection');
    Route::any('accounting-db-connection-test', 'settings\BranchSettingsController@testAccountingConnection')->name('accounting-db-connection-test');
    Route::any('accounting-db-connection-save', 'settings\BranchSettingsController@saveAccountingConnection')->name('accounting-db-connection-save');

    Route::any('seal-upload', 'settings\BranchSettingsController@sealupload')->name('seal-upload');
    Route::any('headder-upload', 'settings\BranchSettingsController@headderUpload')->name('headder-upload');
    Route::any('footer-upload', 'settings\BranchSettingsController@footerUpload')->name('footer-upload');
    Route::any('save-branch-details', 'settings\BranchSettingsController@saveBranchDetails')->name('save-branch-details');
    Route::group(['middleware' => ['check.branch.settings']], function () {

        // crm
        Route::group(['namespace' => 'crm'], function () {

            Route::get('test', 'HomeController@test')->name('test');
            Route::any('crm', 'DashboardController@index')->name('Dashboard');

            Route::post('CustomertypeList', 'CustomerController@customertypeshow')->name('CustomertypeList');
            Route::post('Typesubmit', 'CustomerController@typeSubmit')->name('Typesubmit');
            Route::any('customergroup', 'CustomerController@groupindex')->name('customergroup');
            Route::post('grouptrashrestore', 'CustomerController@grouptrashrestore')->name('grouptrashrestore');
            Route::any('grouptrash', 'CustomerController@grouptrash')->name('grouptrash');
            Route::post('getgroupupdate', 'CustomerController@groupupdate')->name('getgroupupdate');
            Route::post('deletegroup', 'CustomerController@groupdelete')->name('deletegroup');
            Route::post('CustGroupinfo', 'CustomerController@groupsubmit')->name('CustGroupinfo');
            Route::post('getSinglecustomerInfo', 'CustomerController@getSinglecustomerInfo')->name('getSinglecustomerInfo');
            Route::any('customerdetails', 'CustomerController@index')->name('Customer Information');

            Route::any('customertypedetails', 'CustomerController@custtypeindex')->name('customertypedetails.index');
            Route::any('customercategorydetails', 'CustomerController@custcategoryindex')->name('customercategorydetails.index');
            Route::any('Categoryinfo', 'CustomerController@Categorys_submit')->name('Categoryinfo');
            Route::any('categorytrash', 'CustomerController@trashcategory')->name('categorytrash');
            Route::any('typetrash', 'CustomerController@typetrashs')->name('typetrash');
            Route::any('customertrash', 'CustomerController@customertrashshow')->name('customertrash');
            Route::post('customerTrashRestore', 'CustomerController@customertrashrestore')->name('customerTrashRestore');

            Route::post('categoryTrashRestore', 'CustomerController@trashrestore')->name('categoryTrashRestore');
            Route::post('deletecustrows', 'CustomerController@deleted')->name('deletecustrows');
            Route::any('getcategorycode', 'CustomerController@getcategorycode')->name('getcategorycode');

            Route::any('edit_customer_document', 'CustomerController@edit_customer_document')->name('edit_customer_document');
            Route::any('cust_docpdf', 'CustomerController@cust_docpdf')->name('cust_docpdf');
            Route::post('customerdocumentSubmit', 'CustomerController@customerdocumentSubmit')->name('customerdocumentSubmit');

            Route::post('Categorytrashlist', 'CustomerController@trashcategoryshow')->name('Categorytrashlist');
            Route::post('typetrashlist', 'CustomerController@trashtypeshow')->name('typetrashlist');
            Route::post('getcategorylist', 'CustomerController@categoryedit')->name('getcategorylist');
            Route::post('deletecategory', 'CustomerController@deletecategory')->name('deletecategory');
            Route::post('deletetypeInfo', 'CustomerController@deletetypeds')->name('deletetypeInfo');

            Route::post('gettypeupdate', 'CustomerController@type_updatess')->name('gettypeupdate');
            Route::post('deleteCustomerInfo', 'CustomerController@delete_customer')->name('deleteCustomerInfo');
            Route::get('newcustomer', 'CustomerController@add_custmer')->name('newcustomer');
            Route::get('addcustomercategorydetails', 'CustomerController@add_category')->name('addcustomercategorydetails');
            Route::get('edit_customer', 'CustomerController@edit_customer')->name('edit_customer');
            Route::get('view_customer', 'CustomerController@view_customer')->name('view_customer');
            Route::get('view_type_lists', 'CustomerController@view_type_list')->name('view_type_lists');
            Route::get('view_category', 'CustomerController@view_category_list')->name('view_category');
            Route::post('CustomerSubmit', 'CustomerController@submit_customer')->name('CustomerSubmit');
            Route::get('edit_customer_docs', 'CustomerController@edit_customer_docs')->name('edit_customer_docs');
            Route::any('crmcustomerdocuments', 'CustomerController@crmcustomerdocuments')->name('crmcustomerdocuments');
            Route::get('/findstartform', 'CustomerController@findstartform');
            Route::get('edit_customers', 'CustomerController@edits')->name('edit_customers');
            Route::any('customer_pdf', 'CustomerController@customer_pdf')->name('customer_pdf');
            Route::post('typeTrashRestore', 'CustomerController@typetrashrestore')->name('typeTrashRestore');
            Route::any('CustomerAccountsList', 'CustomerController@customeraccountshow')->name('CustomerAccountsList');
            Route::any('customer_download', 'CustomerController@customer_download')->name('customer_download');
            Route::any('cust_doc_view', 'CustomerController@cust_doc_view')->name('Customer Doucment View');
            Route::any('deleteCustomerdocumentfile', 'CustomerController@deleteCustomerdocumentfile')->name('deleteCustomerdocumentfile');
            Route::any('deleteSupplierdocumentfile', 'CustomerController@deleteSupplierdocumentfile')->name('deleteSupplierdocumentfile');
            Route::any('deleteVendordocumentfile', 'CustomerController@deleteVendordocumentfile')->name('deleteVendordocumentfile');
            Route::any('getcustomerusername', 'CustomerController@getcustomerusername')->name('getcustomerusername');


            Route::any('suppliergroup', 'suppliergroup@supplier_grup')->name('suppliergroup');
            Route::get('suppliergroupList', 'suppliergroup@suppliergrupstore')->name('suppliergroupList');
            Route::any('suppliergroupSubmit', 'suppliergroup@submitgroup')->name('suppliergroupSubmit');
            Route::any('getsuppliergrup', 'suppliergroup@getsuppliergrup')->name('getsuppliergrup');
            Route::any('deletesuppliergrupInfo', 'suppliergroup@deletesuppliergrupInfo')->name('deletesuppliergrupInfo');
            Route::any('suppliertrashshows', 'suppliergroup@suppliergroupindex')->name('suppliertrashshows');
            Route::post('suppliergruptrash', 'suppliergroup@suppliergrouplist')->name('suppliergruptrash');
            Route::any('suppliergrupTrashRestore', 'suppliergroup@suppliergrupTrashRestore')->name('suppliergrupTrashRestore');


            Route::any('suppliercategory', 'SupplierController@category_list')->name('suppliercategory');
            Route::any('supplier_pdf', 'SupplierController@supplier_pdf')->name('supplier_pdf');
            Route::any('suppliercatgrySubmit', 'SupplierController@Submit')->name('suppliercatgrySubmit');
            Route::any('getsuppliercatgry', 'SupplierController@getsuppliercatgry')->name('getsuppliercatgry');
            Route::post('deletesuppliercatgryInfo', 'SupplierController@deletesuppliercatgryInfo')->name('deletesuppliercatgryInfo');
            Route::any('suppliercatgrytrash', 'SupplierController@suplircatgry_trash')->name('suppliercatgrytrash');
            Route::any('sup_cat_TrashRestore', 'SupplierController@sup_cat_TrashRestore')->name('sup_cat_TrashRestore');
            Route::post('CategoryLists', 'SupplierController@Categoryshows')->name('CategoryLists');
            Route::get('addsupplierdetails', 'SupplierController@add')->name('addsupplierdetails.add');
            Route::any('supplierdetails', 'SupplierController@supplierdetailss')->name('supplierdetails');
            Route::post('SupplierList', 'SupplierController@suppliershow')->name('SupplierList');
            Route::get('edit_supplier', 'SupplierController@edit_supplier')->name('edit_supplier');
            Route::get('view_supplier', 'SupplierController@view_supplier')->name('view_supplier');
            Route::any('supplierdetailstrash', 'SupplierController@supplierdetailstrash')->name('supplierdetailstrash');
            Route::post('suptrashlist', 'SupplierController@suptrashlist')->name('suptrashlist');
            Route::post('SupplierSubmit', 'SupplierController@suppliersubmit')->name('SupplierSubmit');
            Route::post('supplierTrashRestore', 'SupplierController@supplierTrashRestore')->name('supplierTrashRestore');
            Route::any('suplier_accountpdf', 'SupplierController@suplier_accountpdf')->name('suplier_accountpdf');
            Route::post('deletesupplierInfo', 'SupplierController@deletefiles')->name('deletesupplierInfo');
            Route::any('supplierdocuments', 'SupplierController@supplierdocuments')->name('supplierdocuments');
            Route::any('sup_doc_view', 'SupplierController@sup_doc_view')->name('sup_doc_view');
            Route::any('sup_docpdf', 'SupplierController@sup_docpdf')->name('sup_docpdf');
            Route::any('SupplierdocumentList', 'SupplierController@SupplierdocumentList')->name('SupplierdocumentList');
            Route::any('edit_supplier_document', 'SupplierController@edit_supplier_document')->name('edit_supplier_document');
            Route::post('supplierdocumentSubmit', 'SupplierController@supplierdocumentSubmit')->name('supplierdocumentSubmit');
            Route::any('supplier_type', 'SupplierController@suplir_type')->name('supplier_type');
            Route::any('suppliertypeList', 'SupplierController@suppliertypestore')->name('suppliertypeList');
            Route::any('suppliertypeSubmit', 'SupplierController@typeSubmit')->name('suppliertypeSubmit');
            Route::any('getsuppliertype', 'SupplierController@getsuppliertype')->name('getsuppliertype');
            Route::any('deletesuppliertypeInfo', 'SupplierController@deletesuppliertypeInfo')->name('deletesupplierInfo');
            Route::any('suppliertrash', 'SupplierController@suplir_trash')->name('suppliertrash');
            Route::post('suppliertypetrash', 'SupplierController@getsuplir_trash')->name('suppliertypetrash');
            Route::any('typeTrashRestores', 'SupplierController@typeTrashRestores')->name('typeTrashRestores');
            Route::get('edit_suppliers', 'SupplierController@edits')->name('edit_suppliers');
            Route::get('edit_supplier_docs', 'SupplierController@edit_supplier_docs')->name('edit_supplier_docs');
            Route::get('/findsupplierstartfrom', 'SupplierController@findsupplierstartfrom');
            Route::get('supplier', 'SupplierController@index')->name('supplier.index');
            Route::post('SupplieraccountsList', 'SupplierController@supplieraccountsshow')->name('SupplieraccountsList');
            Route::post('getpayterms', 'SupplierController@getpayterms')->name('getpayterms');
            Route::any('supplier_download', 'SupplierController@supplier_download')->name('supplier_download');
            Route::get('supplierdownload/{path}/{file}', 'SupplierController@download');
            Route::any('sgetcategorycode', 'SupplierController@getcategorycode');
            Route::any('getsupplierusername', 'SupplierController@getsupplierusername')->name('getsupplierusername');


            Route::post('getcreditlimits', 'customercreditlimit@getcreditlimitcustomer')->name('getcreditlimits');
            Route::post('CustomerCreditSubmit', 'customercreditlimit@CustomerCreditSubmit')->name('CustomerCreditSubmit');
            Route::get('customercreditlimitdetails', 'customercreditlimit@customercredit_settings')->name('customercreditlimitdetails');
            Route::post('customercreditList', 'customercreditlimit@customercreditstore')->name('customercreditList');
            Route::post('creditlimitSubmit', 'customercreditlimit@creditsubmitgroup')->name('creditlimitSubmit');
            Route::post('getcreditlimit', 'customercreditlimit@getcreditlimit')->name('getcreditlimit');
            Route::post('deletecreditlimitInfo', 'customercreditlimit@deletecreditlimitInfo')->name('deletecreditlimitInfo');


            Route::get('/vencategoryfindstartform', 'vendorsController@vencategoryfindstartform');
            Route::any('vendors', 'vendorsController@index')->name('vendors.index');
            Route::post('vendorList', 'vendorsController@vendorshow')->name('vendorList');
            Route::get('addvendordetails', 'vendorsController@addvendordetails')->name('addvendordetails');
            Route::post('VendorSubmit', 'vendorsController@submit_vendor')->name('VendorSubmit');
            Route::post('getVendordetailsInfo', 'vendorsController@edit_vendor')->name('getVendordetailsInfo');
            Route::get('edit_vendor', 'vendorsController@edit_vendor')->name('edit_vendor');
            Route::post('deleteVendorInfo', 'vendorsController@delete_vendor')->name('deleteVendorInfo');
            Route::post('vendorRestoreTrash', 'vendorsController@vendorTrashRestore')->name('vendorRestoreTrash');
            Route::any('vendorInfoTrash', 'vendorsController@vendorInfoTrash')->name('vendors.trash');
            Route::post('vendortrashList', 'vendorsController@vendortrashshow')->name('vendortrashList');
            Route::any('vendor_pdf', 'vendorsController@vendor_pdf')->name('vendor_pdf');
            Route::post('vendorAccountsList', 'vendorsController@vendoraccountshow')->name('vendorAccountsList');
            Route::any('vgetcategorycode', 'vendorsController@getcategorycode');
            Route::any('view_vendor', 'vendorsController@view_vendor')->name('view_vendor');
            Route::any('getvendorusername', 'vendorsController@getvendorusername')->name('getvendorusername');


            Route::any('vendorcategorydetails', 'VendorCategoryController@vendorcategoryindex')->name('vendorcategorydetails');
            Route::get('addvendorcategorydetails', 'VendorCategoryController@addvendorcategorydetails')->name('VendorCategory.addvendorcategorydetails');
            Route::post('VendorCategorySubmit', 'VendorCategoryController@submit_vendorcategory')->name('VendorCategorySubmit');
            Route::get('edit_vendorcategory', 'VendorCategoryController@edit_vendorcategory')->name('edit_vendorcategory');
            Route::post('deleteVendorCategory', 'VendorCategoryController@delete_vendorcategory')->name('deleteVendorCategory');
            Route::any('vendorCategoryTrash', 'VendorCategoryController@vendorCategoryTrash')->name('vendorCategoryTrash');
            Route::post('vendorCategoryRestoreTrash', 'VendorCategoryController@vendorcategoryRestore')->name('vendorCategoryRestoreTrash');
            Route::post('VendorcategoryList', 'VendorCategoryController@vendorcategoryshow')->name('VendorcategoryList');
            Route::post('getvendorcategory', 'VendorCategoryController@categoryedit')->name('getvendorcategory');

            Route::any('vendortypedetails', 'VendorTypeController@vendortypeindex')->name('vendortypedetails');
            Route::post('getvendortype', 'VendorTypeController@typeedit')->name('getvendortype');
            Route::post('VendorTypeSubmit', 'VendorTypeController@submit_vendortype')->name('VendorTypeSubmit');
            Route::post('deleteVendorType', 'VendorTypeController@delete_vendortype')->name('deleteVendorType');
            Route::any('vendortypetrash', 'VendorTypeController@vendorTypeTrash')->name('vendortypetrash');
            Route::post('VendorTypeRestoreTrash', 'VendorTypeController@VendorTypeRestoreTrash')->name('VendorTypeRestoreTrash');
            Route::post('vendortypetrashList', 'VendorTypeController@vendortypelistTrash')->name('vendortypetrashList');



            Route::get('vendortaxdetails', 'VendorTaxController@vendortaxindex')->name('VendorTax.index');
            Route::post('taxList', 'VendorTaxController@taxList')->name('taxList');
            Route::post('taxInfo', 'VendorTaxController@store')->name('taxInfo');
            Route::post('getTaxInfo', 'VendorTaxController@getTaxInfo')->name('getTaxInfo');
            Route::post('deleteTaxInfo', 'VendorTaxController@deleteTaxInfo')->name('deleteTaxInfo');
            Route::get('userTaxTrash', 'VendorTaxController@TaxDetailsTrash')->name('userTaxTrash');
            Route::post('taxtrashList', 'VendorTaxController@taxinfotrash')->name('taxtrashList');
            Route::post('VendorTaxRestoreTrash', 'VendorTaxController@VendorTaxRestore')->name('VendorTaxRestoreTrash');

            Route::any('vendorgroupdetails', 'VendorGroupController@index')->name('vendorgroupdetails');
            Route::post('getvendorgroup', 'VendorGroupController@groupedit')->name('getvendorgroup');
            Route::post('VendorGroupSubmit', 'VendorGroupController@submit_vendorgroup')->name('VendorGroupSubmit');
            Route::post('deleteVendorGroup', 'VendorGroupController@delete_vendorgroup')->name('deleteVendorGroup');
            Route::any('vendorgrouptrash', 'VendorGroupController@GroupTrash')->name('VendorGroup.trash');
            Route::post('vendorGroupRestoreTrash', 'VendorGroupController@VendorGroupRestore')->name('vendorGroupRestoreTrash');

            Route::any('vendordocuments', 'VendorDocumentController@index')->name('Vendor-Documents');
            Route::post('docList', 'VendorDocumentController@docList')->name('docList');
            Route::post('docInfo', 'VendorDocumentController@store')->name('docInfo');
            Route::post('getDocInfo', 'VendorDocumentController@getDocInfo')->name('getDocInfo');
            Route::post('deleteDocInfo', 'VendorDocumentController@deleteDocInfo')->name('deleteDocInfo');
            Route::any('edit_vendor_docs', 'VendorDocumentController@edit_vendor_docs')->name('edit_vendor_docs');
            Route::get('VendorDocTrash', 'VendorDocumentController@DocDetailsTrash')->name('VendorDocTrash');
            Route::post('DoctrashList', 'VendorDocumentController@docinfotrash')->name('DoctrashList');
            Route::post('getDocAdd', 'VendorDocumentController@getDocAdd')->name('getDocAdd');
            Route::post('getDocEdit', 'VendorDocumentController@getDocEdit')->name('getDocEdit');
            Route::post('VendordocList', 'VendorDocumentController@VendordocList')->name('VendordocList');
            Route::get('view_VendorDoc', 'VendorDocumentController@view_vendordoc')->name('view_VendorDoc');
            Route::get('vendor_docpdf', 'VendorDocumentController@vendor_docpdf')->name('vendor_docpdf');
            Route::any('vendor_documentList', 'VendorDocumentController@vendor_documentsshow')->name('vendor_documentList');
            Route::any('edit_vendor_documents', 'VendorDocumentController@edit_vendor_documents')->name('edit_vendor_documents');
            Route::any('vendordocumentSubmit', 'VendorDocumentController@vendordocumentSubmit')->name('vendordocumentSubmit');
            Route::any('vendor_download', 'VendorDocumentController@vendor_download')->name('vendor_download');
            Route::any('vendor_doc_view', 'VendorDocumentController@vendor_doc_view')->name('Vendor Document View');

            Route::get('vendorCreditLimits', 'VendorCreditLimitController@index')->name('VendorCredit.index');
            Route::post('VendorCreditList', 'VendorCreditLimitController@VendorCreditList')->name('VendorCreditList');
            Route::post('getCreditAdd', 'VendorCreditLimitController@getCreditAdd')->name('getCreditAdd');
            Route::post('CreditInfo', 'VendorCreditLimitController@store')->name('CreditInfo');
            Route::post('deleteCreditInfo', 'VendorCreditLimitController@deleteCreditInfo')->name('deleteCreditInfo');

            Route::any('paymentTerms', 'PaymentController@index')->name('PaymentDetail.index');
            Route::post('paymentTermstrashlists', 'PaymentController@paymentttrashlists')->name('paymentTermstrashlists');
            Route::any('PaymentSubmit', 'PaymentController@PaymentSubmit')->name('PaymentSubmit');
            Route::any('getPaymentTerms', 'PaymentController@getPaymentTerms')->name('getPaymentTerms');
            Route::any('deletePaymentInfo', 'PaymentController@deletePaymentInfo')->name('deletePaymentInfo');
            Route::any('paymentmenttrashdetails', 'PaymentController@trash')->name('PaymentDetail.trash');
            Route::any('paymentttrash', 'PaymentController@paymentttrash')->name('paymentttrash');
            Route::any('paymentTrashRestore', 'PaymentController@paymentTrashRestore')->name('paymentTrashRestore');


            Route::any('Department', 'DepartmentController@index')->name('Department');
            Route::any('newdepartment', 'DepartmentController@add')->name('newdepartment');
            Route::any('departmentSubmit', 'DepartmentController@save')->name('departmentSubmit');
            Route::any('edit_department', 'DepartmentController@edit_department')->name('edit_department');
            Route::any('deletedepartment', 'DepartmentController@delete')->name('deletedepartment');
            Route::any('departmenttrash', 'DepartmentController@trash')->name('departmenttrash');
            Route::any('departmenttrashlist', 'DepartmentController@departmenttrashlist')->name('departmenttrashlist');



            Route::any('salesmandetailssettings', 'SalesmanDetailController@salesmanindex', 'salesmandetailssettings');
            Route::any('keysalesmandetailssettings', 'SalesmanDetailController@keysalesmanindex', 'keysalesmandetailssettings');
            Route::any('Salesmandetailstrash', 'SalesmanDetailController@Salesmandetailstrash', 'Salesmandetailstrash');
            Route::any('salesmantrashs', 'SalesmanDetailController@trashsalesman', 'salesmantrashs');
            Route::any('Salesmandetailsrestore', 'SalesmanDetailController@Salesmandetailsrestore', 'Salesmandetailsrestore');
            Route::any('edit_salesman', 'SalesmanDetailController@edit_salesman', 'edit_salesman');
            Route::any('keyedit_salesman', 'SalesmanDetailController@keyedit_salesman', 'keyedit_salesman');
            Route::any('salesman_detailspdf', 'SalesmanDetailController@salesman_detailspdf', 'salesman_detailspdf');
            Route::any('view_salesman', 'SalesmanDetailController@view_salesman', 'view_salesman');
            Route::any('deletesalesmans', 'SalesmanDetailController@deletesalesman', 'deletesalesman');
            Route::any('keydeletesalesman', 'SalesmanDetailController@keydeletesalesman', 'keydeletesalesman');
            Route::any('addsalesmandetails', 'SalesmanDetailController@addsalesmandetails', 'addsalesmandetails');
            Route::any('keyaddsalesmandetails', 'SalesmanDetailController@keyaddsalesmandetails', 'keyaddsalesmandetails');
            Route::any('SalesmanSubmit', 'SalesmanDetailController@SalesmanSubmit', 'SalesmanSubmit');
            Route::any('keySalesmanSubmit', 'SalesmanDetailController@keySalesmanSubmit', 'keySalesmanSubmit');
            Route::get('salesmanaccounts', 'SalesmanDetailController@salesmanaccounts', 'salesmanaccounts');
            Route::post('salesman_accounts_detailslist', 'SalesmanDetailController@salesman_accounts_detailslist', 'salesman_accounts_detailslist');
            Route::post('getsalesmanaccounts', 'SalesmanDetailController@getsalesmanaccounts')->name('getsalesmanaccounts');
            Route::post('salesmanAccountSubmit', 'SalesmanDetailController@salesmanAccountSubmit')->name('salesmanAccountSubmit');
            Route::any('getsalesmanemail', 'SalesmanDetailController@getsalesmanemail')->name('getsalesmanemail');

            Route::any('salesdepartment', 'Salesdepartment@salesDepartment_settings')->name('salesdepartment');
            Route::any('salesdepartmentList', 'Salesdepartment@salesmandepartmentstore')->name('salesdepartmentList');
            Route::any('saledepartmentSubmit', 'Salesdepartment@salesdepartmentsubmitgroup')->name('saledepartmentSubmit');
            Route::any('getsalesdepartment', 'Salesdepartment@getsalesdepartmentsettings')->name('getsalesdepartment');
            Route::any('deletesalesdptInfo', 'Salesdepartment@deletesalesdptInfo')->name('deletesalesdptInfo');
            Route::any('salesdepartmenttrashshows', 'Salesdepartment@salesdepartment_index')->name('salesdepartmenttrashshows');
            Route::any('salesdpttrash', 'Salesdepartment@salesdepartmentList')->name('salesdepartmentList');
            Route::any('salesdptTrashRestore', 'Salesdepartment@salesDptTrashRestore')->name('salesdptTrashRestore');
            Route::get('salesdepartment', 'Salesdepartment@salesDepartment_settings')->name('salesdepartment');
            Route::get('salesdepartmentList', 'Salesdepartment@salesmandepartmentstore')->name('salesdepartmentList');
            Route::post('saledepartmentSubmit', 'Salesdepartment@salesdepartmentsubmitgroup')->name('saledepartmentSubmit');
            Route::post('getsalesdepartment', 'Salesdepartment@getsalesdepartmentsettings')->name('getsalesdepartment');
            Route::post('deletesalesdptInfo', 'Salesdepartment@deletesalesdptInfo')->name('deletesalesdptInfo');
            Route::get('salesdepartmenttrashshows', 'Salesdepartment@salesdepartment_index')->name('salesdepartmenttrashshows');
            Route::post('salesdpttrash', 'Salesdepartment@salesdepartmentList')->name('salesdepartmentList');
            Route::post('salesdptTrashRestore', 'Salesdepartment@salesDptTrashRestore')->name('salesdptTrashRestore');


            Route::any('salesmanroutesettings', 'Salesmanroutesettings@salesmanrout_settings')->name('salesmanroutesettings');
            Route::any('salesmanroutesettingList', 'Salesmanroutesettings@salesmanroutestore')->name('salesmanroutesettingList');
            Route::any('salesmanrouteSubmit', 'Salesmanroutesettings@salesmansubmitgroup')->name('salesmanrouteSubmit');
            Route::any('getsalesmanroutesettings', 'Salesmanroutesettings@getsalesmanroutesettings')->name('getsalesmanroutesettings');
            Route::any('deletesalesmanrouteInfo', 'Salesmanroutesettings@deletesalesmanrouteInfo')->name('deletesalesmanrouteInfo');
            Route::any('salesmanroutetrashshows', 'Salesmanroutesettings@salesmanroute_index')->name('salesmanroutetrashshows');
            Route::any('salesmanroutetrash', 'Salesmanroutesettings@salesmanroutesettingList')->name('salesmanroutetrash');
            Route::any('salesmanrouteTrashRestore', 'Salesmanroutesettings@salesmanrouteTrashRestore')->name('salesmanrouteTrashRestore');
            Route::any('salesman_routepdf', 'Salesmanroutesettings@salesman_routepdf')->name('salesman_routepdf');

            Route::any('vendoraccounts', 'vendoraccountsController@accountsList')->name('vendoraccounts');
            Route::any('vendoraccount_pdf', 'vendoraccountsController@vendoraccount_pdf')->name('vendoraccount_pdf');
            Route::post('getvendoraccounts', 'vendoraccountsController@getaccountdata')->name('getvendoraccounts');
            Route::post('VendorAccountSubmit', 'vendoraccountsController@accountsubmit')->name('VendorAccountSubmit');

            Route::any('supplieraccounts', 'supplieraccountsController@accountsList')->name('supplieraccounts');
            Route::post('SupAccountSubmit', 'supplieraccountsController@accountsubmit')->name('SupAccountSubmit');
            Route::post('getsupplieraccounts', 'supplieraccountsController@getaccountdata')->name('getsupplieraccounts');

            Route::any('customeraccounts', 'customeraccountsController@accountsList')->name('customeraccounts');
            Route::post('getcustomeraccounts', 'customeraccountsController@getaccountdata')->name('getcustomeraccounts');
            Route::post('CustAccountSubmit', 'customeraccountsController@accountsubmit')->name('CustAccountSubmit');

            Route::post('get-accounting-next-code', 'CommonController@getAccountingNextCode')->name('get-accounting-next-code');


            Route::any('signatureupload', 'FileUploadController@signatureupload')->name('signatureupload');
            Route::post('FileUpload', 'FileUploadController@store')->name('FileUpload');
            Route::post('crmcustdocumentFileUpload', 'FileUploadController@custdocumentInfoData')->name('custdocumentInfoData');
            Route::post('customerdocumentDelete', 'FileUploadController@customerdocumentDelete')->name('customerdocumentDelete');
            Route::post('supplierdocumentDelete', 'FileUploadController@supplierdocumentDelete')->name('supplierdocumentDelete');
            Route::post('vendordocumentDelete', 'FileUploadController@vendordocumentDelete')->name('vendordocumentDelete');
            Route::post('supdocumentFileUpload', 'FileUploadController@supdocumentFileUpload')->name('supdocumentFileUpload');
            Route::post('vendordocumentFileUpload', 'FileUploadController@vendordocumentFileUpload')->name('vendordocumentFileUpload');

            Route::get('download/{path}/{file}', 'DownloadsController@download');
            Route::get('vdownload/{path}/{uid}/{file}', 'DownloadsController@download1');
            Route::any('ccdownload', 'DownloadsController@ccdownload');
            Route::any('ssdownload', 'DownloadsController@ssdownload');
            Route::any('vvdownload', 'DownloadsController@vvdownload');


            Route::any('termsconditions', 'TermsandconditionsController@list')->name('list');
            Route::any('termsSubmit', 'TermsandconditionsController@termsSubmit')->name('termsSubmit');
            Route::any('termstrashdetails', 'TermsandconditionsController@termstrashdetails')->name('termstrashdetails');
            Route::any('deletetermsInfo', 'TermsandconditionsController@deletetermsInfo')->name('deletetermsInfo');
            Route::any('getTermsconditions', 'TermsandconditionsController@getTermsconditions')->name('getTermsconditions');


            Route::any('supplier-bank-account', 'SupplierBankAccountController@list')->name('supplier-bank-account');
            Route::any('supplier-bank-account-add', 'SupplierBankAccountController@add')->name('supplier-bank-account-add');
            Route::any('supplier-bank-account-save', 'SupplierBankAccountController@save')->name('supplier-bank-account-save');
            Route::any('supplier-bank-account-edit-view', 'SupplierBankAccountController@editView')->name('supplier-bank-account-edit-view');
            Route::any('supplier-bank-account-update', 'SupplierBankAccountController@update')->name('supplier-bank-account-update');
            Route::any('supplier-bank-account-specific', 'SupplierBankAccountController@specificSupplier')->name('supplier-bank-account-specific');
            Route::any('supplier-bank-account-pdf', 'SupplierBankAccountController@pdf')->name('supplier-bank-account-pdf');


            Route::any('customerdatamigration', 'DatamigrationController@customerdatamigration')->name('customerdatamigration');
            Route::any('customer_download', 'DatamigrationController@customer_download')->name('customer_download');
            Route::post('file-import-customer', 'DatamigrationController@submit_file_customer')->name('file-import-customer');
            Route::any('supplierdatamigration', 'DatamigrationController@supplierdatamigration')->name('supplierdatamigration');
            Route::any('supplier_download', 'DatamigrationController@supplier_download')->name('supplier_download');
            Route::post('file-import-supplier', 'DatamigrationController@submit_file_supplier')->name('file-import-supplier');

            Route::any('exportproductdatacustomer', 'CustomerController@exportproductdatacustomer')->name('exportproductdatacustomer');
            Route::any('exportproductdatasupplier', 'SupplierController@exportproductdatasupplier')->name('exportproductdatasupplier');


            Route::any('settingssuppliergroup', 'settings\SupplierController@supplier_grup')->name('Supplier Group');
            Route::any('settingssuppliertrashshows', 'settings\SupplierController@suppliergroupindex')->name('Supplier Group Trash');
            Route::any('settingssuppliergroupSubmit', 'settings\SupplierController@submitgroup')->name('suppliergroupSubmit');
            Route::any('settingsgetsuppliergrup', 'settings\SupplierController@getsuppliergrup')->name('getsuppliergrup');
            Route::any('settingsdeletesuppliergrupInfo', 'settings\SupplierController@deletesuppliergrupInfo')->name('deletesuppliergrupInfo');
            Route::any('settingssuppliergrupTrashRestore', 'settings\SupplierController@suppliergrupTrashRestore')->name('suppliergrupTrashRestore');

            Route::any('settingssuppliercategory', 'settings\SupplierController@category_list')->name('Supplier Category');
            Route::any('settingssuppliercatgrytrash', 'settings\SupplierController@suplircatgry_trash')->name('Supplier Catgry Trash');
            Route::any('settingssuppliercatgrySubmit', 'settings\SupplierController@Submit')->name('suppliercatgrySubmit');
            Route::any('settingsgetsuppliercatgry', 'settings\SupplierController@getsuppliercatgry')->name('getsuppliercatgry');
            Route::post('settingsdeletesuppliercatgryInfo', 'settings\SupplierController@deletesuppliercatgryInfo')->name('deletesuppliercatgryInfo');
            Route::any('settingssup_cat_TrashRestore', 'settings\SupplierController@sup_cat_TrashRestore')->name('sup_cat_TrashRestore');

            Route::any('settingssupplier_type', 'settings\SupplierController@suplir_type')->name('Supplier Type');
            Route::any('settingssuppliertrash', 'settings\SupplierController@suplir_trash')->name('Supplier Type Trash');
            Route::any('settingssuppliertypeSubmit', 'settings\SupplierController@typeSubmit')->name('suppliertypeSubmit');
            Route::any('settingsgetsuppliertype', 'settings\SupplierController@getsuppliertype')->name('getsuppliertype');
            Route::any('settingsdeletesuppliertypeInfo', 'settings\SupplierController@deletesuppliertypeInfo')->name('deletesupplierInfo');
            Route::any('settingstypeTrashRestores', 'settings\SupplierController@typeTrashRestores')->name('typeTrashRestores');

            Route::any('settingscustomergroup', 'settings\CustomerController@groupindex')->name('Customer Group');
            Route::any('settingsgrouptrash', 'settings\CustomerController@grouptrash')->name('settingsgrouptrash');
            Route::post('settingsCustGroupinfo', 'settings\CustomerController@groupsubmit')->name('CustGroupinfo');
            Route::post('settingsgetgroupupdate1', 'settings\CustomerController@groupupdate')->name('settingsgetgroupupdate');
            Route::post('settingsdeletegroup', 'settings\CustomerController@groupdelete')->name('deletegroup');
            Route::post('settingsgrouptrashrestore', 'settings\CustomerController@grouptrashrestore')->name('grouptrashrestore');

            Route::any('settingscustomercategorydetails', 'settings\CustomerController@custcategoryindex')->name('Customer Category Details');
            Route::any('settingscategorytrash', 'settings\CustomerController@trashcategory')->name('Supplier Category Trash');
            Route::any('settingsCategoryinfo', 'settings\CustomerController@Categorys_submit')->name('Categoryinfo');
            Route::post('settingsgetcategorylist', 'settings\CustomerController@categoryedit')->name('getcategorylist');
            Route::post('settingsdeletecategory', 'settings\CustomerController@deletecategory')->name('deletecategory');
            Route::post('settingscategoryTrashRestore', 'settings\CustomerController@trashrestore')->name('categoryTrashRestore');

            Route::any('settingscustomertypedetails', 'settings\CustomerController@custtypeindex')->name('Customer Type');
            Route::any('settingstypetrash', 'settings\CustomerController@typetrashs')->name('Customer Type Trash');
            Route::post('settingsTypesubmit', 'settings\CustomerController@typeSubmit')->name('Typesubmit');
            Route::post('settingsgettypeupdate', 'settings\CustomerController@type_updatess')->name('gettypeupdate');
            Route::post('settingsdeletetypeInfo', 'settings\CustomerController@deletetypeds')->name('deletetypeInfo');
            Route::post('settingstypeTrashRestore', 'settings\CustomerController@typetrashrestore')->name('typeTrashRestore');
        });
        // ./crm





        Route::get('/', 'HomeController@index')->name('home');
        Route::get('userInfo', 'UserinfoController@index')->name('userInfo.index');
        Route::any('get-terms-from-id', 'GeneralController@getTermsFromId')->name('get-terms-from-id');
        Route::get('test', 'HomeController@test')->name('test');

        Route::get('barcode', 'HomeController@barcode')
            ->name('barcode');

        Route::get('ProductCode', 'HomeController@ProductCode')
            ->name('ProductCode');

        Route::post('userInfo', 'UserinfoController@store')
            ->name('userInfo.store');

        Route::get('appPermission', 'UserPermissionController@appPermission')
            ->name('permissions.appPermission');
        Route::any('permission_store', 'UserPermissionController@store')
            ->name('permission_store');
        Route::any('permissionsforUser', 'UserPermissionController@permissionsforUser')
            ->name('permissionsforUser');

        Route::post('selectOptions/{table}/{id}', 'UserinfoController@selectOptions');
        Route::post('userListDropDown', 'UserinfoController@userListDropDown')
            ->name('userListDropDown');
        Route::get('userInfoSingle', 'UserinfoController@userInfoSingle')
            ->name('userInfoSingle');
        Route::get('userAdd', 'UserinfoController@userAdd')
            ->name('userAdd');
        Route::get('userShow/{id}', 'UserinfoController@userShow')
            ->name('userShow');
        Route::get('profilePdfDownload/{id}', 'UserinfoController@profilePdfDownload')
            ->name('profilePdfDownload');
        Route::get('editSingleUser/{id}', 'UserinfoController@edit')
            ->name('editSingleUser');
        Route::get('edit_customers/{id}', 'CustomerController@edits')
            ->name('edit_customers');
        Route::get('edit_suppliers/{id}', 'SupplierController@edits')
            ->name('edit_suppliers');
        Route::post('userList', 'UserinfoController@userList')
            ->name('userList');
        Route::get('permissions_menu', 'PermissionController@index')
            ->name('permissions_menu');
        Route::post('getSingleUserInfo', 'UserinfoController@getSingleUserInfo')
            ->name('getSingleUserInfo');
        Route::get('/findstartform', 'CustomerController@findstartform');
        Route::get('/findsupplierstartfrom', 'SupplierController@findsupplierstartfrom');

        Route::get('changelog', 'ChangelogController@index')
            ->name('changelog');

        Route::any('changepic', 'HomeController@changepic')->name('changepic');

        Route::any('profilepictureFileUpload', 'ProfileController@profilepictureFileUpload')->name('profilepictureFileUpload');
        Route::any('update-pofile', 'ProfileController@updateProfile')->name('update profile information');

        Route::any('submit-changepic', 'HomeController@submit_changepic')->name('submit-changepic');

        Route::resource('roles', 'RoleController');

        Route::resource('users', 'UserController');

        Route::resource('products', 'ProductController');

        Route::resource('permissions', 'PermissionController');

        Route::post('FileUpload', 'FileUploadController@store')
            ->name('FileUpload');
        Route::post('detUniqueID', 'CommonController@detUniqueID')
            ->name('detUniqueID');


        Route::get('salesdepartment', 'Salesdepartment@salesDepartment_settings')
            ->name('salesdepartment');
        Route::get('salesdepartmentList', 'Salesdepartment@salesmandepartmentstore')
            ->name('salesdepartmentList');
        Route::post('saledepartmentSubmit', 'Salesdepartment@salesdepartmentsubmitgroup')
            ->name('saledepartmentSubmit');
        Route::post('getsalesdepartment', 'Salesdepartment@getsalesdepartmentsettings')
            ->name('getsalesdepartment');
        Route::post('deletesalesdptInfo', 'Salesdepartment@deletesalesdptInfo')
            ->name('deletesalesdptInfo');
        Route::get('salesdepartmenttrashshows', 'Salesdepartment@salesdepartment_index')
            ->name('salesdepartmenttrashshows');
        Route::post('salesdpttrash', 'Salesdepartment@salesdepartmentList')
            ->name('salesdepartmentList');
        Route::post('salesdptTrashRestore', 'Salesdepartment@salesDptTrashRestore')
            ->name('salesdptTrashRestore');

        Route::any('view1', 'view1@DummyController')
            ->name('view1');

        Route::any('view2', 'view2@DummyController')
            ->name('view2');

        Route::any('view3', 'view3@DummyController')
            ->name('view3');

        Route::any('view4', 'view4@DummyController')
            ->name('view4');

        Route::any('view5', 'view5@DummyController')
            ->name('view5');



        Route::post('register', 'Auth\RegistersUsers@showRegistrationForm')->name('register');

        Route::get('/home', 'HomeController@index')
            ->name('home');

        Route::any('c/{id}/{branch}', array(
            'as'   => 'home',
            'uses' => 'HomeController@show',
        ));
        Route::any('pdftest', array(
            'as'   => 'home',
            'uses' => 'HomeController@generate_pdf',
        ));






        Route::resource('roles', 'RoleController');

        Route::resource('users', 'UserController');

        Route::resource('products', 'ProductController');

        Route::resource('permissions', 'PermissionController');

        Route::get('inventory', 'inventory\DashboardController@index')->name('home');
        Route::get('inventory_dashboard', 'inventory\DashboardController@index')->name('Inventory Dashboard');
        Route::any('product_download', 'inventory\DashboardController@product_download')->name('product_download');
        Route::any('exportproductdata', 'inventory\DashboardController@exportdata')->name('exportproductdata');
        Route::post('file-import-product', 'inventory\DashboardController@submit_file')->name('file-import-product');
        Route::get('Dashboard', 'inventory\DashboardController@view')->name('Dashboard');
        Route::get('/getoptions', 'inventory\ProductController@Getoptions');

        Route::any('WarehouseList', 'inventory\WarehouseController@WarehouseListing')
            ->name('WarehouseListing');

        Route::any('Add-Warehouse', 'inventory\WarehouseController@NewWarehouse')
            ->name('NewWarehouse');

        Route::any('warehouseListings', 'inventory\WarehouseController@warehouseListings')
            ->name('warehouseListings');
        Route::any('warehouse_submit', 'inventory\WarehouseController@warehouse_submit')
            ->name('warehouse_submit');
        Route::any('edit_warehouse', 'inventory\WarehouseController@edit_warehouse')
            ->name('edit_warehouse');
        Route::any('deletewarehouse', 'inventory\WarehouseController@deletewarehouse')
            ->name('deletewarehouse');
        Route::any('deletewarehousetrashdetails', 'inventory\WarehouseController@deletewarehousetrashdetails')
            ->name('deletewarehousetrashdetails');
        Route::any('Trash-Warehouse', 'inventory\WarehouseController@trash')
            ->name('Trash-Warehouse');
        Route::any('warehousetrashListings', 'inventory\WarehouseController@warehousetrashListings')
            ->name('warehousetrashListings');
        Route::any('restorewarehouse', 'inventory\WarehouseController@restorewarehouse')
            ->name('restorewarehouse');

        Route::any('view_warehouse', 'inventory\WarehouseController@view_warehouse')
            ->name('view_warehouse');

        Route::any('WarehouseManagerList', 'inventory\WarehouseManagerController@WarehouseManagerListing')
            ->name('WarehouseManagerListing');

        Route::any('Add-WarehouseManager', 'inventory\WarehouseManagerController@NewWarehouseManager')
            ->name('NewWarehouseManager');

        Route::any('WarehousemanagersListings', 'inventory\WarehouseManagerController@WarehousemanagersListings')
            ->name('WarehousemanagersListings');

        Route::any('warehousemanagersubmit', 'inventory\WarehouseManagerController@warehousemanagersubmit')
            ->name('warehousemanagersubmit');

        Route::any('edit_warehouse_manger', 'inventory\WarehouseManagerController@edit_warehouse_manger')
            ->name('edit_warehouse_manger');
        Route::any('deletewarehousemanager', 'inventory\WarehouseManagerController@deletewarehousemanager')
            ->name('deletewarehousemanager');
        Route::any('deletewarehousemanagertrashlist', 'inventory\WarehouseManagerController@deletewarehousemanagertrashlist')
            ->name('deletewarehousemanagertrashlist');
        Route::any('Trash-WarehouseManager', 'inventory\WarehouseManagerController@trash')
            ->name('Trash-WarehouseManager');
        Route::any('WarehousemanagersListings_trash', 'inventory\WarehouseManagerController@WarehousemanagersListings_trash')
            ->name('WarehousemanagersListings_trash');
        Route::any('restorewarehousemanager', 'inventory\WarehouseManagerController@restorewarehousemanager')
            ->name('restorewarehousemanager');
        Route::any('view_warehouse_manger', 'inventory\WarehouseManagerController@view_warehouse_manger')
            ->name('view_warehouse_manger');
        Route::any('WarehouseInchargeList', 'inventory\WarehouseInchargeController@WarehouseInchargeListing')
            ->name('WarehouseInchargeListing');

        Route::any('Add-WarehouseIncharge', 'inventory\WarehouseInchargeController@NewWarehouseIncharge')
            ->name('NewWarehouseIncharge');

        Route::any('warehouseinchargesubmit', 'inventory\WarehouseInchargeController@incharge_submit')
            ->name('warehouseinchargesubmit');

        Route::any('WarehouseInchargeListings', 'inventory\WarehouseInchargeController@WarehouseInchargeListings')
            ->name('WarehouseInchargeListings');

        Route::any('edit_warehouse_incharge', 'inventory\WarehouseInchargeController@warehouseincharge_update')
            ->name('edit warehouse incharge');

        Route::any('deletewarehouseincharge', 'inventory\WarehouseInchargeController@deletewarehouseincharge')
            ->name('deletewarehouseincharge');
        Route::any('trashdeletewarehouseincharge', 'inventory\WarehouseInchargeController@trashdeletewarehouseincharge')
            ->name('trashdeletewarehouseincharge');
        Route::any('WarehouseInchargeListing_trash', 'inventory\WarehouseInchargeController@trash')
            ->name('WarehouseInchargeListing_trash');
        Route::any('Trash-WarehouseIncharge', 'inventory\WarehouseInchargeController@trash')
            ->name('Trash-WarehouseIncharge');

        Route::any('WarehouseInchargeListings_trash', 'inventory\WarehouseInchargeController@WarehouseInchargeListings_trash')
            ->name('WarehouseInchargeListings_trash');
        Route::any('restoreincharge', 'inventory\WarehouseInchargeController@restoreincharge')
            ->name('restoreincharge');
        Route::any('view_warehouse_incharge', 'inventory\WarehouseInchargeController@view_warehouse_incharge')
            ->name('view_warehouse_incharge');

        Route::any('ProductList', 'inventory\ProductController@ProductListing')
            ->name('ProductListing');

        Route::any('ProductpurchaseListing', 'inventory\ProductController@ProductpurchaseListing')
            ->name('ProductpurchaseListing');

        Route::any('ProductsalesListing', 'inventory\ProductController@ProductsalesListing')
            ->name('ProductsalesListing');

        Route::any('ProductListView', 'inventory\ProductController@productview')
            ->name('ProductListingView');

        Route::any('Add-Product', 'inventory\ProductController@NewProduct')
            ->name('NewProduct');
        Route::any('product_submits', 'inventory\ProductController@product_submit')
            ->name('product_submit');

        Route::any('warproduct_submits', 'inventory\ProductController@warproduct_submits')
            ->name('warproduct_submits');

        Route::any('edit_product_details', 'inventory\ProductController@edit_product_details')
            ->name('edit_product_details');
        Route::any('Trash-Product', 'inventory\ProductController@trash')
            ->name('Trash-Product');
        Route::any('productdetails_trash_lists', 'inventory\ProductController@trash_lists')
            ->name('productdetails_trash_lists');
        Route::any('deleteproducts', 'inventory\ProductController@deleteproducts')
            ->name('deleteproducts');
        Route::any('productsrecover', 'inventory\ProductController@recover')
            ->name('productsrecover');
        Route::any('getsellingunits', 'inventory\ProductController@getsellingunits')
            ->name('getsellingunits');

        Route::any('AdjustmentList', 'inventory\InventoryAdjustmentController@AdjustmentListing')
            ->name('AdjustmentListing');

        Route::any('Add-Adjustment', 'inventory\InventoryAdjustmentController@NewAdjustment')
            ->name('NewAdjustment');
        Route::any('UnitList', 'inventory\UnitController@UnitListing')
            ->name('UnitListing');
        Route::any('Add-Unit', 'inventory\UnitController@NewUnit')
            ->name('NewUnit');
        Route::any('ProductunitSubmit', 'inventory\UnitController@creates')
            ->name('ProductunitSubmit');
        Route::any('edit_productunit', 'inventory\UnitController@edit_productunit')
            ->name('edit_productunit');

        Route::any('DeleteProdctunits', 'inventory\UnitController@destroys')
            ->name('DeleteProdctunits');
        Route::any('unittrash', 'inventory\UnitController@unittrash')
            ->name('unittrash');
        Route::any('restoreinventoryunit', 'inventory\UnitController@restoreinventoryunit')
            ->name('restoreinventoryunit');
        Route::any('DeleteTrashProdctunits', 'inventory\UnitController@DeleteTrashProdctunits')
            ->name('DeleteTrashProdctunits');

        Route::any('BrandList', 'inventory\BrandController@BrandListing')
            ->name('BrandListing');

        Route::any('Add-Brand', 'inventory\BrandController@NewBrand')
            ->name('NewBrand');
        Route::any('editbrand', 'inventory\BrandController@editbrand')
            ->name('Edit-Brand');
        Route::any('submit-brand', 'inventory\BrandController@stores')
            ->name('submit-brand');
        Route::any('delete-brand', 'inventory\BrandController@destroy')
            ->name('delete-brand');
        Route::any('brandtrashlist', 'inventory\BrandController@brandtrashlist')
            ->name('brandtrashlist');

        Route::any('restorebrand', 'inventory\BrandController@restorebrand')
            ->name('restorebrand');
        Route::any('DeleteTrashProdctbrand', 'inventory\BrandController@DeleteTrashProdctbrand')
            ->name('DeleteTrashProdctbrand');

        Route::any('ManufacturerList', 'inventory\ManufacturerController@ManufacturerListing')
            ->name('ManufacturerListing');

        Route::any('Add-Manufacturer', 'inventory\ManufacturerController@NewManufacturer')
            ->name('NewManufacturer');
        Route::any('editmanufacturer', 'inventory\ManufacturerController@editmanufacturer')
            ->name('Edit-manufacture');
        Route::any('submit-manufacturer', 'inventory\ManufacturerController@stores')
            ->name('submit-manufacturer');
        Route::any('delete-manufacture', 'inventory\ManufacturerController@destroy')
            ->name('delete-manufacture');
        Route::any('manufacturetrash', 'inventory\ManufacturerController@manufacturetrash')
            ->name('manufacturetrash');
        Route::any('trash_delete_manufacture', 'inventory\ManufacturerController@trash_delete_manufacture')
            ->name('trash_delete_manufacture');
        Route::any('restoremanufacture', 'inventory\ManufacturerController@restoremanufacture')
            ->name('restoremanufacture');
        Route::any('DeleteTrashProdctmanufacture', 'inventory\ManufacturerController@DeleteTrashProdctmanufacture')
            ->name('DeleteTrashProdctmanufacture');
        Route::any('AttributeList', 'inventory\AttributeController@AttributeListing')
            ->name('AttributeListing');

        Route::any('Add-Attribute', 'inventory\AttributeController@NewAttribute')
            ->name('NewAttribute');
        Route::any('submit-attribute', 'inventory\AttributeController@submitattribute')
            ->name('submit-attribute');

        Route::any('delete-attribute', 'inventory\AttributeController@destroy', 'delete-attribute');
        Route::any('edit_attribute', 'inventory\AttributeController@editattribute', 'edit_attribute');
        Route::any('trashlist', 'inventory\AttributeController@attributetrash', 'trashlist');
        Route::any('trashdelete-attribute', 'inventory\AttributeController@trashdelete_attribute', 'trashdelete-attribute');
        Route::any('attributerestore', 'inventory\AttributeController@attributerestore', 'attributerestore');
        Route::any('attribute_trash', 'inventory\AttributeController@attribute_trash', 'attribute_trash');

        Route::any('AccountsList', 'inventory\AccountsController@AccountsListing')
            ->name('AccountsListing');

        Route::any('Add-Account', 'inventory\AccountsController@NewAccount')
            ->name('NewAccount');

        Route::any('accounts_list', 'inventory\AccountsController@accounts_list')
            ->name('accounts_list');

        Route::any('accounts_submit', 'inventory\AccountsController@accounts_submit')
            ->name('accounts_submit');

        Route::any('edit_accounts', 'inventory\AccountsController@edit_accounts')
            ->name('edit_accounts');

        Route::any('deleteaccounts', 'inventory\AccountsController@deleteaccounts')
            ->name('deleteaccounts');

        Route::any('Trash-Account', 'inventory\AccountsController@trash')
            ->name('Trash-Account');

        Route::any('accounts_trash_list', 'inventory\AccountsController@trash_list')
            ->name('accounts_trash_list');
        Route::any('restoreaccounts', 'inventory\AccountsController@restoreaccounts')
            ->name('restoreaccounts');

        Route::any('StoreManagement', 'inventory\StoreManagementController@StoreManagementListing')
            ->name('StoreManagement');

        Route::any('Add-StoreManagement', 'inventory\StoreManagementController@Newstoremanagement')
            ->name('Add-StoreManagement');
        Route::any('storemanagement_submit', 'inventory\StoreManagementController@storemanagement_submit')
            ->name('storemanagement_submit');
        Route::any('edit_store', 'inventory\StoreManagementController@edit_store')
            ->name('edit_store');
        Route::any('deletestore', 'inventory\StoreManagementController@deletestore')
            ->name('deletestore');
        Route::any('deletestoredetails', 'inventory\StoreManagementController@deletestoredetails')
            ->name('deletestoredetails');
        Route::any('Trash-StoreManagement', 'inventory\StoreManagementController@trash')
            ->name('Trash-StoreManagement');
        Route::any('restorestore', 'inventory\StoreManagementController@restorestore')
            ->name('restorestore');

        Route::any('view_store', 'inventory\StoreManagementController@view_store')
            ->name('view_store');

        Route::any('RackManagement', 'inventory\RackManagementController@RackManagementListing')
            ->name('RackManagement');

        Route::any('Add-RackManagement', 'inventory\RackManagementController@Newrackmanagement')
            ->name('Add-RackManagement');
        Route::any('rackmanagement_submit', 'inventory\RackManagementController@rackmanagement_submit')
            ->name('rackmanagement_submit');
        Route::any('edit_rack', 'inventory\RackManagementController@edit_rack')
            ->name('edit_rack');
        Route::any('deleterack', 'inventory\RackManagementController@deleterack')
            ->name('deleterack');
        Route::any('deleterackdetails', 'inventory\RackManagementController@deleterackdetails')
            ->name('deleterackdetails');

        Route::any('Trash-RackManagement', 'inventory\RackManagementController@trash')
            ->name('Trash-RackManagement');
        Route::any('restorerack', 'inventory\RackManagementController@restorerack')
            ->name('restorerack');

        Route::any('view_rack', 'inventory\RackManagementController@view_rack')->name('view_rack');
        Route::any('CategoryList', 'inventory\CategoryController@categorytListing')
            ->name('CategoryList');
        Route::any('Add-category', 'inventory\CategoryController@addcategory')
            ->name('Add-category');
        Route::any('edit_category', 'inventory\CategoryController@editcategory')
            ->name('edit_category');

        Route::any('submit-category', 'inventory\CategoryController@submitcategory')
            ->name('submit-category');
        Route::any('delete-category', 'inventory\CategoryController@deletecategory')
            ->name('delete-category');
        Route::any('CategoryTrash', 'inventory\CategoryController@trashform')
            ->name('CategoryTrash');
        Route::any('ProductCategoryRestoreTrash', 'inventory\CategoryController@ProductCategoryRestoreTrash')
            ->name('ProductCategoryRestoreTrash');
        Route::any('trashdelete-category', 'inventory\CategoryController@trashdeletecategory')
            ->name('trashdelete-category');

        Route::post('setwarehouse', 'inventory\FileUploadControllers@setwarehouse')
            ->name('setwarehouse');
        Route::any('detUniqueID', 'inventory\CommonController@detUniqueID')
            ->name('detUniqueID');
        Route::post('brandstoreFileUpload', 'inventory\FileUploadControllers@brandstore')
            ->name('brandstoreFileUpload');
        Route::post('ManufactureFileUpload', 'inventory\FileUploadControllers@manufacturestore')
            ->name('ManufactureFileUpload');
        Route::post('ProductFileUpload', 'inventory\FileUploadControllers@productstore')
            ->name('ProductFileUpload');

        Route::post('AssetFileUpload', 'inventory\FileUploadControllers@assetstore')
            ->name('AssetFileUpload');

        Route::post('ProductFileUpload1', 'inventory\FileUploadControllers@productstore1')
            ->name('ProductFileUpload1');

        Route::post('custdocumentFileUpload', 'inventory\FileUploadControllers@custdocumentFileUpload')
            ->name('custdocumentFileUpload');
        Route::any('StoreManagers', 'inventory\StoremanagerController@StoreManagers')
            ->name('StoreManagers');
        Route::any('Trash-storemanager', 'inventory\StoremanagerController@trash')
            ->name('Trash-storemanager');
        Route::any('Add-storemanager', 'inventory\StoremanagerController@add')
            ->name('Add-storemanager');
        Route::any('storemanagersubmit', 'inventory\StoremanagerController@storemanagersubmit')
            ->name('storemanagersubmit');
        Route::any('deletestoremanager', 'inventory\StoremanagerController@deletestoremanager')
            ->name('deletestoremanager');
        Route::any('storemanagerupdate', 'inventory\StoremanagerController@storemanagerupdate')
            ->name('storemanagerupdate');
        Route::any('storemanagertrashrestore', 'inventory\StoremanagerController@storemanagertrashrestore')
            ->name('storemanagertrashrestore');
        Route::any('storemanagertrashdelete', 'inventory\StoremanagerController@storemanagertrashdelete')
            ->name('storemanagertrashdelete');

        Route::any('view_storemanager', 'inventory\StoremanagerController@view_storemanager')
            ->name('view_storemanager');

        Route::any('Storekeepers', 'inventory\StorekeeperController@Storekeepers')
            ->name('Storekeepers');
        Route::any('Trash-storekeeper', 'inventory\StorekeeperController@trash')
            ->name('Trash-storekeeper');
        Route::any('Add-storekeeper', 'inventory\StorekeeperController@add')
            ->name('Add-storekeeper');
        Route::any('storekeepersubmit', 'inventory\StorekeeperController@storekeepersubmit')
            ->name('storekeepersubmit');
        Route::any('deletestorekeeper', 'inventory\StorekeeperController@deletestorekeeper')
            ->name('deletestorekeeper');
        Route::any('storekeeperupdate', 'inventory\StorekeeperController@storekeeperupdate')
            ->name('storekeeperupdate');
        Route::any('storekeepertrashrestore', 'inventory\StorekeeperController@storekeepertrashrestore')
            ->name('storekeepertrashrestore');
        Route::any('storekeepertrashdelete', 'inventory\StorekeeperController@storekeepertrashdelete')
            ->name('storekeepertrashdelete');
        Route::any('view_storekeeper', 'inventory\StorekeeperController@view_storekeeper')
            ->name('view_storekeeper');
        Route::any('Storeincharge', 'inventory\StoreinchargeController@Storeincharge')
            ->name('Storeincharge');
        Route::any('Trash-storeincharge', 'inventory\StoreinchargeController@trash')
            ->name('Trash-storeincharge');
        Route::any('Add-storeincharge', 'inventory\StoreinchargeController@add')
            ->name('Add-storeincharge');
        Route::any('storeinchargesubmit', 'inventory\StoreinchargeController@storeinchargesubmit')
            ->name('storeinchargesubmit');
        Route::any('deletestoreincharge', 'inventory\StoreinchargeController@deletestoreincharge')
            ->name('deletestoreincharge');
        Route::any('storeinchargeupdate', 'inventory\StoreinchargeController@storeinchargeupdate')
            ->name('storeinchargeupdate');
        Route::any('storeinchargetrashrestore', 'inventory\StoreinchargeController@storeinchargetrashrestore')
            ->name('storeinchargetrashrestore');
        Route::any('storeinchargetrashdelete', 'inventory\StoreinchargeController@storeinchargetrashdelete')
            ->name('storeinchargetrashdelete');

        Route::any('view_storeincharge', 'inventory\StoreinchargeController@view_storeincharge')
            ->name('view_storeincharge');
        Route::any('Batchlist', 'inventory\BatchlistControllers@Batchlist')
            ->name('Batchlist');
        Route::any('Add-batch', 'inventory\BatchlistControllers@addbatch')
            ->name('Add-batch');
        Route::any('edit_batch', 'inventory\BatchlistControllers@edit')
            ->name('edit_batch');

        Route::any('submit-batch', 'inventory\BatchlistControllers@submit')
            ->name('submit-batch');
        Route::any('delete-batch', 'inventory\BatchlistControllers@delete')
            ->name('delete-batch');
        Route::any('batchTrash', 'inventory\BatchlistControllers@Trash')
            ->name('batchTrash');
        Route::any('batch_restore', 'inventory\BatchlistControllers@restore')
            ->name('batch_restore');
        Route::any('trashdelete-batch', 'inventory\BatchlistControllers@trashdeletecategory')
            ->name('trashdelete-batch');

        Route::any('rackmanager', 'inventory\RackmanagerController@listing')
            ->name('rackmanager');

        Route::any('Add-rackmanager', 'inventory\RackmanagerController@add')
            ->name('NewrackManager');
        Route::any('rackmanagersubmit', 'inventory\RackmanagerController@rackmanagersubmit')
            ->name('rackmanagersubmit');

        Route::any('rackmanagerupdate', 'inventory\RackmanagerController@rackmanagerupdate')
            ->name('rackmanagerupdate');
        Route::any('deleterackmanager', 'inventory\RackmanagerController@deleterackmanager')
            ->name('deleterackmanager');
        Route::any('rackmanagertrashdelete', 'inventory\RackmanagerController@rackmanagertrashdelete')
            ->name('rackmanagertrashdelete');
        Route::any('Trash-rackmanager', 'inventory\RackmanagerController@trash')
            ->name('Trash-rackmanager');
        Route::any('rackmanagertrashrestore', 'inventory\RackmanagerController@rackmanagertrashrestore')
            ->name('rackmanagertrashrestore');

        Route::any('view_rackmanager', 'inventory\RackmanagerController@view_rackmanager')->name('view_rackmanager');
        Route::any('rackincharge', 'inventory\RackinchargeController@listing')
            ->name('rackincharge');

        Route::any('Add-rackincharge', 'inventory\RackinchargeController@add')
            ->name('NewrackIncharge');
        Route::any('rackinchargesubmit', 'inventory\RackinchargeController@rackinchargesubmit')
            ->name('rackinchargesubmit');

        Route::any('rackinchargeupdate', 'inventory\RackinchargeController@rackinchargeupdate')
            ->name('rackinchargeupdate');
        Route::any('deleterackincharge', 'inventory\RackinchargeController@deleterackincharge')
            ->name('deleterackincharge');
        Route::any('rackinchargetrashdelete', 'inventory\RackinchargeController@rackinchargetrashdelete')
            ->name('rackinchargetrashdelete');
        Route::any('Trash-rackincharge', 'inventory\RackinchargeController@trash')
            ->name('Trash-rackincharge');
        Route::any('rackinchargetrashrestore', 'inventory\RackinchargeController@rackinchargetrashrestore')
            ->name('rackinchargetrashrestore');

        Route::any('DeleteTrashProduct', 'inventory\ProductController@DeleteTrashProduct')
            ->name('DeleteTrashProduct');
        Route::any('getsupplier_vendor1', 'inventory\ProductController@getsupplier_vendor')->name('getsupplier_vendor');

        Route::any('getproduct_purchase', 'purchase\PurchaseController@getproduct')->name('getproduct_purchase');

        Route::any('view_rackincharge', 'inventory\RackinchargeController@view_rackincharge')->name('view_rackincharge');

        Route::any('newmenu', 'inventory\NewmenuController@newmenu')->name('newmenu');
        Route::any('inventorydashboard', 'inventory\DashboardController@inventorydashboard')->name('newmenu');
        Route::any('stockadjustment_inventory', 'inventory\StockadjustmentController@stockadjustment_inventory')->name('stockadjustment');

        Route::any('sales', array('as' => 'home', 'uses' => 'sales\DashboardController@show'));
        Route::any('InvoiceList', 'sales\InvoiceController@InvoiceListing')
            ->name('InvoiceListing');

        Route::any('Add-Invoice', 'sales\InvoiceController@NewInvoice')
            ->name('NewInvoice');
        Route::any('getproductvariants', 'sales\InvoiceController@getproductvariants')->name('getproductvariants');
        Route::any('getproduct_salesprice', 'sales\InvoiceController@getproduct_salesprice')
            ->name('getproduct_salesprice');
        Route::any('sales_submit', 'sales\InvoiceController@sales_submit')
            ->name('sales_submit');
        Route::any('View-SalesInvoice', 'sales\InvoiceController@View_invoice')
            ->name('ViewInvoice');
        Route::any('getvatgroup_percentage', 'sales\InvoiceController@getvatgroup_percentage')
            ->name('getvatgroup_percentage');
        Route::any('getproductbatches', 'sales\InvoiceController@getproductbatches')
            ->name('getproductbatches');
        Route::any('getproduct_batch', 'sales\InvoiceController@getproduct_batch')
            ->name('getproduct_batch');
        Route::any('getproduct_name_details', 'sales\InvoiceController@getproduct_name_details')
            ->name('getproduct_name_details');
        Route::any('edit_sales_invoice', 'sales\InvoiceController@edit_sales_invoice')
            ->name('edit_sales_invoice');
        Route::any('getproductstockdetails', 'sales\InvoiceController@getproductstockdetails')
            ->name('getproductstockdetails');
        Route::any('Customer_submit', 'sales\InvoiceController@Customer_submit')
            ->name('Customer_submit');
        Route::any('invoice_delete', 'sales\InvoiceController@invoice_delete')
            ->name('invoice_delete');

        Route::any('salesorder', 'sales\SalesorderController@salesorder')
            ->name('salesorder');
        Route::any('View-Salesorder', 'sales\SalesorderController@view')->name('View-Salesorder');
        Route::any('Add-salesorder', 'sales\SalesorderController@newsalesorder')
            ->name('Add-salesorder');
        Route::any('sales_order_submit', 'sales\SalesorderController@submit')
            ->name('sales_order_submit');
        Route::any('edit_sales_order', 'sales\SalesorderController@edit_sales_order')
            ->name('edit_sales_order');
        Route::any('update_sales_order', 'sales\SalesorderController@update_sales_order')->name('update_sales_order');
        Route::any('sales_order_product_submit', 'sales\SalesorderController@sales_order_product_submit')->name('sales_order_product_submit');
        Route::any('convert_to_delivery', 'sales\SalesorderController@convert_to_delivery')->name('convert_to_delivery');
        Route::any('convert_delivery_submit', 'sales\SalesorderController@convert_delivery_submit')->name('convert_delivery_submit');
        Route::any('sales_order_confirm', 'sales\SalesorderController@sales_order_confirm')->name('sales_order_confirm');
        Route::any('convert_invoice_submit', 'sales\SalesorderController@convert_invoice_submit')->name('convert_invoice_submit');

        Route::any('Sales-Settings', 'sales\SalesSettingsController@sales_settings')
            ->name('Sales-Settings');
        Route::any('vat', 'sales\VatController@list')
            ->name('vat');

        Route::any('Add-vat', 'sales\VatController@add')
            ->name('Add-vat');
        Route::any('vatTrash', 'sales\VatController@trash')
            ->name('vatTrash');
        Route::any('vatsubmit', 'sales\VatController@submit')
            ->name('vatsubmit');
        Route::any('edit_vat', 'sales\VatController@edit')
            ->name('edit_vat');
        Route::any('delete-vat', 'sales\VatController@delete')
            ->name('delete-vat');
        Route::any('restore-vat', 'sales\VatController@restore')
            ->name('restore-vat');
        Route::any('trashdelete-vat', 'sales\VatController@trashdelete')
            ->name('trashdelete-vat');
        Route::any('vatgroup', 'sales\VatgroupController@list')
            ->name('vatgroup');

        Route::any('Add-vatgroups', 'sales\VatgroupController@add')
            ->name('Add-vatgroups');
        Route::any('vatgroupsTrash', 'sales\VatgroupController@trash')
            ->name('vatgroupsTrash');
        Route::any('vatgroupsubmit', 'sales\VatgroupController@submit')
            ->name('vatgroupsubmit');
        Route::any('edit_vatgroups', 'sales\VatgroupController@edit')
            ->name('edit_vatgroups');
        Route::any('delete-vatgroups', 'sales\VatgroupController@delete')
            ->name('delete-vatgroups');
        Route::any('restore-vatgroups', 'sales\VatgroupController@restore')
            ->name('restore-vatgroups');
        Route::any('trashdelete-vatgroups', 'sales\VatgroupController@trashdelete')
            ->name('trashdelete-vatgroups');
        Route::any('stockadjustment', 'sales\StockadjustmentController@list')
            ->name('stockadjustment');
        Route::any('edit_stock_adjustment', 'sales\StockadjustmentController@edit')->name('edit_stock_adjustment');
        Route::any('stockadjustmentsubmit', 'sales\StockadjustmentController@update')->name('stockadjustmentsubmit');
        Route::any('deliveryorder', 'sales\DeliveryorderController@list')
            ->name('deliveryorder');
        Route::any('convertinvoice', 'sales\DeliveryorderController@invoice')
            ->name('convertinvoice');
        Route::any('convert_invoice_submit_del', 'sales\DeliveryorderController@convert_invoice_submit_del')
            ->name('convert_invoice_submit_del');
        Route::any('deliveryorder_view', 'sales\DeliveryorderController@deliveryorder_view')
            ->name('deliveryorder_view');
        Route::any('deliveryorder_view', 'sales\DeliveryorderController@deliveryorder_view')
            ->name('deliveryorder_view');
        Route::any('deliveryorder_pdf', 'sales\NewQuotationController@deliveryorder_pdf')
            ->name('deliveryorder_pdf');
        Route::any('categoryprice', 'sales\CategorypriceController@list')
            ->name('categoryprice');
        Route::any('categoryprice_update', 'sales\CategorypriceController@update')
            ->name('categoryprice_update');
        Route::any('category_price_submit', 'sales\CategorypriceController@submit')
            ->name('category_price_submit');
        Route::any('purchase_number', 'sales\PurchasenumberController@list')
            ->name('purchasenumber');
        Route::any('Add-purchasenumber', 'sales\PurchasenumberController@add')
            ->name('Add-purchasenumber');
        Route::any('purchasenumbersubmit', 'sales\PurchasenumberController@submit')
            ->name('purchasenumbersubmit');
        Route::any('purchasenumber_edit', 'sales\PurchasenumberController@edit')
            ->name('purchasenumber_edit');
        Route::any('delete-purchasenumber', 'sales\PurchasenumberController@delete')
            ->name('delete-purchasenumber');
        Route::any('purchasenumberTrash', 'sales\PurchasenumberController@trash')
            ->name('purchasenumberTrash');
        Route::any('purchasenumber_restore', 'sales\PurchasenumberController@restore')
            ->name('purchasenumber_restore');
        Route::any('salesordernumber', 'sales\SalesordernumberController@list')
            ->name('salesordernumber');
        Route::any('Add-salesordernumber', 'sales\SalesordernumberController@add')
            ->name('Add-salesordernumber');
        Route::any('salesordernumbersubmit', 'sales\SalesordernumberController@submit')
            ->name('salesordernumbersubmit');
        Route::any('salesordernumber_edit', 'sales\SalesordernumberController@edit')
            ->name('salesordernumber_edit');
        Route::any('delete-salesordernumber', 'sales\SalesordernumberController@delete')
            ->name('delete-salesordernumber');
        Route::any('salesordernumberTrash', 'sales\SalesordernumberController@trash')
            ->name('salesordernumberTrash');
        Route::any('salesordernumbernumber_restore', 'sales\SalesordernumberController@restore')
            ->name('salesordernumbernumber_restore');
        Route::any('invoicenumber', 'sales\InvoiceController@list')
            ->name('invoicenumber');
        Route::any('Add-invoicenumber', 'sales\InvoiceController@add')
            ->name('Add-invoicenumber');
        Route::any('invoicenumbersubmit', 'sales\InvoiceController@submit')
            ->name('invoicenumbersubmit');
        Route::any('invoicenumber_edit', 'sales\InvoiceController@edit')
            ->name('invoicenumber_edit');
        Route::any('delete-invoicenumber', 'sales\InvoiceController@delete')
            ->name('delete-invoicenumber');
        Route::any('invoicenumberTrash', 'sales\InvoiceController@trash')
            ->name('invoicenumberTrash');
        Route::any('invoicenumber_restore', 'sales\InvoiceController@restore')
            ->name('invoicenumber_restore');
        Route::any('Quotation', 'sales\QuotationController@Quotationlisting')
            ->name('Quotationlist');

        Route::any('Add-Quotation', 'sales\QuotationController@NewQuotation')
            ->name('NewQuotation');

        Route::any('quotation_submit', 'sales\QuotationController@quotation_submit')
            ->name('quotation_submit');

        Route::any('edit_quotation', 'sales\QuotationController@edit_quotation')->name('edit_quotation');
        Route::any('delete_quotation', 'sales\QuotationController@delete_quotation')->name('delete_quotation');

        Route::any('getcustomeraddress', 'sales\InvoiceController@getcustomeraddress')->name('getcustomeraddress');

        Route::any('getcustomeraddressquote', 'sales\InvoiceController@getcustomeraddressquote')->name('getcustomeraddressquote');

        Route::any('gettermsquote', 'sales\InvoiceController@gettermsquote')->name('gettermsquote');

        Route::any('getcurrencydatavalue', 'sales\InvoiceController@getcurrencydatavalue')->name('getcurrencydatavalue');

        Route::any('getsupplier_vendor', 'sales\QuotationController@getsupplier_vendor')
            ->name('getsupplier_vendor');

        Route::any('getwarehouse', 'sales\QuotationController@getwarehouse')
            ->name('getwarehouse');

        Route::any('getcostheadrate', 'sales\QuotationController@getcostheadrate')->name('getcostheadrate');

        Route::any('getproduct_name_detailss', 'sales\QuotationController@getproduct_name_detailss')
            ->name('getproduct_name_detailss');

        Route::any('view_quotation', 'sales\QuotationController@view_quotation')
            ->name('view_quotation');

        Route::any('pdf_quotation', 'sales\QuotationController@pdf_quotation')
            ->name('pdf_quotation');

        Route::any('salesreturn', 'sales\SalesreturnController@listing')
            ->name('salesreturn');

        Route::any('Add-salesreturn', 'sales\SalesreturnController@add')
            ->name('Add-salesreturn');

        Route::any('salesreturn_submit', 'sales\SalesreturnController@salesreturn_submit')
            ->name('salesreturn_submit');

        Route::any('edit_salesreturn', 'sales\SalesreturnController@edit_salesreturn')
            ->name('edit_salesreturn');

        Route::any('salesreturn_delete', 'sales\SalesreturnController@salesreturn_delete')
            ->name('salesreturn_delete');

        Route::any('salesreturn_pdf', 'sales\SalesreturnController@salesreturn_pdf')->name('salesreturn_pdf');

        Route::any('purchasereturn', 'sales\PurchasereturnController@listing')
            ->name('purchasereturn');

        Route::any('Add-purchasereturn', 'sales\PurchasereturnController@add')
            ->name('Add-purchasereturn');

        Route::any('purchasereturn_submit', 'sales\PurchasereturnController@purchasereturn_submit')
            ->name('purchasereturn_submit');

        Route::any('edit_purchasereturn', 'sales\PurchasereturnController@edit_purchasereturn')
            ->name('edit_purchasereturn');

        Route::any('purchasereturn_delete', 'sales\PurchasereturnController@purchasereturn_delete')
            ->name('purchasereturn_delete');
        Route::any('pdftest', array('as' => 'dashboard', 'uses' => 'sales\DashboardController@generate_pdf'));
        Route::any('Pdf-SalesInvoice', 'sales\InvoiceController@generate_pdf');
        Route::any('Pdf-Salesorder', 'sales\SalesorderController@generate_pdf');

        Route::any('invoicesettings', 'sales\InvoiceController@invoicesettings');

        Route::any('pdfheaderFileUpload', 'sales\FileUploadControllers@pdfheaderFileUpload')
            ->name('pdfheaderFileUpload');

        Route::any('pdfheader_submit', 'sales\InvoiceController@pdfheader_submit');

        Route::any('salesreport', 'sales\InvoiceController@salesreport');

        Route::any('/salesreportgenerate', 'sales\InvoiceController@salesreportgenerate');

        Route::any('vatreport', 'sales\InvoiceController@vatreport');

        Route::any('/vatreportgenerate', 'sales\InvoiceController@vatreportgenerate');

        Route::any('newQuotation', 'sales\NewQuotationController@listing')
            ->name('Quotationlist');
        Route::any('Add-newQuotation', 'sales\NewQuotationController@add')
            ->name('Add-newQuotation');

        Route::any('newproductsubmit', 'sales\NewQuotationController@productadd')
            ->name('newproductsubmit');

        Route::any('getproductdetails', 'sales\NewQuotationController@getproductdetails')
            ->name('getproductdetails');

        Route::any('getallproductdetails', 'sales\NewQuotationController@getallproductdetails')
            ->name('getallproductdetails');

        Route::any('newquotationsubmit', 'sales\NewQuotationController@newquotationsubmit')
            ->name('newquotationsubmit');

        // Route::any('newquotationupdate', 'sales\NewQuotationController@newquotationupdate')
        //     ->name('newquotationupdate');

        Route::any('newquotationrevise', 'sales\NewQuotationController@newquotationrevise')
            ->name('newquotationrevise');

        Route::any('quotation_revise', 'sales\NewQuotationController@quotation_revise')
            ->name('quotation_revise');

        Route::any('quotation_edit', 'sales\NewQuotationController@quotation_edit')
            ->name('quotation_edit');

        Route::any('quotation_approve', 'sales\NewQuotationController@quotation_approve')
            ->name('quotation_approve');

        Route::any('quotation_enquiry', 'sales\NewQuotationController@quotation_enquiry')
            ->name('quotation_enquiry');

        Route::any('sale_quotation_enquiry', 'sales\NewQuotationController@sale_quotation_enquiry')
            ->name('sale_quotation_enquiry');

        Route::any('quotation_view', 'sales\NewQuotationController@quotation_view')
            ->name('quotation_view');

        Route::any('quotation_pdf', 'sales\NewQuotationController@quotation_pdf')
            ->name('quotation_pdf');

        Route::any('quotation_send', 'sales\NewQuotationController@quotation_send')
            ->name('quotation_send');

        Route::any('quotation_approved', 'sales\NewQuotationController@quotation_approved')
            ->name('quotation_approved');

        Route::any('quotation_rejected', 'sales\NewQuotationController@quotation_rejected')
            ->name('quotation_rejected');

        Route::any('quotation_negotiation', 'sales\NewQuotationController@quotation_negotiation')
            ->name('quotation_negotiation');

        Route::any('quotation_revised', 'sales\NewQuotationController@quotation_revised')
            ->name('quotation_revised');

        Route::any('newSalesorder', 'sales\NewQuotationController@salesorderlisting')
            ->name('salesorderlisting');

        Route::any('saleorder_view', 'sales\NewQuotationController@saleorder_view')->name('saleorder_view');
        Route::any('salesorder_pdf', 'sales\NewQuotationController@salesorder_pdf')->name('salesorder_pdf');
        Route::any('salesorder_edit', 'sales\NewQuotationController@salesorder_edit')->name('salesorder_edit');

        Route::any('saleorder_deivery', 'sales\NewQuotationController@saleorder_deivery')->name('saleorder_deivery');
        Route::any('saleorder_invoice', 'sales\NewQuotationController@saleorder_invoice')->name('saleorder_invoice');
        Route::any('newDeliveryorder', 'sales\NewQuotationController@deliveryorderlisting')
            ->name('deliveryorderlisting');
        Route::any('deliveryorderlistingall', 'sales\NewQuotationController@deliveryorderlistingall')
            ->name('deliveryorderlistingall');

        Route::any('deliveryorder_invoice_partial', 'sales\NewQuotationController@deliveryorder_invoice_partial')
            ->name('deliveryorder_invoice_partial');
        Route::any('deliveryorder_view', 'sales\NewQuotationController@deliveryorder_view')
            ->name('deliveryorder_view');
        Route::any('deliveryorder_invoice', 'sales\NewQuotationController@deliveryorder_invoice')
            ->name('deliveryorder_invoice');

        Route::any('newInvoiceList', 'sales\NewQuotationController@invoicelisting')->name('invoicelisting');
        Route::any('invoicelistingall', 'sales\NewQuotationController@invoicelistingall')->name('invoicelistingall');

        Route::any('invoiceorder_view', 'sales\NewQuotationController@invoiceorder_view')
            ->name('invoiceorder_view');
        Route::any('invoiceorder_pdf', 'sales\NewQuotationController@invoiceorder_pdf')
            ->name('invoiceorder_pdf');
        Route::any('invoiceorder_deivery_partial', 'sales\NewQuotationController@invoiceorder_deivery_partial')
            ->name('invoiceorder_deivery_partial');

        Route::any('invoiceorder_deivery', 'sales\NewQuotationController@invoiceorder_deivery')
            ->name('invoiceorder_deivery');

        Route::any('revised_quotation', 'sales\NewQuotationController@revised_quotation')
            ->name('revised_quotation');

        Route::any('view_revisedquotation', 'sales\NewQuotationController@view_revisedquotation')->name('view_revisedquotation');
        Route::any('sales_convert_deliveryorder', 'sales\NewQuotationController@sales_convert_deliveryorder')
            ->name('convert_deliveryorder');

        Route::any('sales_convert_invoiceorder', 'sales\NewQuotationController@sales_convert_invoiceorder')
            ->name('convert_invoiceorder');

        Route::any('purchase_invoices', 'sales\EnquiryController@purchase_invoices')->name('purchase_invoices');

        Route::any('sales_convert_deliveryorder_update', 'sales\NewQuotationController@sales_convert_deliveryorder_update')
            ->name('sales_convert_deliveryorder_update');
        Route::any('sales_convert_invoiceorder_update', 'sales\NewQuotationController@sales_convert_invoiceorder_update')
            ->name('sales_convert_invoiceorder_update');

        Route::any('viewmore_revisedquotation', 'sales\NewQuotationController@viewmore_revisedquotation')->name('viewmore_revisedquotation');

        Route::any('view_revisedquotation_more', 'sales\NewQuotationController@view_revisedquotation_more')->name('view_revisedquotation_more');

        Route::any('sales_convert_proformaorder', 'sales\NewQuotationController@sales_convert_proformaorder')
            ->name('convert_invoiceorder');
        Route::any('sales_convert_proformaorder_update', 'sales\NewQuotationController@sales_convert_proformaorder_update')
            ->name('sales_convert_proformaorder_update');

        Route::any('deliveryorder_convert_invoiceorder', 'sales\NewQuotationController@deliveryorder_convert_invoiceorder')->name('deliveryorder_convert_invoiceorder');

        Route::any('deliveryorder_convert_invoiceorder_update', 'sales\NewQuotationController@deliveryorder_convert_invoiceorder_update')->name('deliveryorder_convert_invoiceorder_update');

        Route::any('invoiceorder_convert_deliveryorder', 'sales\NewQuotationController@invoiceorder_convert_deliveryorder')->name('invoiceorder_convert_deliveryorder');

        Route::any('invoiceorder_convert_deliveryorder_update', 'sales\NewQuotationController@invoiceorder_convert_deliveryorder_update')->name('invoiceorder_convert_deliveryorder_update');

        Route::any('customeinvoicelist', 'sales\CustomInvoiceController@customeinvoicelist')->name('customeinvoicelist');


        Route::any('Add-newcustominvoice', 'sales\CustomInvoiceController@add')
            ->name('Add-newcustominvoice');
        Route::any('custominvoicesubmit', 'sales\CustomInvoiceController@custominvoicesubmit')->name('custominvoicesubmit');

        Route::any('cinvoice_view', 'sales\CustomInvoiceController@cinvoice_view')
            ->name('cinvoice_view');

        Route::any('cinvoice_pdf', 'sales\CustomInvoiceController@cinvoice_pdf')
            ->name('cinvoice_pdf');

        Route::any('cinvoice_edit', 'sales\CustomInvoiceController@cinvoice_edit')
            ->name('cinvoice_edit');

        Route::any('cinvoice_pdf_print', 'sales\CustomInvoiceController@cinvoice_pdf_print')
            ->name('cinvoice_pdf_print');
        Route::any('newcinvoiceupdate', 'sales\CustomInvoiceController@newcinvoiceupdate')
            ->name('newcinvoiceupdate');

        Route::any('newcinvoicerevise', 'sales\CustomInvoiceController@newcinvoicerevise')
            ->name('newcinvoicerevise');

        Route::any('cinvoice_revised', 'sales\CustomInvoiceController@cinvoice_revised')
            ->name('cinvoice_revised');
        Route::any('revisedcustominvoice', 'sales\CustomInvoiceController@revisedcustominvoice')->name('revisedcustominvoice');
        Route::any('revisedinvoice_view', 'sales\CustomInvoiceController@revisedinvoice_view')
            ->name('revisedinvoice_view');
        Route::any('revisedinvoice_pdf', 'sales\CustomInvoiceController@revisedinvoice_pdf')
            ->name('revisedinvoice_pdf');
        Route::any('getproduct_name_details_quotation', 'sales\NewQuotationController@getproduct')->name('getproduct');

        Route::any('salesreports', 'sales\SalesReportController@salesreport')->name('salesreport');
        Route::any('viewsalesreport', 'sales\SalesReportController@viewsalesreport')->name('viewsalesreport');
        Route::any('cashsales_report', 'sales\SalesReportController@cashsales_report')->name('cashsales_report');
        Route::any('viewcashsalesreport', 'sales\SalesReportController@viewcashsalesreport')->name('viewcashsalesreport');
        Route::any('creditsales_report', 'sales\SalesReportController@creditsales_report')->name('creditsales_report');
        Route::any('viewcreditsalesreport', 'sales\SalesReportController@viewcreditsalesreport')->name('viewcreditsalesreport');
        Route::any('sales_salesreturn', 'sales\Sales_ReturnController@index')->name('sales_salesreturn');
        Route::any('invoicenumber_submit', 'sales\Sales_ReturnController@invoicenumber_submit')->name('invoicenumber_submit');
        Route::any('salesreturnupdate', 'sales\Sales_ReturnController@salesreturnupdate')->name('salesreturnupdate');

        Route::any('cashsales_report_list', 'sales\PaymentInvoiceController@cashsales_report_list')->name('cashsales_report_list');
        Route::any('creditsales_report_list', 'sales\PaymentInvoiceController@creditsales_report_list')->name('creditsales_report_list');
        Route::any('creditinvoice_pay', 'sales\PaymentInvoiceController@creditinvoice_pay')->name('creditinvoice_pay');
        Route::any('creditinvoicesubmit', 'sales\PaymentInvoiceController@creditinvoicesubmit')->name('creditinvoicesubmit');
        Route::any('creditinvoice_pay_edit', 'sales\PaymentInvoiceController@creditinvoice_pay_edit')->name('creditinvoice_pay_edit');
        Route::any('creditinvoice_pay_transactions', 'sales\PaymentInvoiceController@creditinvoice_pay_transactions')->name('creditinvoice_pay_transactions');
        Route::any('creditinvoicesubmit_transactions', 'sales\PaymentInvoiceController@creditinvoicesubmit_transactions')->name('creditinvoicesubmit_transactions');

        Route::any('statementofaccount', 'sales\SOAController@statementofaccount')->name('statementofaccount');

        Route::any('statementofaccountlist', 'sales\SOAController@statementofaccountlist')->name('statementofaccountlist');

        Route::any('soacorrect', 'sales\SOAController@soacorrect')->name('soacorrect');

        Route::any('sales_return_list', 'sales\Sales_ReturnController@sales_return_list')->name('sales_return_list');
        Route::any('perfomainvoicelist', 'sales\PerformaInvoiceController@perfomainvoicelist')->name('perfomainvoicelist');
        Route::any('pinvoice_view', 'sales\PerformaInvoiceController@pinvoice_view')->name('pinvoice_view');
        Route::any('pinvoice_pdf', 'sales\PerformaInvoiceController@pinvoice_pdf')->name('pinvoice_pdf');

        Route::any('pinvoice_pdf_print', 'sales\PerformaInvoiceController@pinvoice_pdf_print')->name('pinvoice_pdf_print');

        Route::any('pinvoice_edit', 'sales\PerformaInvoiceController@pinvoice_edit')->name('pinvoice_edit');

        Route::any('performa_convert', 'sales\PerformaInvoiceController@performa_convert')->name('performa_convert');

        Route::any('perfomainvoicesubmit', 'sales\PerformaInvoiceController@perfomainvoicesubmit')->name('perfomainvoicesubmit');
        Route::any('newpinvoiceupdate', 'sales\PerformaInvoiceController@newpinvoiceupdate')->name('newpinvoiceupdate');
        Route::any('Add-newperfominvoice', 'sales\PerformaInvoiceController@add')
            ->name('Add-newperfominvoice');

        Route::any('salesvatreport', 'sales\SalesReportController@salesvatreport')
            ->name('salesvatreport');
        Route::any('salesvatlistreports', 'sales\SalesReportController@salesvatlistreports')
            ->name('salesvatlistreports');

        Route::any('sales_reportpdf_print', 'sales\SalesReportController@sales_reportpdf_print')
            ->name('sales_reportpdf_print');

        Route::any('salessoapdf', 'sales\SOAController@salessoapdf')->name('salessoapdf');

        Route::any('Draft_quotationss', 'sales\NewQuotationController@Draft_quotationsslisting')
            ->name('Draft_quotationsslist');
        Route::any('adminsalesreports', 'sales\AdminSalesReportController@salesreport')->name('adminsalesreports');
        Route::any('admincashsales_report', 'sales\AdminSalesReportController@cashsales_report')->name('admincashsales_report');
        Route::any('adminviewcashsalesreport', 'sales\AdminSalesReportController@viewcashsalesreport')->name('adminviewcashsalesreport');
        Route::any('admincinvoice_pdf', 'sales\CustomInvoiceController@cinvoice_pdf')
            ->name('admincinvoice_pdf');
        Route::any('admincreditsales_report', 'sales\AdminSalesReportController@creditsales_report')->name('admincreditsales_report');
        Route::any('adminviewcreditsalesreport', 'sales\AdminSalesReportController@viewcreditsalesreport')->name('adminviewcreditsalesreport');
        Route::any('adminviewsalesreport', 'sales\AdminSalesReportController@viewsalesreport')->name('adminviewsalesreport');
        Route::any('adminsalesvatreport', 'sales\AdminSalesReportController@salesvatreport')
            ->name('adminsalesvatreport');
        Route::any('adminsalesvatlistreports', 'sales\AdminSalesReportController@salesvatlistreports')
            ->name('adminsalesvatlistreports');
        Route::any('adminsales_reportpdf_print', 'sales\AdminSalesReportController@sales_reportpdf_print')
            ->name('adminsales_reportpdf_print');
        Route::any('creditnote', 'sales\CreditNoteController@creditnote')->name('creditnote');
        Route::any('Add-creditnote_customer', 'sales\CreditNoteController@add_customer')
            ->name('Add-creditnote_customer');
        Route::any('getsupplier_customer', 'sales\CreditNoteController@getsupplier_customer')
            ->name('getsupplier_customer');
        Route::any('getcreditnotecustomer', 'sales\CreditNoteController@getcreditnotecustomer')->name('getcreditnotecustomer');

        Route::any('getcustomerinvoices', 'sales\CreditNoteController@getcustomerinvoices')->name('getcustomerinvoices');
        Route::any('getcustomerinvoices_details', 'sales\CreditNoteController@getcustomerinvoices_details')->name('getcustomerinvoices_details');
        Route::any('getcustomerinvoices_details_products', 'sales\CreditNoteController@getcustomerinvoices_details_products')->name('getcustomerinvoices_details_products');

        Route::any('debitnote', 'sales\DebitNoteController@debitnote')->name('debitnote');

        Route::any('Add-debitnote_customer', 'sales\DebitNoteController@add_customer')->name('Add-debitnote_customer');

        Route::any('getdebitnotecustomer', 'sales\DebitNoteController@getdebitnotecustomer')->name('getdebitnotecustomer');

        Route::any('getcustomerinvoices_dbt', 'sales\DebitNoteController@getcustomerinvoices_dbt')->name('getcustomerinvoices_dbt');
        Route::any('getcustomerinvoices_details_dbt', 'sales\DebitNoteController@getcustomerinvoices_details')->name('getcustomerinvoices_details_dbt');
        Route::any('getcustomerinvoices_details_products_dbt', 'sales\DebitNoteController@getcustomerinvoices_details_products')->name('getcustomerinvoices_details_products_dbt');

        Route::any('creditnotecustomer_submit', 'sales\CreditNoteController@customersubmit')->name('creditnotecustomer_submit');
        Route::any('debitnotecustomer_submit', 'sales\DebitNoteController@customersubmit')->name('debitnotecustomer_submit');

        Route::any('creditnotepdf', 'sales\CreditNoteController@creditnotepdf')->name('creditnotepdf');

        Route::any('debitnote_pdf', 'sales\DebitNoteController@debitnote_pdf')->name('debitnote_pdf');

        Route::any('advancepayment', 'sales\AdvancePaymentController@advancepayment')->name('advancepayment');

        Route::any('advancepayment_add', 'sales\AdvancePaymentController@add')->name('advancepayment_add');

        Route::any('getcustomerinvoices_advance', 'sales\AdvancePaymentController@getcustomerinvoices')->name('getcustomerinvoices_advance');

        Route::any('advancepaymentsubmit', 'sales\AdvancePaymentController@submit')->name('advancepaymentsubmit');

        Route::any('delete-advancepayment', 'sales\AdvancePaymentController@delete')->name('delete-advancepayment');

        Route::any('advancepayment_edit', 'sales\AdvancePaymentController@edit')->name('advancepayment_edit');

        Route::any('advancepayment_pdf', 'sales\AdvancePaymentController@pdf')->name('advancepayment_pdf');

        Route::any('advancepaymentupdate', 'sales\AdvancePaymentController@update')->name('advancepaymentupdate');

        Route::any('newEnquiry', 'sales\EnquiryController@list')->name('newEnquiry');

        Route::any('Add-newenquiry', 'sales\EnquiryController@add')->name('Add-newenquiry');

        Route::any('Add-newestimation', 'sales\EnquiryController@addestimation')->name('Add-newestimation');

        Route::any('newenquirysubmit', 'sales\EnquiryController@newenquirysubmit')->name('newenquirysubmit');

        Route::any('newposubmit', 'sales\EnquiryController@newposubmit')->name('newposubmit');

        Route::any('rfq_send', 'sales\EnquiryController@rfq_send')
            ->name('rfq_send');

        Route::any('rfq_negotiation', 'sales\EnquiryController@rfq_negotiation')
            ->name('rfq_negotiation');

        Route::any('rfq_revised', 'sales\EnquiryController@rfq_revised')
            ->name('rfq_revised');

        Route::any('rfq_approve', 'sales\EnquiryController@rfq_approve')
            ->name('rfq_approve');

        Route::any('rfq_rejected', 'sales\EnquiryController@rfq_rejected')
            ->name('rfq_rejected');
        Route::any('enquiry_edit', 'sales\EnquiryController@enquiry_edit')
            ->name('enquiry_edit');

        Route::any('enquiry_rfq', 'sales\EnquiryController@enquiry_rfq')
            ->name('enquiry_rfq');

        Route::any('enquiryquote', 'sales\EnquiryController@enquiryquote')
            ->name('enquiryquote');

        Route::any('rfqquote', 'sales\EnquiryController@rfqquote')
            ->name('rfqquote');

        Route::any('estimationquote', 'sales\EnquiryController@estimationquote')
            ->name('estimationquote');

        Route::any('getvendordetails', 'sales\EnquiryController@getvendordetails')
            ->name('getvendordetails');
        Route::any('getsupplierdetails', 'sales\EnquiryController@getsupplierdetails')->name('getsupplierdetails');

        Route::any('enquiryrfqsubmit', 'sales\EnquiryController@enquiryrfqsubmit')->name('enquiryrfqsubmit');
        Route::any('rfqlisting', 'sales\EnquiryController@rfqlisting')->name('rfqlisting');
        Route::any('estimationlisting', 'sales\EnquiryController@estimationlisting')->name('estimationlisting');

        Route::any('newenquiryupdate', 'sales\EnquiryController@newenquiryupdate')
            ->name('newenquiryupdate');

        Route::any('rfq_edit', 'sales\EnquiryController@rfq_edit')->name('rfq_edit');
        Route::any('rfq_edit1', 'sales\EnquiryController@rfq_edit1')->name('rfq_edit1');
        Route::any('enquiryrfqupdate', 'sales\EnquiryController@enquiryrfqupdate')->name('enquiryrfqupdate');

        Route::any('enquirypoupdate', 'sales\EnquiryController@enquirypoupdate')->name('enquirypoupdate');

        Route::any('enquirypoupdateissue', 'sales\EnquiryController@enquirypoupdateissue')->name('enquirypoupdateissue');

        Route::any('delivery_order_edit', 'sales\EnquiryController@po_edit')->name('po_edit');

        Route::any('delivery_order_issue', 'sales\EnquiryController@delivery_order_issue')->name('delivery_order_issue');

        Route::any('enquiryrfqupdate1', 'sales\EnquiryController@enquiryrfqupdate1')->name('enquiryrfqupdate1');

        Route::any('enquiryrfqvalueupdate', 'sales\EnquiryController@enquiryrfqvalueupdate')->name('enquiryrfqvalueupdate');
        Route::any('rfq_value', 'sales\EnquiryController@rfq_value')->name('rfq_value');

        Route::any('enquiryrfqapprove', 'sales\EnquiryController@enquiryrfqapprove')->name('enquiryrfqapprove');
        Route::any('enquiryrfq_convert_po', 'sales\EnquiryController@enquiryrfq_convert_po')->name('enquiryrfq_convert_po');

        Route::any('rfq_convert_po', 'sales\EnquiryController@rfq_convert_po')->name('rfq_convert_po');

        Route::any('enquiryrfqrevision', 'sales\EnquiryController@enquiryrfqrevision')->name('enquiryrfqrevision');

        Route::any('rfq_view', 'sales\EnquiryController@rfq_view')->name('rfq_view');
        Route::any('rfq_pdf', 'sales\EnquiryController@rfq_pdf')->name('rfq_pdf');

        Route::any('rfq_pdf1', 'sales\EnquiryController@rfq_pdf1')->name('rfq_pdf1');
        Route::any('rfqpo_pdf', 'sales\EnquiryController@rfqpo_pdf')->name('rfqpo_pdf');
        Route::any('rfqpo_pdf1', 'sales\EnquiryController@rfqpo_pdf1')->name('rfqpo_pdf1');

        Route::any('enquiry_approve', 'sales\EnquiryController@enquiry_approve')->name('enquiry_approve');
        Route::any('enquiry_rejected', 'sales\EnquiryController@enquiry_rejected')->name('enquiry_rejected');

        Route::any('rfqlisting_draft', 'sales\EnquiryController@rfqlisting_draft')->name('rfqlisting_draft');
        Route::any('rfqlisting_send', 'sales\EnquiryController@rfqlisting_send')->name('rfqlisting_send');
        Route::any('rfqlisting_negotiated', 'sales\EnquiryController@rfqlisting_negotiated')->name('rfqlisting_negotiated');
        Route::any('rfqlisting_approved', 'sales\EnquiryController@rfqlisting_approved')->name('rfqlisting_approved');
        Route::any('rfqlisting_rejected', 'sales\EnquiryController@rfqlisting_rejected')->name('rfqlisting_rejected');
        Route::any('rfqlisting_revised', 'sales\EnquiryController@rfqlisting_revised')->name('rfqlisting_revised');

        Route::any('rfq_view_more', 'sales\EnquiryController@rfq_view_more')->name('rfq_view_more');

        Route::any('rfqlistingrevisedversions', 'sales\EnquiryController@rfqlistingrevisedversions')->name('rfqlistingrevisedversions');
        Route::any('rfqrevised_view_more', 'sales\EnquiryController@rfqrevised_view_more')->name('rfqrevised_view_more');

        Route::any('newEnquiry_draft', 'sales\EnquiryController@newEnquiry_draft')->name('newEnquiry_draft');
        Route::any('newEnquiry_approved', 'sales\EnquiryController@newEnquiry_approved')->name('newEnquiry_approved');
        Route::any('newEnquiry_rejected', 'sales\EnquiryController@newEnquiry_rejected')->name('newEnquiry_rejected');

        Route::any('advancerequest', 'sales\AdvanceRequestController@advancerequest')->name('advancerequest');

        Route::any('Add-advance_request', 'sales\AdvanceRequestController@add')->name('Add-advance_request');

        Route::any('advancerequestids', 'sales\AdvanceRequestController@advancerequestids')->name('advancerequestids');
        Route::any('getinvoices_details', 'sales\AdvanceRequestController@getinvoices_details')->name('getinvoices_details');
        Route::any('getinvoices_details_products', 'sales\AdvanceRequestController@getinvoices_details_products')->name('getinvoices_details_products');

        Route::any('paymentrequest', 'sales\PaymentRequestController@paymentrequest')->name('paymentrequest');

        Route::any('Add-payment_request', 'sales\PaymentRequestController@add')->name('Add-payment_request');

        Route::any('paymentrequestids', 'sales\PaymentRequestController@paymentrequestids')->name('paymentrequestids');
        Route::any('paymentgetinvoices_details', 'sales\PaymentRequestController@getinvoices_details')->name('getinvoices_details');
        Route::any('paymentgetinvoices_details_products', 'sales\PaymentRequestController@getinvoices_details_products')->name('getinvoices_details_products');

        Route::any('purchase_delivery', 'sales\EnquiryController@purchase_delivery')->name('purchase_delivery');

        Route::any('purchase_delivery1', 'sales\EnquiryController@purchase_delivery1')->name('purchase_delivery1');
        Route::any('purchase_delivery2', 'sales\EnquiryController@purchase_delivery2')->name('purchase_delivery2');

        Route::any('getcustomerdetails_advance', 'sales\AdvanceRequestController@getcustomerdetails_advance')->name('getcustomerdetails_advance');
        Route::any('advance_request_submit', 'sales\AdvanceRequestController@advance_request_submit')->name('advance_request_submit');

        Route::any('delivery_order_convert_grn', 'sales\EnquiryController@delivery_order_convert_grn')->name('delivery_order_convert_grn');

        Route::any('delivery_order_convert_invoice', 'sales\EnquiryController@delivery_order_convert_invoice')->name('delivery_order_convert_invoice');

        Route::any('grnupdate', 'sales\EnquiryController@grnupdate')->name('grnupdate');

        Route::any('piupdate', 'sales\EnquiryController@piupdate')->name('piupdate');
        Route::any('getcustomerdetails_payment', 'sales\PaymentRequestController@getcustomerdetails_advance')->name('getcustomerdetails_payment');
        Route::any('payment_request_submit', 'sales\PaymentRequestController@payment_request_submit')->name('payment_request_submit');

        Route::any('paymentrequest_edit', 'sales\PaymentRequestController@paymentrequest_edit')->name('paymentrequest_edit');
        Route::any('advancerequest_edit', 'sales\AdvanceRequestController@advancerequest_edit')->name('advancerequest_edit');

        Route::any('delete-advancerequest', 'sales\AdvanceRequestController@delete')->name('delete-advancerequest');
        Route::any('delete-paymentrequest', 'sales\PaymentRequestController@delete')->name('delete-paymentrequest');

        Route::any('enquiry_view', 'sales\EnquiryController@enquiry_view')->name('enquiry_view');

        Route::any('delivery_order_view', 'sales\EnquiryController@delivery_order_view')->name('delivery_order_view');
        Route::any('grn', 'sales\GRNController@grn')->name('grn');
        Route::any('grn_view', 'sales\GRNController@grn_view')->name('grn_view');
        Route::any('grn_pdf', 'sales\GRNController@grn_pdf')->name('grn_pdf');
        Route::any('grn_pdf1', 'sales\GRNController@grn_pdf1')->name('grn_pdf1');

        Route::any('purchaseinvoice', 'sales\PurchaseInvoiceController@purchaseinvoice')->name('grn');
        Route::any('purchaseinvoice_view', 'sales\PurchaseInvoiceController@purchaseinvoice_view')->name('purchaseinvoice_view');
        Route::any('purchaseinvoice_pdf', 'sales\PurchaseInvoiceController@purchaseinvoice_pdf')->name('purchaseinvoice_pdf');

        Route::any('purchaseinvoice_pdf1', 'sales\PurchaseInvoiceController@purchaseinvoice_pdf1')->name('purchaseinvoice_pdf1');

        Route::any('creditnotepdfletter', 'sales\CreditNoteController@creditnotepdfletter')->name('creditnotepdfletter');
        Route::any('debitnote_pdfletter', 'sales\DebitNoteController@debitnote_pdfletter')->name('debitnote_pdfletter');

        Route::any('advancerequest_pdf', 'sales\AdvanceRequestController@advancerequest_pdf')->name('advancerequest_pdf');
        Route::any('advancerequest_pdf_letter', 'sales\AdvanceRequestController@advancerequest_pdf_letter')->name('advancerequest_pdf_letter');

        Route::any('paymentrequest_pdf', 'sales\PaymentRequestController@paymentrequest_pdf')->name('paymentrequest_pdf');
        Route::any('paymentrequest_pdf_letter', 'sales\PaymentRequestController@paymentrequest_pdf_letter')->name('paymentrequest_pdf_letter');

        Route::any('creditnote_purchase', 'purchase\CreditNoteController@creditnote_purchase')->name('creditnote_purchase');
        Route::any('Add-creditnote_supplier', 'purchase\CreditNoteController@add_supplier')->name('Add-creditnote_supplier');
        Route::any('getsupplierpurchases', 'purchase\CreditNoteController@getsupplierpurchases')->name('getsupplierpurchases');
        Route::any('getcreditnotesupplier', 'purchase\CreditNoteController@getcreditnotesupplier')->name('getcreditnotesupplier');
        Route::any('getsupplierpurchase_details', 'purchase\CreditNoteController@getsupplierpurchase_details')->name('getsupplierpurchase_details');
        Route::any('getsupplierpurchase_details_products', 'purchase\CreditNoteController@getsupplierpurchase_details_products')->name('getsupplierpurchase_details_products');
        Route::any('creditnotesupplier_submit', 'purchase\CreditNoteController@creditnotesupplier_submit')->name('creditnotesupplier_submit');
        Route::any('purchasecreditnotepdf', 'purchase\CreditNoteController@creditnotepdf')->name('creditnotepdf');
        Route::any('purchasecreditnotepdfletter', 'purchase\CreditNoteController@creditnotepdfletter')->name('creditnotepdfletter');

        Route::any('debitnote_purchase', 'purchase\DebitNoteController@debitnote_purchase')->name('debitnote_purchase');
        Route::any('Add-debitnote_supplier', 'purchase\DebitNoteController@add_supplier')->name('Add-debitnote_supplier');
        Route::any('getsupplierpurchases_debit', 'purchase\DebitNoteController@getsupplierpurchases')->name('getsupplierpurchases_debit');
        Route::any('getcreditnotesupplier_debit', 'purchase\DebitNoteController@getcreditnotesupplier')->name('getcreditnotesupplier_debit');
        Route::any('getsupplierpurchase_details_debit', 'purchase\DebitNoteController@getsupplierpurchase_details')->name('getsupplierpurchase_details_debit');
        Route::any('getsupplierpurchase_details_products_debit', 'purchase\DebitNoteController@getsupplierpurchase_details_products')->name('getsupplierpurchase_details_products_debit');
        Route::any('debitnotesupplier_submit', 'purchase\DebitNoteController@suppliersubmit')->name('debitnotesupplier_submit');
        Route::any('purchasedebitnote_pdf', 'purchase\DebitNoteController@debitnote_pdf')->name('debitnote_pdf');
        Route::any('purchasedebitnote_pdfletter', 'purchase\DebitNoteController@debitnote_pdfletter')->name('debitnote_pdfletter');
        Route::any('purchaseinvoice_pdfletterhead', 'sales\PurchaseInvoiceController@purchaseinvoice_pdfletterhead')->name('purchaseinvoice_pdfletterhead');
        Route::any('grn_pdfletterhead', 'sales\GRNController@grn_pdfletterhead')->name('grn_pdfletterhead');
        Route::any('contracts', 'sales\ContractController@list')->name('contracts');

        Route::any('contractadd', 'sales\ContractController@add')->name('contractadd');
        Route::any('contractreference_id', 'sales\ContractController@contractreference_id')->name('contractreference_id');
        Route::any('contract_submit', 'sales\ContractController@contract_submit')->name('contract_submit');
        Route::any('contracts_edit', 'sales\ContractController@edit')->name('contracts_edit');
        Route::any('contracts_update', 'sales\ContractController@contracts_update')->name('contracts_update');
        Route::any('delete-contract', 'sales\ContractController@delete')->name('delete-contract');
        Route::any('contracts_pdf', 'sales\ContractController@pdf')->name('contracts_pdf');
        Route::any('groupreceipt', 'sales\GroupReceiptController@groupreceipt')->name('groupreceipt');
        Route::any('groupreceipt_add', 'sales\GroupReceiptController@groupreceipt_add')->name('groupreceipt_add');
        Route::any('getcustomerinvoices_group', 'sales\GroupReceiptController@getcustomerinvoices_group')->name('getcustomerinvoices_group');

        Route::any('groupreceipt_step', 'sales\GroupReceiptController@groupreceipt_step')->name('groupreceipt_step');
        Route::any('groupreceipt_step3', 'sales\GroupReceiptController@groupreceipt_step3')->name('groupreceipt_step3');
        Route::any('getrfq_details', 'sales\EnquiryController@getrfq_details')->name('getrfq_details');
        Route::any('getrfq_details_products', 'sales\EnquiryController@getrfq_details_products')->name('getrfq_details_products');
        Route::any('newestimationsubmit', 'sales\EnquiryController@newestimationsubmit')->name('newestimationsubmit');
        Route::any('estimation_pdf', 'sales\EnquiryController@estimation_pdf')->name('estimation_pdf');
        Route::any('estimation_edit', 'sales\EnquiryController@estimation_edit')->name('estimation_edit');
        Route::any('newestimationupdate', 'sales\EnquiryController@newestimationupdate')->name('newestimationupdate');
        Route::any('po_vo', 'sales\EnquiryController@po_vo')->name('po_vo');
        Route::any('enquirypovoupdate', 'sales\EnquiryController@enquirypovoupdate')->name('enquirypovoupdate');
        Route::any('salesorder_vo', 'sales\NewQuotationController@salesorder_vo')->name('salesorder_vo');
        Route::any('voupdate', 'sales\NewQuotationController@voupdate')->name('voupdate');

        Route::any('direct_po', 'sales\EnquiryController@direct_po')->name('direct_po');

        Route::any('tradingsettings', array('as' => 'home', 'uses' => 'settings\DashboardController@show'));

        Route::any('settingstax', 'settings\TaxController@list')
            ->name('Tax');
        Route::any('settingstaxTrash', 'settings\TaxController@trash')
            ->name('TrashTax');
        Route::any('settingsAdd-tax', 'settings\TaxController@add')
            ->name('Add');
        Route::any('settingstaxsubmit', 'settings\TaxController@submit')
            ->name('Add');
        Route::any('settingsedit_tax', 'settings\TaxController@edit')
            ->name('Edit');
        Route::any('settingsTaxView', 'settings\TaxController@TaxView')
            ->name('TaxView');
        Route::any('settingsdelete-tax', 'settings\TaxController@delete')
            ->name('Delete');
        Route::any('settingsrestore-tax', 'settings\TaxController@restore')
            ->name('Restore');
        Route::any('settingstrashdelete-tax', 'settings\TaxController@trashdelete')
            ->name('Restore');

        Route::any('settingstaxgroups', 'settings\TaxgroupController@list')
            ->name('taxgroups');
        Route::any('settingstaxgroupsTrash', 'settings\TaxgroupController@trash')
            ->name('trash');
        Route::any('settingsAdd-taxgroups', 'settings\TaxgroupController@add')
            ->name('Add');
        Route::any('settingstaxgroupsubmit', 'settings\TaxgroupController@submit')
            ->name('submit');
        Route::any('settingsedit_taxgroups', 'settings\TaxgroupController@edit')
            ->name('edit');
        Route::any('settingstaxgroupsview', 'settings\TaxgroupController@taxgroupview')
            ->name('taxgroupview');
        Route::any('settingsdelete-taxgroups', 'settings\TaxgroupController@delete')
            ->name('settingsdelete-taxgroups');
        Route::any('settingsrestore-taxgroups', 'settings\TaxgroupController@restore')
            ->name('restore');
        Route::any('settingstrashdelete-taxgroups', 'settings\TaxgroupController@trashdelete')
            ->name('trashdelete');

        Route::any('settingsvendorgroupdetails', 'settings\VendorController@index')->name('Vendor Group Details');
        Route::any('settingsvendorgrouptrash', 'settings\VendorController@GroupTrash')->name('Vendor Group Trash');
        Route::any('settingsVendorGroupSubmit', 'settings\VendorController@submit_vendorgroup')->name('VendorGroupSubmit');
        Route::any('settingsgetvendorgroup', 'settings\VendorController@groupedit')->name('getvendorgroup');
        Route::any('settingsdeleteVendorGroup', 'settings\VendorController@delete_vendorgroup')->name('deleteVendorGroup');
        Route::any('settingsvendorGroupRestoreTrash', 'settings\VendorController@VendorGroupRestore')->name('vendor Group Restore Trash');

        Route::any('settingsvendorcategorydetails', 'settings\VendorController@vendorcategoryindex')->name('Vendor Category');
        Route::any('settingsvendorCategoryTrash', 'settings\VendorController@vendorCategoryTrash')->name('Vendor Category Trash');
        Route::any('settingsVendorCategorySubmit', 'settings\VendorController@submit_vendorcategory')->name('VendorCategorySubmit');
        Route::any('settingsgetvendorcategory', 'settings\VendorController@categoryedit')->name('getvendorcategory');
        Route::any('settingsdeleteVendorCategory', 'settings\VendorController@delete_vendorcategory')->name('deleteVendorCategory');
        Route::post('settingsvendorCategoryRestoreTrash', 'settings\VendorController@vendorcategoryRestore')->name('vendorCategoryRestoreTrash');

        Route::any('settingsvendortypedetails', 'settings\VendorController@vendortypeindex')->name('Vendor Type');
        Route::any('settingsvendortypetrash', 'settings\VendorController@vendorTypeTrash')->name('Vendor Type Trash');
        Route::any('settingsVendorTypeSubmit', 'settings\VendorController@submit_vendortype')->name('VendorTypeSubmit');
        Route::any('settingsgetvendortype', 'settings\VendorController@typeedit')->name('getvendortype');
        Route::any('settingsdeleteVendorType', 'settings\VendorController@delete_vendortype')->name('deleteVendorType');
        Route::any('settingsVendorTypeRestoreTrash', 'settings\VendorController@VendorTypeRestoreTrash')->name('VendorTypeRestoreTrash');

        Route::any('settingspaymentTerms', 'settings\PaymentController@index')->name('Payment Details List');
        Route::any('settingspaymentmenttrashdetails', 'settings\PaymentController@trash')->name('Payment Detail Trash list');
        Route::any('settingsPaymentSubmit', 'settings\PaymentController@PaymentSubmit')->name('PaymentSubmit');
        Route::any('settingsgetPaymentTerms', 'settings\PaymentController@getPaymentTerms')->name('getPaymentTerms');
        Route::any('settingsdeletePaymentInfo', 'settings\PaymentController@deletePaymentInfo')->name('deletePaymentInfo');

        Route::any('settingsDepartment', 'settings\DepartmentController@index')->name('Department');
        Route::any('settingsdepartmenttrash', 'settings\DepartmentController@trash')->name('Department Trash');
        Route::any('settingsnewdepartment', 'settings\DepartmentController@add')->name('newdepartment');
        Route::any('settingsdepartmentSubmit', 'settings\DepartmentController@save')->name('departmentSubmit');
        Route::any('settingsedit_department', 'settings\DepartmentController@edit_department')->name('edit_department');
        Route::any('settingsdeletedepartment', 'settings\DepartmentController@delete')->name('deletedepartment');
        Route::any('settingsdepartmenttrashlist', 'settings\DepartmentController@departmenttrashlist')->name('Department Trash List');



        Route::any('settingstermsconditions', 'settings\TermsandconditionsController@list')->name('Terms And Conditions');

        Route::any('settingsTermsView', 'settings\TermsandconditionsController@view')->name('settingsTermsView');

        Route::any('settingstermstrashdetails', 'settings\TermsandconditionsController@termstrashdetails')->name('Terms And Conditions Trash');
        Route::any('settingstermsSubmit', 'settings\TermsandconditionsController@termsSubmit')->name('termsSubmit');
        Route::any('settingsgetTermsconditions', 'settings\TermsandconditionsController@getTermsconditions')->name('getTermsconditions');
        Route::any('settingsdeletetermsInfo', 'settings\TermsandconditionsController@deletetermsInfo')->name('deletetermsInfo');
        Route::any('settingstermsTrashRestore', 'settings\TermsandconditionsController@termsTrashRestore')
            ->name('termsTrashRestore');

        Route::any('settingscurrency', 'settings\CurrencyController@list')
            ->name('Currency Settings');
        Route::any('settingsAdd-Currency', 'settings\CurrencyController@add')
            ->name('Add-Currency');
        Route::any('settingscurrencysubmit', 'settings\CurrencyController@submit')
            ->name('currencysubmit');
        Route::any('settingsCurrencyTrash', 'settings\CurrencyController@trash')
            ->name('Currency Settings Trash');
        Route::any('settingsedit_currency', 'settings\CurrencyController@edit')
            ->name('edit_currency');
        Route::any('settingsCurrencyView', 'settings\CurrencyController@currencyview')
            ->name('CurrencyView');
        Route::any('settingsdelete-currency', 'settings\CurrencyController@delete')
            ->name('delete-currency');
        Route::any('settingstrashdelete-currency', 'settings\CurrencyController@trashdelete')
            ->name('trashdelete-currency');
        Route::any('settingsrestore-currency', 'settings\CurrencyController@restore')
            ->name('restore-currency');

        Route::any('settingsUnitList', 'settings\UnitController@UnitListing')
            ->name('Unit');
        Route::any('settingsAdd-Unit', 'settings\UnitController@NewUnit')
            ->name('NewUnit');
        Route::any('settingsProductunitSubmit', 'settings\UnitController@creates')
            ->name('ProductunitSubmit');
        Route::any('settingsedit_productunit', 'settings\UnitController@edit_productunit')
            ->name('edit_productunit');

        Route::any('settingsDeleteProdctunits', 'settings\UnitController@destroys')
            ->name('DeleteProdctunits');
        Route::any('settingsunittrash', 'settings\UnitController@unittrash')
            ->name('Unit Trash');
        Route::any('settingsrestoreinventoryunit', 'settings\UnitController@restoreinventoryunit')
            ->name('restoreinventoryunit');
        Route::any('settingsDeleteTrashProdctunits', 'settings\UnitController@DeleteTrashProdctunits')
            ->name('DeleteTrashProdctunits');


        Route::any('myaccount', 'settings\MyaccountController@index')->name('myaccount');

        Route::any('voucehersettings', 'settings\VouchersettingsController@voucehersettings')->name('voucehersettings');
        Route::any('vouchersettings_add', 'settings\VouchersettingsController@vouchersettings_add')->name('vouchersettings_add');
        Route::any('vouchersettingssubmit', 'settings\VouchersettingsController@vouchersettingssubmit')->name('vouchersettingssubmit');
        Route::any('settingsedit_voucher', 'settings\VouchersettingsController@settingsedit_voucher')->name('settingsedit_voucher');
        Route::any('settingsdelete-voucher', 'settings\VouchersettingsController@delete')->name('settingsdelete-voucher');
        Route::any('walletaccount', 'settings\WalletController@walletaccount')->name('walletaccount');
        Route::any('walletaccount_add', 'settings\WalletController@walletaccount_add')->name('walletaccount_add');

        Route::any('walletaccountsubmit', 'settings\WalletController@walletaccountsubmit')->name('walletaccountsubmit');
        Route::any('edit_wallet', 'settings\WalletController@edit_wallet')->name('edit_wallet');
        Route::any('delete-wallet', 'settings\WalletController@delete')->name('delete-wallet');

        Route::any('wallettransactions', 'settings\WalletController@listing')->name('wallettransactions');
        Route::any('wallettransactions_add', 'settings\WalletController@add')->name('wallettransactions_add');
        Route::any('wallettransactionsubmit', 'settings\WalletController@submit')->name('wallettransactionsubmit');
        Route::any('edit_wallettransaction', 'settings\WalletController@edit')->name('edit_wallettransaction');

        Route::any('delete-wallettransaction', 'settings\WalletController@deletewallet')->name('delete-wallettransaction');
        Route::any('customefields', 'settings\SettingsController@customefields')->name('customefields');

        Route::any('customfieldsubmit', 'settings\SettingsController@customfieldsubmit')->name('customfieldsubmit');

        Route::any('settings_emailset', 'settings\EmailsettingsController@list')->name('Email Settings');
        Route::any('settingsgetemailconfg', 'settings\EmailsettingsController@getEmailsetngDetails')->name('getEmailsetngDetails');
        Route::any('settingsemailSubmit', 'settings\EmailsettingsController@emailsetngSubmit')->name('emailsetngSubmit');

        Route::any('purchase_dashboard', 'purchase\DashboardController@view')->name('Purchase Dashboard');
        Route::any('PurchaseList', 'purchase\PurchaseController@PurchaseListing')
            ->name('PurchaseListing');
        Route::any('PurchaseView', 'purchase\PurchaseController@view')
            ->name('PurchaseView');
        Route::any('Add-Purchase', 'purchase\PurchaseController@NewPurchase')
            ->name('NewPurchase');

        Route::any('gethistory', 'purchase\PurchaseController@gethistory')->name('gethistory');

        Route::any('getsupplier_vendor', 'purchase\PurchaseController@getsupplier_vendor')
            ->name('getsupplier_vendor');
        Route::any('getwarehouse', 'purchase\PurchaseController@getwarehouse')
            ->name('getwarehouse');
        Route::any('getproduct_unit_price', 'purchase\PurchaseController@getproduct_unit_price')
            ->name('getproduct_unit_price');
        Route::any('purchase_submit', 'purchase\PurchaseController@purchase_submit')
            ->name('purchase_submit');
        Route::any('trash_purchase', 'purchase\PurchaseController@PurchasetrashListing')
            ->name('trash_purchase');
        Route::any('purchase_delete', 'purchase\PurchaseController@deletepurchase')->name('purchase_delete');
        Route::any('edit_purchase', 'purchase\PurchaseController@edit_purchase')->name('edit_purchase');

        Route::any('SalesManagement', 'purchase\SalesManagement@SalesManagentListing')
            ->name('SalesManagement');
        Route::any('Addto-stock', 'purchase\SalesManagement@AddtoStock')
            ->name('AddStock');
        Route::any('getstorename', 'purchase\SalesManagement@getstorenames')
            ->name('getstorename');
        Route::any('getrackname', 'purchase\SalesManagement@getracknames')
            ->name('getrackname');
        Route::any('getrackname1', 'purchase\SalesManagement@getracknames1')
            ->name('getrackname1');
        Route::any('getvariants', 'purchase\SalesManagement@getvariants')
            ->name('getvariants');
        Route::any('stock_variant_submit', 'purchase\SalesManagement@stock_variant_submit')
            ->name('stock_variant_submit');
        Route::any('purchaseFileUpload', 'purchase\FileUploadControllers@purchaseFileUpload')
            ->name('purchaseFileUpload');
        Route::any('getproduct_name_details', 'purchase\PurchaseController@getproduct_name_details')
            ->name('getproduct_name_details');
        Route::any('getvatgroup_percentage', 'purchase\PurchaseController@getvatgroup_percentage')
            ->name('getvatgroup_percentage');
        Route::any('getproduct_unit_value', 'purchase\PurchaseController@getproduct_unit_value')
            ->name('getproduct_unit_value');
        Route::any('getsellingunits', 'purchase\SalesManagement@getsellingunits')
            ->name('getsellingunits');

        Route::any('purchaseSettings', 'purchase\SettingsController@SettingsListing')
            ->name('purchaseSettings');
        Route::any('SettingsView', 'purchase\SettingsController@setview')
            ->name('SettingsView');

        Route::any('Add-settings', 'purchase\SettingsController@Newsettings')
            ->name('Add-settings');

        Route::any('submit_settings', 'purchase\SettingsController@submit')->name('submit');

        Route::any('edit_settings', 'purchase\SettingsController@edit')->name('edit_settings');

        Route::any('delete-settings', 'purchase\SettingsController@delete')->name('delete-settings');
        Route::any('purchaseSettingstrash', 'purchase\SettingsController@SettingsListingtrash')->name('purchaseSettings');

        Route::any('restore_purchasesettings', 'purchase\SettingsController@restore_purchasesettings')->name('restore_purchasesettings');
        Route::any('CostHead', 'purchase\CostheadController@list')
            ->name('CostHead');

        Route::any('CostHeadView', 'purchase\CostheadController@costheadview')
            ->name('CostHeadView');

        Route::any('Add-CostHead', 'purchase\CostheadController@add')
            ->name('Add-CostHead');
        Route::any('CostHeadTrash', 'purchase\CostheadController@trash')
            ->name('CostHeadTrash');
        Route::any('costheadsubmit', 'purchase\CostheadController@submit')
            ->name('CostHeadsubmit');
        Route::any('edit_CostHead', 'purchase\CostheadController@edit')
            ->name('edit_CostHead');
        Route::any('delete-costhead', 'purchase\CostheadController@delete')
            ->name('delete-CostHead');
        Route::any('restore-costhead', 'purchase\CostheadController@restore')
            ->name('restore-CostHead');
        Route::any('trashdelete-costhead', 'purchase\CostheadController@trashdelete')
            ->name('trashdelete-CostHead');

        Route::any('Accounts', 'purchase\AccountsController@list')->name('Accounts');
        Route::any('Addaccounts', 'purchase\AccountsController@Add')->name('Add Accounts');
        Route::any('accountssubmit', 'purchase\AccountsController@submit')->name('Accounts Submit');

        Route::any('getpaymentterms', 'purchase\PurchaseController@getpaymentterms')->name('getpaymentterms');

        Route::any('cash-Purchase', 'purchase\PurchaseController@cash_Purchase')->name('cash-Purchase');

        Route::any('credit-Purchase', 'purchase\PurchaseController@credit_Purchase')->name('credit-Purchase');


        Route::any('vatfiling', 'purchase\ReportsController@vatfiling')
            ->name('vatfiling');

        Route::any('vatlistreports', 'purchase\ReportsController@vatlistreports')->name('vatlistreports');

        Route::any('vatfiling_print', 'purchase\ReportsController@vatfiling_print')->name('vatfiling_print');

        Route::any('getprovider_details', 'purchase\PurchaseController@getprovider_details')->name('getprovider_details');

        Route::any('payments', 'purchase\PaymentsController@payments')->name('payments');
        Route::any('cash-Purchasepayments', 'purchase\PaymentsController@cash_Purchase')->name('cash-Purchase');
        Route::any('credit-Purchasepayments', 'purchase\PaymentsController@credit_Purchase')->name('credit-Purchase');

        Route::any('creditpurchase_pay', 'purchase\PaymentsController@creditpurchase_pay')->name('creditpurchase_pay');
        Route::any('creditpurchasesubmit', 'purchase\PaymentsController@creditpurchasesubmit')->name('creditpurchasesubmit');

        Route::any('creditpurchase_pay_edit', 'purchase\PaymentsController@creditpurchase_pay_edit')->name('creditpurchase_pay_edit');
        Route::any('creditpurchase_pay_transactions', 'purchase\PaymentsController@creditpurchase_pay_transactions')->name('creditpurchase_pay_transactions');

        Route::any('creditpurchasesubmit_transactions', 'purchase\PaymentsController@creditpurchasesubmit_transactions')->name('creditpurchasesubmit_transactions');

        Route::any('purchasesoa', 'purchase\SOAController@statementofaccount')->name('statementofaccount');
        Route::any('purchasestatementofaccountlist', 'purchase\SOAController@statementofaccountlist')->name('purchasestatementofaccountlist');

        Route::any('purchasesoapdf', 'purchase\SOAController@purchasesoapdf')->name('purchasesoapdf');

        Route::any('purchasedelivery_order_view', 'purchase\EnquiryController@delivery_order_view')->name('purchasedelivery_order_view');
        Route::any('purchasedelivery_order_convert_grn', 'purchase\EnquiryController@delivery_order_convert_grn')->name('purchasedelivery_order_convert_grn');
        Route::any('purchasedelivery_order_convert_invoice', 'sales\EnquiryController@delivery_order_convert_invoice')->name('purchasedelivery_order_convert_invoice');
        Route::any('purchasegrn', 'purchase\GRNController@grn')->name('purchasegrn');
        Route::any('purchasegrn_view', 'purchase\GRNController@grn_view')->name('purchasegrn_view');
        Route::any('purchasegrn_pdf', 'purchase\GRNController@grn_pdf')->name('purchasegrn_pdf');
        Route::any('purchasegrn_pdfletterhead', 'purchase\GRNController@grn_pdfletterhead')->name('purchasegrn_pdfletterhead');
        Route::any('purchaseadvancepayment', 'purchase\AdvancePaymentController@purchaseadvancepayment')->name('purchaseadvancepayment');
        Route::any('purchaseadvancepayment_add', 'purchase\AdvancePaymentController@add')->name('purchaseadvancepayment_add');
        Route::any('getcustomerpurchase_advance', 'purchase\AdvancePaymentController@getcustomerpurchase_advance')->name('getcustomerpurchase_advance');
        Route::any('getproviderdetails_advancepayment', 'purchase\AdvancePaymentController@getproviderdetails_advancepayment')->name('getproviderdetails_advancepayment');
        Route::any('purchasepaymentinvoicelist', 'purchase\PaymentInvoiceController@purchasepaymentinvoicelist')->name('purchasepaymentinvoicelist');
        Route::any('cash-Purchasepayment', 'purchase\PurchaseController@cash_Purchase')->name('cash-Purchasepayment');
        Route::any('credit-Purchasepayment', 'purchase\PurchaseController@credit_Purchase')->name('credit-Purchasepayment');
        Route::any('advancerequest_purchase', 'purchase\AdvanceRequestController@advancerequest')->name('advancerequest_purchase');
        Route::any('paymentrequest_purchase', 'purchase\PaymentRequestController@paymentrequest')->name('paymentrequest_purchase');
        Route::any('Add-payment_request_purchase', 'purchase\PaymentRequestController@add')->name('Add-payment_request_purchase');
        Route::any('Add-advance_request_purchase', 'purchase\AdvanceRequestController@add')->name('Add-advance_request_purchase');
        Route::any('advancepaymentsubmit_purchase', 'purchase\AdvancePaymentController@submit')->name('advancepaymentsubmit_purchase');
        Route::any('purchase_advancepayment_edit', 'purchase\AdvancePaymentController@edit')->name('purchase_advancepayment_edit');
        Route::any('advancepaymentupdate_purchase', 'purchase\AdvancePaymentController@update')->name('advancepaymentupdate_purchase');
        Route::any('delete-advancepayment_purchase', 'purchase\AdvancePaymentController@delete')->name('delete-advancepayment_purchase');
        Route::any('advancerequestids_purchase', 'purchase\AdvanceRequestController@advancerequestids')->name('advancerequestids_purchase');
        Route::any('getinvoices_details_products_purchase', 'purchase\AdvanceRequestController@getinvoices_details_products')->name('getinvoices_details_products_purchase');
        Route::any('getinvoices_details_purchase', 'purchase\AdvanceRequestController@getinvoices_details')->name('getinvoices_details_purchase');
        Route::any('getcustomerdetails_advance_purchase', 'purchase\AdvanceRequestController@getcustomerdetails_advance')->name('getcustomerdetails_advance_purchase');
        Route::any('advance_request_submit_purchase', 'purchase\AdvanceRequestController@advance_request_submit')->name('advance_request_submit_purchase');
        Route::any('purchase_advancerequest_edit', 'purchase\AdvanceRequestController@advancerequest_edit')->name('purchase_advancerequest_edit');
        Route::any('delete-advancerequest_purchase', 'purchase\AdvanceRequestController@delete')->name('delete-advancerequest_purchase');
        Route::any('purchaseadvancerequest_pdf', 'purchase\AdvanceRequestController@advancerequest_pdf')->name('purchaseadvancerequest_pdf');
        Route::any('purchaseadvancerequest_pdf_letter', 'purchase\AdvanceRequestController@advancerequest_pdf_letter')->name('purchaseadvancerequest_pdf_letter');
        Route::any('payment_request_submit_purchase', 'purchase\PaymentRequestController@payment_request_submit')->name('payment_request_submit_purchase');
        Route::any('purchasepaymentrequest_edit', 'purchase\PaymentRequestController@paymentrequest_edit')->name('purchasepaymentrequest_edit');
        Route::any('purchasepaymentrequest_pdf', 'purchase\PaymentRequestController@paymentrequest_pdf')->name('purchasepaymentrequest_pdf');
        Route::any('purchasepaymentrequest_pdf_letter', 'purchase\PaymentRequestController@paymentrequest_pdf_letter')->name('purchasepaymentrequest_pdf_letter');
        Route::any('purchasedelete-paymentrequest', 'purchase\PaymentRequestController@delete')->name('purchasedelete-paymentrequest');

        Route::any('purchase_order_convert_purchase', 'purchase\EnquiryController@purchase_order_convert_purchase')->name('purchase_order_convert_purchase');

        Route::any('po_convert_purchase', 'purchase\EnquiryController@po_convert_purchase')->name('po_convert_purchase');

        Route::any('documentation', array('as' => 'home', 'uses' => 'documentation\DashboardController@show'));

        Route::any('help', 'documentation\HelpSupportController@index')->name('help');

        Route::any('help_category1', 'documentation\HelpSupportController@show')->name('category1');
        Route::any('help_category2', 'documentation\HelpSupportController@show')->name('category2');
        Route::any('help_category3', 'documentation\HelpSupportController@show')->name('category3');

        Route::any('help_category_view1', 'documentation\HelpSupportController@view')->name('help_category_view1');
        Route::any('help_category_view2', 'documentation\HelpSupportController@view')->name('help_category_view2');
        Route::any('help_category_view3', 'documentation\HelpSupportController@view')->name('help_category_view3');
        Route::any('help_category_view4', 'documentation\HelpSupportController@view')->name('help_category_view5');
        Route::any('help_category_view5', 'documentation\HelpSupportController@view')->name('help_category_view4');
        Route::any('help_category_view6', 'documentation\HelpSupportController@view')->name('help_category_view6');

        Route::any('help_articles', 'documentation\HelpArticlesController@index')->name('help_articles');
        Route::any('getHelpArticle', 'documentation\HelpArticlesController@getHelpArticle')->name('getHelpArticle');
        Route::any('deleteHelpArticle', 'documentation\HelpArticlesController@deleteHelpArticle')->name('deleteHelpArticle');
        Route::any('help_article_submit', 'documentation\HelpArticlesController@save')->name('help_article_submit');

        Route::any('addArticleHelp', 'documentation\HelpArticlesController@addArticleHelp')->name('addArticleHelp');
        Route::any('helparticleedit', 'documentation\HelpArticlesController@helparticleedit')->name('helparticleedit');
        Route::any('helparticleview', 'documentation\HelpArticlesController@helparticleview')->name('helparticleview');
        Route::any('autocomplete_help', 'documentation\HelpArticlesController@autocomplete')->name('autocomplete_help');

        Route::any('help_categories', 'documentation\HelpCategoryController@index')->name('help_categories');
        Route::any('getHelpCategory', 'documentation\HelpCategoryController@getCategory')->name('getHelpCategory');
        Route::any('helpCategoryDelete', 'documentation\HelpCategoryController@deleteHelpCategory')->name('helpCategoryDelete');
        Route::any('help_categoriesSubmit', 'documentation\HelpCategoryController@save')->name('help_categoriesSubmit');
        Route::any('knowledge_base', 'documentation\KnowledgeBaseController@index')->name('knowledge_base');

        Route::any('category1', 'documentation\knowledgeBaseController@show')->name('category1');
        Route::any('category2', 'documentation\knowledgeBaseController@show')->name('category2');
        Route::any('category3', 'documentation\knowledgeBaseController@show')->name('category3');

        Route::any('knowledge_base_articles', 'documentation\KnowledgeBaseArticlesController@index')->name('knowledge_base_articles');
        Route::any('addArticlebase', 'documentation\KnowledgeBaseArticlesController@add')->name('addArticlebase');
        Route::any('knowledge_article_submit', 'documentation\KnowledgeBaseArticlesController@submit')->name('knowledge_article_submit');
        Route::any('basearticleedit', 'documentation\KnowledgeBaseArticlesController@edit')->name('basearticleedit');
        Route::any('deletebaseArticle', 'documentation\KnowledgeBaseArticlesController@delete')->name('deletebaseArticle');

        Route::any('knowledge_base_categories', 'documentation\KnowledgeBaseCategoriesController@index')->name('knowledge_base_categories');
        Route::any('getKnowledgeBaseCategory', 'documentation\KnowledgeBaseCategoriesController@getKnowledgeBaseCategory')->name('getKnowledgeBaseCategory');
        Route::any('knowledgeBaseCategoryDelete', 'documentation\KnowledgeBaseCategoriesController@deleteKnowledgeBaseCategory')->name('knowledgeBaseCategoryDelete');
        Route::any('knowledge_base_categoriesSubmit', 'documentation\KnowledgeBaseCategoriesController@save')->name('knowledge_base_categoriesSubmit');
        Route::any('basearticleview', 'documentation\KnowledgeBaseArticlesController@basearticleview')->name('basearticleview');
        Route::any('autocomplete_base', 'documentation\KnowledgeBaseArticlesController@autocomplete')->name('autocomplete');

        Route::get('userperission', 'UserPermissionController@userperission')->name('userperission');

        Route::any('operations', array('as' => 'home', 'uses' => 'operations\DashboardController@show'));

        Route::any('operational_entries', array('as' => 'operational_entries', 'uses' => 'operations\DashboardController@operational_entries'));

        Route::any('post_entry', array('as' => 'post_entry', 'uses' => 'operations\DashboardController@post_entry'));

        Route::any('boq', 'boq\DashboardController@index')->name('boq');

        Route::any('list-boq', 'boq\BOQController@list')->name('list-boq');
        Route::any('view-childen', 'boq\BOQController@listChilden')->name('view-childen');

        Route::any('list-boq-estimation-pending', 'boq\BOQController@listEstimationPending')->name('list-boq-estimation-pending');
        Route::any('view-childen-estimation-pending', 'boq\BOQController@listChildenEstimationPending')->name('view-childen');
        Route::any('list-boq-estimation-completed', 'boq\BOQController@listEstimationCompleted')->name('list-boq-estimation-completed-completed');
        Route::any('view-childen-estimation-completed', 'boq\BOQController@listChildenEstimationCompleted')->name('view-childen-estimation-completed');

        Route::any('main-boq-download', 'boq\BOQController@main_boq_download')->name('main-boq-download');
        Route::any('boq-send', 'boq\BOQController@sendToEstimation')->name('boq-send');
        Route::any('boq-enable-edit', 'boq\BOQController@enableEdit')->name('boq-send');
        Route::any('boq-send-to-tender', 'boq\BOQController@sendToTender')->name('boq-send');


        Route::any('boq_main_edit', 'boq\BOQController@boq_main_edit')->name('boq_main_edit');
        Route::any('mainboqupdate', 'boq\BOQController@mainboqupdate')->name('mainboqupdate');
        Route::any('boqsubmit', 'boq\BOQController@boqsubmit')->name('boqsubmit');
        Route::any('boqupdate', 'boq\BOQController@boqupdate')->name('boqupdate');
        Route::any('boq_update', 'boq\BOQController@boq_update')->name('boq_update');
        Route::any('exportdata', 'boq\BOQController@exportdata')->name('exportdata');
        Route::any('submit-file', 'boq\BOQController@submit_file')->name('submit-file');
        Route::get('/boq_head/find', 'boq\BOQController@searcheads');
        Route::any('boqadd/{ids}', 'boq\BOQController@boqadd')->name('boqadd');

        Route::any('boqaddparent/{ids}', 'boq\BOQController@boqaddparent')->name('boqaddparent');

        Route::any('innerboqsubmit', 'boq\BOQController@innerboqsubmit')->name('innerboqsubmit');
        Route::any('innerboqupdatebulk', 'boq\BOQController@innerboqupdatebulk')->name('innerboqupdatebulk');
        Route::any('innerboqsubmitgroup', 'boq\BOQController@innerboqsubmitgroup')->name('innerboqsubmitgroup');

        Route::any('boq_bulk_edit', 'boq\BOQController@boq_bulk_edit')->name('boq_bulk_edit');

        Route::post('file-import', 'boq\BOQController@submit_file')->name('file-import');
        Route::get('file-export', 'boq\BOQController@submit_file')->name('file-export');

        Route::any('children-boq-download', 'boq\BOQController@children_boq_download')->name('children-boq-download');
        Route::any('exportdata_child/{ids}', 'boq\BOQController@exportdata_child')->name('exportdata_child');
        Route::any('file-import_child', 'boq\BOQController@file_import_child')->name('file-import_child');
        Route::any('innerboqedit', 'boq\BOQController@innerboqedit')->name('innerboqedit');
        Route::any('innerboqupdate', 'boq\BOQController@innerboqupdate')->name('innerboqupdate');



        Route::any('Addto-stock_sales', 'purchase1\SalesManagement@AddtoStock_salesmanage')
            ->name('AddStock');
        Route::any('stock_submit', 'purchase1\SalesManagement@stock_submit')
            ->name('stock_submit');
        Route::any('getsku', 'purchase1\SalesManagement@getsku')
            ->name('getsku');

        Route::any('studentsales', 'StudentSalesController@studentsales')->name('studentsales');
        Route::any('Add-newinvoice', 'StudentSalesController@Add')->name('Add-newinvoice');
        Route::any('studentinvoicesubmit', 'StudentSalesController@studentinvoicesubmit')->name('studentinvoicesubmit');
        Route::any('studentinvoice_edit', 'StudentSalesController@studentinvoice_edit')->name('studentinvoice_edit');

        Route::any('getsupplieraddressquote', 'sales\EnquiryController@getsupplieraddressquote')->name('getsupplieraddressquote');

        Route::any('rfqsubmittedlisting', 'sales\EnquiryController@rfqsubmittedlisting')->name('rfqsubmittedlisting');

        Route::any('enquiry_pdf', 'sales\EnquiryController@enquiry_pdf')->name('enquiry_pdf');

        Route::any('pos', 'pos\DashboardController@pos')->name('pos');
        Route::any('van', 'pos\VanController@listing')->name('van');
        Route::any('Add-van', 'pos\VanController@Add_van')->name('Add-van');
        Route::any('submit-van', 'pos\VanController@submit_van')->name('submit-van');
        Route::any('getcustomerdetailspos', 'pos\VanController@getcustomerdetailspos')->name('getcustomerdetailspos');
        Route::any('vanpdf', 'pos\VanController@vanpdf')->name('vanpdf');
        Route::any('getvanemailspos', 'pos\VanController@getvanemailspos')->name('getvanemailspos');

        Route::any('stocktransfer', 'pos\StockTransferController@listing')->name('stocktransfer');
        Route::any('Add-stocktransfer', 'pos\StockTransferController@stocktransfer')->name('Add-stocktransfer');
        Route::any('submit-stocktransfer', 'pos\StockTransferController@submit_stocktransfer')->name('submit-stocktransfer');
        Route::any('stocktransfer_pdf', 'pos\StockTransferController@stocktransfer_pdf')->name('stocktransfer_pdf');

        Route::any('stockreturn', 'pos\StockReturnController@listing')->name('stockreturn');
        Route::any('Add-stockreturn', 'pos\StockReturnController@stockreturn')->name('Add-stockreturn');
        Route::any('stockreturn_pdf', 'pos\StockReturnController@stockreturn_pdf')->name('stockreturn_pdf');

        Route::any('getvanname_details_pos', 'pos\StockReturnController@getvanname_details_pos')->name('getvanname_details_pos');
        Route::any('submit-stockreturn', 'pos\StockReturnController@submit_stockreturn')->name('submit-stockreturn');
        Route::any('getvanproductsreturn', 'pos\StockReturnController@getvanproductsreturn')->name('getvanproductsreturn');
        Route::any('possalesinvoicelisting', 'pos\SalesInvoiceController@listing')->name('possalesinvoicelisting');
        Route::any('possalesinvoice', 'pos\SalesInvoiceController@possalesinvoice')->name('possalesinvoice');
        Route::any('getcustomer_van', 'pos\SalesInvoiceController@getcustomer_van')->name('getcustomer_van');

        Route::any('posProductpurchaseListing', 'pos\SalesInvoiceController@posProductpurchaseListing')->name('posProductpurchaseListing');
        Route::any('getproduct_name_details_pos', 'pos\SalesInvoiceController@getproduct_name_details_pos')->name('getproduct_name_details_pos');
        Route::any('posinvoicesubmit', 'pos\SalesInvoiceController@posinvoicesubmit')->name('posinvoicesubmit');
        Route::any('posinvoice_pdf', 'pos\SalesInvoiceController@posinvoice_pdf')->name('posinvoice_pdf');

        Route::any('possalesorder', 'pos\SalesOrderController@possalesorder')->name('possalesorder');

        Route::any('driver', 'pos\DriverController@listing')->name('driver');
        Route::any('Add-driver', 'pos\DriverController@Add_driver')->name('Add-driver');
        Route::any('submit-driver', 'pos\DriverController@submit_driver')->name('submit-driver');

        Route::any('asset_manage', 'asset\DashboardController@asset_manage')->name('asset_manage');
        Route::any('asset_list', 'asset\AssetController@asset_list')->name('asset_list');
        Route::any('asset_add', 'asset\AssetController@asset_add')->name('asset_add');
        Route::any('asset_submit', 'asset\AssetController@asset_submit')->name('asset_submit');
        Route::any('asset_download', 'asset\AssetController@asset_download')->name('asset_download');

        Route::any('exportassetdata', 'asset\AssetController@exportdata')->name('exportassetdata');
        Route::post('file-import-asset', 'asset\AssetController@submit_file')->name('file-import-asset');
        Route::any('assetedit', 'asset\AssetController@assetedit')->name('assetedit');

        Route::any('asset_allocation_add', 'asset\AssetController@asset_allocation_add')->name('asset_allocation_add');
        Route::any('asset_allocation_submit', 'asset\AssetController@asset_allocation_submit')->name('asset_allocation_submit');
        Route::any('allocation_list', 'asset\AssetController@allocation_list')->name('allocation_list');

        Route::any('revoke_list', 'asset\AssetController@revoke_list')->name('revoke_list');

        Route::any('asset_revoke_add', 'asset\AssetController@asset_revoke_add')->name('asset_revoke_add');

        Route::any('asset_revoke_submit', 'asset\AssetController@asset_revoke_submit')->name('asset_revoke_submit');

        Route::any('editgeolocation', 'asset\SettingsController@editgeolocation')->name('editgeolocation');

        Route::any('geolocation', 'asset\SettingsController@geolocation_addd')->name('geolocation');
        Route::any('geolocationlisting', 'asset\SettingsController@geolocationlisting')->name('geolocationlisting');
        Route::any('submit-geolocation', 'asset\SettingsController@submit_geolocation')->name('submit-geolocation');
        Route::any('editassetarea', 'asset\SettingsController@editassetarea')->name('editassetarea');
        Route::any('arealisting', 'asset\SettingsController@arealisting')->name('arealisting');
        Route::any('assetarea', 'asset\SettingsController@assetarea_addd')->name('assetarea');
        Route::any('submit-assetarea', 'asset\SettingsController@submit_assetarea')->name('submit-assetarea');
        Route::any('editassetdepartment', 'asset\SettingsController@editassetdepartment')->name('editassetdepartment');
        Route::any('departmentlisting', 'asset\SettingsController@departmentlisting')->name('departmentlisting');
        Route::any('assetdepartment', 'asset\SettingsController@assetdepartment_addd')->name('assetdepartment');
        Route::any('submit-assetdepartment', 'asset\SettingsController@submit_assetdepartment')->name('submit-assetdepartment');
        Route::any('componentslisting', 'asset\SettingsController@componentslisting')->name('componentslisting');

        Route::any('assetcomponent', 'asset\SettingsController@assetcomponent_addd')->name('assetcomponent');
        Route::any('submit-assetcomponent', 'asset\SettingsController@submit_assetcomponent')->name('submit-assetcomponent');
        Route::any('partslisting', 'asset\SettingsController@partslisting')->name('partslisting');

        Route::any('assetparts', 'asset\SettingsController@assetparts_addd')->name('assetparts');
        Route::any('submit-assetparts', 'asset\SettingsController@submit_assetparts')->name('submit-assetparts');
        Route::any('projectlisting', 'asset\SettingsController@projectlisting')->name('projectlisting');
        Route::any('assetproject', 'asset\SettingsController@assetproject_addd')->name('assetproject');
        Route::any('submit-assetproject', 'asset\SettingsController@submit_assetproject')->name('submit-assetproject');
        Route::any('assetunitSubmit', 'asset\SettingsController@assetunitSubmit')->name('assetunitSubmit');
        Route::any('unitlisting', 'asset\SettingsController@unitlisting')->name('unitlisting');
        Route::any('assetunit', 'asset\SettingsController@assetunit_addd')->name('assetunit');
        Route::any('editassetgroup', 'asset\SettingsController@editassetgroup')->name('editassetgroup');
        Route::any('assetgroup', 'asset\SettingsController@assetgroup_addd')->name('assetgroup');
        Route::any('grouplisting', 'asset\SettingsController@grouplisting')->name('grouplisting');
        Route::any('submit-assetgroup', 'asset\SettingsController@submit_assetgroup')->name('submit-assetgroup');
        Route::any('editassetcategory', 'asset\SettingsController@editassetcategory')->name('editassetcategory');
        Route::any('categorylisting', 'asset\SettingsController@categorylisting')->name('categorylisting');
        Route::any('assetcategory', 'asset\SettingsController@assetcategory_addd')->name('assetcategory');
        Route::any('submit-assetcategory', 'asset\SettingsController@submit_assetcategory')->name('submit-assetcategory');
        Route::any('editassettype', 'asset\SettingsController@editassettype')->name('editassettype');
        Route::any('typelisting', 'asset\SettingsController@typelisting')->name('typelisting');
        Route::any('assettype', 'asset\SettingsController@assettype_addd')->name('assettype');
        Route::any('submit-assettype', 'asset\SettingsController@submit_assettype')->name('submit-assettype');

        Route::any('assetWarehouseList', 'asset\SettingsController@assetWarehouseList')->name('assetWarehouseList');
        Route::any('assetwarehouse', 'asset\SettingsController@assetwarehouse_addd')->name('assetwarehouse');
        Route::any('assetwarehouse_submit', 'asset\SettingsController@assetwarehouse_submit')->name('assetwarehouse_submit');
        Route::any('assetStoreManagement', 'asset\SettingsController@assetStoreManagement')->name('assetStoreManagement');
        Route::any('assetstore', 'asset\SettingsController@assetstore_addd')->name('assetstore');
        Route::any('assetstoremanagement_submit', 'asset\SettingsController@assetstoremanagement_submit')->name('assetstoremanagement_submit');
        Route::any('assetRackManagement', 'asset\SettingsController@assetRackManagement')->name('assetRackManagement');
        Route::any('assetrack', 'asset\SettingsController@assetrack_addd')->name('assetrack');
        Route::any('assetrackmanagement_submit', 'asset\SettingsController@assetrackmanagement_submit')->name('assetrackmanagement_submit');
        Route::any('getassetdetails', 'asset\AssetController@getassetdetails')->name('getassetdetails');

        Route::any('AssetHistory', 'asset\AssetController@asset_history_list')->name('AssetHistory');
        Route::any('AssetAuditing', 'asset\AssetController@asset_audit_list')->name('AssetAuditing');

        Route::any('AssetMaster', 'asset\AssetController@asset_master_list')->name('AssetMaster');
        Route::any('OM', 'asset\AssetController@om_list')->name('OM');

        Route::any('om_add', 'asset\AssetController@om_add')->name('om_add');
        Route::any('asset_status_submit', 'asset\AssetController@asset_status_submit')->name('asset_status_submit');

        Route::any('parts_notification', 'asset\AssetController@parts_notification')->name('parts_notification');
        Route::any('components_notification', 'asset\AssetController@components_notification')->name('components_notification');
        Route::any('asset_update', 'asset\AssetController@asset_update')->name('asset_update');

        Route::any('asset_allocation_borrower', 'asset\AssetController@asset_allocation_borrower')->name('asset_allocation_borrower');

        Route::any('asset_allocation_pdf', 'asset\AssetController@asset_allocation_pdf')->name('asset_allocation_pdf');
        Route::any('asset_revoke_pdf', 'asset\AssetController@asset_revoke_pdf')->name('asset_revoke_pdf');
        Route::any('asetcategoryview', 'asset\AssetController@asetcategoryview')->name('asetcategoryview');
        Route::any('asettypeview', 'asset\AssetController@asettypeview')->name('asettypeview');
        Route::any('asetwarehouseview', 'asset\AssetController@asetwarehouseview')->name('asetwarehouseview');
        Route::any('asetview', 'asset\AssetController@asetview')->name('asetview');

        Route::any('asetgroupview', 'asset\AssetController@asetgroupview')->name('asetgroupview');
        Route::any('asetdocumentview', 'asset\AssetController@asetdocumentview')->name('asetdocumentview');

        Route::any('asset_history_group', 'asset\AssetController@asset_history_group')->name('asset_history_group');

        Route::any('asset_status_edit', 'asset\AssetController@asset_status_edit')->name('asset_status_edit');
        Route::any('assetdocdownload', 'asset\AssetController@assetdocdownload')->name('assetdocdownload');
        Route::any('asetlocationview', 'asset\AssetController@asetlocationview')->name('asetlocationview');
        Route::any('asetprojectview', 'asset\AssetController@asetprojectview')->name('asetprojectview');
        Route::any('partsupdate', 'asset\AssetController@partsupdate')->name('partsupdate');
        Route::any('asset_history_category', 'asset\AssetController@asset_history_category')->name('asset_history_category');
        Route::any('asset_history_type', 'asset\AssetController@asset_history_type')->name('asset_history_type');

        Route::any('componentupdate', 'asset\AssetController@componentupdate')->name('componentupdate');


        Route::any('warehouse', 'Warehouse\DashboardController@warehouse')->name('warehouse');
        Route::any('warehouse_select', 'Warehouse\DashboardController@warehouse_select')->name('warehouse_select');
        Route::any('stockin', 'Warehouse\WarehouseController@stockin')->name('stockin');

        Route::any('stockin_history', 'Warehouse\WarehouseController@stockin_history')->name('stockin_history');

        Route::any('stockin_history_view', 'Warehouse\WarehouseController@stockin_history_view')->name('stockin_history_view');

        Route::any('warehouse_stockin', 'Warehouse\WarehouseController@warehouse_stockin')->name('warehouse_stockin');
        Route::any('newstockin_submit', 'Warehouse\WarehouseController@newstockin_submit')->name('newstockin_submit');

        Route::any('stockout', 'Warehouse\WarehouseController@stockout')->name('stockout');
        Route::any('stocktransfer', 'Warehouse\WarehouseController@stocktransfer')->name('stocktransfer');

        Route::any('stock_transfer_request_list', 'Warehouse\WarehouseController@stock_transfer_request_list')->name('stock_transfer_request_list');

        Route::any('stockin_request_view', 'Warehouse\WarehouseController@stockin_request_view')->name('stockin_request_view');

        Route::any('movement_history', 'Warehouse\WarehouseController@movement_history')->name('movement_history');

        Route::any('stock_status', 'Warehouse\WarehouseController@stock_status')->name('stock_status');

        Route::any('expired_items', 'Warehouse\WarehouseController@expired_items')->name('expired_items');

        Route::any('newstock_adjustment', 'Warehouse\WarehouseController@newstock_adjustment')->name('newstock_adjustment');

        Route::any('stock_adjustsubmit', 'Warehouse\WarehouseController@stock_adjustsubmit')->name('stock_adjustsubmit');

        Route::any('stock_adjust_list', 'Warehouse\WarehouseController@stock_adjust_list')->name('stock_adjust_list');

        Route::any('transaction_history', 'Warehouse\WarehouseController@transaction_history')->name('transaction_history');

        Route::any('stock_transfer_request_processed', 'Warehouse\WarehouseController@stock_transfer_request_processed')->name('stock_transfer_request_processed');

        Route::any('newstockout', 'Warehouse\WarehouseController@newstockout')->name('newstockout');

        Route::any('newstocktransfer', 'Warehouse\WarehouseController@newstocktransfer')->name('newstocktransfer');

        Route::any('newstocktransfer_byrequest', 'Warehouse\WarehouseController@newstocktransfer_byrequest')->name('newstocktransfer_byrequest');

        Route::any('stockoutsubmit', 'Warehouse\WarehouseController@stockoutsubmit')->name('stockoutsubmit');

        Route::any('stocktransfersubmit', 'Warehouse\WarehouseController@stocktransfersubmit')->name('stocktransfersubmit');
        Route::any('stocktransferrequestsubmit', 'Warehouse\WarehouseController@stocktransferrequestsubmit')->name('stocktransferrequestsubmit');

        Route::any('ProductstockoutListing', 'inventory\ProductController@ProductstockoutListing')
            ->name('ProductstockoutListing');

        Route::any('stock_master', 'inventory\ProductController@ProductstockoutListing')
            ->name('stock_master');

        Route::any('stockMaster1', 'Warehouse\WarehouseController@stockMaster1')->name('stockMaster1');

        Route::any('warehouse_brand_view', 'Warehouse\WarehouseController@warehouse_brand_view')->name('warehouse_brand_view');

        Route::any('warehouse_category_view', 'Warehouse\WarehouseController@warehouse_category_view')->name('warehouse_category_view');

        Route::any('warehouse_unit_view', 'Warehouse\WarehouseController@warehouse_unit_view')->name('warehouse_unit_view');

        Route::any('stock_transfer_request', 'Warehouse\WarehouseController@stock_transfer_request')->name('stock_transfer_request');

        Route::any('edit_war_product_details', 'inventory\ProductController@edit_war_product_details')
            ->name('edit_war_product_details');

        Route::any('purchaseproducts', 'purchase\PurchaseController@purchaseproducts')
            ->name('purchaseproducts');
        Route::any('getproduct_name_details_purchase', 'purchase\PurchaseController@getproduct_name_details_purchase')
            ->name('getproduct_name_details_purchase');

        Route::any('Reports', 'Reports\DashboardController@Reports')->name('Reports');
        Route::any('report1', 'Reports\ReportController@report1')->name('report1');
        Route::any('report2', 'Reports\ReportController@report2')->name('report2');
        Route::any('report3', 'Reports\ReportController@report3')->name('report3');
        Route::any('report4', 'Reports\ReportController@report4')->name('report4');
        Route::any('report5', 'Reports\ReportController@report5')->name('report5');
        Route::any('report6', 'Reports\ReportController@report6')->name('report6');
        Route::any('report7', 'Reports\ReportController@report7')->name('report7');
        Route::any('report8', 'Reports\ReportController@report8')->name('report8');
        Route::any('report9', 'Reports\ReportController@report9')->name('report9');
        Route::any('report10', 'Reports\ReportController@report10')->name('report10');
        Route::any('report11', 'Reports\ReportController@report11')->name('report11');
        Route::any('report12', 'Reports\ReportController@report12')->name('report12');
        Route::any('report13', 'Reports\ReportController@report13')->name('report13');

        Route::any('buy_main', 'buy\DashboardController@view')->name('Buy Dashboard');

        Route::any('buy_account_head', 'buy\BuyController@buy_account_head')->name('Buy Account Head');

        Route::any('buy_head_add', 'buy\BuyController@buy_head_add')->name('Buy Account Add');

        Route::any('submit_account_head', 'buy\BuyController@submit_account_head')->name('Buy Account Submit');

        Route::any('buy_direct_purchase', 'buy\BuyController@buy_direct_purchase')->name('Buy Direct Purchase');
        Route::any('buy_voucher_edit', 'buy\BuyController@edit')->name('buy_voucher_edit');


        Route::any('autocomplete-search', 'buy\BuyController@autocompleteSearch')->name('Buy Search');
        Route::get('/account_head/find', 'buy\BuyController@searcheads');

        Route::any('buy_voucher_submit', 'buy\BuyController@buy_voucher_submit')->name('Buy Voucher Submit');

        Route::any('buy_vouchers', 'buy\BuyController@buy_vouchers')->name('Buy Vouchers');
        Route::any('buy_voucher_update', 'buy\BuyController@buy_voucher_update')->name('buy_voucher_update');


        Route::any('buy_voucher_delete', 'buy\BuyController@buy_voucher_delete')->name('Buy Vouchers Delete');

        Route::any('buy_bill_settlement', 'buy\BuyController@buy_bill_settlement')->name('Buy Bill Settlement');

        Route::any('buy_bill_settlement_add', 'buy\BuyController@buy_bill_settlement_add')->name('New Buy Bill Settlement');

        Route::any('submit_buy_supplier', 'buy\BuyController@submit_buy_supplier')->name('Submit Buy Supplier');

        Route::any('buy_bill_settle_submit', 'buy\BuyController@buy_bill_settle_submit')->name('Submit buy bill settlement');

        Route::any('sales_bill_settlement', 'sales\PaymentInvoiceController@sales_bill_settlement')->name('Sales Bill Settlement');

        Route::any('sales_bill_settlement_add', 'sales\PaymentInvoiceController@sales_bill_settlement_add')->name('New Sales Bill Settlement');

        Route::any('submit_buy_customer', 'sales\PaymentInvoiceController@submit_buy_customer')->name('Submit Buy Customer');

        Route::any('sale_bill_settle_submit', 'sales\PaymentInvoiceController@sale_bill_settle_submit')->name('Submit Sale bill settlement');
        Route::any('getemaildetails', 'sales\CustomInvoiceController@getemaildetails')
            ->name('getemaildetails');


        Route::any('download-file/{id}', 'CommonController@downloadFile')->name('download-File');
        Route::any('download-file-from-storage/{id}', 'CommonController@downloadFileFromStorage')->name('download-File');


        Route::group(['namespace' => 'ResourceManagement'], function () {
            Route::any('resourcemanagement', 'DashboardController@resourcemanagement')->name('resourcemanagement');
            Route::any('rmusers', 'UsersController@rmusers')->name('rmusers');
            // Route::any('rmnewusers', 'UsersController@rmnewusers')->name('rmnewusers');
            Route::any('rmexistingusers', 'UsersController@rmexistingusers')->name('rmexistingusers');
            Route::any('get-hr-user-from-id', 'UsersController@getHrUserFromId')->name('get-hr-user-from-id');
            Route::any('save-employees', 'UsersController@saveEmployees')->name('save-employees');

            Route::any('teams-list', 'TeamsController@teamsList')->name('teams-list');
            Route::any('add-team', 'TeamsController@add')->name('add-team');
            Route::any('team-save', 'TeamsController@save')->name('team-save');
            Route::any('teams-edit/{id}', 'TeamsController@edit')->name('teams-edit');


            Route::any('resmanagement', 'ManagementController@resmanagement')->name('resmanagement');
            Route::any('rmnewmanagement', 'ManagementController@rmnewmanagement')->name('rmnewmanagement');
            Route::any('get-team-members', 'ManagementController@getTteamMembers')->name('get-team-members');
            Route::any('project-members-save', 'ManagementController@projectMembersSave')->name('project-members-save');
            Route::any('resmanagement-edit/{id}', 'ManagementController@edit')->name('resmanagement-edit');
        });

        // Procurement
        Route::group(['namespace' => 'Procurement'], function () {
            Route::any('procurement/home', 'ProcurementController@index')->name('Home');

            Route::any('product-purchase-listing', 'DataListingController@ProductpurchaseListing')->name('ProductpurchaseListing');
            Route::any('get-product-from-id', 'DataListingController@getproduct')->name('getproduct');
            Route::any('product-boq-listing', 'DataListingController@loadBOQList')->name('product-boq-listing');
            Route::any('get-boq-product-from-id', 'DataListingController@getBoqProduct')->name('get-boq-product-from-id');
            Route::any('load-project-from-client', 'DataListingController@loadProject')->name('load-project-from-client');
            Route::any('material-directory-list', 'DataListingController@getMaterialDirectoryList')->name('material-directory-list');
            Route::any('get-material-directory-from-id', 'DataListingController@getMaterialDirectoryData')->name('get-material-directory-from-id');

            Route::any('all-material-request', 'AllMRController@index')->name('All material-request');
            Route::any('all-list-non-boq', 'AllMRController@listNonBoq')->name('All list-non-boq');
            Route::any('all-list-stock-req', 'AllMRController@listStockReq')->name('All list-stock-req');

            Route::any('material-request', 'MaterialRequestController@index')->name('material-request');
            Route::any('list-non-boq', 'MaterialRequestController@listNonBoq')->name('list-non-boq');
            Route::any('list-stock-req', 'MaterialRequestController@listStockReq')->name('list-stock-req');
            Route::any('list-trashed-epr', 'MaterialRequestController@listTrashedEpr')->name(' list-trashed-epr');

            Route::any('list-boq-draft', 'MaterialRequestController@listBoqDraft')->name('list-boq-draft');
            Route::any('list-boq-send', 'MaterialRequestController@listBoqSend')->name('list-non-send');
            Route::any('list-boq-approved', 'MaterialRequestController@listBoqApproved')->name('list-boq-approved');
            Route::any('list-boq-rejected', 'MaterialRequestController@listBoqRejected')->name('list-boq-rejected');

            Route::any('list-non-boq-draft', 'MaterialRequestController@listNonBoqDraft')->name('list-non-boq-draft');
            Route::any('list-non-boq-send', 'MaterialRequestController@listNonBoqSend')->name('list-non-boq-send');
            Route::any('list-non-boq-approved', 'MaterialRequestController@listNonBoqApproved')->name('list-non-boq-approved');
            Route::any('list-non-boq-rejected', 'MaterialRequestController@listNonBoqRejected')->name('list-non-boq-rejected');

            Route::any('list-stock-draft', 'MaterialRequestController@listStockDraft')->name('list-stock-draft');
            Route::any('list-stock-send', 'MaterialRequestController@listStockSend')->name('list-stock-send');
            Route::any('list-stock-approved', 'MaterialRequestController@listStockApproved')->name('list-stock-approved');
            Route::any('list-stock-rejected', 'MaterialRequestController@listStockRejected')->name('list-stock-rejected');

            Route::any('material-request-add', 'MaterialRequestController@add')->name('material-request-add');

            Route::any('epr-attachments-upload', 'MaterialRequestController@attachmentsUpload')->name('epr-attachments-upload');
            Route::any('epr-attachments-delete', 'MaterialRequestController@attachmentsDelete')->name('epr-attachments-delete');
            Route::any('epr-attachments/{id}', 'MaterialRequestController@attachmentsList')->name('epr-attachments');
            Route::any('material-request-save', 'MaterialRequestController@newEpr')->name('material-request-save');
            Route::any('material-request-edit-view', 'MaterialRequestController@editView')->name('material-request-edit-view');
            Route::any('material-request-view', 'MaterialRequestController@view')->name('material-request-view');
            Route::any('material-request-update', 'MaterialRequestController@materialRequestUpdate')->name('material-request-update');
            Route::any('material-request-send', 'MaterialRequestController@materialRequestSend')->name('material-request-send');
            Route::any('material-request-trash', 'MaterialRequestController@materialRequestTrash')->name('material-request-trash');
            Route::any('material-request-resubmit', 'MaterialRequestController@reSendView')->name('material-request-resubmit');
            Route::any('material-request-resend', 'MaterialRequestController@materialRequestReSend')->name('material-request-resend');


            Route::any('material-category', 'MaterialCategory@list')->name('Material-Category');
            Route::any('material-category-add', 'MaterialCategory@add')->name('Material-Category-add');
            Route::any('material-category-submit', 'MaterialCategory@submit')->name('material-category-submit');
            Route::any('material-category-edit', 'MaterialCategory@edit')->name('material-category-edit');
            Route::any('material-category-view', 'MaterialCategory@TaxView')->name('material-category-view');
            Route::any('material-category-delete', 'MaterialCategory@delete')->name('material-category-delete');

            Route::any('mr-workflow', 'MrWorkflowController@index')->name('Material-Workflow');
            Route::any('mr-workflow-add', 'MrWorkflowController@add')->name('Material-Workflow-add');
            Route::any('mr-workflow-save', 'MrWorkflowController@save')->name('mr-workflow-save');
            Route::any('mr-workflow-view', 'MrWorkflowController@view')->name('mr-workflow-view');
            Route::any('mr-workflow-edit-view', 'MrWorkflowController@editView')->name('mr-workflow-edit-view');
            Route::any('mr-workflow-update', 'MrWorkflowController@update')->name('mr-workflow-update');
            Route::any('mr-workflow-delete', 'MrWorkflowController@delete')->name('mr-workflow-delete');
            Route::any('mr-workflow-clone', 'MrWorkflowController@clone')->name('mr-workflow-clone');
            Route::any('mr-workflow-clone-save', 'MrWorkflowController@cloneSave')->name('mr-workflow-clone-save');


            Route::any('stock-transfer-workflow', 'StockTransferWorkflowController@index')->name('stock-transfer-Workflow');
            Route::any('stock-transfer-workflow-add', 'StockTransferWorkflowController@add')->name('stock-transfer-Workflow-add');
            Route::any('stock-transfer-workflow-save', 'StockTransferWorkflowController@save')->name('stock-transfer-workflow-save');
            Route::any('stock-transfer-workflow-view', 'StockTransferWorkflowController@view')->name('stock-transfer-workflow-view');
            Route::any('stock-transfer-workflow-edit-view', 'StockTransferWorkflowController@editView')->name('stock-transfer-workflow-edit-view');
            Route::any('stock-transfer-workflow-update', 'StockTransferWorkflowController@update')->name('stock-transfer-workflow-update');
            Route::any('stock-transfer-workflow-delete', 'StockTransferWorkflowController@delete')->name('stock-transfer-workflow-delete');
            Route::any('stock-transfer-workflow-clone', 'StockTransferWorkflowController@clone')->name('stock-transfer-workflow-clone');
            Route::any('stock-transfer-workflow-clone-save', 'StockTransferWorkflowController@cloneSave')->name('stock-transfer-workflow-clone-save');

            Route::any('po-workflow', 'PoWorkflowController@index')->name('po-Workflow');
            Route::any('po-workflow-add', 'PoWorkflowController@add')->name('po-Workflow-add');
            Route::any('po-workflow-save', 'PoWorkflowController@save')->name('po-workflow-save');
            Route::any('po-workflow-view', 'PoWorkflowController@view')->name('po-workflow-view');
            Route::any('po-workflow-edit-view', 'PoWorkflowController@editView')->name('po-workflow-edit-view');
            Route::any('po-workflow-update', 'PoWorkflowController@update')->name('po-workflow-update');
            Route::any('po-workflow-delete', 'PoWorkflowController@delete')->name('po-workflow-delete');
            Route::any('po-workflow-clone', 'PoWorkflowController@clone')->name('po-workflow-clone');
            Route::any('po-workflow-clone-save', 'PoWorkflowController@cloneSave')->name('po-workflow-clone-save');

            Route::any('grn-workflow', 'GrnWorkflowController@index')->name('grn-Workflow'); //grnWorkflow
            Route::any('grn-workflow-add', 'GrnWorkflowController@add')->name('grn-Workflow-add');
            Route::any('grn-workflow-save', 'GrnWorkflowController@save')->name('grn-workflow-save');
            Route::any('grn-workflow-view', 'GrnWorkflowController@view')->name('grn-workflow-view');
            Route::any('grn-workflow-edit-view', 'GrnWorkflowController@editView')->name('grn-workflow-edit-view');
            Route::any('grn-workflow-update', 'GrnWorkflowController@update')->name('grn-workflow-update');
            Route::any('grn-workflow-delete', 'GrnWorkflowController@delete')->name('grn-workflow-delete');
            Route::any('grn-workflow-clone', 'GrnWorkflowController@clone')->name('grn-workflow-clone');
            Route::any('grn-workflow-clone-save', 'GrnWorkflowController@cloneSave')->name('grn-workflow-clone-save');

            Route::any('invoice-workflow', 'InvoiceWorkflowController@index')->name('invoice-Workflow'); //invoiceWorkflow
            Route::any('invoice-workflow-add', 'InvoiceWorkflowController@add')->name('invoice-Workflow-add');
            Route::any('invoice-workflow-save', 'InvoiceWorkflowController@save')->name('invoice-workflow-save');
            Route::any('invoice-workflow-view', 'InvoiceWorkflowController@view')->name('invoice-workflow-view');
            Route::any('invoice-workflow-edit-view', 'InvoiceWorkflowController@editView')->name('invoice-workflow-edit-view');
            Route::any('invoice-workflow-update', 'InvoiceWorkflowController@update')->name('invoice-workflow-update');
            Route::any('invoice-workflow-delete', 'InvoiceWorkflowController@delete')->name('invoice-workflow-delete');
            Route::any('invoice-workflow-clone', 'InvoiceWorkflowController@clone')->name('invoice-workflow-clone');
            Route::any('invoice-workflow-clone-save', 'InvoiceWorkflowController@cloneSave')->name('invoice-workflow-clone-save');

            Route::any('payment-workflow', 'SupplierPaymentWorkflowController@index')->name('Payment-Workflow');
            Route::any('payment-workflow-add', 'SupplierPaymentWorkflowController@add')->name('Payment-Workflow-add');
            Route::any('payment-workflow-save', 'SupplierPaymentWorkflowController@save')->name('Payment-workflow-save');
            Route::any('payment-workflow-view', 'SupplierPaymentWorkflowController@view')->name('Payment-workflow-view');
            Route::any('payment-workflow-edit-view', 'SupplierPaymentWorkflowController@editView')->name('Payment-workflow-edit-view');
            Route::any('payment-workflow-update', 'SupplierPaymentWorkflowController@update')->name('Payment-workflow-update');
            Route::any('payment-workflow-delete', 'SupplierPaymentWorkflowController@delete')->name('Payment-workflow-delete');
            Route::any('payment-workflow-clone', 'SupplierPaymentWorkflowController@clone')->name('Payment-workflow-clone');
            Route::any('payment-workflow-clone-save', 'SupplierPaymentWorkflowController@cloneSave')->name('Payment-workflow-clone-save');

            Route::any('stock-in-workflow', 'StockInWorkflowController@index')->name('stock-in-Workflow');
            Route::any('stock-in-workflow-add', 'StockInWorkflowController@add')->name('stock-in-Workflow-add');
            Route::any('stock-in-workflow-save', 'StockInWorkflowController@save')->name('stock-in-workflow-save');
            Route::any('stock-in-workflow-view', 'StockInWorkflowController@view')->name('stock-in-workflow-view');
            Route::any('stock-in-workflow-edit-view', 'StockInWorkflowController@editView')->name('stock-in-workflow-edit-view');
            Route::any('stock-in-workflow-update', 'StockInWorkflowController@update')->name('stock-in-workflow-update');
            Route::any('stock-in-workflow-delete', 'StockInWorkflowController@delete')->name('stock-in-workflow-delete');
            Route::any('stock-in-workflow-clone', 'StockInWorkflowController@clone')->name('stock-in-workflow-clone');
            Route::any('stock-in-workflow-clone-save', 'StockInWorkflowController@cloneSave')->name('stock-in-workflow-clone-save');

            Route::any('epr-approve', 'EprApprovalController@epr_approve')->name('list Project Purpose');
            Route::any('epr-resubmit', 'EprApprovalController@epr_resubmit')->name('list Project Purpose');
            Route::any('epr-reject', 'EprApprovalController@epr_reject')->name('list Project Purpose');
            Route::any('epr_view', 'MaterialRequestController@viewpdf')->name('EPR-View');

            Route::any('get-epr-approval-history', 'EprApprovalController@history')->name('get-epr-approval-history');

            Route::any('epr-approval', 'EprApprovalController@index')->name('epr-approval'); //Decision Pending
            Route::any('epr-approval-done', 'EprApprovalController@listDone')->name('list approval done'); //Decision Taken

            Route::any('epr-approve', 'EprApprovalController@epr_approve')->name('list Project Purpose');
            Route::any('epr-resubmit', 'EprApprovalController@epr_resubmit')->name('list Project Purpose');
            Route::any('epr-reject', 'EprApprovalController@epr_reject')->name('list Project Purpose');
            Route::any('epr_view', 'MaterialRequestController@viewpdf')->name('EPR-View');

            Route::any('procurement-list', 'ProcurementController@listing')->name('procurement-list');
            Route::any('proc-list-deptuse', 'ProcurementController@listDeptUse')->name('proc-list-deptuse');
            Route::any('proc-list-personal-use', 'ProcurementController@listPersonalUse')->name('proc-list-personal-use');
            Route::any('proc-list-projectpurpose', 'ProcurementController@listProjectPurpose')->name('proc-list-projectpurpose');

            Route::any('epr-rfq-list', 'RfqController@list')->name('epr-rfq-list');
            Route::any('epr-rfq-list-department', 'RfqController@listDepartment')->name('epr-rfq-list');
            Route::any('epr-rfq-list-personal', 'RfqController@listPersonal')->name('epr-rfq-list');
            Route::any('epr-rfq-list-project', 'RfqController@listProject')->name('epr-rfq-list');
            Route::any('epr-rfq-view', 'RfqController@view')->name('epr-rfq-view');
            Route::any('epr-rfq-view-pdf', 'RfqController@viewPdf')->name('epr-rfq-view-pdf');
            Route::any('epr-rfq-view-pdf-quote', 'RfqController@viewPdfQuote')->name('epr-rfq-view-pdf-quote');
            Route::any('epr-rfq-edit', 'RfqController@editView')->name('epr-rfq-edit');
            Route::any('epr-rfq-update', 'RfqController@update')->name('epr-rfq-update');
            Route::any('epr-rfq-submit', 'RfqController@editforSubmit')->name('epr-rfq-submit');
            Route::any('epr-rfq-submit-update', 'RfqController@submitUpdate')->name('epr-rfq-submit-update');
            Route::any('epr-rfq-generate-po', 'RfqController@editforPo')->name('epr-rfq-PO-update');
            Route::any('epr-rfq-submit-po', 'RfqController@submitPo')->name('epr-rfq-PO-generate');
            Route::any('send-rfq', 'RfqController@sendRfq')->name('send-rfq');
            Route::any('supplier-quotation', 'RfqController@supplierQuotation')->name('supplier-quotation');
            Route::any('supplier-quotation-compare', 'RfqController@supplierQuotationCompare')->name('supplier-quotation-compare');
            Route::any('supplier-quotation-group', 'RfqController@supplierQuotationGroup')->name('supplier-quotation-group');
            Route::any('epr-detail-list', 'RfqController@detailList')->name('epr-detail-list');
            Route::any('quote-comparison-detail-list', 'RfqController@quoteDetailList')->name('quote-comparison-detail-list');


            Route::any('generate-rfq', 'RfqController@generate')->name('generate-rfq');
            Route::any('epr-save-rfq', 'RfqController@save')->name('save-rfq');
            //
            Route::any('epr-po-list', 'PoController@list')->name('epr-po-list');
            Route::any('epr-po-list-department', 'PoController@listDepartment')->name('epr-po-list-department');
            Route::any('epr-po-list-personal', 'PoController@listPersonal')->name('epr-po-list-personal');
            Route::any('epr-po-list-project', 'PoController@listProject')->name('epr-po-list-project');
            Route::any('generate-po', 'PoController@generate')->name('generate-po');
            Route::any('epr-save-po', 'PoController@save')->name('save-po');
            Route::any('epr-po-edit-view', 'PoController@editView')->name('epr-po-edit-view');
            Route::any('epr-po-update', 'PoController@update')->name('epr-po-update');
            Route::any('epr-po-send', 'PoController@send')->name('epr-po-send');
            Route::any('epr-po-resubmit', 'PoController@resubmit')->name('epr-po-resubmit');
            Route::any('epr-po-resubmit-update', 'PoController@resubmitUpdate')->name('epr-po-resubmit-update');
            Route::any('epr-po-view', 'PoController@view')->name('PO View');
            Route::any('epr-po-pdf', 'PoController@pdf')->name('PO pdf');
            Route::any('epr-po-pdf-no-sign', 'PoController@pdfNoSign')->name('PO pdf 1');
            Route::any('epr-po-pdf-technical', 'PoController@pdfPoTechnical')->name('technical PO');
            Route::any('get-po-from-supplier', 'PoController@getPo')->name('get-po-id');

            Route::any('epr-po-closed-list', 'PoController@closedPo')->name('epr-po-closed-list');
            Route::any('purchase-index-list', 'PoController@purchaseIndex')->name('purchase-index-list');
            Route::any('purchase-index-list-specific', 'PoController@purchaseIndexSpecific')->name('purchase-index-list-specific');
            Route::any('purchase-index-pdf', 'PoController@purchaseIndexPdf')->name('purchase-index-pdf');



            Route::any('epr-po-approve-list', 'PoApprovalController@list')->name('po-approve-list');
            Route::any('epr-po-approve-list-approved', 'PoApprovalController@listApproved')->name('po-approve-list-approved');
            Route::any('po-approve', 'PoApprovalController@approve')->name('PO Approve');
            Route::any('po-return', 'PoApprovalController@resubmit')->name('PO return');
            Route::any('po-reject', 'PoApprovalController@reject')->name('PO Reject');
            Route::any('get-po-approval-history', 'PoApprovalController@history')->name('get-po-approval-history');

            Route::any('epr-po-approved-list', 'PoOperationsController@listApproved')->name('epr-po-approved-list');
            Route::any('epr-po-approved-ack-list', 'PoOperationsController@listAck')->name('epr-po-approved-ack-list');
            Route::any('epr-po-opend-list', 'PoOperationsController@listOpend')->name('epr-po-opend-list');
            Route::any('epr-po-opend-list-department', 'PoOperationsController@listOpendDepartment')->name('epr-po-opend-list-department');
            Route::any('epr-po-opend-list-personal', 'PoOperationsController@listOpendPersonal')->name('epr-po-opend-list-personal');
            Route::any('epr-po-opend-list-project', 'PoOperationsController@listOpendProject')->name('epr-po-opend-list-project');



            Route::any('epr-po-send-for-ack', 'PoOperationsController@sendForAck')->name('epr-po-send-for-ack');
            Route::any('epr-po-acknowledge', 'PoOperationsController@acknowledge')->name('epr-po-acknowledge');
            Route::any('epr-po-grn', 'PoOperationsController@grnAdd')->name('epr-po-grn');
            Route::any('epr-po-grn-save', 'PoOperationsController@saveGrn')->name('epr-po-grn-save');


            Route::any('epr-po-invoice-booking', 'PoOperationsController@invoiceBooking')->name('epr-po-invoice-booking');
            Route::any('epr-po-invoice-save', 'PoOperationsController@saveInvoice')->name('epr-po-invoice-save');

            Route::any('epr-po-grn-list', 'GrnController@grnList')->name('epr-po-grn-list');
            Route::any('epr-po-grn-send-list', 'GrnController@grnSendList')->name('epr-po-grn-send-list');
            Route::any('epr-po-grn-approved-list', 'GrnController@grnApprovedList')->name('epr-po-grn-approved-list');
            Route::any('epr-po-grn-rejected-list', 'GrnController@grnRejectedList')->name('epr-po-grn-rejected-list');
            Route::any('epr-po-grn-pdf', 'GrnController@pdf')->name('epr-po-grn-view');
            Route::any('epr-po-grn-edit-view', 'GrnController@edit')->name('epr-po-grn-edit-view');
            Route::any('epr-po-grn-update', 'GrnController@update')->name('epr-po-grn-view');
            Route::any('epr-po-grn-send', 'GrnController@send')->name('epr-po-grn-send');
            Route::any('epr-po-grn-resubmit', 'GrnController@resubmit')->name('epr-po-grn-resubmit');
            Route::any('epr-po-grn-resubmit-update', 'GrnController@resubmitUpdate')->name('epr-po-grn-resubmit-update');

            Route::any('epr-po-invoice-list', 'InvoiceController@invoiceList')->name('epr-po-invoice-list');
            Route::any('epr-po-invoice-list-send', 'InvoiceController@invoiceListSend')->name('epr-po-invoice-list-send');
            Route::any('epr-po-invoice-list-approved', 'InvoiceController@invoiceListApproved')->name('epr-po-invoice-list-approved');
            Route::any('epr-po-invoice-list-rejected', 'InvoiceController@invoiceListRejected')->name('epr-po-invoice-list-rejected');

            Route::any('epr-po-invoice-pdf', 'InvoiceController@pdf')->name('epr-po-invoice-pdf');

            Route::any('epr-po-invoice-edit-view', 'InvoiceController@editView')->name('epr-po-invoice-edit-view');
            Route::any('epr-po-invoice-update', 'InvoiceController@update')->name('epr-po-invoice-update');
            Route::any('epr-po-invoice-send', 'InvoiceController@send')->name('epr-po-invoice-send');
            Route::any('epr-po-invoice-resubmit', 'InvoiceController@resubmit')->name('epr-po-invoice-resubmit');
            Route::any('epr-po-invoice-resubmit-update', 'InvoiceController@resubmitUpdate')->name('epr-po-invoice-resubmit-update');
            Route::any('generate-supplier-payment', 'InvoiceController@generateSupplierPayment')->name('generate-supplier-payment');


            Route::any('epr-po-grn-approve-list', 'GrnApprovalController@list')->name('epr-po-grn-approve-list');
            Route::any('epr-po-grn-done-list', 'GrnApprovalController@doneList')->name('epr-po-grn-done-list');
            Route::any('po-grn-approve', 'GrnApprovalController@approve')->name('grn Approve');
            Route::any('po-grn-return', 'GrnApprovalController@resubmit')->name('grn return');
            Route::any('po-grn-reject', 'GrnApprovalController@reject')->name('grn Reject');
            Route::any('get-grn-approval-history', 'GrnApprovalController@history')->name('get-grn-approval-history');

            Route::any('epr-po-invoice-approve-list', 'InvoiceApprovalController@list')->name('epr-po-invoice-approve-list');
            Route::any('epr-po-invoice-approved-list', 'InvoiceApprovalController@listDepartment')->name('epr-po-grn-approved-list');
            Route::any('po-invoice-approve', 'InvoiceApprovalController@approve')->name('Invoice Approve');
            Route::any('po-invoice-return', 'InvoiceApprovalController@resubmit')->name('Invoice return');
            Route::any('po-invoice-reject', 'InvoiceApprovalController@reject')->name('Invoice Reject');
            Route::any('get-invoice-approval-history', 'InvoiceApprovalController@history')->name('get-invoice-approval-history');


            Route::any('generate-supplier-payment-add', 'SupplierPaymentController@save')->name('generate-supplier-payment-add');
            Route::any('generate-supplier-payment-view', 'SupplierPaymentController@view')->name('generate-supplier-payment-view');
            Route::any('generate-supplier-payment-update', 'SupplierPaymentController@update')->name('generate-supplier-payment-update');
            Route::any('generate-supplier-payment-view-revice', 'SupplierPaymentController@reviceView')->name('generate-supplier-payment-revice');
            Route::any('generate-supplier-payment-resend', 'SupplierPaymentController@resend')->name('generate-supplier-payment-resend');
            Route::any('supplier-payment', 'SupplierPaymentController@list')->name('supplier-payment-list');
            Route::any('supplier-payment-pdf', 'SupplierPaymentController@pdf')->name('supplier-payment-pdf');
            Route::any('supplier-payment-send-list', 'SupplierPaymentController@sendList')->name('supplier-payment-send-list');
            Route::any('supplier-payment-approved-list', 'SupplierPaymentController@approvedList')->name('supplier-payment-approved-list');
            Route::any('supplier-payment-rejected-list', 'SupplierPaymentController@rejectedList')->name('supplier-payment-rejected-list');
            Route::any('supplier-payment-send', 'SupplierPaymentController@send')->name('supplier-payment-send');

            Route::any('supplier-payment-approval', 'SupplierPaymentApprovalController@list')->name('supplier-payment-approval-list');
            Route::any('supplier-payment-approved', 'SupplierPaymentApprovalController@approvedList')->name('supplier-payment-approvaled');
            Route::any('supplier-payment-approve', 'SupplierPaymentApprovalController@approve')->name('supplier-payment-approval Approve');
            Route::any('supplier-payment-return', 'SupplierPaymentApprovalController@resubmit')->name('supplier-payment-approval return');
            Route::any('supplier-payment-reject', 'SupplierPaymentApprovalController@reject')->name('supplier-payment-approvalReject');
            Route::any('get-supay-approval-history', 'SupplierPaymentApprovalController@history')->name('get-supay-approval-history');

            Route::any('grn-send-to-ware-house', 'SendToWareHouseController@add')->name('grn-send-to-ware-house');
            Route::any('grn-send-to-ware-house-save', 'SendToWareHouseController@save')->name('grn-send-to-ware-house-save');

            Route::any('epr-po-grn-stock-in', 'SendToWareHouseController@list')->name(' epr-po-grn-stock-in');
            Route::any('epr-po-grn-stock-in-list-send', 'SendToWareHouseController@listSend')->name('epr-po-grn-stock-in-list-send');
            Route::any('epr-po-grn-stock-in-list-approved', 'SendToWareHouseController@listApproved')->name('epr-po-grn-stock-in-list-approved');
            Route::any('epr-po-grn-stock-in-list-rejected', 'SendToWareHouseController@listRejected')->name('epr-po-grn-stock-in-list-rejected');
            Route::any('epr-po-grn-stock-in-pdf', 'SendToWareHouseController@pdf')->name('epr-po-grn-stock-in-pdf');


            Route::any('epr-po-grn-stock-in-edit', 'SendToWareHouseController@edit')->name(' epr-po-grn-stock-in-edit');
            Route::any('epr-po-grn-stock-in-update', 'SendToWareHouseController@update')->name(' epr-po-grn-stock-in-update');
            Route::any('epr-po-grn-stock-in-send', 'SendToWareHouseController@send')->name('epr-po-grn-send');
            Route::any('epr-po-grn-stock-in-resend', 'SendToWareHouseController@editResend')->name('epr-po-grn-resend');
            Route::any('epr-po-grn-stock-in-resend-update', 'SendToWareHouseController@updateAndResend')->name('epr-po-grn-stock-in-resend-update');


            Route::any('epr-po-grn-stock-in-approval-list', 'StockInApprovalController@list')->name('epr-po-grn-stock-in-approval-list');
            Route::any('epr-po-grn-stock-in-approved-list', 'StockInApprovalController@listOldAction')->name('epr-po-grn-stock-in-approvaed-list');
            Route::any('epr-po-grn-stock-in-approve', 'StockInApprovalController@approve')->name('epr-po-grn-stock-in-approve');
            Route::any('epr-po-grn-stock-in-return', 'StockInApprovalController@resubmit')->name('epr-po-grn-stock-in-approval return');
            Route::any('epr-po-grn-stock-in-reject', 'StockInApprovalController@reject')->name('epr-po-grn-stock-in-approvalReject');
            Route::any('get-stockin-approval-history', 'StockInApprovalController@history')->name('get-stockin-approval-history');
            Route::resource('procurement-user-management', 'UsermanegementController');
            Route::post('user-sign-upload', 'UsermanegementController@userSignUpload')->name('user-sign-upload');

            Route::any('epr-pocess-list', 'ProcessListController@getEprFullProcess')->name('epr-pocess-list');

            Route::any('stock-transfer-list', 'StockTransferController@list')->name('stock-transfer-list');
            Route::any('stock-transfer-list-send', 'StockTransferController@sendList')->name('stock-transfer-list-send');
            Route::any('stock-transfer-approvedlist', 'StockTransferController@approvedList')->name('stock-transfer-approvedlist');
            Route::any('stock-transfer-list-rejected', 'StockTransferController@rejectedList')->name('stock-transfer-list-rejected');

            Route::any('generate-stock-transfer', 'StockTransferController@generate')->name('generate-stock-transfer');
            Route::any('stock-transfer-save', 'StockTransferController@save')->name('stock-transfer-save');
            Route::any('stock-transfer-edit-view', 'StockTransferController@editView')->name('stock-transfer-edit-view');
            Route::any('stock-transfer-update', 'StockTransferController@Update')->name('stock-transfer-update');
            Route::any('stock-transfer-resubmit', 'StockTransferController@resubmit')->name('stock-transfer-resubmit');
            Route::any('stock-transfer-update-resubmit', 'StockTransferController@resubmitUpdate')->name('stock-transfer-update-resubmit');

            Route::any('stock-transfer-send', 'StockTransferController@send')->name('stock-transfer-send');
            Route::any('stock-transfer-pdf', 'StockTransferController@pdf')->name('stock-transfer-pdf');

            Route::any('stock-transfer-approve-list', 'StockTransferApprovalController@list')->name('stock-transfer-approve-list');
            Route::any('stock-transfer-approved-list', 'StockTransferApprovalController@listApproved')->name('stock-transfer-approved-list');
            Route::any('stock-transfer-list-approved', 'StockTransferApprovalController@listApproved')->name('stock-transfer-list-approved');
            Route::any('stock-transfer-approve', 'StockTransferApprovalController@approve')->name('stock-transfer-approve');
            Route::any('stock-transfer-return', 'StockTransferApprovalController@resubmit')->name('stock-transfer-return');
            Route::any('stock-transfer-reject', 'StockTransferApprovalController@reject')->name('stock-transfer-reject');
            Route::any('get-stock-transfer-approval-history', 'StockTransferApprovalController@history')->name('get-stock-transfer-approval-history');

            Route::any('get-user-details', 'SuggestionController@getUserDetails')->name('get-user-details');

            Route::any('suggestion-send', 'SuggestionController@index')->name('suggestion-send');
            Route::any('get-suggestion-details', 'SuggestionController@getSuggestions')->name('get-suggestion-details');
            Route::any('suggestion-save', 'SuggestionController@save')->name('suggestion-save');

            Route::any('suggestion-chat-room', 'SuggestionChatRoomController@chatRoom')->name('suggestion-chat-room');
            Route::any('get-suggestion-chat-room-details', 'SuggestionChatRoomController@getSuggestions')->name('get-suggestion-chat-room-details');
            Route::any('suggestion-chat-room-save', 'SuggestionChatRoomController@save')->name('suggestion-chat-room-save');


            Route::any('epr-statistics', 'ReportsController@eprStatistics')->name('epr-statistics');
            Route::any('epr-statistics-non-boq', 'ReportsController@eprStatisticsNonBoq')->name('epr-statistics-non-boq');
            Route::any('epr-statistics-stock-req', 'ReportsController@eprStatisticsStockReq')->name('epr-statistics-stock-req');
            Route::any('epr-product-list/{id}', 'ReportsController@eprProductList')->name('epr-product-list');

            Route::any('po-statistics', 'ReportsController@poStatistics')->name('po-statistics');
            Route::any('po-statistics-non-boq', 'ReportsController@poStatisticsNonBoq')->name('po-statistics-non-boq');
            Route::any('po-statistics-stock-req', 'ReportsController@poStatisticsStockReq')->name('po-statistics-stock-req');
            Route::any('po-product-list/{id}', 'ReportsController@poProductList')->name('po-product-list');
        });
        // Procurement

        // comments
        Route::any('get-comments', 'CommentsController@getComments')->name('get-comments');
        Route::any('comment-save', 'CommentsController@save')->name('comment-save');
        // comments


        Route::any('epr-transfer-request', 'Warehouse\EprTransferController@list')->name('epr-transfer-request');
        Route::any('epr-transfer-request-completed', 'Warehouse\EprTransferController@listCompleted')->name('epr-transfer-request-completed');
        Route::any('stock-transfer-approve-list-warehouse', 'Warehouse\EprTransferController@listApprove')->name('stock-transfer-approve-list-warehouse');
        Route::any('add-transfer-stock', 'Warehouse\EprTransferController@transferStock')->name('add-transfer-stock');
        Route::any('transfer-stock-save', 'Warehouse\EprTransferController@transferStockSave')->name('transfer-stock-save');
        Route::any('transfer-stock-edit-view', 'Warehouse\EprTransferController@editView')->name('transfer-stock-edit-view');
        Route::any('transfer-stock-update', 'Warehouse\EprTransferController@update')->name('transfer-stock-update');
        Route::any('transfer-stock-pdf', 'Warehouse\EprTransferController@pdf')->name('transfer-stock-pdf');

        Route::any('transfer-stock-list', 'Warehouse\EprTransferController@listTransferStock')->name('transfer-stock-list');
        Route::any('transfer-stock-list-send', 'Warehouse\EprTransferController@listTransferStockSend')->name('transfer-stock-list-send');

        Route::any('transfer-stock-send', 'Warehouse\EprTransferController@send')->name('transfer-stock-send');

        Route::any('epr-po-grn-receive-stock', 'Warehouse\ReceiveStockToWareHouseController@receiveStock')->name('epr-po-grn-receive-stock');
        Route::any('epr-po-grn-receive-stock-add', 'Warehouse\ReceiveStockToWareHouseController@add')->name('epr-po-grn-receive-stock-add');
        Route::any('procurement-stock-in', 'Warehouse\ReceiveStockToWareHouseController@list')->name('procurement-stock-in');
        Route::any('procurement-stock-in-received', 'Warehouse\ReceiveStockToWareHouseController@listReceived')->name('procurement-stock-in-received');






        Route::group(['prefix' => 'financial-entries', 'namespace' => 'financialEntries'], function () {
            Route::any('home', 'HomeController@index')->name('financial-entries-home');
            Route::any('financial-entries', 'FinancialEntriesController@list')->name('financial-entries');
        });

        Route::group(['prefix' => 'e-treasury', 'namespace' => 'eTreasury'], function () {
            Route::any('home', 'HomeController@index')->name('e-treasury-home');
            Route::any('electronic-treasury', 'ElectronicTreasuryController@list')->name('electronic-treasury');

            Route::any('e-treasury-vouchers', 'ElectronicTreasuryController@listVouchers')->name('e-treasury-vouchers');
            Route::any('voucher-pdf', 'ElectronicTreasuryController@voucherPdf')->name('voucher-pdf');
            Route::any('generate-payment-voucher-vc', 'ElectronicTreasuryController@generatePaymentVoucheVc')->name('generate-payment-voucher-vc');
            Route::any('generate-payment-voucher-vc-add', 'ElectronicTreasuryController@generatePaymentVoucherVcAdd')->name('generate-payment-voucher-vc-add');

            Route::any('generate-payment-voucher', 'ElectronicTreasuryController@generatePaymentVoucher')->name('generate-payment-voucher');
            Route::any('generate-payment-voucher-add', 'ElectronicTreasuryController@generatePaymentVoucherAdd')->name('generate-payment-voucher-add');
            Route::any('electronic-treasury-generated-voucher', 'ElectronicTreasuryController@generatedVoucherList')->name('electronic-treasury-generated-voucher');
            Route::any('issue-payment-voucher-add', 'ElectronicTreasuryController@issuePaymentVoucherAdd')->name('generate-payment-voucher-add');
            Route::any('issue-payment-voucher', 'ElectronicTreasuryController@issuePayment')->name('issue-payment-voucher');
            Route::any('issued-payment-voucher-list', 'ElectronicTreasuryController@issuePaymentVoucherList')->name('issued-payment-voucher-list');
            Route::any('generated-payment-voucher-pdf', 'ElectronicTreasuryController@generatePaymentVoucherPdf')->name('generated-payment-voucher-Pdf');
            Route::any('issued-payment-voucher-pdf', 'ElectronicTreasuryController@issuePaymentVoucherPdf')->name('issued-payment-voucher-list');
        });

        Route::group(['prefix' => 'vouchers', 'namespace' => 'vouchers'], function () {
            Route::any('home', 'HomeController@index')->name('vouchers-home');
            Route::any('synthesis', 'SynthesisController@index')->name('synthesis');
            Route::any('synthesis-add', 'SynthesisController@add')->name('synthesis-add');
            Route::any('synthesis-save', 'SynthesisController@save')->name('synthesis-save');
            Route::any('synthesis-view', 'SynthesisController@view')->name('synthesis-view');
            Route::any('synthesis-edit-view', 'SynthesisController@editView')->name('synthesis-view');
            Route::any('synthesis-update', 'SynthesisController@update')->name('synthesis-update');
            Route::any('synthesis-delete', 'SynthesisController@delete')->name('synthesis-delete');

            Route::any('vouchers', 'VoucherController@list')->name('vouchers');
            Route::any('vouchers-send-list', 'VoucherController@listSend')->name('vouchers-send-list');
            Route::any('vouchers-approved', 'VoucherController@listApproved')->name('vouchers-approved');
            Route::any('vouchers-rejected', 'VoucherController@listRejected')->name('vouchers-rejected');
            Route::any('vouchers-send', 'VoucherController@send')->name('vouchers-send');
            Route::any('voucher-add', 'VoucherController@add')->name('voucher-add');
            Route::any('voucher-save', 'VoucherController@save')->name('voucher-save');
            Route::any('voucher-edit-view', 'VoucherController@editView')->name('voucher-edit-view');
            Route::any('voucher-update', 'VoucherController@update')->name('voucher-update');
            Route::any('voucher-pdf', 'VoucherController@pdf')->name('voucher-pdf');

            Route::any('voucher-approval', 'VoucherApprovalController@list')->name('voucher-approval');
            Route::any('voucher-approval-old', 'VoucherApprovalController@listOld')->name('voucher-approval-old');
            Route::any('voucher-approve', 'VoucherApprovalController@approve')->name('voucher Approve');
            Route::any('voucher-reject', 'VoucherApprovalController@reject')->name('voucher Reject');
            Route::any('get-voucher-approval-history', 'VoucherApprovalController@history')->name('get-voucher-approval-history');
        });

        Route::group(['prefix' => 'tenders', 'namespace' => 'Tenders'], function () {
            Route::any('home', 'HomeController@index')->name('Tenders-home');
            Route::any('tender', 'TenderController@index')->name('tender-list');
            Route::any('tender-list-send', 'TenderController@sendList')->name('tender-list-send');
            Route::any('approved-tender-list', 'TenderController@ApprovedList')->name('approved-tender-list');
            Route::any('tender-list-rejected', 'TenderController@rejectedList')->name('tender-list-rejected');
            Route::any('tender-add', 'TenderController@add')->name('tender-add');
            Route::any('tender-save', 'TenderController@save')->name('tender-save');
            Route::any('tender-edit-view', 'TenderController@edit')->name('tender-edit-view');
            Route::any('tender-update', 'TenderController@update')->name('tender-update');

            Route::any('tender-trash', 'TenderController@trash')->name('tender-trash');
            Route::any('tender-send', 'TenderController@send')->name('tender-send');
            Route::any('tender-pdf', 'TenderController@pdf')->name('tender-pdf');

            Route::any('participation-list', 'TenderController@participationList')->name('participation-list');
            Route::any('participation-send', 'TenderController@participationSend')->name('participation-send');


            Route::any('category', 'CategoryController@list')->name('category');
            Route::any('category-add', 'CategoryController@add')->name('category-add');
            Route::any('category-submit', 'CategoryController@submit')->name('category-submit');
            Route::any('category-edit', 'CategoryController@edit')->name('category-edit');
            Route::any('category-delete', 'CategoryController@delete')->name('category-delete');

            Route::any('sales-proposal-category', 'SalesProposalCategoryController@list')->name('sales-proposal-category');
            Route::any('sales-proposal-category-add', 'SalesProposalCategoryController@add')->name('sales-proposal-category-add');
            Route::any('sales-proposal-category-submit', 'SalesProposalCategoryController@submit')->name('sales-proposal-category-submit');
            Route::any('sales-proposal-category-edit', 'SalesProposalCategoryController@edit')->name('sales-proposal-category-edit');
            Route::any('sales-proposal-category-delete', 'SalesProposalCategoryController@delete')->name('sales-proposal-category-delete');


            Route::any('category-synthesis', 'CategorySynthesisController@index')->name('category-synthesis');
            Route::any('category-synthesis-add', 'CategorySynthesisController@add')->name('category-synthesis-add');
            Route::any('category-synthesis-save', 'CategorySynthesisController@save')->name('category-synthesis-save');
            Route::any('category-synthesis-view', 'CategorySynthesisController@view')->name('category-synthesis-view');
            Route::any('category-synthesis-edit-view', 'CategorySynthesisController@editView')->name('category-synthesis-edit-view');
            Route::any('category-synthesis-update', 'CategorySynthesisController@update')->name('category-synthesis-update');
            Route::any('category-synthesis-delete', 'CategorySynthesisController@delete')->name('category-synthesis-delete');
            Route::any('category-synthesis-clone', 'CategorySynthesisController@clone')->name('category-synthesis-clone');
            Route::any('category-synthesis-clone-save', 'CategorySynthesisController@cloneSave')->name('category-synthesis-clone-save');

            Route::any('sales-proposal-synthesis', 'SalesProposalSynthesisController@index')->name('sales-proposal-synthesis');
            Route::any('sales-proposal-synthesis-add', 'SalesProposalSynthesisController@add')->name('sales-proposal-synthesis-add');
            Route::any('sales-proposal-synthesis-save', 'SalesProposalSynthesisController@save')->name('sales-proposal-synthesis-save');
            Route::any('sales-proposal-synthesis-view', 'SalesProposalSynthesisController@view')->name('sales-proposal-synthesis-view');
            Route::any('sales-proposal-synthesis-edit-view', 'SalesProposalSynthesisController@editView')->name('sales-proposal-synthesis-edit-view');
            Route::any('sales-proposal-synthesis-update', 'SalesProposalSynthesisController@update')->name('sales-proposal-synthesis-update');
            Route::any('sales-proposal-synthesis-delete', 'SalesProposalSynthesisController@delete')->name('sales-proposal-synthesis-delete');
            Route::any('sales-proposal-synthesis-clone', 'SalesProposalSynthesisController@clone')->name('sales-proposal-synthesis-clone');
            Route::any('sales-proposal-synthesis-clone-save', 'SalesProposalSynthesisController@cloneSave')->name('sales-proposal-synthesis-clone-save');


            Route::any('tender-approve-list', 'TenderApprovalController@list')->name('tender-approve-list');
            Route::any('tender-approved-list', 'TenderApprovalController@listApproved')->name('tender-approved-list');
            Route::any('tender-list-approved', 'TenderApprovalController@listApproved')->name('tender-list-approved');
            Route::any('tender-approve', 'TenderApprovalController@approve')->name('tender-approve');
            Route::any('tender-return', 'TenderApprovalController@resubmit')->name('tender-return');
            Route::any('tender-reject', 'TenderApprovalController@reject')->name('tender-reject');
            Route::any('get-tender-approval-history', 'TenderApprovalController@history')->name('get-tender-approval-history');

            Route::post('tender-file-upload', 'TenderController@tenderFileUpload')->name('user-sign-upload');

            Route::any('estimated-boq-list', 'EstimatedBoqController@index')->name('estimated-boq-list');
            Route::any('estimated-boq-list-child', 'EstimatedBoqController@Child')->name('estimated-boq-list-child');

            Route::any('generate-proposal', 'EstimatedBoqController@generateProposal')->name('generate-proposal');
            Route::any('generate-proposal-save', 'EstimatedBoqController@save')->name('generate-proposal-save');

            Route::any('prepare-sales-proposal', 'SalesProposalController@index')->name('prepare-sales-proposal');
            Route::any('prepare-sales-proposal-save', 'SalesProposalController@save')->name('prepare-sales-proposal-save');
            Route::any('prepare-sales-proposal-edit', 'SalesProposalController@edit')->name('prepare-sales-proposal-edit');
            Route::any('prepare-sales-proposal-update', 'SalesProposalController@update')->name('prepare-sales-proposal-update');
            Route::any('prepare-sales-proposal-send', 'SalesProposalController@send')->name('prepare-sales-proposal-send');
            Route::any('sales-proposal-list', 'SalesProposalController@listTender')->name('sales-proposal-list');
            Route::any('sales-proposal-list-send', 'SalesProposalController@listTenderSend')->name('sales-proposal-list-send');
            Route::any('sales-proposal-list-main-approved', 'SalesProposalController@listTenderApproved')->name('sales-proposal-list-main-approved');
            Route::any('sales-proposal-list-rejected', 'SalesProposalController@listTenderRejected')->name('sales-proposal-list-rejected');
            Route::any('sales-proposal-list-project', 'SalesProposalController@listProject')->name('sales-proposal-list-project');
            Route::any('sales-proposal-list-project-send', 'SalesProposalController@listProjectSend')->name('sales-proposal-list-project-send');
            Route::any('sales-proposal-list-project-approved', 'SalesProposalController@listProjectApproved')->name('sales-proposal-list-project-approved');
            Route::any('sales-proposal-list-project-rejected', 'SalesProposalController@listProjectRejected')->name('sales-proposal-list-project-rejected');
            Route::post('sales-proposal-upload', 'SalesProposalController@salesProposalUpload')->name('sales-proposal-upload');
            Route::any('sales-proposal-pdf', 'SalesProposalController@pdf')->name('sales-proposal-pdf');


            Route::any('sales-proposal-approve-list', 'SalesProposalApprovalController@list')->name('sales-proposal-approve-list');
            Route::any('sales-proposal-approved-list', 'SalesProposalApprovalController@listApproved')->name('sales-proposal-approved-list');
            Route::any('sales-proposal-approve', 'SalesProposalApprovalController@approve')->name('sales-proposal-approve');
            Route::any('sales-proposal-return', 'SalesProposalApprovalController@resubmit')->name('sales-proposal-return');
            Route::any('sales-proposal-reject', 'SalesProposalApprovalController@reject')->name('sales-proposal-reject');
            Route::any('get-sales-proposal-approval-history', 'SalesProposalApprovalController@history')->name('get-sales-proposal-approval-history');

            Route::any('sales-order-list', 'SalesOrderController@index')->name('sales-order-list');
            Route::any('sales-order-converted-list', 'SalesOrderController@indexConverted')->name('sales-order-converted-list');
            Route::any('sales-order-add', 'SalesOrderController@add')->name('sales-order-add');
            Route::any('sales-order-add-blank', 'SalesOrderController@addBlank')->name('sales-order-add-blank');
            Route::any('sales-order-save', 'SalesOrderController@save')->name('sales-order-save');
            Route::any('so-delete', 'SalesOrderController@delete')->name('so-delete');

            Route::any('so-convert-to-project', 'SalesOrderController@convert')->name('so-convert-to-project');
        });

        Route::group(['namespace' => 'costing'], function () {
            Route::any('cost-estimation/dashboard', 'DashboardController@index')->name('cost-estimation');
            Route::any('cost-estimation', 'CostController@index')->name('cost-estimation');
            Route::any('cost-estimation-child', 'CostController@child')->name('cost-estimation-child');
            Route::any('boq-mark-estimation-completed', 'CostController@markEstimationCompleted')->name('boq-mark-estimation-completed');
            Route::any('boq-mark-estimation-pending', 'CostController@markEstimationPending')->name('boq-mark-estimation-pending');

            Route::any('estimation-column', 'SettingsController@list')->name('estimation-column');
            Route::any('estimation-column-add', 'SettingsController@add')->name('estimation-column-add');
            Route::any('estimation-column-submit', 'SettingsController@submit')->name('estimation-column-submit');
            Route::any('estimation-column-edit', 'SettingsController@edit')->name('estimation-column-edit');
            Route::any('estimation-column-view', 'SettingsController@view')->name('estimation-column-view');
            Route::any('estimation-column-delete', 'SettingsController@delete')->name('estimation-column-delete');

            Route::any('costmatrix', 'CostmatrixController@costmatrix')->name('costmatrix');
            Route::any('Add_costmatrix', 'CostmatrixController@Add_costmatrix')->name('Add_costmatrix');
            Route::any('costmatrixsubmit', 'CostmatrixController@costmatrixsubmit')->name('costmatrixsubmit');
            Route::any('addcostestimation', 'CostmatrixController@addcostestimation')->name('addcostestimation');
            Route::any('/costmatrix_head/find', 'CostmatrixController@searcheads')->name('costmatrix-head-find');
            Route::any('delete-costmatrix', 'CostmatrixController@delete_costmatrix')->name('delete-costmatrix');
            Route::any('costmatrixedit', 'CostmatrixController@costmatrixedit')->name('costmatrixedit');
            Route::any('costmatrixupdate', 'CostmatrixController@costmatrixupdate')->name('costmatrixupdate');
            Route::any('costmatrix_estimation', 'CostmatrixController@costmatrix_estimation')->name('costmatrix_estimation');
            Route::any('getproduct-costmatrix', 'CostmatrixController@getproductCostmatrix')->name('getproduct-costmatrix');


            Route::any('direct-cost-estimation/{id}', 'CostDescribeController@directCostEstimation')->name('direct cost Estimation');
            Route::any('direct-cost-estimation-save', 'CostDescribeController@directCostEstimationSave')->name('direct cost Estimation Save');
            Route::any('cost-describe', 'CostDescribeController@index')->name('cost-describe');
            Route::any('cost-describe-save', 'CostDescribeController@save')->name('cost-describe-save');
            Route::any('cost-describe-view', 'CostDescribeController@view')->name('cost-describe-view');
        });

        Route::group(['namespace' => 'MaterialDirectory'], function () {
            Route::any('material-directory/dashboard', 'MaterialDirectoryControlller@dashboard')->name('material-directory/dashboard');
            Route::any('material-directory', 'MaterialDirectoryControlller@index')->name('material-directory');
            Route::any('material-directory-add', 'MaterialDirectoryControlller@add')->name('material-directory-add');
            Route::any('material-directory-save', 'MaterialDirectoryControlller@save')->name('material-directory-save');
            Route::any('material-directory-edit-view', 'MaterialDirectoryControlller@editView')->name('material-directory-edit-view');
            Route::any('material-directory-update', 'MaterialDirectoryControlller@update')->name('material-directory-update');
            Route::any('material-directory-upload', 'MaterialDirectoryControlller@fileUp')->name('material-directory-upload');
            Route::any('file-import-material-directory', 'MaterialDirectoryControlller@file_import')->name('file-import-material-directory');
            Route::any('material-directory-get-tmplate', 'MaterialDirectoryControlller@getTmplate')->name('material-directory-get-tmplate');
        });

        Route::group(['prefix' => 'e-sign', 'namespace' => 'Esign'], function () {
            Route::any('dashboard', 'HomeController@index')->name('e-sign-home');
            Route::any('newpage', 'HomeController@newpage')->name('newpage');
            Route::any('newform', 'HomeController@newForm')->name('newForm');
            Route::any('signform', 'HomeController@signform')->name('signform');
            Route::any('approvals', 'HomeController@approvals')->name('approvals');
        });

        Route::group(['namespace' => 'Projects'], function () {
            Route::any('projects', 'DashboardController@projects')->name('projects');
            Route::any('projectlist', 'ProjectController@projectlist')->name('Project list');
            Route::any('project-list-send', 'ProjectController@projectlistSend')->name('Project list send');
            Route::any('project-list-approved', 'ProjectController@projectlistApproved')->name('Project list Approved');
            Route::any('project-list-rejected', 'ProjectController@projectlistRejected')->name('Project list Rejected');
            Route::any('addprojects', 'ProjectController@addprojects')->name('Add projects');
            Route::any('projectsubmit', 'ProjectController@projectsubmit')->name('Project Submit');
            Route::any('projectupdate', 'ProjectController@projectupdate')->name('Project Update');
            Route::any('deleteprojects', 'ProjectController@deleteprojects')->name('Delete Projects');
            Route::any('project-send', 'ProjectController@projectSend')->name('project-send');

            Route::any('projects-awarded-list', 'ProjectController@awardedList')->name('projects-awarded-list');

            Route::any('project-pdf', 'ProjectController@pdf')->name('project-pdf');

            Route::any('managelabels', 'ProjectController@managelabels')->name('Manage labels');
            Route::any('labelsubmit', 'ProjectController@labelsubmit')->name('Label Save');
            Route::any('getlabelupdate', 'ProjectController@getlabelupdate')->name('Get Label Update');
            Route::any('deletelabels', 'ProjectController@deletelabels')->name('Delete Labels');
            Route::any('getsalesorder', 'ProjectController@getsalesorder')->name('Get Sales Order');


            Route::any('project-category', 'ProjectCategoryController@list')->name('project-category');
            Route::any('project-category-add', 'ProjectCategoryController@add')->name('project-category-add');
            Route::any('project-category-submit', 'ProjectCategoryController@submit')->name('project-category-submit');
            Route::any('project-category-edit', 'ProjectCategoryController@edit')->name('project-category-edit');
            Route::any('project-category-delete', 'ProjectCategoryController@delete')->name('project-category-delete');

            Route::any('project-category-synthesis', 'ProjectCategorySynthesisController@index')->name('project-category-synthesis');
            Route::any('project-category-synthesis-add', 'ProjectCategorySynthesisController@add')->name('project-category-synthesis-add');
            Route::any('project-category-synthesis-save', 'ProjectCategorySynthesisController@save')->name('project-category-synthesis-save');
            Route::any('project-category-synthesis-view', 'ProjectCategorySynthesisController@view')->name('project-category-synthesis-view');
            Route::any('project-category-synthesis-edit-view', 'ProjectCategorySynthesisController@editView')->name('project-category-synthesis-edit-view');
            Route::any('project-category-synthesis-update', 'ProjectCategorySynthesisController@update')->name('project-category-synthesis-update');
            Route::any('project-category-synthesis-delete', 'ProjectCategorySynthesisController@delete')->name('project-category-synthesis-delete');
            Route::any('project-category-synthesis-clone', 'ProjectCategorySynthesisController@clone')->name('project-category-synthesis-clone');
            Route::any('project-category-synthesis-clone-save', 'ProjectCategorySynthesisController@cloneSave')->name('project-category-synthesis-clone-save');

            Route::any('project-approve-list', 'ProjectApprovalController@list')->name('project-approve-list');
            Route::any('project-approved-list', 'ProjectApprovalController@listApproved')->name('project-approved-list');
            Route::any('project-list-approved-approval', 'ProjectApprovalController@listApproved')->name('project-list-approved-approval');
            Route::any('project-approve', 'ProjectApprovalController@approve')->name('project-approve');
            Route::any('project-return', 'ProjectApprovalController@resubmit')->name('project-return');
            Route::any('project-reject', 'ProjectApprovalController@reject')->name('project-reject');
            Route::any('get-project-approval-history', 'ProjectApprovalController@history')->name('get-project-approval-history');

            Route::any('project-overview/{id}', 'ProjectFunctionsController@overView')->name('project-reject');
            Route::any('project-task-list/{id}', 'ProjectFunctionsController@taskList')->name('project-task-list');
            Route::any('project-task-list-kanaban/{id}', 'ProjectFunctionsController@taskListKanaban')->name('project-task-list-kanaban');
            Route::any('project-task-list-gantt/{id}', 'ProjectFunctionsController@taskListGantt')->name('project-task-list-gantt');
            Route::any('project-milestones/{id}', 'ProjectFunctionsController@milestones')->name('project-milestones');
            Route::any('project-notes/{id}', 'ProjectFunctionsController@notes')->name('project-notes');
            Route::any('project-files/{id}', 'ProjectFunctionsController@files')->name('project-files');
            Route::any('project-comments/{id}', 'ProjectFunctionsController@comments')->name('project-comments');
            Route::any('project-customer-feedback/{id}', 'ProjectFunctionsController@customerFeedback')->name('project-customer-feedback');
            Route::any('project-material-request/{id}', 'ProjectFunctionsController@materialRequest')->name('project-material-request');
            Route::any('project-materials-alocated/{id}', 'ProjectFunctionsController@materialAlocated')->name('project-materials-alocated');
            Route::any('project-materials/{id}', 'ProjectFunctionsController@material')->name('project-materials');
            Route::any('project-invoices/{id}', 'ProjectFunctionsController@invoices')->name('project-invoices');
            Route::any('project-payments/{id}', 'ProjectFunctionsController@payments')->name('project-payments');
            Route::any('project-expences/{id}', 'ProjectFunctionsController@expences')->name('project-expences');
            Route::any('project-contracts/{id}', 'ProjectFunctionsController@contracts')->name('project-contracts');
            Route::any('project-cost-centre/{id}', 'ProjectFunctionsController@costCentre')->name('project-cost-centre');
            Route::any('project-time-sheet/{id}', 'ProjectFunctionsController@timeSheet')->name('project-time-sheet');
            Route::any('project-debit-note/{id}', 'ProjectFunctionsController@debitNote')->name('project-debit-note');
            Route::any('project-credit-note/{id}', 'ProjectFunctionsController@creditNote')->name('project-credit-note');
            Route::any('project-adwance/{id}', 'ProjectFunctionsController@adwance')->name('project-adwancet');
            Route::any('project-receipt/{id}', 'ProjectFunctionsController@receipt')->name('project-receipt');
            Route::any('project-progressive-report/{id}', 'ProjectFunctionsController@progressiveReport')->name('project-progressive-report');
            Route::any('project-completion-report/{id}', 'ProjectFunctionsController@completionReport')->name('project-completion-report');

            Route::group(['namespace' => 'gantt'], function () {
                Route::any('gantt/listproject/{id}', 'GanttController@get')->name('gantt/listproject');
                Route::resource('gantt/task', 'TaskController');
            });

            Route::any('project-cost-centre-man-power/{id}', 'ProjectFunctionsController@costCentreManPower')->name('project-cost-centre-man-power');

            Route::any('project-member-add', 'ProjectFunctionsController@addMemeber')->name('project-member-add');
            Route::any('project-member-delete', 'ProjectFunctionsController@removeMemeber')->name('project-member-delete');

            Route::any('project-milestone-submit', 'ProjectFunctionsController@projectMilestoneSubmit')->name('project-milestone-submit');
            Route::any('get-project-milestone', 'ProjectFunctionsController@getProjectMilestone')->name('get-project-milestone');
            Route::any('project-milestone-delete', 'ProjectFunctionsController@projectMilestoneDelete')->name('project-milestone-delete');


            Route::any('get-project-note', 'ProjectFunctionsController@getProjectNotes')->name('get-project-note');
            Route::any('project-note-submit', 'ProjectFunctionsController@projectNotesSubmit')->name('project-note-submit');
            Route::any('project-note-delete', 'ProjectFunctionsController@projectNotesDelete')->name('project-note-delete');

            Route::any('get-project-file-details', 'ProjectFunctionsController@getProjectFileDetails')->name('get-project-file-details');
            Route::any('project-file-details-update', 'ProjectFunctionsController@projectFileDetailsUpdate')->name('project-file-details-update');
            Route::any('project-file-upload', 'ProjectFunctionsController@projectFilesUpload')->name('project-file-upload');
            Route::any('project-file-delete', 'ProjectFunctionsController@projectFileDelete')->name('project-file-delete');
            Route::any('project-file-download', 'ProjectFunctionsController@projectFileDownload')->name('project-file-download');


            Route::any('project-comment-file-upload', 'ProjectFunctionsController@projectCommentFilesUpload')->name('project-comment-file-upload');
            Route::any('project-comment-submit', 'ProjectFunctionsController@projectCommentSubmit')->name('project-comment-submit');
            Route::any('project-comment-delete', 'ProjectFunctionsController@projectCommentDelete')->name('project-comment-delete');

            Route::any('project-sub-comment-submit', 'ProjectFunctionsController@projectSubCommentSubmit')->name('project-sub-comment-submit');
            Route::any('project-sub-comment-delete', 'ProjectFunctionsController@projectSubCommentSubmit')->name('roject-sub-comment-delete');

            Route::any('project-customer-feedback-file-upload', 'ProjectFunctionsController@projectCustomerFeedbackFilesUpload')->name('project-customer-feedback-file-upload');
            Route::any('project-customer-feedback-submit', 'ProjectFunctionsController@projectCustomerFeedbackSubmit')->name('project-customer-feedback-submit');
            Route::any('project-customer-feedback-delete', 'ProjectFunctionsController@projectCustomerFeedbackDelete')->name('project-customer-feedback-delete');

            Route::any('project-sub-customer-feedback-submit', 'ProjectFunctionsController@projectSubCustomerFeedbackSubmit')->name('project-sub-customer-feedback-submit');
            Route::any('project-sub-customer-feedback-delete', 'ProjectFunctionsController@projectSubCustomerFeedbackDelete')->name('roject-sub-customer-feedback-delete');


            // material request
            Route::any('project-material-request-add/{id}', 'StockTransferController@generate')->name('project-material-request-add');
            Route::any('project-stock-transfer-save', 'StockTransferController@save')->name('stock-transfer-save');
            Route::any('project-material-request-edit-view/{id}', 'StockTransferController@editView')->name('project-material-request-edit-view');
            Route::any('project-stock-transfer-update', 'StockTransferController@Update')->name('stock-transfer-update');
            Route::any('project-stock-transfer-resubmit/{id}', 'StockTransferController@resubmit')->name('project-stock-transfer-resubmit');
            Route::any('project-stock-transfer-resubmit-update', 'StockTransferController@resubmitUpdate')->name('project-stock-transfer-resubmit-update');
            // ./ material request


            Route::any('get-project-contract-details', 'ProjectFunctionsController@getProjectContractDetails')->name('get-project-contract-details');
            Route::any('project-contract-details-update', 'ProjectFunctionsController@projectContractDetailsUpdate')->name('project-contract-details-update');
            Route::any('project-contract-upload', 'ProjectFunctionsController@projectContractsUpload')->name('project-contract-upload');
            Route::any('project-contract-delete', 'ProjectFunctionsController@projectContractDelete')->name('project-contract-delete');
            Route::any('project-contract-download', 'ProjectFunctionsController@projectContractDownload')->name('project-contract-download');

            Route::any('project-time-sheet-submit', 'ProjectFunctionsController@timeSheetSubmit')->name('project-time-sheet-submit');
            Route::any('get-project-time-sheet', 'ProjectFunctionsController@getTimeSheet')->name('get-project-time-sheet');
            Route::any('project-time-sheet-delete', 'ProjectFunctionsController@deleteTimeSheet')->name('project-time-sheet-delete');


            Route::any('task-state', 'TaskStateController@list')->name('task-state');
            Route::any('task-state-add', 'TaskStateController@add')->name('task-state-add');
            Route::any('task-state-submit', 'TaskStateController@submit')->name('task-state-submit');
            Route::any('task-state-edit', 'TaskStateController@edit')->name('task-state-edit');
            Route::any('task-state-delete', 'TaskStateController@delete')->name('task-state-delete');


            Route::any('task-list', 'TaskController@list')->name('task-list');
            Route::any('task-submit', 'TaskController@submit')->name('task-submit');
            Route::any('task-view', 'TaskController@view')->name('task-view');
            Route::any('task-delete', 'TaskController@delete')->name('task-delete');
            Route::any('get-milestone-and-members-from-project-id', 'TaskController@getProjectMilestoneAndMembers')->name('get-milestone-and-members-from-project-id');


            // 
            Route::any('warehouse-inbound-list', 'WarehouseInboundController@warehouseInboundList')->name('warehouse-inbound-list');
            Route::any('warehouse-inbound-list-done', 'WarehouseInboundController@warehouseInboundListDone')->name('warehouse-inbound-list-done');
            Route::any('recive-to-project', 'WarehouseInboundController@reciveToProject')->name('recive-to-project');

            Route::any('epr-po-grn-receive-stock-project', 'ReceiveStockToProjectController@receiveStock')->name('epr-po-grn-receive-stock');
            Route::any('epr-po-grn-receive-stock-project-add', 'ReceiveStockToProjectController@add')->name('epr-po-grn-receive-stock-add');
            Route::any('procurement-stock-in-to-project', 'ReceiveStockToProjectController@list')->name('procurement-stock-in-to-project');
            Route::any('procurement-stock-in-to-project-received', 'ReceiveStockToProjectController@listReceived')->name('procurement-stock-in-to-project');

            Route::any('task-list-kanaban', 'TaskController@listKanaban')->name('task-list-kanaban');
            Route::any('task-list-gantt', 'TaskController@listGantt')->name('task-list-gantt');
            Route::any('load-task-state', 'TaskController@loadTaskState')->name('load-task-state');
            Route::any('task-sate-change', 'TaskController@taskSateChange')->name('task-sate-change');
        });


        Route::group(['prefix' => 'cost-center', 'namespace' => 'CostCenter'], function () {
            Route::any('/', 'DashboardController@index')->name('Cost Center Dashboard');
            Route::any('list', 'CostCenterController@list')->name('Cost Center List');
            Route::any('list-childen/{id}', 'CostCenterController@listChilden')->name('Cost Center List Child');
            Route::any('list-childen', 'CostCenterController@listChilden')->name('cost-center-list-childen');

            Route::any('save', 'CostCenterController@save')->name('Cost Center Save');
            Route::any('save-group', 'CostCenterController@saveGroup')->name('Cost Center Group Save');
            Route::any('save-element', 'CostCenterController@saveElement')->name('Cost Center element Save');
            Route::any('get-cost-center/{id}', 'CostCenterController@getCostrCenterFromId')->name('Cost Center Save');
        });


        // Begin :: Support Tickets
        Route::group(['namespace' => 'RequestAndApproval'], function () {
            // Dashboard
            Route::any('request-approval', 'DashboardController@index')->name('Dashboard');

            // request-list
            Route::any('request-list', 'RequestController@index')->name('Request-list');
            Route::any('request-send-list', 'RequestController@sendList')->name('Request-send-list');
            Route::any('request-approved-list', 'RequestController@approvedList')->name('Request-approved-list');
            Route::any('request-rejected-list', 'RequestController@rejectedList')->name('Request-rejected-list');
            Route::any('request-add', 'RequestController@add')->name('Request Add');
            Route::any('request-edit/{id}', 'RequestController@edit')->name('Request edit');
            Route::any('request-save', 'RequestController@save')->name('Request Save');
            Route::any('request-revise-save', 'RequestController@reviseSave')->name('Request revise Save');
            Route::any('request-trash', 'RequestController@trash')->name('Request delete');
            Route::any('request-pdf/{id}', 'RequestController@pdf')->name('request-pdf');

            Route::any('request-attachments-upload', 'RequestController@attachmentsUpload')->name('Request file upload');
            Route::any('request-attachments/{id}', 'RequestController@attachmentsList')->name('request-attachments');
            Route::any('request-send', 'RequestController@send')->name('Request Send');
            Route::any('request-revise-view/{id}', 'RequestController@reviseView')->name('request-revise-view');


            Route::any('request-approval-list', 'RequestApprovalController@requestApprovalList')->name('request-approval-list');
            Route::any('request-approval-list-done', 'RequestApprovalController@requestApprovalListDone')->name('request-approval-list-done');
            Route::any('get-request-approval-history', 'RequestApprovalController@getHistoryFromReqId')->name('get-Request-approval-history');
            Route::any('request-approve', 'RequestApprovalController@approve')->name('request-approve');
            Route::any('request-revise', 'RequestApprovalController@revise')->name('request-revise');
            Route::any('request-reject', 'RequestApprovalController@reject')->name('request-reject');

            Route::any('request-category', 'RequestCategoryController@list')->name('request-Category');
            Route::any('request-category-add', 'RequestCategoryController@add')->name('request-Category-add');
            Route::any('request-category-submit', 'RequestCategoryController@submit')->name('request-category-submit');
            Route::any('request-category-edit', 'RequestCategoryController@edit')->name('request-category-edit');
            Route::any('request-category-view', 'RequestCategoryController@TaxView')->name('request-category-view');
            Route::any('request-category-delete', 'RequestCategoryController@delete')->name('request-category-delete');

            Route::any('request-category-synthesis', 'RequestCategorySynthesisController@index')->name('request-category-synthesis');
            Route::any('request-category-synthesis-add', 'RequestCategorySynthesisController@add')->name('request-category-synthesis-add');
            Route::any('request-category-synthesis-save', 'RequestCategorySynthesisController@save')->name('request-category-synthesis-save');
            Route::any('request-category-synthesis-view', 'RequestCategorySynthesisController@view')->name('request-category-synthesis-view');
            Route::any('request-category-synthesis-edit-view', 'RequestCategorySynthesisController@editView')->name('request-category-synthesis-edit-view');
            Route::any('request-category-synthesis-update', 'RequestCategorySynthesisController@update')->name('request-category-synthesis-update');
            Route::any('request-category-synthesis-delete', 'RequestCategorySynthesisController@delete')->name('request-category-synthesis-delete');
            Route::any('request-category-synthesis-clone', 'RequestCategorySynthesisController@clone')->name('request-category-synthesis-clone');
            Route::any('request-category-synthesis-clone-save', 'RequestCategorySynthesisController@cloneSave')->name('request-category-synthesis-clone-save');
        });


        //sell
        Route::any('sales_dashboard', 'sell\DashboardController@index')->name('sales_dashboard');
        Route::any('quotation_list', 'sell\QuotationController@list')->name('quotation_list');
        Route::any('Quotation-Add', 'sell\QuotationController@add')->name('Quotation-Add');
        Route::any('getproduct_name_details_sell_quotation', 'sell\CommonController@getproduct')->name('getproduct_name_details_sell_quotation');
        Route::any('gettermsquote_sell', 'sell\CommonController@gettermsquote')->name('gettermsquote_sell');
        Route::any('getcustomeraddressquote_sell', 'sell\CommonController@getcustomeraddressquote')->name('getcustomeraddressquote_sell');
        Route::any('newquotationsubmit_sell', 'sell\QuotationController@submit')->name('newquotationsubmit_sell');

        Route::any('Quotation-Send', 'sell\QuotationController@send')->name('Quotation-Send');
        Route::any('Quotation-Negotiation', 'sell\QuotationController@negotiation')->name('Quotation-Negotiation');
        Route::any('Quotation-Approve', 'sell\QuotationController@approve')->name('Quotation-Approve');
        Route::any('Quotation-Reject', 'sell\QuotationController@reject')->name('Quotation-Reject');
        Route::any('Quotation-Revise', 'sell\QuotationController@revise')->name('Quotation-Revise');
        Route::any('Quotation-Delete', 'sell\QuotationController@delete')->name('Quotation-Delete');
        Route::any('Quotation-Edit', 'sell\QuotationController@edit')->name('Quotation-Edit');
        Route::any('newquotationupdate', 'sell\QuotationController@update')->name('newquotationupdate');
        Route::any('sellquotationrevise', 'sell\QuotationController@sellquotationrevise')->name('sellquotationrevise');
        Route::any('sellquotationapprove', 'sell\QuotationController@sellquotationapprove')->name('sellquotationapprove');

        Route::any('newquotationupdate_sell', 'sell\QuotationController@update')->name('newquotationupdate_sell');
        Route::any('Quotation-Pdf', 'sell\QuotationController@Quotation_Pdf')->name('Quotation-Pdf');
        Route::post('quotationfileupload', 'sell\FileUploadControllers@quotationfileupload')->name('quotationfileupload');
        Route::post('quotationfiledelete', 'sell\FileUploadControllers@quotationfiledelete')->name('quotationfiledelete');
        Route::any('Quotation-Revised-Pdf', 'sell\QuotationController@Quotation_Revised_Pdf')->name('Quotation-Revised-Pdf');
        Route::any('sell_saleorder_list', 'sell\SalesOrderController@sell_saleorder_list')->name('sell_saleorder_list');


        Route::any('sell-cost-sheet/{id}', 'sell\SalesOrderController@CostSheet')->name('sell-cost-sheet');
        Route::any('sell-cost-center', 'sell\SalesOrderController@CostCenter')->name('sell-cost-center');


        Route::any('saleorder-add', 'sell\SalesOrderController@add')->name('saleorder-add');
        Route::any('saleorder-edit', 'sell\SalesOrderController@edit')->name('saleorder-edit');
        Route::any('saleorder-submit', 'sell\SalesOrderController@submit')->name('saleorder-submit');


        Route::any('SaleOrder-Delivery', 'sell\SalesOrderController@sell_saleorder_convert_delivery')->name('SaleOrder-Delivery');
        Route::any('SaleOrder-Invoice', 'sell\SalesOrderController@sell_saleorder_convert_invoice')->name('SaleOrder-Invoice');
        Route::any('saleorder_generate_delivery', 'sell\SalesOrderController@saleorder_generate_delivery')->name('saleorder_generate_delivery');
        Route::any('saleorder_invoice_sell', 'sell\SalesOrderController@saleorder_invoice_sell')->name('saleorder_invoice_sell');
        Route::any('sell_delivery_list', 'sell\DeliveryOrderController@sell_delivery_list')->name('sell_delivery_list');


        Route::any('sell_invoice_list', 'sell\InvoiceOrderController@sell_invoice_list')->name('sell_invoice_list');
        Route::any('pending_bills', 'sell\InvoiceOrderController@pending_bills')->name('pending_bills');
        Route::any('invoice_accounting', 'sell\InvoiceOrderController@invoice_accounting')->name('invoice_accounting');
        Route::any('voucher_accounting', 'sell\InvoiceOrderController@voucher_accounting')->name('voucher_accounting');

        Route::any('Add-Invoice-Sell', 'sell\InvoiceOrderController@Add_Invoice_Sell')->name('Add-Invoice-Sell');
        Route::any('Deliveryorderpdf_sell', 'sell\DeliveryOrderController@pdf')->name('Deliveryorderpdf_sell');
        Route::any('invoicesubmit_sell', 'sell\InvoiceOrderController@invoicesubmit_sell')->name('invoicesubmit_sell');

        Route::any('invoice_correct', 'sell\InvoiceOrderController@invoice_correct')->name('invoice_correct');

        Route::any('product_correct', 'inventory\ProductController@product_correct')->name('product_correct');


        Route::any('customer_correct', 'sell\InvoiceOrderController@customer_correct')->name('customer_correct');

        Route::any('all-expenditure-list', 'sell\ExpenditureController@allList')->name('all-expenditure-list');
        Route::any('expenditure_list/{id}', 'sell\ExpenditureController@sell_invoice_list')->name('expenditure_list');
        Route::any('expenditure-add/{id}', 'sell\ExpenditureController@Add_Invoice_Sell')->name('Add-Invoice-Sell');
        Route::any('expenditure-edit/{id}', 'sell\ExpenditureController@editInvoice')->name('edit-Invoice-Sell');
        Route::any('expenditure-submit', 'sell\ExpenditureController@invoicesubmit_sell')->name('invoicesubmit_sell');
        Route::any('expenditure-pdf/{id}', 'sell\ExpenditureController@pdf')->name('pdf');


        Route::any('getcurrency_sell', 'sell\CommonController@getcurrency_sell')->name('getcurrency_sell');

        Route::any('sales_return_list_sell', 'sell\SalesReturnController@sales_return_list_sell')->name('sales_return_list_sell');
        Route::any('sales_return_add_sell', 'sell\SalesReturnController@add')->name('sales_return_add_sell');

        Route::any('creditnote_sell', 'sell\CreditNoteController@list')->name('creditnote_sell');
        Route::any('Add-creditnote_sell', 'sell\CreditNoteController@add')->name('Add-creditnote_sell');
        Route::any('creditnote_submit_sell', 'sell\CreditNoteController@creditnote')->name('creditnote_submit_sell');
        Route::any('creditnotesubmit_sell', 'sell\CreditNoteController@creditnotesubmit_sell')->name('creditnotesubmit_sell');
        Route::any('creditnote-approve', 'sell\CreditNoteController@approve')->name('creditnote-approve');
        Route::any('creditnote-edit', 'sell\CreditNoteController@edit')->name('creditnote-edit');
        Route::any('creditnote-delete', 'sell\CreditNoteController@delete')->name('creditnote-delete');


        // Route::any('converttocreditnote_sell', 'sell\CreditNoteController@convert')->name('converttocreditnote_sell');
        // Route::any('creditnotesubmit_sell1', 'sell\CreditNoteController@creditnotesubmit_sell1')->name('creditnotesubmit_sell1');
        Route::any('Credit-Pdf', 'sell\CreditNoteController@Credit_Pdf')->name('Credit-Pdf');


        Route::any('debitnote_sell', 'sell\DebitNoteController@list')->name('debitnote_sell');
        Route::any('Add-debitnote_sell', 'sell\DebitNoteController@add')->name('Add-debitnote_sell');
        Route::any('advancerequest_sell', 'sell\AdvanceRequestController@list')->name('advancerequest_sell');
        Route::any('Add-advance_request_sell', 'sell\AdvanceRequestController@add')->name('Add-advance_request_sell');
        Route::any('paymentrequest_sell', 'sell\PaymentRequestController@list')->name('paymentrequest_sell');
        Route::any('Add-payment_request_sell', 'sell\PaymentRequestController@add')->name('Add-payment_request_sell');
        Route::any('getinvoicenumber_sell', 'sell\SalesReturnController@getinvoicenumber_sell')->name('getinvoicenumber_sell');
        Route::any('invoicenumber_submit_sell', 'sell\SalesReturnController@invoicenumber_submit_sell')->name('invoicenumber_submit_sell');
        Route::any('salesreturnsubmit_sell', 'sell\SalesReturnController@salesreturnsubmit_sell')->name('salesreturnsubmit_sell');
        Route::any('producthistorylist_sell', 'sell\CommonController@producthistorylist_sell')->name('producthistorylist_sell');
        Route::any('productquotationhistorylist_sell', 'sell\CommonController@productquotationhistorylist_sell')->name('productquotationhistorylist_sell');

        Route::any('ProductSalesHistory', 'sell\CommonController@ProductSalesHistory')->name('ProductSalesHistory');
        Route::any('ProductQuoteHistory', 'sell\CommonController@ProductQuoteHistory')->name('ProductQuoteHistory');





        Route::any('Salesorder-Confirm', 'sell\SalesOrderController@confirm')->name('Salesorder-Confirm');
        Route::any('Salesorder-Edit', 'sell\SalesOrderController@edit')->name('Salesorder-Edit');
        Route::any('newsalesorderupdate_sell', 'sell\SalesOrderController@update')->name('newsalesorderupdate_sell');
        Route::any('sell_performainvoice_list', 'sell\PerformaInvoiceController@list')->name('sell_performainvoice_list');
        Route::any('Add-PerformaInvoice-Sell', 'sell\PerformaInvoiceController@add')->name('Add-PerformaInvoice-Sell');
        Route::any('performainvoicesubmit_sell', 'sell\PerformaInvoiceController@performainvoicesubmit_sell')->name('performainvoicesubmit_sell');
        Route::any('performainvoice_edit', 'sell\PerformaInvoiceController@edit')->name('performainvoice_edit');
        Route::any('performainvoiceupdate_sell', 'sell\PerformaInvoiceController@update')->name('performainvoiceupdate_sell');
        Route::any('performaconvertinvoice_edit', 'sell\PerformaInvoiceController@convertinvoice')->name('performaconvertinvoice_edit');
        Route::any('performainvoiceconvert_sell', 'sell\PerformaInvoiceController@convertinvoice_submit')->name('performainvoiceconvert_sell');
        Route::any('performainvoicepdf', 'sell\PerformaInvoiceController@pdf')->name('performainvoicepdf');




        Route::any('advancepayment_sell', 'sell\AdvancePaymentController@advancepayment')->name('advancepayment_sell');
        Route::any('advancepayment_add_sell', 'sell\AdvancePaymentController@add')->name('advancepayment_add_sell');
        Route::any('advancepayment-edit', 'sell\AdvancePaymentController@edit')->name('advancepayment-edit');

        Route::any('advancepaymentsubmit_sell', 'sell\AdvancePaymentController@submit')->name('advancepaymentsubmit_sell');
        Route::any('advancepayment-approve', 'sell\AdvancePaymentController@approve')->name('advancepayment-approve');
        Route::any('Adpayment-Pdf', 'sell\AdvancePaymentController@Pdf1')->name('Adpayment-Pdf');


        Route::any('sales_bill_settlement_sell', 'sell\PaymentInvoiceController@sales_bill_settlement')->name('sales_bill_settlement_sell');
        Route::any('sales_bill_settlement_add_sell', 'sell\PaymentInvoiceController@sales_bill_settlement_add_sell')->name('sales_bill_settlement_add_sell');
        Route::any('customer_submit_sell', 'sell\PaymentInvoiceController@customer_submit_sell')->name('customer_submit_sell');
        Route::any('sale_bill_settle_submit_sell', 'sell\PaymentInvoiceController@sale_bill_settle_submit')->name('sale_bill_settle_submit_sell');
        Route::any('sales_bill_settlement_edit_sell', 'sell\PaymentInvoiceController@edit')->name('sales_bill_settlement_edit_sell');
        Route::any('sales_bill_settlement_update_sell', 'sell\PaymentInvoiceController@update')->name('sales_bill_settlement_update_sell');
        Route::any('bill-settilement-approve', 'sell\PaymentInvoiceController@approve')->name('bill-settilement-approve');
        Route::any('bill-settilement-delete', 'sell\PaymentInvoiceController@delete')->name('bill-settilement-delete');
        Route::any('bill_pdf', 'sell\PaymentInvoiceController@pdf')->name('bill_pdf');


        Route::any('getcustomerinvoices_advance_sell', 'sell\CommonController@getcustomerinvoices_advance_sell')->name('getcustomerinvoices_advance_sell');

        Route::any('submit_buy_customer_sell', 'sell\CommonController@submit_buy_customer_sell')->name('submit_buy_customer_sell');
        Route::any('SaleOrder-Purchase', 'sell\SalesOrderController@sell_saleorder_convert_po')->name('SaleOrder-Purchase');
        Route::any('so_convert_po', 'sell\SalesOrderController@so_convert_po')->name('so_convert_po');
        Route::any('Invoice_edit_sell', 'sell\InvoiceOrderController@Invoice_edit_sell')->name('Invoice_edit_sell');
        Route::any('invoiceupdate_sell', 'sell\InvoiceOrderController@invoiceupdate_sell')->name('invoiceupdate_sell');
        Route::any('invoicenumber_submit_sell_debit', 'sell\DebitNoteController@invoicenumber_submit_sell_debit')->name('invoicenumber_submit_sell_debit');
        Route::any('getcreditbalance', 'sell\CommonController@getcreditbalance')->name('getcreditbalance');
        Route::any('salesreturns-Pdf', 'sell\SalesReturnController@salesreturns_Pdf')->name('salesreturns-Pdf');


        Route::any('debitnotesubmit_sell', 'sell\DebitNoteController@debitnotesubmit_sell')->name('debitnotesubmit_sell');
        Route::any('debitnotes-Pdf', 'sell\DebitNoteController@Pdf')->name('debitnotes-Pdf');
        Route::any('SaleOrder-Pdf', 'sell\SalesOrderController@Pdf')->name('SaleOrder-Pdf');
        Route::any('salesinvoice-PDF', 'sell\InvoiceOrderController@Pdf')->name('salesinvoice-PDF');

        Route::any('Invoice_approve_sell', 'sell\InvoiceOrderController@Invoice_approve_sell')->name('Invoice_approve_sell');
        Route::any('Invoice-Approve', 'sell\InvoiceOrderController@Invoice_Approve')->name('Invoice-Approve');

        Route::any('delivery_Approve', 'sell\SalesOrderController@delivery_Approve')->name('delivery_Approve');
        Route::any('Deliveryorderedit_sell', 'sell\DeliveryOrderController@Deliveryorderedit_sell')->name('Deliveryorderedit_sell');
        Route::any('saleorder_generate_delivery_edit', 'sell\DeliveryOrderController@saleorder_generate_delivery_edit')->name('saleorder_generate_delivery_edit');
        Route::any('delivery_delete', 'sell\DeliveryOrderController@delivery_delete')->name('delivery_delete');

        Route::any('invoiceupdate_sell_byquote', 'sell\InvoiceOrderController@invoiceupdate_sell_byquote')->name('invoiceupdate_sell_byquote');
        Route::any('saleorder_performa_sell', 'sell\SalesOrderController@saleorder_performa_sell')->name('saleorder_performa_sell');

        Route::any('Deliveryorderinvoice_sell', 'sell\DeliveryOrderController@Deliveryorderinvoice_sell')->name('Deliveryorderinvoice_sell');
        Route::any('deliveryorder_performa_sell', 'sell\DeliveryOrderController@deliveryorder_performa_sell')->name('deliveryorder_performa_sell');
        Route::any('invoiceOrder-Delivery', 'sell\InvoiceOrderController@invoiceOrder_Delivery')->name('invoiceOrder-Delivery');


        //sell

        //qpurchase

        Route::any('qpurchase-bill-settlement-list', 'qpurchase\BillSettlementController@list')->name('qpurchase-bill-settlement-list');
        Route::any('qpurchase-bill-settlement-add', 'qpurchase\BillSettlementController@add')->name('qpurchase-bill-settlement-add');
        Route::any('qpurchase-supplier-submit', 'qpurchase\BillSettlementController@supplier_submit')->name('qpurchase-supplier-submit');
        Route::any('qpurchase-bill-settle-save', 'qpurchase\BillSettlementController@billSettleSave')->name('qpurchase-bill-settle-save');
        Route::any('qpurchase-bill-settlement-edit', 'qpurchase\BillSettlementController@edit')->name('qpurchase-bill-settlement-edit');
        Route::any('qpurchase-bill-settlement-update', 'qpurchase\BillSettlementController@update')->name('qpurchase-bill-settlement-update');
        Route::any('qpurchase-bill-settilement-approve', 'qpurchase\BillSettlementController@approve')->name('qpurchase-bill-settilement-approve');
        Route::any('qpurchase-bill-settilement-delete', 'qpurchase\BillSettlementController@delete')->name('qpurchase-bill-settilement-delete');
        Route::any('qpurchase-bill-pdf', 'qpurchase\BillSettlementController@pdf')->name('qpurchase-bill-pdf');
        Route::any('qpurchase-bill-view/{id}', 'qpurchase\BillSettlementController@view')->name('qpurchase-bill-view');


        Route::any('qpurchase_dashboard', 'qpurchase\DashboardController@view')->name('qPurchase Dashboard');
        Route::any('getproduct_name_details_qpurchase', 'qpurchase\CommonController@getproduct')->name('getproduct_name_details_qpurchase');
        Route::any('getcurrency_qpurchase', 'qpurchase\CommonController@getcurrency_qpurchase')->name('getcurrency_qpurchase');
        Route::any('getsupplierdetails_qpurchase', 'qpurchase\CommonController@getsupplierdetails_qpurchase')->name('getsupplierdetails_qpurchase');

        Route::any('qdirect_po', 'qpurchase\PurchaseOrderController@qdirect_po')->name('qdirect_po');
        Route::any('qpurchase_order', 'qpurchase\PurchaseOrderController@qpurchase_order')->name('qpurchase_order');
        Route::any('newposubmit_qpurchase', 'qpurchase\PurchaseOrderController@newposubmit')->name('newposubmit_qpurchase');
        Route::get('qpurchase-order-view/{id}', 'qpurchase\PurchaseOrderController@view')->name('qpurchase-order-view');
        Route::any('qpurchase_order_edit', 'qpurchase\PurchaseOrderController@edit')->name('qpurchase_order_edit');
        Route::any('qpurchase_order_update', 'qpurchase\PurchaseOrderController@update')->name('qpurchase_order_update');

        Route::any('convertpi', 'qpurchase\PurchaseOrderController@convertpi')->name('convertpi');
        Route::any('pisubmit_qpurchase', 'qpurchase\PurchaseOrderController@pisubmit_qpurchase')->name('pisubmit_qpurchase');

        Route::any('convertgrn', 'qpurchase\PurchaseOrderController@convertgrn')->name('convertgrn');
        Route::any('grn-save-from-po', 'qpurchase\PurchaseOrderController@grnSaveFromPO')->name('grn-save-from-po');

        Route::any('qpurchaseinvoice', 'qpurchase\PurchaseInvoiceController@list')->name('qpurchaseinvoice');
        Route::any('add_direct_pi', 'qpurchase\PurchaseInvoiceController@add')->name('add_direct_pi');
        Route::any('purchaseinvoicesubmit', 'qpurchase\PurchaseInvoiceController@submit')->name('purchaseinvoicesubmit');
        Route::any('qpurchase_invoice_edit', 'qpurchase\PurchaseInvoiceController@edit')->name('qpurchase_invoice_edit');
        Route::any('purchaseinvoiceupdate', 'qpurchase\PurchaseInvoiceController@update')->name('purchaseinvoiceupdate');
        Route::any('qpurchase-invoice-approve', 'qpurchase\PurchaseInvoiceController@approve')->name('qpurchase-invoice-approve');
        Route::any('qpurchase_invoice_delete', 'qpurchase\PurchaseInvoiceController@qpurchase_invoice_delete')->name('qpurchase_invoice_delete');
        Route::any('qpurchase_invoice_pdf', 'qpurchase\PurchaseInvoiceController@pdf')->name('qpurchase_invoice_pdf');
        Route::any('qpurchase-invoice-view/{id}', 'qpurchase\PurchaseInvoiceController@view')->name('qpurchase-invoice-view');
        Route::any('qpurchaseinvoice', 'qpurchase\PurchaseInvoiceController@list')->name('qpurchaseinvoice');

        Route::any('getdebitbalance', 'qpurchase\CommonController@getdebitbalance')->name('getdebitbalance');

        Route::any('convert-grn-from-invoice', 'qpurchase\PurchaseInvoiceController@convertgrn')->name('convert-grn-from-invoice');
        Route::any('grn-save-from-invoice', 'qpurchase\PurchaseInvoiceController@grnSaveFromInvoice')->name('grn-save-from-invoice');


        Route::any('qpurchasegrn', 'qpurchase\GRNController@list')->name('qpurchasegrn');
        Route::any('qpurchasegrn-edit-by-po', 'qpurchase\GRNController@editByPO')->name('qpurchasegrn-edit-by-po');
        Route::any('qpurchasegrn-update', 'qpurchase\GRNController@update')->name('qpurchasegrn-update');
        Route::any('qpurchasegrn-approve', 'qpurchase\GRNController@approve')->name('qpurchasegrn-approve');
        Route::any('qpurchasegrn-delete', 'qpurchase\GRNController@delete')->name('qpurchasegrn-delete');
        Route::any('qpurchasegrn-pdf', 'qpurchase\GRNController@pdf')->name('qpurchasegrn-pdf');
        Route::any('qpurchase-grn-view/{id}', 'qpurchase\GRNController@view')->name('qpurchase-grn-view');

        Route::any('qpurchaselist', 'qpurchase\PurchaseController@list')->name('qpurchaselist');
        Route::any('qpurchaseadd', 'qpurchase\PurchaseController@add')->name('qpurchaseadd');
        Route::any('qpurchase_submit', 'qpurchase\PurchaseController@submit')->name('qpurchase_submit');
        Route::any('qpurchase_edit', 'qpurchase\PurchaseController@edit')->name('qpurchase_edit');
        Route::any('qpurchase_update', 'qpurchase\PurchaseController@update')->name('qpurchase_update');
        Route::any('qpurchase_creditnote', 'qpurchase\CreditNoteController@creditnote')->name('qpurchase_creditnote');
        Route::any('qpurchase_creditnote_add', 'qpurchase\CreditNoteController@add')->name('qpurchase_creditnote_add');

        // purchase return
        Route::any('qpurchase-return', 'qpurchase\PurchaseReturnController@index')->name('qpurchase-return');
        Route::any('qpurchase-return-add', 'qpurchase\PurchaseReturnController@add')->name('qpurchase-return-add');
        Route::any('qpurchase-invoice-load-for-return', 'qpurchase\PurchaseReturnController@loadPurchaseInvoice')->name('qpurchase-invoice-load-for-return');
        Route::any('qpurchase-invoice-load-for-return-edit', 'qpurchase\PurchaseReturnController@loadPurchaseInvoiceEdit')->name('qpurchase-invoice-load-for-return-edit');
        Route::any('qpurchase-return-save', 'qpurchase\PurchaseReturnController@save')->name('qpurchase-return-save');
        Route::any('qpurchase-return-approve', 'qpurchase\PurchaseReturnController@approve')->name('qpurchase-return-approve');
        Route::any('qpurchase-return-delete', 'qpurchase\PurchaseReturnController@delete')->name('qpurchase-return-delete');
        Route::any('qpurchase-return-pdf', 'qpurchase\PurchaseReturnController@pdf')->name('qpurchase-return-pdf');
        Route::any('qpurchase-return-view/{id}', 'qpurchase\PurchaseReturnController@view')->name('qpurchase-return-view');
        Route::any('qpurchase-debit-note-pdf', 'qpurchase\PurchaseReturnController@debitNotePdf')->name('qpurchase-debit-note-pdf');
        // purchase return

        Route::any('qpurchase-refund-list', 'qpurchase\PurchaseRefund@list')->name('qpurchase-refund-list');
        Route::any('qpurchase-refund/{id}', 'qpurchase\PurchaseRefund@add')->name('qpurchase-refund');
        Route::any('qpurchase-refund-edit/{id}', 'qpurchase\PurchaseRefund@edit')->name('qpurchase-refund-edit');
        Route::any('qpurchase-refund-save', 'qpurchase\PurchaseRefund@save')->name('qpurchase-refund-save');
        Route::any('qpurchase-refund-view/{id}', 'qpurchase\PurchaseRefund@view')->name('qpurchase-refund-view');
        Route::any('qpurchase-refund-approve', 'qpurchase\PurchaseRefund@approve')->name('qpurchase-refund-approve');
        Route::any('qpurchase-refund-delete', 'qpurchase\PurchaseRefund@delete')->name('qpurchase-refund-delete');

        Route::any('get-purchase-number-for-rerurn', 'qpurchase\CommonController@getPurchaseNumberForReturn')->name('get-purchase-number-for-rerurn');

        Route::any('purchasenumber_submit_purchase_credit', 'qpurchase\CreditNoteController@purchasenumber_submit_purchase_credit')->name('purchasenumber_submit_purchase_credit');
        Route::any('qpurchase_creditnote_submit', 'qpurchase\CreditNoteController@qpurchase_creditnote_submit')->name('qpurchase_creditnote_submit');

        Route::any('qpurchaseorder_pdf', 'qpurchase\PurchaseOrderController@popdf')->name('qpurchaseorder_pdf');
        Route::any('qpurchase_vo_pdf', 'qpurchase\PurchaseOrderController@povopdf')->name('qpurchase_vo_pdf');

        Route::any('qpurchase-opening-balance-index', 'qpurchase\PurchaseOpeningBalanceController@index')->name('qpurchase-opening-balance-index');
        Route::post('qpurchase-opening-balance-save', 'qpurchase\PurchaseOpeningBalanceController@submit')->name('qpurchase-opening-balance-save');
        Route::get('qpurchase-opening-balance-pdf', 'qpurchase\PurchaseOpeningBalanceController@pdf')->name('qpurchase-opening-balance-pdf');
        Route::post('qpurchase-opening-balance-update', 'qpurchase\PurchaseOpeningBalanceController@getData')->name('qpurchase-opening-balance-update');
        Route::post('qpurchase-opening-balance-approve', 'qpurchase\PurchaseOpeningBalanceController@approve')->name('qpurchase-opening-balance-approve');
        Route::post('qpurchase-opening-balance-delete', 'qpurchase\PurchaseOpeningBalanceController@delete')->name('qpurchase-opening-balance-delete');

        Route::any('qpurchase_advancepayment', 'qpurchase\AdvancePaymentController@list')->name('qpurchase_advancepayment');
        Route::any('qpurchaseadvancepayment_add', 'qpurchase\AdvancePaymentController@add')->name('qpurchaseadvancepayment_add');
        Route::any('qpurchaseadvancepayment_edit', 'qpurchase\AdvancePaymentController@edit')->name('qpurchaseadvancepayment_edit');
        Route::any('qpurchase-advancepayment-approve', 'qpurchase\AdvancePaymentController@approve')->name('qpurchase-advancepayment-approve');
        Route::any('qpurchase-advancepayment-delete', 'qpurchase\AdvancePaymentController@delete')->name('qpurchase-advancepayment-delete');
        Route::any('qpurchase-advancepayment-view/{id}', 'qpurchase\AdvancePaymentController@view')->name('qpurchase-advancepayment-view');

        Route::any('advancepaymentsubmit_qpurchase', 'qpurchase\AdvancePaymentController@submit')->name('advancepaymentsubmit_qpurchase');
        Route::any('Adpayment-Pdf_purchase', 'qpurchase\AdvancePaymentController@pdf')->name('Adpayment-Pdf_purchase');



        Route::any('qpurchase_pdf', 'qpurchase\PurchaseController@pdf')->name('qpurchase_pdf');
        Route::any('qpurchase_creditnote_pdf', 'qpurchase\CreditNoteController@pdf')->name('qpurchase_creditnote_pdf');
        Route::any('getsupplierpurchaseid', 'qpurchase\CommonController@getsupplierpurchaseid')->name('getsupplierpurchaseid');
        Route::any('Purchaseorder-Approve', 'qpurchase\PurchaseOrderController@approve')->name('Purchaseorder-Approve');
        Route::any('Purchase-Approve', 'qpurchase\PurchaseController@approve')->name('Purchase-Approve');
        Route::any('qpurchase_voucher_pdf', 'buy\BuyController@pdf')->name('qpurchase_voucher_pdf');

        Route::any('getsupplierpurchaseidamount', 'qpurchase\CommonController@getsupplierpurchaseidamount')->name('getsupplierpurchaseidamount');
        //./ qpurchase
    });

    // vouchers
    Route::get('desc-vouchers/{token}', 'vouchers\EmailApproveController@loadDocument')->name('desc.pending.action.vouchers');
    Route::any('mark-desc-vouchers', 'vouchers\VoucherEmailApprovalController@markVouchers')->name('mark.dec.vouchers');
    // vouchers

    // Procurement
    Route::get('desc/{token}', 'Procurement\EmailApproveController@loadDocument')->name('desc.pending.action');
    Route::any('mark-desc-epr', 'Procurement\EmailApprove\EprApprovalController@markEpr')->name('mark.dec.epr');
    Route::any('mark-desc-po', 'Procurement\EmailApprove\PoApprovalController@markPo')->name('mark.dec.po');
    Route::any('mark-desc-grn', 'Procurement\EmailApprove\GrnApprovalController@markGrn')->name('mark.dec.grn');
    Route::any('mark-desc-stock-in', 'Procurement\EmailApprove\StockInApprovalController@markStockIn')->name('mark.dec.stockin');
    Route::any('mark-desc-invoice', 'Procurement\EmailApprove\InvoiceApprovalController@markInvoice')->name('mark.dec.invoice');
    Route::any('mark-desc-payment', 'Procurement\EmailApprove\SupplierPaymentApprovalController@markPayment')->name('mark.dec.payment');
    Route::any('mark-desc-stock-transfer', 'Procurement\EmailApprove\StockTransferApprovalController@markTransfer')->name('mark.dec.transfer');
    Route::any('epr-pocess-list/{id}', 'Procurement\ProcessListController@getEprFullProcessList')->name('epr-pocess-list');
    // Procurement

    // Project
    Route::any('mark-desc-project', 'Projects\EmailApprove\ProjectApprovalController@markProject')->name('mark-desc-project');
    // Project

    //request
    Route::any('mark-desc-request', 'RequestAndApproval\email\RequestApprovalController@markDesc')->name('mark-desc-request');
    // request 

    // tender
    Route::any('mark-desc-tender', 'Tenders\EmailApprove\TenderApprovalController@markTransfer')->name('mark.dec.tender');
    Route::any('mark-desc-sales-proposal', 'Tenders\EmailApprove\SalesProposalApprovalController@markDesc')->name('mark.dec.salesproposal');
    // tender

    Route::group(['prefix' => 'car-rental', 'namespace' => 'CarRental', 'middleware' => ['language', 'auth']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');


        Route::any('car-in-and-out', 'CarInAndOutController@list')->name('car-in-and-out');
        Route::any('car-in-and-out-confirmed', 'CarInAndOutController@listConfirmed')->name('car-in-and-out');
        Route::any('car-in-and-out-completed', 'CarInAndOutController@listCompleted')->name('car-in-and-out-completed');
        Route::any('car-in-and-out-canceled', 'CarInAndOutController@listCanceled')->name('car-in-and-out-canceled');

        Route::any('car-in-and-out-add', 'CarInAndOutController@add')->name('car-in-and-out-add');
        Route::any('car-in-and-out-edit/{id}', 'CarInAndOutController@edit')->name('car-in-and-out-edit');
        Route::any('get-car-in-and-out', 'CarInAndOutController@getCarInAndOut')->name('get-car-in-and-out');


        Route::any('car-in-and-out-submit', 'CarInAndOutController@save')->name('car-in-and-out-submit');
        Route::any('car-in-and-out-confirm', 'CarInAndOutController@confirm')->name('car-in-and-out-confirm');
        Route::any('car-in-and-out-complete', 'CarInAndOutController@complete')->name('car-in-and-out-complete');
        Route::any('car-in-and-out-cancel', 'CarInAndOutController@cancell')->name('car-in-and-out-cancel');
        Route::any('car-in-and-out-pdf/{id}', 'CarInAndOutController@pdf')->name('car-in-and-out-pdf');
        Route::any('car-in-and-out-delete', 'CarInAndOutController@delete')->name('car-in-and-out-delete');

        Route::any('trip-overview/{id}', 'CarInAndOutFunctionsController@overView')->name('trip-overview');
        Route::any('trip-agreements/{id}', 'CarInAndOutFunctionsController@agreements')->name('trip-agreements');
        Route::any('trip-attachments/{id}', 'CarInAndOutFunctionsController@attachments')->name('trip-attachments');
        Route::any('trip-additional-cost/{id}', 'CarInAndOutFunctionsController@additionalCost')->name('trip-additional-cost');
        Route::any('trip-advance/{id}', 'CarInAndOutFunctionsController@advance')->name('trip-advance');
        Route::any('trip-proforma-invoice/{id}', 'CarInAndOutFunctionsController@proformaInvoice')->name('trip-proforma-invoice');
        Route::any('trip-invoices/{id}', 'CarInAndOutFunctionsController@invoices')->name('trip-invoices');
        Route::any('trip-statement-of-accounts/{id}', 'CarInAndOutFunctionsController@statementOfAccounts')->name('trip-statement-of-accounts');
        Route::any('trip-notes/{id}', 'CarInAndOutFunctionsController@notes')->name('trip-notes');


        Route::any('trip-statement-of-accounts-pdf/{id}', 'CarInAndOutFunctionsController@statementOfAccountsPdf')->name('trip-statement-of-accounts-pdf');

        Route::any('trip-advance-add/{id}', 'PaymentsController@add')->name('trip-advance-add');
        Route::any('trip-advance-edit/{id}', 'PaymentsController@edit')->name('trip-advance-edit');
        Route::any('trip-advance-submit', 'PaymentsController@save')->name('trip-advance-submit');
        Route::any('payement-generate-to-receipt', 'PaymentsController@generateReceipt')->name('payement-generate-to-receipt');
        Route::any('trip-advance-delete', 'PaymentsController@delete')->name('trip-advance-delete');
        Route::any('trip-receipt-pdf/{id}', 'PaymentsController@pdf')->name('trip-receipt-pdf');


        Route::any('trip-proforma-invoice-add/{id}', 'PerformaInvoiceController@add')->name('trip-proforma-invoice-add');
        Route::any('trip-proforma-invoice-edit/{id}', 'PerformaInvoiceController@edit')->name('trip-proforma-invoice-edit');
        Route::any('trip-proforma-invoice-submit', 'PerformaInvoiceController@save')->name('trip-proforma-invoice-submit');
        Route::any('trip-proforma-invoice-delete', 'PerformaInvoiceController@delete')->name('trip-proforma-invoice-delete');
        Route::any('proforma-invoice-convert-to-invoice/{id}', 'PerformaInvoiceController@convertToInvoice')->name('proforma-invoice-convert-to-invoice');
        Route::any('trip-performa-invoice-pdf/{id}', 'PerformaInvoiceController@pdf')->name('trip-performa-invoice-pdf');
        Route::any('trip-invoice-from-performa-submit', 'PerformaInvoiceController@generateInvoice')->name('trip-invoice-from-performa-submit');


        Route::any('trip-invoice-add/{id}', 'InvoiceController@add')->name('trip-invoice-add');
        Route::any('trip-invoice-edit/{id}', 'InvoiceController@edit')->name('trip-invoice-edit');
        Route::any('trip-invoice-submit', 'InvoiceController@save')->name('trip-invoice-submit');
        Route::any('trip-invoice-delete', 'InvoiceController@delete')->name('trip-invoice-delete');
        Route::any('trip-invoice-send', 'InvoiceController@send')->name('trip-invoice-send');
        Route::any('trip-invoice-pdf/{id}', 'InvoiceController@pdf')->name('trip-invoice-pdf');
        Route::any('invoice-convert-to-receipt/{id}', 'InvoiceController@convertToReceipt')->name('invoice-convert-to-receipt');


        Route::any('trip-receipt-edit/{id}', 'ReceiptController@edit')->name('trip-receipt-edit');
        Route::any('trip-receipt-submit', 'ReceiptController@save')->name('trip-receipt-submit');


        Route::any('get-agreements-details', 'CarInAndOutFunctionsController@getAgreementsDetails')->name('get-agreements-details');
        Route::any('agreements-details-update', 'CarInAndOutFunctionsController@agreementsUpdate')->name('agreements-details-update');
        Route::any('agreements-upload', 'CarInAndOutFunctionsController@agreementsUpload')->name('agreements-upload');
        Route::any('agreements-delete', 'CarInAndOutFunctionsController@agreementsDelete')->name('agreements-delete');

        Route::any('get-attachments-details', 'CarInAndOutFunctionsController@getAttachmentsDetails')->name('get-attachments-details');
        Route::any('attachments-details-update', 'CarInAndOutFunctionsController@attachmentsUpdate')->name('attachments-details-update');
        Route::any('attachments-upload', 'CarInAndOutFunctionsController@attachmentsUpload')->name('attachments-upload');
        Route::any('attachments-delete', 'CarInAndOutFunctionsController@attachmentsDelete')->name('attachments-delete');

        Route::any('get-additional-cost', 'CarInAndOutFunctionsController@getAdditionalCost')->name('get-additional-cost');
        Route::any('additional-cost-submit', 'CarInAndOutFunctionsController@additionalCostSubmit')->name('additional-cost-submit');
        Route::any('additional-cost-delete', 'CarInAndOutFunctionsController@additionalCostDelete')->name('additional-cost-delete');

        Route::any('get-note', 'CarInAndOutFunctionsController@getNotes')->name('get-note');
        Route::any('note-submit', 'CarInAndOutFunctionsController@notesSubmit')->name('note-submit');
        Route::any('note-delete', 'CarInAndOutFunctionsController@notesDelete')->name('note-delete');


        Route::any('car-category', 'CarCategoryController@list')->name('car-category');
        Route::any('car-category-add', 'CarCategoryController@add')->name('car-category-add');
        Route::any('car-category-submit', 'CarCategoryController@submit')->name('car-category-submit');
        Route::any('car-category-edit', 'CarCategoryController@edit')->name('car-category-edit');
        Route::any('car-category-delete', 'CarCategoryController@delete')->name('car-category-delete');

        Route::any('car', 'CarController@list')->name('car');
        Route::any('car-add', 'CarController@add')->name('car-add');
        Route::any('car-submit', 'CarController@submit')->name('car-submit');
        Route::any('car-edit', 'CarController@edit')->name('car-edit');
        Route::any('car-delete', 'CarController@delete')->name('car-delete');
        Route::any('get-car-reant', 'CarController@getReant')->name('get-car-reant');
    });
    //warehouse johny
    Route::any('salesmaster', 'Warehouse\WarehouseController@salesmaster')->name('salesmaster');

    Route::any('salesmaster_edit', 'Warehouse\WarehouseController@salesmaster_edit')->name('salesmaster_edit');
    Route::any('warehouseProductListView', 'Warehouse\WarehouseController@warehouseProductListView')->name('warehouseProductListView');
    Route::any('directstocktransfer', 'Warehouse\DirectstocktransferController@index')->name('directstocktransfer');
    Route::any('directstocktransfer_add', 'Warehouse\DirectstocktransferController@add')->name('directstocktransfer_add');
    Route::any('directstocktransfersubmit', 'Warehouse\DirectstocktransferController@submit')->name('directstocktransfersubmit');
    Route::any('directstocktransfer_edit', 'Warehouse\DirectstocktransferController@edit')->name('directstocktransfer_edit');
    Route::any('directstocktransferupdate', 'Warehouse\DirectstocktransferController@update')->name('directstocktransferupdate');
    Route::any('transferapproval', 'Warehouse\TransferapprovalController@list')->name('transferapproval');
    Route::any('transferapproval_view', 'Warehouse\TransferapprovalController@view')->name('transferapproval_view');
    Route::any('transferrequests', 'Warehouse\TransferrequestsController@index')->name('transferrequests');
    Route::any('transferrequest_add', 'Warehouse\TransferrequestsController@add')->name('transferrequest_add');
    Route::any('transferrequestsubmit', 'Warehouse\TransferrequestsController@submit')->name('transferrequestsubmit');
    Route::any('transfer_request_edit', 'Warehouse\TransferrequestsController@edit')->name('transfer_request_edit');
    Route::any('transferrequestupdate', 'Warehouse\TransferrequestsController@update')->name('transferrequestupdate');
    Route::any('transferrequest-Delete', 'Warehouse\TransferrequestsController@delete')->name('transferrequest-Delete');
    Route::any('directtransfer-Delete', 'Warehouse\DirectstocktransferController@delete')->name('directtransfer-Delete');
    Route::any('transferapproved', 'Warehouse\TransferapprovalController@approve')->name('transferapproved');

    //
    //projects johny
    //
    //costing johny
    Route::any('estimation', 'costing\EstimationController@list')->name('estimation');
    Route::any('newestimation', 'costing\EstimationController@index')->name('newestimation');
    Route::any('estimate_submit', 'costing\EstimationController@estimate_submit')
        ->name('estimate_submit');
    Route::any('group', 'costing\GroupController@index')->name('group');
    Route::any('newgroup', 'costing\GroupController@addnew')->name('newgroup');
    Route::any('getitem_name_details', 'costing\GroupController@getitem_name_details')->name('getitem_name_details');
    Route::any('group_submit', 'costing\GroupController@groupsubmit')->name('group_submit');
    Route::any('edit_group', 'costing\GroupController@edit_group')->name('edit_group');
    Route::any('group_update', 'costing\GroupController@group_update')->name('group_update');
    Route::any('deletegroup', 'costing\GroupController@groupdelete')->name('deletegroup');
    Route::any('estimate_view', 'costing\EstimationController@view')->name('estimate_view');
    Route::any('estimationpdf', 'costing\EstimationController@generatePDF')->name('estimationpdf');
    Route::any('estimationexcel', 'costing\EstimationController@estimationexcel')->name('estimationpdf');
    Route::any('editestimation', 'costing\EstimationController@edit')->name('estimationpdf');
    Route::any('deleteestimation', 'costing\EstimationController@deleteestimation')->name('deleteestimation');
    Route::any('getgroup_name_details', 'costing\EstimationController@getgroup_name_details')->name('getgroup_name_details');





    Route::any('getvoucherdetails', 'buy\BuyController@getvoucherdetails')->name('getvoucherdetails');
    Route::any('productpurchase', 'purchase\PurchaseProductController@productpurchase')->name('productpurchase');
    Route::any('sales_convert_purchaseorder', 'sales\NewQuotationController@sales_convert_purchaseorder')->name('sales_convert_purchaseorder');

    //Reports Johny

    Route::any('enquiryreport', 'Reports\ReportController@enquiryreport')->name('enquiryreport');
    Route::any('enquiryreportsalesman', 'Reports\ReportController@enquiryreportsalesman')->name('enquiryreportsalesman');

    //
    Route::any('dummysubmit', 'sell\DummyController@dummysubmit')->name('dummysubmit');

    //
    Route::post('qtndocumentFileUpload', 'sales\FileUploadControllers@qtndocumentFileUpload')
        ->name('qtndocumentFileUpload');
    Route::post('qtndocumentDelete', 'sales\FileUploadControllers@qtndocumentDelete')
        ->name('qtndocumentDelete');
    Route::any('producthistorylist', 'sales\NewQuotationController@producthistorylist')->name('producthistorylist');

    Route::any('productquotationhistorylist', 'sales\NewQuotationController@productquotationhistorylist')
        ->name('productquotationhistorylist');
    Route::any('quotation_file_download', 'sales\NewQuotationController@quotation_file_download')->name('quotation_file_download');
    Route::any('qtndownload', 'sales\DownloadsController@qtndownload');
    Route::any('piupdate1', 'sales\EnquiryController@piupdate1')->name('piupdate1');


    Route::any('salessao', 'Reports\SalesSOAController@salessao')->name('salessao');
    Route::any('salessoasubmit', 'Reports\SalesSOAController@salessoasubmit')->name('salessoasubmit');
    Route::any('soasalespdf', 'Reports\SalesSOAController@soasalespdf')->name('soasalespdf');


    Route::any('sellreports', 'Reports\SalesReportController@sellreports')->name('sellreports');
    Route::any('viewsellreport', 'Reports\SalesReportController@viewsellreport')->name('viewsellreport');
    Route::any('cashsell_report', 'Reports\SalesReportController@cashsell_report')->name('cashsell_report');
    Route::any('viewcashsellreport', 'Reports\SalesReportController@viewcashsellreport')->name('viewcashsellreport');
    Route::any('creditsell_report', 'Reports\SalesReportController@creditsell_report')->name('creditsell_report');
    Route::any('viewcreditsellreport', 'Reports\SalesReportController@viewcreditsellreport')->name('viewcreditsellreport');
    Route::any('sellvatlistreports', 'Reports\SalesReportController@sellvatlistreports')->name('sellvatlistreports');
    Route::any('sellvatlist', 'Reports\SalesReportController@sellvatlist')->name('sellvatlist');
    Route::any('sell_reportpdf_print', 'Reports\SalesReportController@sell_reportpdf_print')->name('sell_reportpdf_print');
    Route::any('sell_reportexcel_print', 'Reports\SalesReportController@sell_reportexcel_print')->name('sell_reportexcel_print');
    Route::any('sellreports1', 'Reports\SalesReportController@sellreports1')->name('sellreports1');
    Route::any('sellreportsubmit', 'Reports\SalesReportController@sellreportsubmit')->name('sellreportsubmit');
    Route::any('sell_report1pdf_print', 'Reports\SalesReportController@sell_report1pdf_print')->name('sell_report1pdf_print');
    Route::any('sellreceivable', 'Reports\SalesReportController@sellreceivable')->name('sellreceivable');
    Route::any('sellreceivablereportsubmit', 'Reports\SalesReportController@sellreceivablereportsubmit')->name('sellreceivablereportsubmit');
    Route::any('sell_receivable_reportpdf', 'Reports\SalesReportController@sell_receivable_reportpdf')->name('sell_receivable_reportpdf');
    Route::any('sellpayablereport', 'Reports\SalesReportController@sellpayablereport')->name('sellpayablereport');
    Route::any('sellpayablereportsubmit', 'Reports\SalesReportController@sellpayablereportsubmit')->name('sellpayablereportsubmit');
    Route::any('sell_payable_reportpdf', 'Reports\SalesReportController@sell_payable_reportpdf')->name('sell_payable_reportpdf');
    Route::any('sellincome', 'Reports\SalesReportController@sellincome')->name('sellincome');
    Route::any('sellincomereportsubmit', 'Reports\SalesReportController@sellincomereportsubmit')->name('sellincomereportsubmit');
    Route::any('sell_income_reportpdf', 'Reports\SalesReportController@sell_income_reportpdf')->name('sell_income_reportpdf');
    Route::any('sellexpense', 'Reports\SalesReportController@sellexpense')->name('sellexpense');
    Route::any('sellexpensereportsubmit', 'Reports\SalesReportController@sellexpensereportsubmit')->name('sellexpensereportsubmit');
    Route::any('sell_expense_reportpdf', 'Reports\SalesReportController@sell_expense_reportpdf')->name('sell_expense_reportpdf');
    Route::any('sellreturnreport', 'Reports\SalesReturnController@sellreturnreport')->name('sellreturnreport');
    Route::any('salesreturnsubmit', 'Reports\SalesReturnController@salesreturnsubmit')->name('salesreturnsubmit');
    Route::any('salesreturn_reportpdf', 'Reports\SalesReturnController@salesreturn_reportpdf')->name('salesreturn_reportpdf');
    Route::any('dailysalesreport', 'Reports\SalesReportController@dailysalesreport')->name('dailysalesreport');
    Route::any('dailysalessubmit', 'Reports\SalesReportController@dailysalessubmit')->name('dailysalessubmit');
    Route::any('sell_report_pdf_bydate', 'Reports\SalesReportController@sell_report_pdf_bydate')->name('sell_report_pdf_bydate');
    Route::any('cashsell_report_bydate', 'Reports\SalesReportController@cashsell_report_bydate')->name('cashsell_report_bydate');
    Route::any('dailycashsalessubmit', 'Reports\SalesReportController@dailycashsalessubmit')->name('dailycashsalessubmit');
    Route::any('cashsell_report_pdf_bydate', 'Reports\SalesReportController@cashsell_report_pdf_bydate')->name('cashsell_report_pdf_bydate');
    Route::any('creditsell_report_bydate', 'Reports\SalesReportController@creditsell_report_bydate')->name('creditsell_report_bydate');
    Route::any('dailycreditsalessubmit', 'Reports\SalesReportController@dailycreditsalessubmit')->name('dailycreditsalessubmit');
    Route::any('creditsell_report_pdf_bydate', 'Reports\SalesReportController@creditsell_report_pdf_bydate')->name('creditsell_report_pdf_bydate');
    Route::any('sellreturnsoareport', 'Reports\SalesReturnController@sellreturnsoareport')->name('sellreturnsoareport');
    Route::any('salesreturnsoasubmit', 'Reports\SalesReturnController@salesreturnsoasubmit')->name('salesreturnsoasubmit');
    Route::any('soasalesreturnpdf', 'Reports\SalesReturnController@soasalesreturnpdf')->name('soasalesreturnpdf');
    Route::any('sell_report_date_pdf', 'Reports\SalesReportController@sell_report_date_pdf')->name('sell_report_date_pdf');

    //pos
    Route::any('pos_invoice_list', 'sell\POSController@pos_invoice_list')->name('pos_invoice_list');
    Route::any('Add-Invoice-pos', 'sell\POSController@Add_Invoice_pos')->name('Add-Invoice-pos');
    Route::any('posinvoice-PDF', 'sell\POSController@Pdf')->name('posinvoice-PDF');
    Route::any('Invoice_edit_pos', 'sell\POSController@Invoice_edit_pos')->name('Invoice_edit_pos');
    Route::any('Invoice-Approve_pos', 'sell\POSController@Invoice_Approve')->name('Invoice-Approve_pos');

    //
    Route::any('sell_report_pdf', 'Reports\SalesReportController@sell_report_pdf')->name('sell_report_pdf');
    Route::any('quotation_documents', 'sell\SalesOrderController@quotation_documents')->name('quotation_documents');
    Route::any('quotationdownload', 'sell\SalesOrderController@quotationdownload')->name('quotationdownload');
    Route::any('SaleOrder-Performa', 'sell\SalesOrderController@SaleOrder_Performa')->name('SaleOrder-Performa');

    Route::any('Deliveryorderperformainvoice_sell', 'sell\DeliveryOrderController@deliveryOrder_Performa')->name('Deliveryorderperformainvoice_sell');

    //
    Route::any('purchasestock_reports', 'Reports\StockController@purchasestock_reports')->name('purchasestock_reports');
    Route::any('salesstock_reports', 'Reports\StockController@salesstock_reports')->name('salesstock_reports');
    Route::any('salesstockreport', 'Reports\StockController@salesstockreport')->name('salesstockreport');
    Route::any('purchasestockreport', 'Reports\StockController@purchasestockreport')->name('purchasestockreport');
    Route::any('viewpurchasereport', 'Reports\StockController@viewpurchasereport')->name('viewpurchasereport');
    Route::any('viewsalesreport', 'Reports\StockController@viewsalesreport')->name('viewsalesreport');
    Route::any('purchasereportpdf', 'Reports\StockController@purchasereportpdf')->name('purchasereportpdf');
    Route::any('purchasestockreportpdf', 'Reports\StockController@purchasestockreportpdf')->name('purchasestockreportpdf');
    Route::any('salesreportpdf', 'Reports\StockController@salesreportpdf')->name('salesreportpdf');
    Route::any('salesstockreportpdf', 'Reports\StockController@salesstockreportpdf')->name('salesstockreportpdf');

    //

    //Enquiry
    Route::any('enquiry_list', 'sell\EnquiryController@list')->name('enquiry_list');
    Route::any('enquiry-Add', 'sell\EnquiryController@add')->name('enquiry-Add');
    Route::any('newenquirysubmit_sell', 'sell\EnquiryController@submit')->name('newenquirysubmit_sell');
    Route::any('Enquiry-Approve', 'sell\EnquiryController@approve')->name('Enquiry-Approve');
    Route::any('sellenquiryapprove', 'sell\EnquiryController@sellenquiryapprove')->name('sellenquiryapprove');
    Route::any('enquiry-Edit', 'sell\EnquiryController@edit')->name('enquiry-Edit');
    Route::any('enquiryupdate_sell', 'sell\EnquiryController@update')->name('enquiryupdate_sell');
    Route::any('enquiry-Pdf', 'sell\EnquiryController@pdf')->name('enquiry-Pdf');

    Route::any('all-ticket-list', 'sell\TicketController@listAll')->name('all-ticket-list');
    Route::any('ticket_list/{id}', 'sell\TicketController@list')->name('trip-bill_list');
    Route::any('ticket-Add/{id}', 'sell\TicketController@add')->name('ticket-Add');
    Route::any('new-ticket-submit_sell', 'sell\TicketController@submit')->name('new-trip-billsubmit_sell');
    Route::any('ticket-Approve', 'sell\TicketController@approve')->name('ticket-Approve');
    Route::any('sell-trip-billapprove', 'sell\TicketController@sellenquiryapprove')->name('sellenquiryapprove');
    Route::any('ticket-edit/{id}', 'sell\TicketController@edit')->name('ticket-Edit');

    Route::any('ticket-pdf/{id}', 'sell\TicketController@pdf')->name('ticket-Pdf');
    Route::any('sell-calculator', 'sell\CommonController@calculator')->name('sell-calculator');

    //
    //
    Route::any('Quotation-verify', 'sell\QuotationController@verify')->name('Quotation-verify');
    Route::any('sellquotationverify', 'sell\QuotationController@sellquotationverify')->name('sellquotationverify');
    //
    //
    Route::any('purchasecostreports', 'Reports\PurchaseCostController@purchasecostreports')->name('purchasecostreports');
    Route::any('purchasecostsubmit', 'Reports\PurchaseCostController@purchasecostsubmit')->name('purchasecostsubmit');
    Route::any('purchasecostpdf', 'Reports\PurchaseCostController@purchasecostpdf')->name('purchasecostpdf');

    Route::any('salesmanreports', 'Reports\SalesmanReportController@salesmanreports')->name('salesmanreports');
    Route::any('salesmanreportsubmit', 'Reports\SalesmanReportController@salesmanreportsubmit')->name('salesmanreportsubmit');

    //


    // purchase 
    Route::any('purchase-soa', 'Reports\PurchaseSOAController@purchaseSoa')->name('purchase-soa');
    Route::any('purchase-soa-pdf', 'Reports\PurchaseSOAController@pdf')->name('purchase-soa-pdf');

    Route::any('purchase-all', 'Reports\PurchaseReportController@All')->name('purchase-all');
    Route::any('purchase-all-pdf', 'Reports\PurchaseReportController@AllPdf')->name('purchase-all-pdf');

    Route::any('purchase-bydate', 'Reports\PurchaseReportController@byDate')->name('purchase-bydate');
    Route::any('purchase-bydate-pdf', 'Reports\PurchaseReportController@byDatePdf')->name('purchase-bydate-pdf');

    Route::any('purchase-vat-index', 'Reports\PurchaseReportController@vatIndex')->name('purchase-vat-index');
    Route::any('purchase-vat-list', 'Reports\PurchaseReportController@vatList')->name('purchase-vat-list');
    Route::any('purchase-vat-pdf', 'Reports\PurchaseReportController@vatListPdf')->name('purchase-vat-pdf');

    Route::any('purchase-return-report-index', 'Reports\PurchaseReturnController@index')->name('purchase-return-report-index');
    Route::any('purchase-return-report-list', 'Reports\PurchaseReturnController@list')->name('purchase-return-report-list');
    Route::any('purchase-return-report-pdf', 'Reports\PurchaseReturnController@pdf')->name('purchase-return-report-pdf');

    Route::any('purchase-refund-report', 'Reports\PurchaseRefundController@index')->name('purchase-refund-report');
    Route::any('purchase-refund-report-pdf', 'Reports\PurchaseRefundController@pdf')->name('purchase-refund-report-pdf');

    Route::any('purchase_register', 'Reports\PurchaseRegisterController@purchase_register')->name('purchase_register');
    Route::any('purchase_registerpdf', 'Reports\PurchaseRegisterController@purchase_registerpdf')->name('purchase_registerpdf');

    Route::any('payable', 'Reports\PurchasePayableController@payable')->name('payable');
    Route::any('payablepdf', 'Reports\PurchasePayableController@payablepdf')->name('payablepdf');

    // purchase

});



Route::get('lang/{locale}', 'LocalizationController@index');

Route::get('/1', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/2', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

Route::get('/3', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

Route::get('/4', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

Route::get('/5', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

Route::get('/6', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/8', function () {
    $exitCode = Artisan::call('key:generate');
    return '<h1>key Config cleared</h1>';
});

Route::get('setlocale/{locale}', 'LocaleController@setLocale');



Route::any('purvatreport', 'sales\SalesReportController@purvatreport')->name('purvatreport');

Route::any('purvatlistreports', 'sales\SalesReportController@purvatlistreports')
    ->name('purvatlistreports');

Route::any('pur_reportpdf_print', 'sales\SalesReportController@pur_reportpdf_print')
    ->name('pur_reportpdf_print');

// });



//////////////////

Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');
Route::resource('assignrole', 'RoleAssign');

///////////////

// Begin :: Support Tickets
Route::group(['prefix' => 'support_ticket', 'namespace' => 'support_ticket'], function () {
    // Route::any('deletefn', 'CommonController@common_deletefn')->name('deletefn');

    // Dashboard
    Route::any('/', 'DashboardController@index')->name('Dashboard');
    Route::any('dashboard', 'DashboardController@index')->name('dashboard');

    // Create Ticket
    Route::any('create_ticket', 'CreateTicketController@index')->name('create_ticket');
    Route::any('assignd_ticket', 'CreateTicketController@assignedlist')->name('assignd_ticket');
    Route::any('add_new_ticket', 'CreateTicketController@createticket')->name('add_new_ticket');
    Route::post('getclient_projects', 'CreateTicketController@client_projectsajax')->name('getclient_projects');
    Route::post('ticketsubmit', 'CreateTicketController@ticket_submit')->name('ticketsubmit');
    Route::any('upload_ticktattachmnts', 'CreateTicketController@upld_ticketattchment')->name('upload_ticktattachmnts');
    Route::get('edit_ticket/{id}', 'CreateTicketController@editticket')->name('edit_ticket');
    Route::post('ticketupdate', 'CreateTicketController@ticket_update')->name('ticketupdate');
    Route::any('ticket_dlt', 'CreateTicketController@ticket_deletefn')->name('ticket_dlt');
    Route::get('view_ticket', 'CreateTicketController@viewticket')->name('View Ticket Details');
    Route::post('ticketcomments_submit', 'CreateTicketController@ticket_commentssubmit')->name('View Ticket Details');
    Route::any('download_attachment', 'CreateTicketController@dwnload_attachment')->name('View Ticket Details');

    // Assign Ticket
    Route::any('assign_ticket', 'AssignTicketController@index')->name('Assigned Tickets');
    Route::post('ticketstat_update', 'AssignTicketController@ticketstatupdate')->name('Assigned Tickets');
    Route::post('closeticket', 'AssignTicketController@close_ticket')->name('Assigned Tickets');
    Route::post('delegateticket_submit', 'AssignTicketController@delegateticketsubmit')->name('Assigned Tickets');
    Route::any('view_assignedticket', 'AssignTicketController@viewassigned_ticket')->name('View Ticket Details');
    Route::any('delegatd_ticket', 'AssignTicketController@delegated_ticketlist')->name('Delegated Tickets');
    Route::get('view_delegatedticket', 'AssignTicketController@viewdelegated_ticket')->name('View Ticket Details');
    Route::post('delegtcloseticket', 'AssignTicketController@delegtclose_ticket')->name('Assigned Tickets');

    // Open / Close Tickets
    Route::any('open_or_close', 'Open_closeticketController@index')->name('Open/Close Tickets');
    Route::any('closed_tickets', 'Open_closeticketController@closed_ticketslist')->name('Open/Close Tickets');
    Route::any('view_ticketdetails', 'Open_closeticketController@view_ticket_details')->name('View Ticket Details');

    // ------------ Settings --------------------------
    // Ticket Type
    Route::any('ticket_type', 'TickettypeController@index')->name('ticket_type');
    Route::post('tickettype_submit', 'TickettypeController@ticket_type_submit')->name('tickettype_submit');
    Route::post('tickettypedet_ajax', 'TickettypeController@get_tickettype_det')->name('tickettypedet_ajax');
    Route::post('tickettype_update', 'TickettypeController@ticket_type_update')->name('tickettype_update');
    Route::any('tickettyp_dlt', 'TickettypeController@type_deletefn')->name('tickettyp_dlt');

    // Ticket Category
    Route::any('ticket_category', 'TicketcategoryController@index')->name('ticket_category');
    Route::post('ticketcatg_submit', 'TicketcategoryController@ticket_ctg_submit')->name('ticketcatg_submit');
    Route::post('ticketctgdet_ajax', 'TicketcategoryController@get_ticketctg_det')->name('ticketctgdet_ajax');
    Route::post('ticketcatg_update', 'TicketcategoryController@ticket_ctg_update')->name('ticketcatg_update');
    Route::any('ticketctg_dlt', 'TicketcategoryController@catg_deletefn')->name('ticketctg_dlt');

    // Ticket Tags
    Route::any('ticket_tags', 'TickettagsController@index')->name('ticket_tags');
    Route::post('tickettag_submit', 'TickettagsController@ticket_tag_submit')->name('tickettag_submit');
    Route::post('tickettagdet_ajax', 'TickettagsController@get_tickettags_det')->name('tickettagdet_ajax');
    Route::post('tickettag_update', 'TickettagsController@ticket_tag_update')->name('tickettag_update');
    Route::any('tickettag_dlt', 'TickettagsController@tag_deletefn')->name('tickettag_dlt');

    // Ticket Status
    Route::any('ticket_status', 'TicketstatusController@index')->name('ticket_status');
    Route::post('ticketstatus_submit', 'TicketstatusController@ticket_status_submit')->name('ticketstatus_submit');
    Route::post('ticketstatusdet_ajax', 'TicketstatusController@get_ticketstatus_det')->name('ticketstatusdet_ajax');
    Route::post('ticketstatus_update', 'TicketstatusController@ticket_status_update')->name('ticketstatus_update');
    Route::any('ticketstat_dlt', 'TicketstatusController@status_deletefn')->name('Ticket Status');

    // Email Settings
    Route::any('emailsetting', 'EmailsettingsController@index')->name('Email Settings');
    Route::post('emailsettingsdet_ajax', 'EmailsettingsController@get_emailsetting_det')->name('Email Settings');
    Route::post('emailsettings_update', 'EmailsettingsController@emailsettngs_update')->name('Email Settings');
});
// End   :: Support Tickets

//print barcode
Route::any('printbarcode', 'inventory\BarcodeController@printbarcode')->name('printbarcode');

//

Route::any('sales_soacorrect', 'sell\InvoiceOrderController@sales_soacorrect')->name('sales_soacorrect');
Route::any('Add-barcode', 'inventory\BarcodeController@Add_barcode')->name('Add-barcode');
Route::any('submit-barcode', 'inventory\BarcodeController@submit_barcode')->name('submit-barcode');

Route::any('purchasereports', 'Reports\ReportsController@purchasereports')->name('purchasereports');
Route::any('purchaselistreports', 'Reports\ReportsController@purchaselistreports')->name('purchaselistreports');

Route::any('purchase_reportpdf_print', 'Reports\ReportsController@purchase_reportpdf_print')->name('purchase_reportpdf_print');
Route::get('/productcode_sales/find', 'sell\POSController@productcode_sales');
Route::any('getproduct_product_code', 'sell\CommonController@getproduct_product_code');


Route::any('nextNumber', 'CommonController@nextNumber');

Route::any('Invoice-Delete', 'sell\InvoiceOrderController@delete')->name('Invoice-Delete');




Route::any('tsearch', 'CommonController@tsearch');




Route::any('datasearch', 'inventory\ProductController@datasearch')
    ->name('datasearch');


Route::any('pproduct', 'inventory\ProductController@pproduct')
    ->name('pproduct');

//autoincrement
Route::any('autoincrement', 'CommonController@autoincrement')->name('autoincrement');
Route::any('update', 'CommonController@update')->name('update');
//autoincrement
//only routes
Route::any('tozero', 'CommonController@tozero')->name('tozero');
Route::any('quantitychange_purchase', 'CommonController@quantitychange_purchase')->name('quantitychange_purchase');
Route::any('quantitychange_sales', 'CommonController@quantitychange_sales')->name('quantitychange_sales');
Route::any('gettermsqpurchase', 'CommonController@gettermsquote')->name('gettermsqpurchase');
//