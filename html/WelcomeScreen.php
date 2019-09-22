<?php
	$Currency_Symbol = get_option("UPCP_Currency_Symbol");
	$Color = get_option("UPCP_Color_Scheme");
	$Links = get_option("UPCP_Product_Links");
	$Product_Search = get_option("UPCP_Product_Search");
?>
<div class='upcp-welcome-screen'>
	<?php  if (!isset($_GET['exclude'])) { ?>
	<div class='upcp-welcome-screen-header'>
		<h1><?php _e('Welcome to the Ultimate Product Catalog Plugin', 'UPC_MC'); ?></h1>
		<p><?php _e('Thanks for choosing the Ultimate Product Catalog! The following will help you get started with the setup of your catalog by creating your first product, category and catalog, as well as adding your catalog to a page and configuring a few key options.', 'UPC_MC'); ?></p>
	</div>
	<?php } ?>

	<div class='upcp-welcome-screen-box upcp-welcome-screen-categories upcp-welcome-screen-open' data-screen='categories'>
		<h2><?php _e('1. Create Categories', 'UPC_MC'); ?></h2>
		<div class='upcp-welcome-screen-box-content'>
			<p><?php _e('Categories let you organize your products in a way that is easy for you - and your customers - to find.', 'UPC_MC'); ?></p>
			<div class='upcp-welcome-screen-created-categories'>
				<div class='upcp-welcome-screen-add-category-name upcp-welcome-screen-box-content-divs'><label><?php _e('Category Name:', 'UPC_MC'); ?></label><input type='text' /></div>
				<div class='upcp-welcome-screen-add-category-description upcp-welcome-screen-box-content-divs'><label><?php _e('Category Description:', 'UPC_MC'); ?></label><textarea></textarea></div>
				<div class='upcp-welcome-screen-add-category-button'><?php _e('Add Category', 'UPC_MC'); ?></div>
				<div class="upcp-welcome-clear"></div>
				<div class="upcp-welcome-screen-show-created-categories">
					<h3><?php _e('Created Categories:', 'UPC_MC'); ?></h3>
					<div class="upcp-welcome-screen-show-created-categories-name"><?php _e('Name', 'UPC_MC'); ?></div>
					<div class="upcp-welcome-screen-show-created-categories-description"><?php _e('Description', 'UPC_MC'); ?></div>
				</div>
			</div>
			<div class='upcp-welcome-screen-next-button upcp-welcome-screen-next-button-not-top-margin' data-nextaction='catalogue'><?php _e('Next Step', 'UPC_MC'); ?></div>
			<div class='clear'></div>
		</div>
	</div>
	
