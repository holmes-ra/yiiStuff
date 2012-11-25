<?php
if (!$data->isActive) {
	echo "<a href='#' rel='tooltip' title='Inactive - please refresh key'><i class='icon-warning-sign'></i></a>"; }
else { 
	if ($data->info->accessMask != $data->activeAPIMask) {
		echo "<a href='#' rel='tooltip' title='Access mismatch - please refresh key'><i class='icon-warning-sign'></i></a>"; }
	else {
		echo "<a href='#' rel='tooltip' title='OK'><i class='icon-ok'></i></a>"; }
}
?>	