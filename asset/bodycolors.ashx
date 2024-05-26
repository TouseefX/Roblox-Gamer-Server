<?php
$head = $_GET['headc'];
$larm = $_GET['larmc'];
$lleg = $_GET['llegc'];
$rarm = $_GET['rarmc'];
$rleg = $_GET['rlegc'];
$torso = $_GET['torsoc'];

?>
<?xml version="1.0" encoding="utf-8" ?>
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="BodyColors">
		<Properties>
			<int name="HeadColor"><?php echo $head ?></int>
			<int name="LeftArmColor"><?php echo $larm ?></int>
			<int name="LeftLegColor"><?php echo $lleg ?></int>
			<string name="Name">Body Colors</string>
			<int name="RightArmColor"><?php echo $rarm ?></int>
			<int name="RightLegColor"><?php echo $rleg ?></int>
			<int name="TorsoColor"><?php echo $torso ?></int>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>