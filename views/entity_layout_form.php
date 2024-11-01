<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_entity_layout_form()
{
?>
<input id="ent-layout" type="hidden">
<div class="modal hide" id="myModal">
  <div class="modal-header">
	<button id="edit-close" type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3><?php esc_html_e("Enter a new title","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both">
<form id="layout-form"><fieldset><table><tr><td><label for="grp-title"><?php esc_html_e("Title:","wp-app-studio"); ?></label></td><td><input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all" /></td></tr></table></fieldset> </form>
  </div>
  <div class="modal-footer">
<button id="edit-cancel" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
<button id="save-layout-title" class="btn btn-primary"><?php esc_html_e("Save","wp-app-studio"); ?></button>
  </div>
</div>
<div class="modal hide" id="errorModal">
  <div class="modal-header">
	<button id="error-close" type="button" class="close" data-dismiss="errorModal" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("All attributes must be assigned to at least one panel.","wp-app-studio"); ?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorModal" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
<div class="modal hide" id="errorModal1">
  <div class="modal-header">
	<button id="error-close" type="button" class="close" data-dismiss="errorModal1" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("All panels must have at least one attribute.","wp-app-studio"); ?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorModal1" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
<div class="modal hide" id="errorModal2">
  <div class="modal-header">
	<button id="error-close" type="button" class="close" data-dismiss="errorModal2" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("This action will reset custom layout for this entity.","wp-app-studio"); ?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorModal2" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
<div class="modal hide" id="errorModal3">
  <div class="modal-header">
	<button id="error-close" type="button" class="close" data-dismiss="errorModal3" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("All element dropdowns must be assigned to an attribute.","wp-app-studio"); ?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorModal3" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
<div class="modal hide" id="errorModal4">
  <div class="modal-header">
	<button id="error-close" type="button" class="close" data-dismiss="errorModal4" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("Please remove duplicate attributes from the layout.","wp-app-studio"); ?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorModal4" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
<div class="row-fluid"><div id="layout-alert" class="span12"></div></div>
<div class="row-fluid">
<div class="layout-bin span3 pull-left" data-spy="affix" data-offset-top="50">
<ul class="ui-draggable">
<li class="ui-draggable"><div class="tabgrp" id="tabgrp"><div><i class="icon-check-empty"></i><?php  esc_html_e("Tab Panel","wp-app-studio"); ?>
</div></div></li>
<li class="ui-draggable"><div class="tab"><div><i class="icon-folder-close"></i><?php esc_html_e("Tab","wp-app-studio"); ?></div></div></li>
<li class="ui-draggable"><div class="accgrp" id="accgrp"><div><i class="icon-reorder"></i><?php  esc_html_e("Accordion Panel","wp-app-studio"); ?>
</div></div></li>
<li class="ui-draggable"><div class="acc"><div><i class="icon-minus"></i><?php esc_html_e("Accordion","wp-app-studio"); ?></div></div></li>
</ul>
<div class="attr-bin"><ul class="ui-draggable">
<li class="ui-draggable"><div class="tabattr"> <i class="icon-tasks"></i><?php esc_html_e("Element","wp-app-studio"); ?> </div></li>
</ul></div>
</div><!-- end of layout-bin -->
<div id="layout-ctr" class="span9 pull-right">
<ol class="layout"> </ol>
</div>
</div>
<div id="layout-frm-btn" class="control-group emdt-row">
<button id="cancel" class="btn btn-inverse layout-buttons" name="cancel" type="button"><i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio"); ?></button>
<button id="save-layout" class="btn btn-inverse layout-buttons" type="submit" name="Save"><i class="icon-save"></i>
<?php esc_html_e("Save","wp-app-studio"); ?>
</button>
</div>
<?php
}
function wpas_entity_container($layout,$fields)
{
$grp_count = 0;
$tab_count = 0;
$acc_count = 0;
$layout_html = "";
if(!is_array($layout))
{
$layout_html ="<div class=\"dragme\">" . __("DRAG AND DROP","wp-app-studio") . "</div>";
}
else
{
$layout_html .='<script type="text/javascript">
jQuery(document).ready(function($) {
$("#layout-ctr").sortable();
$(".multitab-ctr").sortable();
$(".multiacc-ctr").sortable();
});
</script>';
foreach($layout as $mylayout)
{
$grp_count++;
if(!empty($mylayout['tabs']))
{
$layout_html .= "<div id=\"tabgrp".$grp_count . "\" class=\"tabgrp-ctr ui-sortable\">
	<div id=\"tabgrp" . $grp_count . "-row\" class=\"row-fluid\">
	<div class=\"pull-left layout-edit-icons\"><a class=\"edit\"><i class=\"icon-edit\"></i></a></div>
	<div id=\"tabgrp" . $grp_count . "-title\" class=\"tabgrp-title layout-title span10 pull-left\">" . esc_html($mylayout['gr_title']) . "</div>
	<div class=\"pull-right layout-edit-icons\">
	<a class=\"delete\"><i class=\"icon-trash\"></i></a></div>
	</div><div class=\"multitab-ctr ui-droppable ui-sortable\">";
}
elseif(!empty($mylayout['accs']))
{
$layout_html .= "<div id=\"accgrp".$grp_count . "\" class=\"accgrp-ctr ui-sortable\">
	<div class=\"pull-left layout-edit-icons\"><a class=\"edit\"><i class=\"icon-edit\"></i></a></div>
        <div id=\"accgrp" . $grp_count . "-row\" class=\"row-fluid\">
        <div id=\"accgrp" . $grp_count . "-title\" class=\"accgrp-title layout-title span10 pull-left\">" . esc_html($mylayout['gr_title']) . "</div>
        <div class=\"pull-right layout-edit-icons\">
        <a class=\"delete\"><i class=\"icon-trash\"></i></a></div>
        </div><div class=\"multiacc-ctr ui-droppable ui-sortable\">";
}
if(isset($mylayout['tabs']))
{
	foreach($mylayout['tabs'] as $mytab)
	{
		$tab_count++;
		$layout_html .= "<div id=\"tab-ctr" . $tab_count . "\" class=\"tab-ctr\">
				<div id=\"tab-ctr". $tab_count . "-row\" class=\"row-fluid\">
				<div class=\"pull-left layout-edit-icons\"><a class=\"edit\"><i class=\"icon-edit\"></i></a></div>
				<div id=\"tab-ctr" . $tab_count . "-title\" class=\"tabctr-title layout-title span10 pull-left\">" . $mytab['tab_title'] . "</div>
				<div class=\"pull-right layout-edit-icons\">
				<a class=\"delete\"><i class=\"icon-trash\"></i></a></div></div>
				<div id=\"multiattr-ctr\" class=\"multiattr-ctr ui-droppable\">";
		if(!empty($mytab['attr']))
		{
			foreach($mytab['attr'] as $myattr)
			{
				$layout_html .= "<div class=\"el-attr row-fluid\">" . wpas_get_select_attrs($fields,$myattr) . "</div>";
			}
		}
		$layout_html .="</div></div>";
	}
}
if(isset($mylayout['accs']))
{
	foreach($mylayout['accs'] as $myacc)
	{
		$acc_count++;
		$layout_html .= "<div id=\"acc-ctr" . $acc_count . "\" class=\"acc-ctr\">
				<div id=\"acc-ctr". $acc_count . "-row\" class=\"row-fluid\">
				<div class=\"pull-left layout-edit-icons\"><a class=\"edit\"><i class=\"icon-edit\"></i></a></div>
				<div id=\"acc-ctr" . $acc_count . "-title\" class=\"accctr-title layout-title span10 pull-left\">" . esc_html($myacc['acc_title']) . "</div>
				<div class=\"pull-right layout-edit-icons\">
				<a class=\"delete\"><i class=\"icon-trash\"></i></a></div></div>
				<div id=\"multiattr-ctr\" class=\"multiattr-ctr ui-droppable\">";
		if(!empty($myacc['attr']))
		{
			foreach($myacc['attr'] as $myattr)
			{
				$layout_html .= "<div class=\"el-attr row-fluid\">" . wpas_get_select_attrs($fields,$myattr) . "</div>";
			}
		}
		$layout_html .="</div></div>";
	}
}
$layout_html .="</div></div>";
}
}
return $layout_html;
}
?>
