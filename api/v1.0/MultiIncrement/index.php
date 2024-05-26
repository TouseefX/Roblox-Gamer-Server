<?php
/* This will give an error. Note the output
 * above, which is before the header() call */
header('roblox-machine-id: CHI1-WEB2214
expires: -1
server: Microsoft-IIS/8.5
p3p: CP="CAO DSP COR CURa ADMa DEVa OUR IND PHY ONL UNI COM NAV INT DEM PRE"');
exit;
?>