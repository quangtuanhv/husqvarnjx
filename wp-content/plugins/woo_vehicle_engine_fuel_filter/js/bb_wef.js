/************************widget js*****************************/
function bbWEF_create_request_widget(obj,token,url){
	if(obj.value > 0){
		jQuery("#bbwefLoader").show();
		wef_default_behave(token);
		var wp_ajax_url = url;
		jQuery.ajax({
			type: "POST",
			url: wp_ajax_url,
			data : {
				'action': 'wef_filter_info',
				'wef_data': obj.value,
				'wef_token': token,
			},
			success: function(response){
				if(token == 2){
					jQuery(".wef_model_box").append(response);
				}
				else if(token == 3){
					jQuery(".wef_year_box").append(response);
				}
				else if(token == 4){
					jQuery(".wef_engine_box").append(response);
				}
				else if(token == 5){
					jQuery(".wef_fuel_box").append(response);
				}
				jQuery("#bbwefLoader").hide();
			}
		});
	}
	else{
		wef_default_behave(token);
	}
}
function wef_default_behave(token){
	if(token == 2){
		jQuery('.wef_model_box').children('option:not(:first)').remove();
		jQuery('.wef_year_box').children('option:not(:first)').remove();
		jQuery('.wef_engine_box').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box').children('option:not(:first)').remove();
	}
	else if(token == 3){
		jQuery('.wef_year_box').children('option:not(:first)').remove();
		jQuery('.wef_engine_box').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box').children('option:not(:first)').remove();
	}
	else if(token == 4){
		jQuery('.wef_engine_box').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box').children('option:not(:first)').remove();
	}
	else if(token == 5){
		jQuery('.wef_fuel_box').children('option:not(:first)').remove();
	}
}
function wef_default_behave_sc(token){
	if(token == 2){
		jQuery('.wef_model_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_year_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_engine_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box_sc').children('option:not(:first)').remove();
	}
	else if(token == 3){
		jQuery('.wef_year_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_engine_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box_sc').children('option:not(:first)').remove();
	}
	else if(token == 4){
		jQuery('.wef_engine_box_sc').children('option:not(:first)').remove();
		jQuery('.wef_fuel_box_sc').children('option:not(:first)').remove();
	}
	else if(token == 5){
		jQuery('.wef_fuel_box_sc').children('option:not(:first)').remove();
	}
}
/*****************************shortcode************************************/

function bbWEF_create_request_shortcode(obj,token,url){
	if(obj.value > 0){
		jQuery("#bbwefLoader_sc").show();
		wef_default_behave_sc(token);
		var wp_ajax_url = url;
		jQuery.ajax({
			type: "POST",
			url: wp_ajax_url,
			data : {
				'action': 'wef_filter_info',
				'wef_data': obj.value,
				'wef_token': token,
			},
			success: function(response){
				if(token == 2){
					jQuery(".wef_model_box_sc").append(response);
				}
				else if(token == 3){
					jQuery(".wef_year_box_sc").append(response);
				}
				else if(token == 4){
					jQuery(".wef_engine_box_sc").append(response);
				}
				else if(token == 5){
					jQuery(".wef_fuel_box_sc").append(response);
				}
				jQuery("#bbwefLoader_sc").hide();
			}
		});
	}
	else{
		wef_default_behave_sc(token);
	}
}
