<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- TABLE: LATEST ORDERS -->
      <div class="card card-primary card-outline">
        <div class="card-header with-border">
          <h3 class="card-title"><?= lang('user_views_activate_label_title'); ?></h3>
          <p class="float-right" style="padding-right: 50px;"><?= sprintf(lang('user_views_activate_label_sub_title'), ((isset($_SESSION['active_account'])) ? $_SESSION['active_account']->label : lang('user_views_activate_label_subtitle_NONE'))); ?></p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive" style="max-height: 320px;">
            <table id="accounts" class="table table-striped table-hover custom-table">
              <thead>
                <tr>
                  <th><?= lang('user_views_activate_label_thead_label'); ?></th>
                  <th><?= lang('user_views_activate_label_thead_name'); ?></th>
                  <th><?= lang('user_views_activate_label_thead_fiscal_year'); ?></th>
                  <th><?= lang('user_views_activate_label_thead_status'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($accounts) {
                  foreach ($accounts as $account) {
                    $href = base_url()."user/activate/".$account->id;
                    if ($active_account_id != 0 && $active_account_id == $account->id) {
                      $href = base_url()."user/deactivate/".$account->id;
                      if ($account->account_locked == 1) {
                        $status = lang('user_views_activate_label_active_locked');
                        $title = lang('user_views_activate_label_active_locked_tooltip');
                        $class = 'badge badge-warning';
                        $icon_class = 'fas fa-unlock';
                      }else{
                        $status = lang('user_views_activate_label_active');
                        $title = lang('user_views_activate_label_active_tooltip');
                        $class = 'badge badge-success';
                        $icon_class = 'fas fa-check';
                      }
                    }elseif ($account->account_locked == 1) {
                      $status = lang('user_views_activate_label_locked');
                      $title = lang('user_views_activate_label_locked_tooltip');
                      $class = 'badge badge-danger';
                      $icon_class = 'fas fa-lock';
                    }else{
                      $status = lang('user_views_activate_label_inactive');
                      $title = lang('user_views_activate_label_inactive_tooltip');
                      $class = 'badge badge-secondary';
                      $icon_class = 'fas fa-times';
                    }
                ?>
                  <tr>
                    <td><?= "<em>".$account->label."</em>"; ?></td>
                    <td><?= $account->name; ?></td>
                    <td>
                      <?= $this->functionscore->dateFromSql($account->fy_start).lang('user_views_activate_label_td_fy_year_to').$this->functionscore->dateFromSql($account->fy_end); ?>
                    </td>
                    <td>
                      <a href="<?= $href; ?>" data-toggle="tooltip" data-placement="left" title="<?= $title; ?>"><span class="<?= $class; ?>"><?= $status; ?> <i class="<?= $icon_class ?>"></i></span></a>
                    </td>
                  </tr>
                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th><?= lang('user_views_activate_label_tfoot_label'); ?></th>
                  <th><?= lang('user_views_activate_label_tfoot_name'); ?></th>
                  <th><?= lang('user_views_activate_label_tfoot_fiscal_year'); ?></th>
                  <th><?= lang('user_views_activate_label_tfoot_status'); ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <p style="font-size: 18px;"><?= lang('user_views_activate_note_box_footer'); ?></p>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<script>
$(document).ready(function() {
    var datatables = $('#accounts').DataTable( {
        "scrollY":        "180px",
        "scrollCollapse": true,
        "paging":         false,
        "info":           false,
        "searching":      true,
        "autoWidth":      true
    });
    $(".sidebar-toggle").click(function() {
      setTimeout(function() {
        datatables.columns.adjust().draw();    
      },310);
    });
    $( ".main-sidebar" ).hover(function() {
      setTimeout(function() {
        datatables.columns.adjust().draw();    
      },310);
    });
  });
</script>