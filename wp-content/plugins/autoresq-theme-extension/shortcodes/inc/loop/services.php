<?php

$str = '<div class="ztl-service-container">';
while ( $query->have_posts() ) : $query->the_post();

	//thumb
	$autoresq_service_thumb = '';
	if ( has_post_thumbnail() ) {
		$autoresq_service_thumb = get_the_post_thumbnail_url( get_the_ID(), 'autoresq-wide' );
	}

	$autoresq_service_excerpt = autoresq_get_excerpt( 40, false );

	if ( $autoresq_service_cost = get_post_meta( get_the_ID(), 'autoresq_service_cost', true ) ) {
		$autoresq_service_cost_content = '
	        <span class="ztl-service-info-line">
	            <span>
	                <span>' . esc_html( $autoresq_service_cost ) . ' //</span>
	                ' . esc_html__('starting price','zoutula') . '
	            </span>
	        </span>';
	}

	if ( $autoresq_service_duration = get_post_meta( get_the_ID(), 'autoresq_service_duration', true ) ) {
		$autoresq_service_duration_content = '
	        <span class="ztl-service-info-line">
	            <span>
	                <span>' . esc_html( $autoresq_service_duration ) . ' //</span>
	                ' . esc_html__('estimated repair time','zoutula') . '
	            </span>
	        </span>';
	}

	$str .= '
        <div class="ztl-service-item">
	    <div class="row table-row">
	        <div class="first ztl-col ' . autoresq_get_bc( '12', '12', '12', '12' ) . '">
	            <div class="ztl-flex">
	                <div class="ztl-post-thumbnail" style="background-image:url('.$autoresq_service_thumb.');">
	                    <a href="' . get_the_permalink() . '" title="'.the_title_attribute(array('echo'=>false)).'"></a>
	                </div>
	                <div class="ztl-post-details">
	                    <div class="ztl-service-info ztl-font-bold">
		                    ' . $autoresq_service_cost_content . '
		                    ' . $autoresq_service_duration_content . '
	                    </div>
	                    <div class="ztl-service-title ztl-accent-font">
	                        <h3><a href="' . get_the_permalink() . '" title="'.the_title_attribute(array('echo'=>false)).'">' . get_the_title() . '</a></h3>
	                    </div>
	                    <div class="ztl-service-description">
	                        ' . $autoresq_service_excerpt . '
	                    </div>
						<div class="clear40"></div>
						<div class="ztl-button-one">
	               			<a href="' . get_the_permalink() . '" title="'.the_title_attribute(array('echo'=>false)).'">' . esc_html__( 'More Details', 'zoutula' ) . '</a>
	           			</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>';
endwhile;
$str .= '</div>';