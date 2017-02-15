<?php
/* SVN FILE: $Id: default.thtml 4409 2007-02-02 13:20:59Z phpnut $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.pages
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 4409 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title>Ab Poker Tour : <?php echo $title_for_layout;?></title>
<link rel="icon" href="<?php echo $this->webroot . 'favicon.ico';?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $this->webroot . 'favicon.ico';?>" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="RSS" href="/poker/index.php/parties/rss" />
<?php echo $html->css('cake.generic');?>
</head>
<body>
	<div class="container">
		<div class="header">
			<div class="title">
				<h1>Ab Poker Tour</h1>
			</div>
		</div>
		<div class="navigation">
			<?php echo $html->link('Classement Officiel', '/joueurs/index'); ?>
			<?php echo $html->link('Classement complet', '/joueurs/index/2'); ?>
			<?php echo $html->link('Toutes les parties', '/parties/'); ?>
			<?php echo $this->Html->link('Derni&egrave;re partie', '/parties/last', array('escape' => false)); ?>
			<?php echo $html->link('RSS', '/parties/rss'); ?>			
			<div class="clearer"><span></span></div>

		</div>
		<div class="main">
			<div class="content">
				<?php if ($session->check('Message.flash'))
					{
						$session->flash();
					}
					echo $content_for_layout;
				?>
			</div>
			<div class="clearer"><span></span></div>
		</div>
		<div class="footer">
			Template by <a href="http://templates.arcsin.se">Arcsin</a>
			- Powered by <a href="http://www.cakephp.org/" target="_new">
				<?php echo $html->image('cake.power.png', array('alt'=>"CakePHP(tm) : Rapid Development Framework", 'border'=>"0"));?>
			</a>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