<?php  if (!isset($_GET['exclude'])) { ?>
	<div class='upcp-welcome-screen-box upcp-welcome-screen-catalogue' data-screen='catalogue'>
		<h2><?php _e('2. Create a Catalog', 'UPC_MC'); ?></h2>
		<div class='upcp-welcome-screen-box-content'>
			<p><?php _e('You can make multiple catalogs, but one catalog with all of your categories is a great place to start.', 'UPC_MC'); ?></p>
			<div class='upcp-welcome-screen-catalogue'>
				<div class='upcp-welcome-screen-add-catalogue-name upcp-welcome-screen-box-content-divs'><label><?php _e('Catalog Name:', 'UPC_MC'); ?></label><input type='text' /></div>
				<div class='upcp-welcome-screen-add-catalogue-categories'><h3><?php _e('Include Categories:', 'UPC_MC'); ?></h3><br /></div>
				<div class='upcp-welcome-screen-add-catalogue-button'><?php _e('Create Catalog', 'UPC_MC'); ?></div>
			</div>
			<div class="upcp-welcome-clear"></div>
			<div class='upcp-welcome-screen-next-button' data-nextaction='shop'><?php _e('Next Step', 'UPC_MC'); ?></div>
			<div class='upcp-welcome-screen-previous-button' data-previousaction='categories'><?php _e('Previous Step', 'UPC_MC'); ?></div>
			<div class='clear'></div>
		</div>
	</div>

	<div class='upcp-welcome-screen-box upcp-welcome-screen-shop' data-screen='shop'>
		<h2><?php _e('3. Add a Shop Page', 'UPC_MC'); ?></h2>
		<div class='upcp-welcome-screen-box-content'>
			<p><?php _e('You can create a dedicated shop page below, or skip this step and add your catalog to a page you\'ve already created manually.', 'UPC_MC'); ?></p>
			<div class='upcp-welcome-screen-shop'>
				<div class='upcp-welcome-screen-add-shop-name upcp-welcome-screen-box-content-divs'><label><?php _e('Page Title:', 'UPC_MC'); ?></label><input type='text' value='Shop' /></div>
				<div class='upcp-welcome-screen-add-shop-button'><?php _e('Create Page', 'UPC_MC'); ?></div>
			</div>
			<div class="upcp-welcome-clear"></div>
			<div class='upcp-welcome-screen-next-button' data-nextaction='options'><?php _e('Next Step', 'UPC_MC'); ?></div>
			<div class='upcp-welcome-screen-previous-button' data-previousaction='catalogue'><?php _e('Previous Step', 'UPC_MC'); ?></div>
			<div class='clear'></div>
		</div>
	</div>

	<div class='upcp-welcome-screen-box upcp-welcome-screen-options' data-screen='options'>
		<h2><?php _e('4. Set Key Options', 'UPC_MC'); ?></h2>
		<div class='upcp-welcome-screen-box-content'>
			<p><?php _e('Options can always be changed later, but here are a few that a lot of users want to set for themselves.', 'UPC_MC'); ?></p>
			<table class="form-table">
				<tr>
					<th><?php _e('Currency Symbol', 'UPC_MC'); ?></th>
					<td>
						<div class='upcp-welcome-screen-option'>
							<fieldset>
								<legend class="screen-reader-text"><span><?php _e("Currency Symbol", 'UPC_MC')?></span></legend>
								<label><input type='text' name='currency_symbol' value='<?php echo $Currency_Symbol; ?>'/></label>
								<p><?php _e("What currency symbol, if any, should be displayed before or after the price? Leave blank for none.", 'UPC_MC')?></p>
							</fieldset>
						</div>
					</td>
				</tr>
				<tr>
					<th><?php _e('Catalog Color', 'UPC_MC'); ?></th>
					<td>
						<div class='upcp-welcome-screen-option'>
							<fieldset><legend class="screen-reader-text"><span><?php _e("Catalog Color", 'UPC_MC')?></span></legend>
								<label title='Blue' class='ewd-upcp-admin-input-container'><input type='radio' name='color_scheme' value='Blue' <?php if($Color == "Blue") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Blue", 'UPC_MC')?></span></label><br />		
								<label title='Black' class='ewd-upcp-admin-input-container'><input type='radio' name='color_scheme' value='Black' <?php if($Color == "Black") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Black", 'UPC_MC')?></span></label><br />			
								<label title='Grey' class='ewd-upcp-admin-input-container'><input type='radio' name='color_scheme' value='Grey' <?php if($Color == "Grey") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Grey", 'UPC_MC')?></span></label><br />
								<p><?php _e("Set the color of the image and border elements", 'UPC_MC')?></p>
							</fieldset>
						</div>
					</td>
				</tr>
				<tr>
					<th><?php _e('Product Links', 'UPC_MC'); ?></th>
					<td>
						<div class='upcp-welcome-screen-option'>
							<fieldset>
								<legend class="screen-reader-text"><span><?php _e("Product Links", 'UPC_MC')?></span></legend>
								<label title='Same' class='ewd-upcp-admin-input-container'><input type='radio' name='product_links' value='Same' <?php if($Links == "Same") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Open in Same Window", 'UPC_MC')?></span></label><br />
								<label title='New' class='ewd-upcp-admin-input-container'><input type='radio' name='product_links' value='New' <?php if($Links == "New") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Open in New Window", 'UPC_MC')?></span></label><br />
								<!--<label title='External'><input type='radio' name='product_links' value='External' <?php if($Links == "External") {echo "checked='checked'";} ?> /> <span><?php _e("Open External Links Only in New Window", 'UPC_MC')?></span></label><br />-->
								<p><?php _e("Should external product links open in a new window?", 'UPC_MC')?></p>
							</fieldset>
						</div>
					</td>
				</tr>
				<tr>
					<th><?php _e('Product Search', 'UPC_MC'); ?></th>
					<td>
						<div class='upcp-welcome-screen-option'>
							<fieldset>
								<legend class="screen-reader-text"><span><?php _e("Product Search", 'UPC_MC')?></span></legend>
								<label title='None' class='ewd-upcp-admin-input-container'><input type='radio' name='product_search' value='none' <?php if($Product_Search == "none") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("None", 'UPC_MC')?></span></label><br />
								<label title='Name' class='ewd-upcp-admin-input-container'><input type='radio' name='product_search' value='name' <?php if($Product_Search == "name") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Name Only", 'UPC_MC')?></span></label><br />
								<label title='Name-and-Desc' class='ewd-upcp-admin-input-container'><input type='radio' name='product_search' value='namedesc' <?php if($Product_Search == "namedesc") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Name and Description", 'UPC_MC')?></span></label><br />
								<label title='Name-Desc-and-Cust' class='ewd-upcp-admin-input-container'><input type='radio' name='product_search' value='namedesccust' <?php if($Product_Search == "namedesccust") {echo "checked='checked'";} ?> /><span class='ewd-upcp-admin-radio-button'></span> <span><?php _e("Name, Description and Custom Fields", 'UPC_MC')?></span></label><br />
								<p><?php _e("Set the 'Product Search' text box to search either product name, product name and description or product name, description and custom fields (slowest option)", 'UPC_MC')?></p>
							</fieldset>
						</div>
					</td>
				</tr>
			</table>

			<div class='upcp-welcome-screen-save-options-button'><?php _e('Save Options', 'UPC_MC'); ?></div>
			<div class="upcp-welcome-clear"></div>

			<div class='upcp-welcome-screen-next-button' data-nextaction='products'><?php _e('Next Step', 'UPC_MC'); ?></div>
			<div class='upcp-welcome-screen-previous-button' data-previousaction='shop'><?php _e('Previous Step', 'UPC_MC'); ?></div>
			<div class='clear'></div>
		</div>
	</div>
<?php } ?>
	<div class='upcp-welcome-screen-box upcp-welcome-screen-products' data-screen='products'>
		<h2><?php echo (isset($_GET['exclude']) ? '2.' : '5.') . __(' Add Products', 'UPC_MC'); ?></h2>
		<div class='upcp-welcome-screen-box-content'>
			<p><?php isset($_GET['exclude']) ? '' : printf(__('Want more options (product images, sub-categories,  etc)? You can create products using the <a href="%s">dedicated product builder</a> instead.', 'UPC_MC'), esc_url('admin.php?page=UPCP-options&Action=UPCP_Add_Product_Screen')); ?></p>
			<div class='upcp-welcome-screen-created-products'>
				<div class='upcp-welcome-screen-add-product-image upcp-welcome-screen-box-content-divs'>
					<label><?php _e('Product Image:', 'UPC_MC'); ?></label>
					<div class='upcp-welcome-screen-image-preview-container'>
						<div class='upcp-hidden upcp-welcome-screen-image-preview'>
							<img />
						</div>
						<input type='hidden' name='product_image_url' />
						<input id="Welcome_Item_Image_button" class="button" type="button" value="Upload Image" />
					</div>
				</div>
				<div class='upcp-welcome-screen-add-product-name upcp-welcome-screen-box-content-divs'><label><?php _e('Product Name:', 'UPC_MC'); ?></label><input type='text' /></div>
				<div class='upcp-welcome-screen-add-product-description upcp-welcome-screen-box-content-divs'><label><?php _e('Product Description:', 'UPC_MC'); ?></label><textarea></textarea></div>
				<div class='upcp-welcome-screen-add-product-category upcp-welcome-screen-box-content-divs'><label><?php _e('Product Category:', 'UPC_MC'); ?></label><select></select></div>
				<div class='upcp-welcome-screen-add-product-price upcp-welcome-screen-box-content-divs'><label><?php _e('Product Price:', 'UPC_MC'); ?></label><input type='text' /></div>
				<div class='upcp-welcome-screen-add-product-button'><?php _e('Add Product', 'UPC_MC'); ?></div>
				<div class="upcp-welcome-clear"></div>
				<div class="upcp-welcome-screen-show-created-products">
					<h3><?php _e('Created Products:', 'UPC_MC'); ?></h3>
					<div class="upcp-welcome-screen-show-created-products-image"><?php _e('Image', 'UPC_MC'); ?></div>
					<div class="upcp-welcome-screen-show-created-products-name"><?php _e('Name', 'UPC_MC'); ?></div>
					<div class="upcp-welcome-screen-show-created-products-description"><?php _e('Description', 'UPC_MC'); ?></div>
					<div class="upcp-welcome-screen-show-created-products-price"><?php _e('Price', 'UPC_MC'); ?></div>
				</div>
			</div>
			<div class="upcp-welcome-clear"></div>
			<div class='upcp-welcome-screen-previous-button' data-previousaction='options'><?php _e('Previous Step', 'UPC_MC'); ?></div>
			<div class='upcp-welcome-screen-finish-button' data-nextaction='shop'><a href='admin.php?page=UPCP-options'><?php _e('Finish', 'UPC_MC'); ?></a></div>
			<div class='clear'></div>
		</div>
	</div>

	<div class='upcp-welcome-screen-skip-container'>
		<a href='admin.php?page=UPCP-options'><div class='upcp-welcome-screen-skip-button'><?php _e('Skip Setup', 'UPC_MC'); ?></div></a>
	</div>
</div>