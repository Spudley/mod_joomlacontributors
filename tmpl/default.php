<?php
/**
 * @package     mod_joomlacontributors
 *
 * @copyright   Copyright (C) 2016 Simon Champion
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$avatarSize = $processor->getAvatarSize();
$avatarSizeStyle = "height:{$avatarSize}px; width:{$avatarSize}px; margin-bottom:0.5em;";

?>
<div class="joomlaContributors">
    <?php foreach($processor->getContributors() as $contributor) { ?>
        <div class="joomlaContributor icon-wrapper" style="<?php echo $avatarSizeStyle; ?>">
            <div class="icon"><a href="<?php echo $contributor['html_url']; ?>"><img src="<?php echo $contributor['avatar_url']; ?>" title="<?php echo $contributor['login'].": ".$contributor['contributions']." contributions." ?>"></a></div>
        </div>
    <?php } ?>
    <p><?php echo htmlspecialchars(JText::_('MOD_JOOMLACONTRIBUTORS_THANKS'));?> <a href="https://www.joomla.org/contribute-to-joomla.html"><?php echo htmlspecialchars(JText::_('MOD_JOOMLACONTRIBUTORS_CONTRIBUTE'));?></a></p>
</div>