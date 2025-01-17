<script type="text/javascript">
$(document).ready(function() {
	/**
	 * On changing the parent group select box check whether the selected value
	 * should show the "Affects Gross Profit/Loss Calculations".
	 */
	$('#GroupParentId').change(function() {
		if ($(this).val() == '3' || $(this).val() == '4') {
			$('#AffectsGross').show();
		} else {
			$('#AffectsGross').hide();
		}
	});
	$('#GroupParentId').trigger('change');
	$("#GroupParentId").select2({width:'100%'});


});

function getNumber(x) {
	var id = $("#GroupParentId option:selected").val()
	$.ajax({
    	type:"POST",
        url: "<?=base_url(); ?>" + "groups/getNextCode",
    	data: { id }
    }).done(function(msg){
    	console.log(msg);
    	$('#g_code').val(msg);
    });

}
</script>

<style type="text/css">
.select2-container--default .select2-results__option {
	font-weight: bold;
	color: #333;
}
</style>


<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <!-- <div class="card-header with-border">
              <h3 class="card-title"><?= lang('entries_views_add_title') ?></h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
            	<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
             	<div class="groups add form">
					<?php
						echo form_open();

						echo "<div class='row'>";
						echo "<div class='col-md-5'>";
							echo '<div class="form-group">';
							echo form_label(lang('groups_views_add_label_parent_group'), 'parent_id');
							echo form_dropdown('parent_id', $parents, set_value('parent_id'),array('class' => 'form-control', 'id'=>'GroupParentId',  'onchange'=>"getNumber()"));
							echo "</div>";
						echo "</div>";						
						echo "<div class='col-md-2'>";
							echo '<div class="form-group">';
							echo form_label(lang('groups_views_add_label_group_code'), 'code');
							echo form_input('code', set_value('code') ,array('class' => 'form-control', 'id'=> 'g_code'));
							echo "</div>";	
						echo "</div>";
						echo "<div class='col-md-5'>";
							echo '<div class="form-group">';
							echo form_label(lang('groups_views_add_label_group_name'), 'name');
							echo form_input('name', set_value('name') ,array('class' => 'form-control'));
							echo "</div>";		
						echo "</div>";
						echo "</div>";
						
						echo '<div class="form-group required" id="AffectsGross">';
						echo form_label(lang('groups_views_add_label_affects'), 'affects_gross');
						$data = array(
						        'name'          => 'affects_gross',
						        'id'            => 'affects_gross',
						        'value'         => '1',
						        'checked'       => TRUE,
						        'style'         => 'margin:10px'
						);
						echo "<br>";
						echo form_radio($data).lang('groups_views_add_label_gross_profit_loss');

						$data = array(
						        'name'          => 'affects_gross',
						        'id'            => 'affects_gross',
						        'value'         => '0',
						        'style'         => 'margin:10px'
						);
						echo "<br>";

						echo form_radio($data).lang('groups_views_add_label_net_profit_loss');

						echo '<span class="help-block">' . (lang('groups_views_add_note')) . '</span>';
						echo '</div>';
					?>
				</div>
            </div>
            <div class="card-footer">
            	<?php
            	echo '<div class="form-group">';
							echo form_submit('submit', lang('submit'), array('class' => 'btn btn-primary float-right'));
							echo '<span class="link-pad"></span>';
							echo anchor('accounts/index', lang('entries_views_add_label_cancel_btn'), array('class' => 'btn btn-danger float-right', 'style' => "margin-right: 5px;"));
							echo '</div>';

							echo form_close();
            	?>
            </div>
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->