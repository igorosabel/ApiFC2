<?php if (is_null($values['diamond'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['diamond']->get('id') ?>,
	"lat": <?php echo $values['diamond']->get('lat') ?>,
	"lon": <?php echo $values['diamond']->get('lon') ?>,
	"picked": <?php echo $values['diamond']->get('picked') ? 'true' : 'false' ?>
}
<?php endif ?>
