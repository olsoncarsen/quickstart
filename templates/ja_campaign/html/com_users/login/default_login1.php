<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
$app = JFactory::getApplication();

?>
<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
  <div class="login-description"><div class="alert alert-info lead mb-3 mb-md-5">
<?php endif; ?>

<?php if ($this->params->get('logindescription_show') == 1) : ?>
  <?php echo $this->params->get('login_description'); ?>
<?php endif; ?>

<?php if ($this->params->get('login_image') != '') : ?>
  <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>" />
<?php endif; ?>

<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
  </div></div>
<?php endif; ?>

<div class="row">
	<div class="col-12 col-md-6">
		<div class="login-form mb-4 mb-lg-0">
			<div class="login<?php echo $this->pageclass_sfx; ?>">
				<?php if ($this->params->get('show_page_heading')) : ?>
					<div class="page-header">
						<h2><?php echo $this->escape($this->params->get('page_heading')); ?></h2>
					</div>
				<?php endif; ?>

				<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well">
					<fieldset>
						<?php echo $this->form->renderFieldset('credentials'); ?>
						<?php if ($this->tfa) : ?>
							<?php echo $this->form->renderField('secretkey'); ?>
						<?php endif; ?>
						<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
							<div class="control-group remember-me">
								<input id="remember" type="checkbox" name="remember" class="inputbox" value="yes" />
								<label for="remember"><?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME'); ?></label>
							</div>
						<?php endif; ?>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary btn-login"><?php echo JText::_('JLOGIN'); ?></button>
							</div>
						</div>
						<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
						<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
						<?php echo JHtml::_('form.token'); ?>
					</fieldset>
				</form>
			</div>
			<div class="other-links">
				<ul class="nav nav-tabs nav-stacked clearfix">
					<li class="float-none float-lg-left">
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?>
						</a>
					</li>
					<li class="float-none float-lg-right">
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php 
	$xml = JPATH_SITE .  "/components/com_users/models/forms/registration.xml";
	$regXml = JForm::getInstance('default',$xml);
?>
	<div class="col-12 col-md-6">
		<div class="signup-form">
			<h2><?php echo JText::_("TPL_JA_CAMPAIGN_FIELD_RESET_REGISTER_HEADING");?></h2>
			<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
		        <div class="row">
					<?php // Iterate through the form fieldsets and display each one. ?>
					<?php foreach ($regXml->getFieldsets() as $fieldset) : ?>
						<?php $fields = $regXml->getFieldset($fieldset->name); ?>
						<?php if (count($fields)) : ?>
								<?php echo $regXml->renderFieldset($fieldset->name); ?>
						<?php endif; ?>
					<?php endforeach; ?>
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn btn-primary validate"><?php echo JText::_('JREGISTER'); ?></button>
							<input type="hidden" name="option" value="com_users" />
							<input type="hidden" name="task" value="registration.register" />
						</div>
					</div>
				</div>
				<?php echo JHtml::_('form.token'); ?>
			</form>
		</div>		

	</div>
</div> 

<script>
	jQuery(document).ready(function($){
		$('#email').on('change',function(){
			$('.email_confirm').val($(this).val());
		});
	});
</script>
