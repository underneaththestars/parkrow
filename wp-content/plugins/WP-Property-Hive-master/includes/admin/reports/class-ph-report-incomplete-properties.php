<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * PH_Report_Incomplete_Properties
 *
 * @author      PropertyHive
 * @category    Admin
 * @package     PropertyHive/Admin/Reports
 * @version     1.0.0
 */
class PH_Report_Incomplete_Properties extends PH_Admin_Report {

	/**
	 * Output the report.
	 */
	public function output_report() {
?>

<style type="text/css">

.chart-with-sidebar { padding:12px 12px 12px 249px; background:#FFF; border:1px solid #DDD; min-height:300px; }
.chart-sidebar { width:225px; margin-left:-237px; float:left; }
.chart-main {  }

</style>

<br>

<div class="chart-with-sidebar">

	<div class="chart-sidebar">

		<form method="post" action="">

			<label for="missing">Show Properties Missing:</label>
			<select name="missing" id="missing" style="width:100%;">
				<option value="">One or more items</option>
				<option value="_photos"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_photos' ) { echo ' selected'; } ?>>Photos</option>
				<option value="_floorplans"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_floorplans' ) { echo ' selected'; } ?>>Floorplans</option>
				<option value="_epcs"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_epcs' ) { echo ' selected'; } ?>>EPCS</option>
				<option value="_brochures"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_brochures' ) { echo ' selected'; } ?>>Brochures</option>
				<option value="_virtual_tours"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_virtual_tours' ) { echo ' selected'; } ?>>Virtual Tours</option>
				<option value="summary"<?php if ( isset($_POST['missing']) && $_POST['missing'] == 'summary' ) { echo ' selected'; } ?>>Summary Description</option>
				<option value="_latitude"<?php if ( isset($_POST['missing']) && $_POST['missing'] == '_latitude' ) { echo ' selected'; } ?>>Map Co-ordinates</option>
			</select>

			<br><br>

			<label for="department">Department:</label>
			<select name="department" id="department" style="width:100%;">
				<option value="">All</option>
				<?php if ( get_option('propertyhive_active_departments_sales', '') == 'yes' ) { ?>
				<option value="residential-sales"<?php if ( isset($_POST['department']) && $_POST['department'] == 'residential-sales' ) { echo ' selected'; } ?>>Residential Sales</option>
				<?php } ?>
				<?php if ( get_option('propertyhive_active_departments_lettings', '') == 'yes' ) { ?>
				<option value="residential-lettings"<?php if ( isset($_POST['department']) && $_POST['department'] == 'residential-lettings' ) { echo ' selected'; } ?>>Residential Lettings</option>
				<?php } ?>
				<?php if ( get_option('propertyhive_active_departments_commercial', '') == 'yes' ) { ?>
				<option value="commercial"<?php if ( isset($_POST['department']) && $_POST['department'] == 'commercial' ) { echo ' selected'; } ?>>Commercial</option>
				<?php } ?>
			</select>

			<br><br>

			<label for="on_market">Market Status:</label>
			<select name="on_market" id="on_market" style="width:100%;">
				<option value=""<?php if ( isset($_POST['on_market']) && $_POST['on_market'] == '' ) { echo ' selected'; } ?>>On Market Properties Only</option>
				<option value="all"<?php if ( isset($_POST['on_market']) && $_POST['on_market'] == 'all' ) { echo ' selected'; } ?>>All Properties</option>
			</select>

			<br><br>
			<input type="submit" value="Update" class="button button-primary">

		</form>

	</div>

	<div class="chart-main">
		
		<?php
			$args = array(
				'post_type' => 'property',
				'nopaging' => true,
				'fields' => 'ids',
			);

			$meta_query = array('relation' => 'AND');

			if ( isset($_POST['on_market']) && $_POST['on_market'] == 'all' )
			{

			}
			else
			{
				$meta_query[] = array(
					'key' => '_on_market',
					'value' => 'yes',
				);
			}

			if ( isset($_POST['department']) && $_POST['department'] != '' )
			{
				$meta_query[] = array(
					'key' => '_department',
					'value' => $_POST['department'],
				);
			}

			$args['meta_query'] = $meta_query;

			$property_query = new WP_Query( $args );

			if ( $property_query->have_posts() )
			{
				echo '<table>
				<tr>
				<th style="text-align:left;">Property Address</th>
				<th style="text-align:left;">Missing</th>
				</tr>';
				while ( $property_query->have_posts() )
				{
					$property_query->the_post();

					$property = new PH_Property( get_the_ID() );

					$missing = array();

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_photos') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$photos = $property->get_gallery_attachment_ids();
						if ( $photos === false || ( is_array($photos) && empty($photos) ) )
						{
							$missing[] = 'Photos';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_floorplans') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$floorplans = $property->get_floorplan_attachment_ids();
						if ( $floorplans === false || ( is_array($floorplans) && empty($floorplans) ) )
						{
							$missing[] = 'Floorplans';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_epcs') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$epcs = $property->get_epc_attachment_ids();
						if ( $epcs === false || ( is_array($epcs) && empty($epcs) ) )
						{
							$missing[] = 'EPCs';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_brochures') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$brochures = $property->get_epc_attachment_ids();
						if ( $brochures === false || ( is_array($brochures) && empty($brochures) ) )
						{
							$missing[] = 'Brochures';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_virtual_tours') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$virtual_tours = $property->get_virtual_tour_urls();
						if ( $virtual_tours === false || ( is_array($virtual_tours) && empty($virtual_tours) ) )
						{
							$missing[] = 'Virtual Tours';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == 'summary') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$summary = $property->post_excerpt;
						if ( $summary === false || $summary == '' )
						{
							$missing[] = 'Summary';
						}
					}

					if ( 
						(isset($_POST['missing']) && $_POST['missing'] == '_latitude') ||  
						(isset($_POST['missing']) && $_POST['missing'] == '') ||
						!isset($_POST['missing'])
					)
					{
						$latitude = $property->latitude;
						if ( $latitude === false || $latitude == '' )
						{
							$missing[] = 'Map Co-ordinates';
						}
					}

					if ( !empty($missing) )
					{
						echo '<tr>';

						echo '<td><a href="' . get_edit_post_link( get_the_ID() ) . '">' . $property->get_formatted_full_address() . '</a></td>';
						
						echo '<td>' . implode(", ", $missing) . '</td>';

						echo '</tr>';
					}
				}
				echo '</table>';
			}
			wp_reset_postdata();
		?>

	</div>

</div>

<?php
	}

}