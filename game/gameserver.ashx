<?php
header("content-type: text/plain");
ob_start();
?>
local placeId, port, sleeptime, access, url, killID, deathID, timeout = ...

if port == nil then
	placeId, sleeptime, port, url, timeout, access = 1818, 0, <?php echo $_GET["port"];?>, "http://www.roblox.com", 0, "8169b38d-abbc-480f-8971-14d8fd560aad"
end

------------------- UTILITY FUNCTIONS --------------------------

local cdnSuccess = 0
local cdnFailure = 0

function reportCdn(blocking)
	pcall(function()
		local newCdnSuccess = settings().Diagnostics.CdnSuccessCount
		local newCdnFailure = settings().Diagnostics.CdnFailureCount
		local successDelta = newCdnSuccess - cdnSuccess
		local failureDelta = newCdnFailure - cdnFailure
		cdnSuccess = newCdnSuccess
		cdnFailure = newCdnFailure
		if successDelta > 0 or failureDelta > 0 then
			game:HttpGet("{17}/Game/Cdn.ashx?source=server&success=" .. successDelta .. "&failure=" .. failureDelta, blocking)
		end
	end)
end

function waitForChild(parent, childName)
	while true do
		local child = parent:findFirstChild(childName)
		if child then
			return child
		end
		parent.ChildAdded:wait()
	end
end

-- returns the player object that killed this humanoid
-- returns nil if the killer is no longer in the game
function getKillerOfHumanoidIfStillInGame(humanoid)

	-- check for kill tag on humanoid - may be more than one - todo: deal with this
	local tag = humanoid:findFirstChild("creator")

	-- find player with name on tag
	if tag then
		local killer = tag.Value
		if killer.Parent then -- killer still in game
			return killer
		end
	end

	return nil
end

-- This code might move to C++
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end

-- send kill and death stats when a player dies
function onDied(victim, humanoid)
	local killer = getKillerOfHumanoidIfStillInGame(humanoid)
	local victorId = 0
	if killer then
		victorId = killer.userId
		print("STAT: kill by " .. victorId .. " of " .. victim.userId)
		game:HttpGet(url .. "/Game/Knockouts.ashx?UserID=" .. victorId .. "&" .. access)
	end
	print("STAT: death of " .. victim.userId .. " by " .. victorId)
	game:HttpGet(url .. "/Game/Wipeouts.ashx?UserID=" .. victim.userId .. "&" .. access)
end

-----------------------------------END UTILITY FUNCTIONS -------------------------

-----------------------------------"CUSTOM" SHARED CODE----------------------------------



settings().Network.PhysicsSend = 1 -- 1==RoundRobin
settings().Network.ExperimentalPhysicsEnabled = true
settings().Network.WaitingForCharacterLogRate = 100
pcall(function() settings().Diagnostics:LegacyScriptMode() end)

-----------------------------------START GAME SHARED SCRIPT------------------------------

local assetId = placeId -- might be able to remove this now

local scriptContext = game:GetService('ScriptContext')
scriptContext.ScriptsDisabled = true

game:SetPlaceID(assetId, true)
game:GetService("ChangeHistoryService"):SetEnabled(false)

-- establish this peer as the Server
local ns = game:GetService("NetworkServer")

if url~=nil then
	pcall(function() game:GetService("Players"):SetAbuseReportUrl(url .. "/AbuseReport/InGameChatHandler.ashx") end)
	pcall(function() game:GetService("ScriptInformationProvider"):SetAssetUrl(url .. "/Asset/") end)
	pcall(function() game:GetService("ContentProvider"):SetBaseUrl(url .. "/") end)
	--pcall(function() game:GetService("Players"):SetChatFilterUrl(url .. "/Game/ChatFilter.ashx") end)

	game:GetService("BadgeService"):SetPlaceId(placeId)
	if access~=nil then
		game:GetService("BadgeService"):SetAwardBadgeUrl(url .. "/Game/Badge/AwardBadge.ashx?UserID=%d&BadgeID=%d&PlaceID=%d&" .. access)
		game:GetService("BadgeService"):SetHasBadgeUrl(url .. "/Game/Badge/HasBadge.ashx?UserID=%d&BadgeID=%d&" .. access)
		game:GetService("BadgeService"):SetIsBadgeDisabledUrl(url .. "/Game/Badge/IsBadgeDisabled.ashx?BadgeID=%d&PlaceID=%d&" .. access)
	end
	game:GetService("BadgeService"):SetIsBadgeLegalUrl("")
	game:GetService("InsertService"):SetBaseCategoryUrl(url .. "/Game/Tools/InsertAsset.ashx?nsets=10&type=base")
	game:GetService("InsertService"):SetUserCategoryUrl(url .. "/Game/Tools/InsertAsset.ashx?nsets=20&type=user&userid=%d")
	game:GetService("InsertService"):SetCollectionUrl(url .. "/Game/Tools/InsertAsset.ashx?sid=%d")
	game:GetService("InsertService"):SetAssetUrl(url .. "/Asset/?id=%d")
	game:GetService("InsertService"):SetAssetVersionUrl(url .. "/Asset/?assetversionid=%d")
	game:GetService("InsertService"):SetAdvancedResults(true)
	game:GetService("InsertService"):SetTrustLevel(0) -- i dont know what this does... it just works...
	
	pcall(function() loadfile(url .. "/Game/LoadPlaceInfo.ashx?PlaceId=" .. placeId)() end)
	
	pcall(function() 
				if access then
					loadfile(url .. "/Game/PlaceSpecificScript.ashx?PlaceId=" .. placeId .. "&" .. access)()
				end
			end)
