jQuery( document ).ready(function($) {
	
	// Reset Form on Page Load
	$('.widget-woo-vpf-ymm-filter form').each(function() {
		$(this)[0].reset();
	});
	
	// Disable Dependent Fields
	if( woo_vpf_ymm_params.disable_dependent_fields == 'yes' ) {
		
		$('.widget-woo-vpf-ymm-filter select').attr( 'disabled', 'disabled' );
		$('.widget-woo-vpf-ymm-filter select[name="year_id"]').removeAttr( 'disabled' );
		$('.widget-woo-vpf-ymm-filter select[name="category"]').removeAttr( 'disabled' );
		
		if( $('.widget-woo-vpf-ymm-filter select[name="year_id"]').val() > 0 ) {
			$('.widget-woo-vpf-ymm-filter select[name="make"]').removeAttr( 'disabled' );
		}
		
		if( $('.widget-woo-vpf-ymm-filter select[name="make"]').val() > 0 ) {
			$('.widget-woo-vpf-ymm-filter select[name="model"]').removeAttr( 'disabled' );
		}
		
		if( $('.widget-woo-vpf-ymm-filter select[name="model"]').val() > 0 ) {
			$('.widget-woo-vpf-ymm-filter select[name="engine"]').removeAttr( 'disabled' );
		}
		
		$( document.body ).on('woo_vpf_ymm_makes_updated', function(event, elem_container, elem_select) {
			if( elem_container.find('select[name="year_id"]').val() == '' ) {
				elem_container.find('select[name="make"]').attr( 'disabled', 'disabled' );
			} else {
				elem_container.find('select[name="make"]').removeAttr( 'disabled' );
			}

			elem_container.find('select[name="model"]').attr( 'disabled', 'disabled' );
			elem_container.find('select[name="engine"]').attr( 'disabled', 'disabled' );
		});
		
		$( document.body ).on('woo_vpf_ymm_models_updated', function(event, elem_container, elem_select) {
			if( elem_container.find('select[name="make"]').val() == '' ) {
				elem_container.find('select[name="model"]').attr( 'disabled', 'disabled' );
			} else {
				elem_container.find('select[name="model"]').removeAttr( 'disabled' );
			}
			
			elem_container.find('select[name="engine"]').attr( 'disabled', 'disabled' );
		});
		
		$( document.body ).on('woo_vpf_ymm_engines_updated', function(event, elem_container, elem_select) {
			if( elem_container.find('select[name="model"]').val() == '' ) {
				elem_container.find('select[name="engine"]').attr( 'disabled', 'disabled' );
			} else {
				elem_container.find('select[name="engine"]').removeAttr( 'disabled' );
			}
		});
	}
	
	// Chosen
	if( woo_vpf_ymm_params.is_chosen == 'yes' ) {
		$('.widget-woo-vpf-ymm-filter select').chosen();
		
		$( document.body ).on('woo_vpf_ymm_makes_updated', function(event, elem_container, elem_select) {
			elem_container.find('select[name="make"]').trigger('chosen:updated');
			elem_container.find('select[name="model"]').trigger('chosen:updated');
			elem_container.find('select[name="engine"]').trigger('chosen:updated');
		});
		
		$( document.body ).on('woo_vpf_ymm_models_updated', function(event, elem_container, elem_select) {
			elem_container.find('select[name="model"]').trigger('chosen:updated');
			elem_container.find('select[name="engine"]').trigger('chosen:updated');
		});
		
		$( document.body ).on('woo_vpf_ymm_engines_updated', function(event, elem_container, elem_select) {
			elem_container.find('select[name="engine"]').trigger('chosen:updated');
		});
	}
	
	// Dynamic DropDowns
	if( $('.widget-woo-vpf-ymm-filter select[name="make"]').length ) {
		$( document.body ).on('change', '.widget-woo-vpf-ymm-filter select[name="year_id"]', function() {
			var $elem = $(this).closest('form');
			$elem.addClass('woo-vpf-ymm-processing');
		
			$term_id = $(this).val();
			$.post( woo_vpf_ymm_params.ajax_url, {'parent':$term_id, 'action':'woo_vpf_ymm_get_terms'}, function( response ) {
				$elem.removeClass('woo-vpf-ymm-processing');
				
				if( $elem.find('select[name="make"]').length ) {
					$elem.find('select[name="make"] option:not(:first)').remove();
					$elem.find('select[name="make"]').append( response );
				}
			
				if( $elem.find('select[name="model"]').length ) {
					$elem.find('select[name="model"] option:not(:first)').remove();
				}
			
				if( $elem.find('select[name="engine"]').length ) {
					$elem.find('select[name="engine"] option:not(:first)').remove();
				}
			
				$( document.body ).trigger( 'woo_vpf_ymm_makes_updated', [ $elem, $elem.find('select[name="make"]') ] );
			});
		});
	}
	
	if( $('.widget-woo-vpf-ymm-filter select[name="model"]').length ) {
		$( document.body ).on('change', '.widget-woo-vpf-ymm-filter select[name="make"]', function() {
			var $elem = $(this).closest('form');
			$elem.addClass('woo-vpf-ymm-processing');
		
			$term_id = $(this).val();
			$.post( woo_vpf_ymm_params.ajax_url, {'parent':$term_id, 'action':'woo_vpf_ymm_get_terms'}, function( response ) {
				$elem.removeClass('woo-vpf-ymm-processing');
				
				if( $elem.find('select[name="model"]').length ) {
					$elem.find('select[name="model"] option:not(:first)').remove();
					$elem.find('select[name="model"]').append( response );
				}
			
				if( $elem.find('select[name="engine"]').length ) {
					$elem.find('select[name="engine"] option:not(:first)').remove();
				}
			
				$( document.body ).trigger( 'woo_vpf_ymm_models_updated', [ $elem, $elem.find('select[name="model"]') ] );
			});
		});
	}
	
	if( $('.widget-woo-vpf-ymm-filter select[name="engine"]').length ) {
		$( document.body ).on('change', '.widget-woo-vpf-ymm-filter select[name="model"]', function() {
			var $elem = $(this).closest('form');
			$elem.addClass('woo-vpf-ymm-processing');
			
			$term_id = $(this).val();
			$.post( woo_vpf_ymm_params.ajax_url, {'parent':$term_id, 'action':'woo_vpf_ymm_get_terms'}, function( response ) {
				$elem.removeClass('woo-vpf-ymm-processing');
				
				if( $elem.find('select[name="engine"]').length ) {
					$elem.find('select[name="engine"] option:not(:first)').remove();
					$elem.find('select[name="engine"]').append( response );
				}
				
				$( document.body ).trigger( 'woo_vpf_ymm_engines_updated', [ $elem, $elem.find('select[name="engine"]') ] );
			});
		});
	}
	
	// Validation Rules
	if( woo_vpf_ymm_params.activate_validation == 'yes' ) {
		
		$( document.body ).on('submit', '.widget-woo-vpf-ymm-filter form', function() {
			var $elem = $(this);
			
			var $error_text = ''; var $error_elem = '';
			
			// Validation: Year
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_year == 'yes' && $elem.find('select[name="year_id"]').length ) {
					if( $elem.find('select[name="year_id"]').val() == '' ) {
						$error_elem = $elem.find('select[name="year_id"]');
						$error_text = woo_vpf_ymm_params.validate_year_text;
					}
				}
			}
			
			// Validation: Make
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_make == 'yes' && $elem.find('select[name="make"]').length ) {
					if( $elem.find('select[name="make"]').val() == '' ) {
						$error_elem = $elem.find('select[name="make"]');
						$error_text = woo_vpf_ymm_params.validate_make_text;
					}
				}
			}
			
			// Validation: Model
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_model == 'yes' && $elem.find('select[name="model"]').length ) {
					if( $elem.find('select[name="model"]').val() == '' ) {
						$error_elem = $elem.find('select[name="model"]');
						$error_text = woo_vpf_ymm_params.validate_model_text;
					}
				}
			}
			
			// Validation: Engine
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_engine == 'yes' && $elem.find('select[name="engine"]').length ) {
					if( $elem.find('select[name="engine"]').val() == '' ) {
						$error_elem = $elem.find('select[name="engine"]');
						$error_text = woo_vpf_ymm_params.validate_engine_text;
					}
				}
			}
			
			// Validation: Category
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_category == 'yes' && $elem.find('select[name="category"]').length ) {
					if( $elem.find('select[name="category"]').val() == '' ) {
						$error_elem = $elem.find('select[name="category"]');
						$error_text = woo_vpf_ymm_params.validate_category_text;
					}
				}
			}
			
			// Validation: Keyword
			if( $error_elem == '' ) {
				if( woo_vpf_ymm_params.validate_keyword == 'yes' && $elem.find('input[name="s"]').length ) {
					if( $elem.find('input[name="s"]').val() == '' ) {
						$error_elem = $elem.find('input[name="s"]');
						$error_text = woo_vpf_ymm_params.validate_keyword_text;
					}
				}
			}
			
			// Validation: Alerts / Styles
			$elem.find('.woo-vpf-ymm-error').removeClass('woo-vpf-ymm-error');
			if( $error_elem != '' ) {
			
				if( woo_vpf_ymm_params.validation_alert == 'yes' ) {
					if( $error_text != '' ) {
						alert( $error_text );
					}
				}
				
				if( woo_vpf_ymm_params.validation_style == 'yes' ) {
					$error_elem.closest('.woo-vpf-ymm-field').addClass('woo-vpf-ymm-error');
				}
				
				return false;
			} else {
				return true;
			}
			
		});
		
	}
	
	
	
	/* My Vehicles */
	
	// Radio Button Link
	$('.woo-vpf-ymm-mv-container').on('click', '.mv-item-radio', function(event) {
		$(this).closest('.mv-item').find('.mv-lnk-browse').get(0).click();
	});
	
	// Expand/Collapse Widget
	$( document.body ).on('click', '.woo-vpf-ymm-mv-container.mv-has-expandable-wrapper > .mv-header, .woo-vpf-ymm-mv-container.mv-has-flyout-wrapper > .mv-header', function(event) {
		var $elem = $(this).closest('.woo-vpf-ymm-mv-container');
		if( $elem.hasClass('mv-expanded') ) {
			$elem.addClass('mv-collapse').removeClass('mv-expanded').find('.mv-inner').slideUp();
		} else {
			$elem.addClass('mv-expanded').removeClass('mv-collapse').find('.mv-inner').slideDown();
		}
	});
	
	// Close Current Widget when Opens Another Widget
	$(document).click(function(e) {
		$('.woo-vpf-ymm-mv-container.mv-has-flyout-wrapper').each(function() {
			var $elem = $(this).closest('.woo-vpf-ymm-mv-container');
			
			if ( ! $elem.is(e.target) && $elem.has(e.target).length === 0 ) {
				if( $elem.hasClass('mv-expanded') ) {
					$elem.addClass('mv-collapse').removeClass('mv-expanded').find('.mv-inner').slideUp();
				}
			}
		});
	});
	
	// Reset Search
	$('.woo-vpf-ymm-reset-search').click(function(event) {
		event.preventDefault();
		
		var $href = $(this).attr('href');		
		var $elem = $(this).closest('form');
		$elem.addClass('woo-vpf-ymm-processing');
			
		$.post( woo_vpf_ymm_params.ajax_url, {'action':'woo_vpf_ymm_reset_search'}, function( response ) {
			if( $href != '#' ) {
				window.location.href = $href;
			} else {
				window.location.href = window.location.href;
			}
		});
	});
	
	// Save User Search from History to Permanent Save
	$('.woo-vpf-ymm-mv-container').on('click', '.mv-lnk-save', function(event) {
		event.preventDefault();
		
		if( $(this).hasClass('mv-lnk-disable') ) {
			return;
		}
		
		var $elem = $(this).closest('.woo-vpf-ymm-mv-container');
		$elem.find('.woo-vpf-ymm-loader').show();
		
		var $search_id = $(this).attr('data-search-id');
		var $search_type = $(this).attr('data-search-type');
		$.post( woo_vpf_ymm_params.ajax_url, {'search_id':$search_id, 'search_type':$search_type, 'action':'woo_vpf_ymm_save_search'}, function( response ) {
			woo_vpf_ymm_set_my_vehicles_html(response);			
			$elem.find('.woo-vpf-ymm-loader').hide();
		});
	});
	
	// Delete User Search
	$('.woo-vpf-ymm-mv-container').on('click', '.mv-lnk-delete', function(event) {
		event.preventDefault();
		
		if( $(this).hasClass('mv-lnk-disable') ) {
			return;
		}
		
		var $elem = $(this).closest('.woo-vpf-ymm-mv-container');
		$elem.find('.woo-vpf-ymm-loader').show();
		
		var $search_id = $(this).attr('data-search-id');
		var $search_type = $(this).attr('data-search-type');
		$.post( woo_vpf_ymm_params.ajax_url, {'search_id':$search_id, 'search_type':$search_type, 'action':'woo_vpf_ymm_delete_search'}, function( response ) {
			woo_vpf_ymm_set_my_vehicles_html(response);			
			$elem.find('.woo-vpf-ymm-loader').hide();
		});
	});
	
	// Clear History
	$('.woo-vpf-ymm-mv-container').on('click', '.mv-clear-history', function(event) {
		event.preventDefault();
		
		var $elem = $(this).closest('.woo-vpf-ymm-mv-container');
		$elem.find('.woo-vpf-ymm-loader').show();
		
		var $search_type = $(this).attr('data-search-type');
		$.post( woo_vpf_ymm_params.ajax_url, {'search_type':$search_type, 'action':'woo_vpf_ymm_clear_history'}, function( response ) {
			woo_vpf_ymm_set_my_vehicles_html(response);
			$elem.find('.woo-vpf-ymm-loader').hide();
		});
	});
	
	// Modal
	if( $('.woo-vpf-ymm-modal').length ) {
		// Add a Vehicle Popup
		$('.woo-vpf-ymm-mv-container').on('click', '.mv-add-vehicle', function(event) {
			event.preventDefault();
			
			var $title = $(this).attr('data-title');
			
			$.colorbox({
				inline:true,
				width:'500',
				maxWidth:'95%',
				maxHeight:'95%',
				href:'#woo-vpf-ymm-modal-filter',
				title:$title,
				className:'woo-vpf-ymm-popup',
				onComplete:function(){
					$('#cboxWrapper').find('select, input[name="s"]').val('');
				
					//$('#cboxWrapper').find('select[name="year_id"]').trigger('change');
					$('#cboxWrapper').find('select[name="make"], select[name="model"], select[name="engine"]').find('option:not(:first)').remove();
					
					if( woo_vpf_ymm_params.disable_dependent_fields == 'yes' ) {
						$('#cboxWrapper').find('select[name="make"], select[name="model"], select[name="engine"]').attr( 'disabled', 'disabled' );
					}
					
					$('#cboxWrapper .widget-woo-vpf-ymm-filter select').trigger("chosen:updated");
				}
			});
		});
	}
	
	// Common Functions
	function woo_vpf_ymm_set_my_vehicles_html(response) {
		if( response != '' ) {
			$response_container = $(response).filter('.woo-vpf-ymm-mv-container');
			
			if( $('.woo-vpf-ymm-mv-container > .mv-header').length ) {
				$('.woo-vpf-ymm-mv-container > .mv-header').html( $response_container.find('.mv-header').html() );
			}
			
			if( $('.woo-vpf-ymm-mv-container .mv-section-vehicles-saved').length ) {
				$('.woo-vpf-ymm-mv-container .mv-section-vehicles-saved').html( $response_container.find('.mv-section-vehicles-saved').html() );
			}
			
			if( $('.woo-vpf-ymm-mv-container .mv-section-vehicles-history .mv-items').length ) {
				$('.woo-vpf-ymm-mv-container .mv-section-vehicles-history .mv-items').html( $response_container.find('.mv-section-vehicles-history .mv-items').html() );
			}
			
			if( $('.woo-vpf-ymm-mv-container .mv-section-vehicles-history .mv-actions .mv-clear-history').length ) {
				$('.woo-vpf-ymm-mv-container .mv-section-vehicles-history .mv-actions .mv-clear-history').html( $response_container.find('.mv-section-vehicles-history .mv-actions .mv-clear-history').html() );
			}
		}
	}
});
