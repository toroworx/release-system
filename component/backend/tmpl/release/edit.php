<?php
/**
 * @package   AkeebaReleaseSystem
 * @copyright Copyright (c)2010-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \Akeeba\Component\ARS\Administrator\View\Release\HtmlView $this */

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');

$user = Factory::getApplication()->getIdentity();
?>

<form action="<?php echo Route::_('index.php?option=com_ars&view=Release&layout=edit&id=' . (int) $this->item->id); ?>"
	  aria-label="<?php echo Text::_('COM_ARS_TITLE_RELEASES_' . ((int) $this->item->id === 0 ? 'ADD' : 'EDIT'), true); ?>"
	  class="form-validate" id="profile-form" method="post" name="adminForm">

	<div class="row">
		<div class="col-lg">
			<div class="card card-block mb-2">
				<div class="card-body">
					<?= $this->form->getField('category_id')->renderField(); ?>
					<?= $this->form->getField('version')->renderField(); ?>
					<?= $this->form->getField('alias')->renderField(); ?>
					<?= $this->form->getField('maturity')->renderField(); ?>
					<?= $this->form->getField('published')->renderField(); ?>
					<?= $this->form->getField('access')->renderField(); ?>
					<?= $this->form->getField('show_unauth_links')->renderField(); ?>
					<?= $this->form->getField('redirect_unauth')->renderField(); ?>
					<?= $this->form->getField('created')->renderField(); ?>
					<?= $this->form->getField('created_by')->renderField(); ?>
					<?= $this->form->getField('language')->renderField(); ?>
					<?= $this->form->getField('hits')->renderField(); ?>
				</div>
			</div>
		</div>
		<div class="col-lg">
			<div class="card card-block mb-2">
				<div class="card-body">
					<h4>
						<?= Text::_('COM_ARS_RELEASE_NOTES_LABEL') ?>
					</h4>
					<?= $this->form->getField('notes')->renderField([
						'hiddenLabel' => true,
					]); ?>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" name="task" value="">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
