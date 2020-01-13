<?php
/**
 *
 * The template for displaying tender-details pages.
 * @since 1.0.0
 * @version 1.4.0
 *
 */
get_header();
get_template_part( 'templates/page-header' );

global $cs_has_section, $post;

$cs_post_meta    = get_post_meta( $post->ID, '_custom_page_options', true );
$cs_page_layout  = ( isset ( $cs_post_meta['sidebar'] ) ) ? $cs_post_meta['sidebar'] : 'full';
$cs_page_column  = ( $cs_page_layout == 'full' ) ? '12' : '9';
$vc_exclude      = cs_get_option( 'vc_exclude_shortcodes' );
$vc_exclude      = ( is_array( $vc_exclude ) ) ? $vc_exclude : array();
$cs_page_padding = ( ! in_array( 'vc_row', $vc_exclude ) ) ? 'md-padding ' : '';
$cs_has_section  = isset( $cs_post_meta['section'] ) ? true : false;

if( ( $cs_page_layout == 'fluid' || isset( $cs_post_meta['section'] ) ) && ! in_array( 'vc_row', $vc_exclude ) ) {

  get_template_part('templates/page', 'section');
  do_action( 'cs_page_end', true );

} else {
?>
<section class="main-content <?php echo $cs_page_padding; ?>page-layout-<?php echo $cs_page_layout; ?>">
  <div class="container">
    <div class="row">

      <?php cs_page_sidebar( 'left', $cs_page_layout ); ?>

      <div class="col-md-<?php echo $cs_page_column; ?>">
        <div class="page-content">
          <?php
            $post_id = $_GET['t_id'];

            if (qtranxf_getLanguage() == 'HI') {
	            $tender_department_name_p    = get_post_meta($post_id, 'wpcf-punjabi-tender-department-name', true );
	            if (!empty($tender_department_name_p)) {
	            	$tender_department_name = $tender_department_name_p;
	            }else{
	            	$tender_department_name    = get_post_meta($post_id, 'wpcf-tender-department-name', true );
	            }

	            $tender_number_p             = get_post_meta($post_id, 'wpcf-punjabi-tender-number', true );
	            if (!empty($tender_number_p)) {
	            	$tender_number = $tender_number_p;
	            }else{
	            	 $tender_number             = get_post_meta($post_id, 'wpcf-tender-number', true );
	            }

	            $tender_work_description_p   = get_post_meta($post_id, 'wpcf-punjabi-description-of-work', true );
	             if (!empty($tender_work_description_p)) {
	            	$tender_work_description = $tender_work_description_p;
	            }else{
	            	  $tender_work_description   = get_post_meta($post_id, 'wpcf-description-of-work', true );
	            }

	            
	           $tender_sales_start_date   = get_post_meta($post_id, 'wpcf-sales-start-date', true);
	            $tender_sales_start_time   = get_post_meta($post_id, 'wpcf-sales-start-time', true );
	            $tender_sales_closes_date  = get_post_meta($post_id, 'wpcf-sales-closes-date', true );
	            $tender_sales_closes_time  = get_post_meta($post_id, 'wpcf-sales-closes-time', true );
	            $tender_opening_date       = get_post_meta($post_id, 'wpcf-tender-opening-date', true );
	            $tender_close_date       = get_post_meta($post_id, 'wpcf-tender-closing-date', true );
	            $tender_upload_document       = get_post_meta($post_id, 'wpcf-upload-project', true );
	           

	            $tender_estimated_cost_p     = get_post_meta($post_id, 'wpcf-punjabi-estimated-cost', true );
	            if (!empty($tender_estimated_cost_p)) {
	            	$tender_estimated_cost = $tender_estimated_cost_p;
	            }else{
	            	 $tender_estimated_cost     = get_post_meta($post_id, 'wpcf-estimated-cost', true );
	            }

	            $tender_forms_available_at_p = get_post_meta($post_id, 'wpcf-punjabi-forms-available-at', true );
	            if (!empty($tender_forms_available_at_p)) {
	            	$tender_forms_available_at = $tender_forms_available_at_p;
	            }else{
	            	 $tender_forms_available_at = get_post_meta($post_id, 'wpcf-forms-available-at', true );
	            }

	            $tender_forms_submission_place_p = get_post_meta($post_id, 'wpcf-punjabi-form-submission-place', true );
	            if (!empty($tender_forms_submission_place_p)) {
	            	$tender_forms_submission_place = $tender_forms_submission_place_p;
	            }else{
	            	  $tender_forms_submission_place = get_post_meta($post_id, 'wpcf-form-submission-place', true );
	            }

	            $tender_type_p              = get_post_meta($post_id, 'wpcf-punjabi-tender-type', true );
	            if (!empty($tender_type_p)) {
	            	$tender_type = $tender_type_p;
	            }else{
	            	  $tender_type               = get_post_meta($post_id, 'wpcf-tender-type', true );
	            }

	            $tender_emd_p                = get_post_meta($post_id,'wpcf-punjabi-emd',true);
	            if (!empty($tender_emd_p)) {
	            	$tender_emd = $tender_emd_p;
	            }else{
	            	  $tender_emd                = get_post_meta($post_id,'wpcf-emd',true);
	            }

	        }
	        else{
	        	$tender_department_name_e    = get_post_meta($post_id, 'wpcf-tender-department-name', true );
	            if (!empty($tender_department_name_e)) {
	            	$tender_department_name = $tender_department_name_e;
	            }else{
	            	$tender_department_name    = get_post_meta($post_id, 'wpcf-punjabi-tender-department-name', true );
	            }

	            $tender_number_e             = get_post_meta($post_id, 'wpcf-tender-number', true );
	            if (!empty($tender_number_e)) {
	            	$tender_number = $tender_number_e;
	            }else{
	            	 $tender_number             = get_post_meta($post_id, 'wpcf-punjabi-tender-number', true );
	            }

	            $tender_work_description_e   = get_post_meta($post_id, 'wpcf-description-of-work', true );
	             if (!empty($tender_work_description_e)) {
	            	$tender_work_description = $tender_work_description_e;
	            }else{
	            	  $tender_work_description   = get_post_meta($post_id, 'wpcf-punjabi-description-of-work', true );
	            }


	            $tender_sales_start_date   = get_post_meta($post_id, 'wpcf-sales-start-date', true);
	            $tender_sales_start_time   = get_post_meta($post_id, 'wpcf-sales-start-time', true );
	            $tender_sales_closes_date  = get_post_meta($post_id, 'wpcf-sales-closes-date', true );
	            $tender_sales_closes_time  = get_post_meta($post_id, 'wpcf-sales-closes-time', true );
	            $tender_opening_date       = get_post_meta($post_id, 'wpcf-tender-opening-date', true );
	            $tender_close_date       = get_post_meta($post_id, 'wpcf-tender-closing-date', true );
	            $tender_upload_document       = get_post_meta($post_id, 'wpcf-upload-project', true );

	            

	            $tender_estimated_cost_e     = get_post_meta($post_id, 'wpcf-estimated-cost', true );
	            if (!empty($tender_estimated_cost_e)) {
	            	$tender_estimated_cost = $tender_estimated_cost_e;
	            }else{
	            	 $tender_estimated_cost = get_post_meta($post_id, 'wpcf-punjabi-estimated-cost', true );
	            }

	            $tender_forms_available_at_e = get_post_meta($post_id, 'wpcf-forms-available-at', true );
	            if (!empty($tender_forms_available_at_e)) {
	            	$tender_forms_available_at = $tender_forms_available_at_e;
	            }else{
	            	 $tender_forms_available_at = get_post_meta($post_id, 'wpcf-punjabi-forms-available-at', true );
	            }

	            $tender_forms_submission_place_e = get_post_meta($post_id, 'wpcf-form-submission-place', true );
	            if (!empty($tender_forms_submission_place_e)) {
	            	$tender_forms_submission_place = $tender_forms_submission_place_e;
	            }else{
	            	  $tender_forms_submission_place = get_post_meta($post_id, 'wpcf-punjabi-form-submission-place', true );
	            }


	            $tender_type_e               = get_post_meta($post_id, 'wpcf-tender-type', true );
	            if (!empty($tender_type_e)) {
	            	$tender_type = $tender_type_e;
	            }else{
	            	  $tender_type               = get_post_meta($post_id, 'wpcf-punjabi-tender-type', true );
	            }



	            $tender_emd_e                = get_post_meta($post_id,'wpcf-emd',true);
	             if (!empty($tender_emd_e)) {
	            	$tender_emd = $tender_emd_e;
	            }else{
	            	  $tender_emd                = get_post_meta($post_id,'wpcf-punjabi-emd',true);
	            }

	        }

          ?>
          <div class="col-md-8">
	        <div class="single-tender-details">
	        	<h2 class="tender-details-heading">Tender Details</h2>
	        	<table class="table table-hover">
				    <tbody>
				      <tr>
				        <th>Tender Department</th>
				        <td><?= $tender_department_name ?></td>
				      </tr>

				      <tr>
				        <th>Tender Number</th>
				        <td><?= $tender_number ?></td>
				      </tr>

				      <tr>
				        <th>Tender Description</th>
				        <td><?= $tender_work_description ?></td>
				      </tr>

				      <tr>
				        <th>Tender sales start date</th>
				        <td><?= date('d M Y',$tender_sales_start_date) ?></td>
				      </tr>

				      <tr>
				        <th>Tender sales start time</th>
				        <td><?= $tender_sales_start_time ?></td>
				      </tr>

				      <tr>
				        <th>Tender sales closes date</th>
				        <td><?= date('d M Y',$tender_sales_closes_date) ?></td>
				      </tr>

				      <tr>
				        <th>Tender sales closes time</th>
				        <td><?= $tender_sales_closes_time ?></td>
				      </tr>

				      <tr>
				        <th>Tender opening date</th>
				        <td><?= date('d M Y',$tender_opening_date)?></td>
				      </tr>

				      <tr>
				        <th>Tender Emd</th>
				        <td><?= $tender_emd ?></td>
				      </tr>

				      <tr>
				        <th>Tender closing date</th>
				        <td><?= date('d M Y',$tender_close_date)?></td>
				      </tr>

				      <tr>
				        <th>Tender estimated cost</th>
				        <td><?= $tender_estimated_cost ?></td>
				      </tr>

				      <tr>
				        <th>Tender forms available at </th>
				        <td><?= $tender_forms_available_at ?></td>
				      </tr>

				      <tr>
				        <th>Tender forms submission place</th>
				        <td><?= $tender_forms_submission_place ?></td>
				      </tr>

				      <?php if(!empty($tender_upload_document)): ?>
					      <tr>
					        <th>Tender File Download</th>
					        <td><a href="<?= $tender_upload_document ?>" class="btn btn-primary tender-download" target="_blank">Download</a></td>
					      </tr>
				      <?php endif; ?>
				    </tbody>
				</table>
	        </div>
	    </div>
        </div>
      </div>

      <?php cs_page_sidebar( 'right', $cs_page_layout ); ?>

    </div>
  </div>
</section>
<?php
}
get_footer();