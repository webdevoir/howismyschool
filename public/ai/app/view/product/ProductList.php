<div class="mortarlist">
	<div class="listheader">
		<?php display_search_box($search2); ?>
		<?php if($add_allowed){?>
		<div class="addnewrecord">
		<?php
		echo link_create(t('Add New Product'),
		array('href'=>'product/ProductAdd&rurl='.$_SERVER['QUERY_STRING'],
 		'class'=>'btn btn-success addCell','target' => '_blank'));
		?>
		</div>
		<?php }?>
		<div class="clr"></div>
	</div>
	<?php //Show Grid Here; ?>
	<?php echo $table_html; ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
 $('#searchbtn').click(function(){
 	searchProduct();
 });
 $("#searchbox").keyup(function(event){
       if(event.keyCode == 13){
          // searchProduct();
       }
 });
 addFancyBoxEdit("addCell",1,"<?php echo ADD_FANCY_BOX_WIDTH; ?>",
                 "<?php echo ADD_FANCY_BOX_HEIGHT; ?>");
});
function searchProduct(){
	includeSearchParam = true;
	<?php echo $table_id;?>.fnReloadAjax("<?php echo $record_url?>");
	includeSearchParam = false;
}
function deleteConfirm(id,element){
	deletableRowElement = element;
	deleteRecord(id,'<?php echo $table_id;?>',
	'<?php echo $delete_url?>','<?php echo DELETE_WARNING_MSG; ?>');
}
</script>