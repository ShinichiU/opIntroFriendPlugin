<?php
$html = '<form style="width: 48%; float: left; text-align: right" action="" method="post"><input type="hidden" name="delete" value="1" /><input type="submit" value="' . __('Yes') . '" /></form>'
      . '<form style="width: 48%; float: right; text-align: left" action="" method="post"><input type="submit" value="' . __('No') . '" /></form>'
      . '<div style="clear: left"></div>';
include_box( 'infobox', __('you really delete it?'));

