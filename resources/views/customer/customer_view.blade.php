@extends('common.layout')
@section('content')


            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
              <div class="row">
                <div class="col-xl-6">

                  <!--begin::Portlet-->
                  <div class="kt-portlet">
                    <div class="kt-portlet__head">
                      <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon kt-hide">
                          <i class="la la-gear"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                          {{ __('customer.Customer Views') }}
                        </h3>
                      </div>
                    </div>
                    <div class="kt-portlet__body">
                      <div class="kt-section">
                        <div class="kt-section__info">
                          
                        </div>
                        <div class="kt-section__content">
                          <div class="table-responsive">
                            <table class="table table-bordered table-head-solid">
                              <!-- <thead>
                                <tr>
                                  <th style="width: 150px">id</th>
                                  
                                  <th>Usage</th>
                                </tr>
                              </thead> -->
                              <tbody>
                                
                                 <tr>
      <td>{{ __('customer.Customer Code') }}</td>
      <td colspan="3"> : <?php echo $data->cust_code ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Customer Type') }}</td>
      <td colspan="3">: <?php echo $data->cust_type ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Customer Category') }}</td>
      <td colspan="3">: <?php echo $data->cust_category ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Sales man') }}</td>
      <td colspan="3">: <?php echo $data->salesman ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Key Accounts') }}</td>
      <td colspan="3">: <?php echo $data->key_account ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Customer Note') }}</td>
      <td colspan="3">: <?php echo $data->cust_note ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Customer Name/Company name') }}</td>
      <td colspan="3">: <?php echo $data->cust_name ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Address 1') }}</td>
      <td colspan="3">: <?php echo $data->cust_add1 ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Address 2') }}</td>
      <td colspan="3">: <?php echo $data->cust_add2 ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Country') }}</td>
      <td colspan="3">: <?php echo $data->cust_country ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Region') }}</td>
      <td colspan="3">: <?php echo $data->cust_region ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.City') }}</td>
      <td colspan="3">: <?php echo $data->cust_city ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Zipcode') }}</td>
      <td colspan="3">: <?php echo $data->cust_zip ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Email 1') }}</td>
      <td colspan="3">: <?php echo $data->email1 ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Email 2') }}</td>
      <td colspan="3">: <?php echo $data->email2 ?></td>
     </tr>
     <tr>
       <tr>
      <td>{{ __('customer.Office Phone 1') }}</td>
      <td colspan="3">: <?php echo $data->office_phone1 ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Office Phone 2') }}</td>
      <td colspan="3">: <?php echo $data->office_phone2 ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Mobile 1') }}</td>
      <td colspan="3">: <?php echo $data->mobile1 ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Mobile 2') }}</td>
      <td colspan="3">: <?php echo $data->mobile2 ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Fax') }}</td>
      <td colspan="3">: <?php echo $data->fax ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Website') }}</td>
      <td colspan="3">: <?php echo $data->website ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Contact Person') }}</td>
      <td colspan="3">: <?php echo $data->contact_person ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Person in Charge') }}</td>
      <td colspan="3">: <?php echo $data->contact_person_incharge ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Mobile') }}</td>
      <td colspan="3">: <?php echo $data->mobile ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Office Charge') }}</td>
      <td colspan="3">: <?php echo $data->office ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Department') }}</td>
      <td colspan="3">:<?php echo $data->contact_department ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Email') }}</td>
      <td colspan="3">:<?php echo $data->email ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Location') }}</td>
      <td colspan="3">:<?php echo $data->location ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Portal URL') }}</td>
      <td colspan="3">:<?php echo $data->portal ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Username') }}</td>
      <td colspan="3">: <?php echo $data->username ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Email') }}</td>
      <td colspan="3">: <?php echo $data->registerd_email ?></td>
     </tr>
     <tr>
      <td>{{ __('customer.Password') }}</td>
      <td colspan="3">: <?php echo $data->password ?></td>
     </tr>

    
  </tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>



@endsection
