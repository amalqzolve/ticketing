@extends('crm.common.layout')
 @section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="row">
    <div class="col-xl-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon kt-hide">
                          <i class="la la-gear"></i>
                        </span>
            <h3 class="kt-portlet__head-title">
                          {{ __('customer.Customer Category Views') }}
                        </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-section">
            <div class="kt-section__info"></div>
            <div class="kt-section__content">
              <div class="table-responsive">
                <table class="table table-head-solid">
                  <tbody>
                    <td>{{ __('customer.Customer Category') }}</td>
                    <td colspan="3">:
                      <?php echo $datas->customer_category ?></td>
                    </tr>
                    <tr>
                      <td>{{ __('customer.Description') }}</td>
                      <td colspan="3">:
                        <?php echo $datas->description ?></td>
                    </tr>
                    <tr>
                      <td>{{ __('customer.Color') }}</td>
                      <td colspan="3">:
                        <?php echo $datas->color ?></td>
                    </tr>
                    <tr>
                      <td>{{ __('customer.Custom Code') }}</td>
                      <td colspan="3">:
                        <?php echo $datas->cust_code ?></td>
                    </tr>
                    <tr>
                      <td>{{ __('customer.Start From') }}</td>
                      <td colspan="3">:
                        <?php echo $datas->start_from ?></td>
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