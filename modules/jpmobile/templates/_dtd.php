<?php echo '<?xml version="1.0" encoding="Shift_JIS"?>' ?>
<?php if (sfJpMobile::isDocomo()): ?>
<!DOCTYPE html PUBLIC "-//i-mode group (ja)//DTD XHTML i-XHTML(Locale/Ver.=ja/1.1) 1.0//EN" "i-xhtml_4ja_10.dtd">
<?php elseif (sfJpMobile::isKddi()): ?>
<!DOCTYPE html PUBLIC "-//OPENWAVE//DTD XHTML 1.0//EN" "http://www.openwave.com/DTD/xhtml-basic.dtd">
<?php elseif (sfJpMobile::isSoftbank()): ?>
<!DOCTYPE html PUBLIC "-//JPHONE//DTD XHTML Basic 1.0 Plus//EN" "xhtml-basic10-plus.dtd">
<?php else: ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php endif; ?>

<?php /* $Id$ */ ?>
<?php /* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */ ?>