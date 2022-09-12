<?php
use OsumiFramework\App\Component\Model\DiamondListComponent;
if (is_null($values['grid'])) {
?>
null
<?php
}
else{
?>
{
	"id": <?php echo $values['grid']->get('id') ?>,
	"map": "<?php echo urlencode($values['grid']->get('map')) ?>",
	"gridCol": <?php echo $values['grid']->get('grid_col') ?>,
	"gridRow": <?php echo $values['grid']->get('grid_row') ?>,
	"num": <?php echo $values['grid']->get('num') ?>,
	"picked": <?php echo $values['grid']->get('picked') ?>,
	"completed": <?php echo $values['grid']->get('completed') ? 'true' : 'false' ?>,
	"diamonds": [
<?php
	$component = new DiamondListComponent([ 'list' => $values['grid']->getDiamonds() ]);
	echo strval($component);
?>
	]
}
<?php
}
?>