end

pcall(function() game:GetService("NetworkServer"):SetIsPlayerAuthenticationRequired(false) end)
settings().Diagnostics.LuaRamLimit = 0
--settings().Network:SetThroughputSensitivity(0.08, 0.01)
--settings().Network.SendRate = 35
--settings().Network.PhysicsSend = 0  -- 1==RoundRobin

shared["__time"] = 0
game:GetService("RunService").Stepped:connect(function (time) shared["__time"] = time end)




if placeId~=nil and killID~=nil and deathID~=nil and url~=nil then
	-- listen for the death of a Player
	function createDeathMonitor(player)
		-- we don't need to clean up old monitors or connections since the Character will be destroyed soon
		if player.Character then
			local humanoid = waitForChild(player.Character, "Humanoid")
			humanoid.Died:connect(
				function ()
					onDied(player, humanoid)
				end
			)
		end
	end

	-- listen to all Players' Characters
	game:GetService("Players").ChildAdded:connect(
		function (player)
			createDeathMonitor(player)
			player.Changed:connect(
				function (property)
					if property=="Character" then
						createDeathMonitor(player)
					end
				end
			)
		end
	)
end

game:GetService("Players").PlayerAdded:connect(function(player)
	print("Player " .. player.userId .. " added")
	if url and access and placeId and player and player.userId then
		--game:HttpGet(url .. "/Game/ClientPresence.ashx?action=connect&" .. access .. "&PlaceID=" .. placeId .. "&UserID=" .. player.userId)
		--game:HttpGet(url .. "/Game/PlaceVisit.ashx?UserID=" .. player.userId .. "&AssociatedPlaceID=" .. placeId .. "&" .. access)
		
	end
	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)
end)


game:GetService("Players").PlayerRemoving:connect(function(player)
	print("Player " .. player.userId .. " leaving")
	if url and access and placeId and player and player.userId then
		--game:HttpGet(url .. "/Game/ClientPresence.ashx?action=disconnect&" .. access .. "&PlaceID=" .. placeId .. "&UserID=" .. player.userId)
		
	end
end)

if placeId~=nil and url~=nil and access~=nil then
	-- yield so that file load happens in the heartbeat thread
	wait()
	
	-- load the game
	game:Load(url .. "/asset/?id=" .. placeId .. "&" .. access)
end

-- Now start the connection
ns:Start(port, sleeptime) 

if timeout then
	scriptContext:SetTimeout(timeout)
end
scriptContext.ScriptsDisabled = false

--delay(1, function()
--	loadfile(url .. "/analytics/GamePerfMonitor.ashx")(game.JobId, placeId)
--end)

if access then
  game.Close:connect(function() 
    reportCdn(true)
  end)
  
  delay(60*5, function()
    while true do
		reportCdn(false)
		wait(60*5)
	end
 end)
end


------------------------------END START GAME SHARED SCRIPT--------------------------



-- StartGame -- 
game:GetService("RunService"):Run()
<?php
 $script = ob_get_clean();
 $sig;
 $key = file_get_contents("..\..\web\privatekey.pem");
 openssl_sign($script, $sig, $key, OPENSSL_ALGO_SHA1);
 echo sprintf("%%%s%%%s", base64_encode($sig), $script);
?>