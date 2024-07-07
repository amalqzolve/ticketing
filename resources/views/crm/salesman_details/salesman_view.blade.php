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
              {{ __('salesman.Salesman Details Views') }}
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-section">
            <div class="kt-section__info"></div>
            <div class="kt-section__content">
              <div class="table-responsive">
                <table class="table table-bordered table-head-solid">
                  <tbody>
                    <tr>
                      <td>{{ __('salesman.Name') }}</td>
                      <td colspan="3">:
                        <?php echo $data->name ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Address 1') }}</td>
                      <td colspan="3">:
                        <?php echo $data->address1 ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Address 2') }}</td>
                      <td colspan="3">:
                        <?php echo $data->address2 ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Address 3') }}</td>
                      <td colspan="3">:
                        <?php echo $data->address3 ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Zip') }}</td>
                      <td colspan="3">:
                        <?php echo $data->zip ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Country') }}</td>
                      <td colspan="3">:
                        <?php echo $data->country ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Region') }}</td>
                      <td colspan="3">:
                        <?php echo $data->region ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Place') }}</td>
                      <td colspan="3">:
                        <?php echo $data->place ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Department') }}</td>
                      <td colspan="3">:
                        <?php echo $data->department ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Department Head') }}</td>
                      <td colspan="3">:
                        <?php echo $data->department_head ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td>{{ __('salesman.Salesman Route') }}</td>
                      <td colspan="3">:
                        <?php echo $data->salesman_route ?></td>
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

@section('script')
<script>
  $('.SKMManagement').addClass('kt-menu__item--open');
  $('.salesmandetailssettings').addClass('kt-menu__item--active');
</script>
@endsection