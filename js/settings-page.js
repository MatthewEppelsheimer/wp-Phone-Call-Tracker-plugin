
jQuery( document ).ready(function(){
	jQuery("input[name='goog_code_out']").click(function(){
		var me = jQuery("input[name='goog_code_out']");
		var dis = jQuery(me).prop('checked');
		
		
		toggle_input( 'goog_man_code', dis );
	});
});

function toggle_input( name, dis ){
	if (dis) {
		jQuery("input[name='" + name + "']").attr("disabled", true);
	} else {
		jQuery("input[name='" + name + "']").attr("disabled", false);;
	}
}
