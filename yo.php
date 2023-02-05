<?php 
include 'header.php'; 

$plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`concurrents`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");

								$plansql -> execute(array(":id" => $_SESSION['ID']));

								$row = $plansql -> fetch(); 

								$date = date("m-d-Y, h:i:s a", $row['expire']);
								if (!$user->hasMembership($odb)){

									$row['mbt'] = 0;

									$row['concurrents'] = 0;

									$row['name'] = 'No active plan';

									$date = 'N/A';

								}
?>
<div class="main-content" id="content">
		<div id="divall" style="display:inline"></div>
		<div id="div" style="display:inline"></div>
		<div role="alert"><img class="spinner-grow text-primary" id="image" role="status" style="display:none"></div>
	</div>
	<div class="content flex-row-fluid" id="kt_content_container">
		<div class="container-fluid">
			<div class="container-fluid">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"> Advanced DDoS Attack Builder

						</h4>
						<fieldset>
							<div class="form-group mb-3">
								<label for="name">Attack Target (URL or IPv4 )</label>
									<input class="form-control" type="text" id="host" name="host">
					
							</div>

							<div class="form-group mb-3">
								<label for="name">Attack Port</label>
									<input class="form-control" type="number" id="port" name="port">
						
							</div>

							<div class="form-group mb-3">
								<label for="name">Attack Duration (In Seconds)</label>
									<input class="form-control" type="number" id="time" name="time" placeholder="Max <?php echo $row['mbt']; ?>">
				
							</div>


							<div class="form-group">
								<label for="method">DDoS Attack Method</label>
								<select class="form-control" id="method">
									<optgroup label="Layer 4  Attack Methods" style="color:#ff0000;">
										<?php
										$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'udp' ORDER BY `id` ASC");

										while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
											$message = $user->hasMembership($odb)
												? '<option class="text-red" " value="' . ($getInfo['name'] ?? 'N/A') . '">' . ($getInfo['fullname'] ?? 'N/A') . '</option>'
												: '<option class="text-danger"disabled value="">' . ($getInfo['fullname'] ?? 'N/A') . '</option>';
											echo $message;
										}
										?>

									</optgroup>

	<optgroup label=" Game Attack Methods" style="color:#1b25ab;">
										<?php
										$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer4' ORDER BY `id` ASC");

										while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
											$message = $user->hasMembership($odb)
												? '<option class="text-red" " value="' . ($getInfo['name'] ?? 'N/A') . '">' . ($getInfo['fullname'] ?? 'N/A') . '</option>'
												: '<option class="text-danger"disabled value="">' . ($getInfo['fullname'] ?? 'N/A') . '</option>';
											echo $message;
										}
										?>
									</optgroup>


									<optgroup label="Layer 4  TCP Attack Methods" style="color:#259490;">
										<?php
										$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'tcp' ORDER BY `id` ASC");

										while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
											$message = $user->hasMembership($odb)
												? '<option class="text-red" " value="' . ($getInfo['name'] ?? 'N/A') . '">' . ($getInfo['fullname'] ?? 'N/A') . '</option>'
												: '<option class="text-danger"disabled value="">' . ($getInfo['fullname'] ?? 'N/A') . '</option>';
											echo $message;
										}
										?>
									</optgroup>


									<optgroup label="Layer 7 Attack Methods" style="color:#006bed;">
										<?php
										$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer7' ORDER BY `id` ASC");

										while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
											$message = $user->hasMembership($odb)
												? '<option class="text-red" " value="' . ($getInfo['name'] ?? 'N/A') . '">' . ($getInfo['fullname'] ?? 'N/A') . '</option>'
												: '<option class="text-success"danger value="">' . ($getInfo['fullname'] ?? 'N/A') . '</option>';
											echo $message;
										}
										?>
									</optgroup>
								</select><br>
								<br>


								<center>
					
        
	<div class="form-group mb-3">
								<label for="name">HTTP Version</label>
								  <!-- Switch -->
<select class="form-control" id="httpversion">
<optgroup label="Select HTTP Version" style="color:#ff0000;">
    <option value="" disabled selected>Choose your version</option>
<option value="0">HTTP/1.1 [MORE R/S]</option>
<option value="2">HTTP/2 [MORE BANDWIDTH]</option>
</optgroup>
</select>
 
							</div>


											<br>

	<div class="form-group mb-3">
								<label for="name">Type </label>
								  <!-- Switch -->
<select class="form-control" id="type">
<optgroup label="Type" style="color:#ff0000;">
<option value="0">GET</option>
<option value="2">Post</option>
</optgroup>
</select>
 
							</div>


											<br>
		


	<div class="form-group mb-3">
								<label for="name"> Reffer</label>
								  <!-- Switch -->
<input class="form-control" type="text" id="reffer" name="reffer" placeholder="Target url or null">
            
							
							</div>


											<br>
											
											
											
											
												<div class="form-group mb-3">
								<label for="name"> Cookie</label>
								  <!-- Switch -->
<input class="form-control" type="text" id="cookiee" name="cookiee" placeholder="session=%RAND% or Word">
            
							
							</div>


											<br>
														<div class="form-group mb-3">
								<label for="name"> Post Data</label>
								  <!-- Switch -->
<input class="form-control" type="text" id="postdata" name="postada" placeholder="Use only with POST">
            
							
							</div>


											<br>
											
											
											

	<div class="form-group mb-3">
								<label for="name">Request per IP</label>
								  <!-- Switch -->
<select class="form-control" id="rate-proxy-list">
  </option>
<option value="300">Send 300 Requests</option>
<option value="100">Send 100 Requests</option>
<option value="80">Send 80 Requests</option>
<option value="50">Send 50 Requests</option>
<option value="30">Send 30 Requests</option>
<option value="25">Send 25 Requests</option>
<option value="15">Send 15 Requests</option>
</optgroup>
</select>
            
							</div>


											<br>
											
											
											
								
											
												<div class="form-group mb-3">
								<label for="name">Attack Origin</label>
							
<select class="form-control" id="geolist">
<optgroup label="Cloud  (For Layer4)" style="color:#ff0000;">
        <option value="" disabled selected>Choose your geolocation attack</option>
<option value="ALL">Random Cloud Provider</option>
<option value="cloudflare">[Cloud] Cloudflare</option>
<option value="ovh">[Cloud] OVH</option>
<option value="google">[Cloud] Google</option>
<option value="amazon">[Cloud] Amazon</option>
<option value="azure">[Cloud] Azure</option>
<option value="digitalocean">[Cloud] Digitalocean</option>
<option value="linode">[Cloud] Linode</option>
<option value="rackspace">[Cloud] Rackspace</option>
<option value="softlayer">[Cloud] Softlayer</option>
<optgroup label=" For Layer4 and Layer7" style="color:#4d10de;">
<option value="ALLl7">Automatic</option>
<option value="US">United States</option>
<option value="CN">China</option>
<option value="AU">Australia</option>
<option value="JP">Japan</option>
<option value="TH">Thailand</option>
<option value="IN">India</option>
<option value="MY">Malaysia</option>
<option value="KR">Korea (Republic of)</option>
 <option value="SG">Singapore</option>
<option value="HK">Hong Kong</option>
<option value="TW">Taiwan</option>
<option value="KH">Cambodia</option>
<option value="PH">Philippines</option>
<option value="VN">Viet Nam</option>
<option value="NO">Norway</option>
<option value="ES">Spain</option>
<option value="FR">France</option>
<option value="NL">Netherlands</option>
<option value="CZ">Czechia</option>
<option value="GB">United Kingdom</option>
<option value="DE">Germany</option>
<option value="AT">Austria</option>
<option value="CH">Switzerland</option>
<option value="BR">Brazil</option>
<option value="IT">Italy</option>
<option value="GR">Greece</option>
<option value="PL">Poland</option>
<option value="BE">Belgium</option>
<option value="IE">Ireland</option>
<option value="DK">Denmark</option>
<option value="PT">Portugal</option>
<option value="SE">Sweden</option>
<option value="GH">Ghana</option>
<option value="TR">Turkey</option>
<option value="RU">Russian Federation</option>
<option value="CM">Cameroon</option>
<option value="ZA">South Africa</option>
<option value="FI">Finland</option>
<option value="AE">United Arab Emirates</option>
<option value="JO">Jordan</option>
<option value="RO">Romania</option>
<option value="LU">Luxembourg</option>
<option value="AR">Argentina</option>
<option value="UG">Uganda</option>
<option value="AM">Armenia</option>
<option value="TZ">Tanzania</option>
<option value="BI">Burundi</option>
<option value="UY">Uruguay</option>
<option value="CL">Chile</option>
<option value="BG">Bulgaria</option>
<option value="UA">Ukraine</option>
<option value="EG">Egypt</option>
<option value="CA">Canada</option>
<option value="IL">Israel</option>
<option value="QA">Qatar</option>
<option value="MD">Moldova (Republic of)</option>
<option value="HR">Croatia</option>
<option value="IQ">Iraq</option>
<option value="LT">Lithuania</option>
<option value="LV">Latvia</option>
<option value="EE">Estonia</option>
<option value="UZ">Uzbekistan</option>
<option value="SK">Slovakia</option>
<option value="KZ">Kazakhstan</option>
<option value="GE">Georgia</option>
<option value="AL">Albania</option>
<option value="PS">Palestine</option>
<option value="HU">Hungary</option>
<option value="SA">Saudi Arabia</option>
<option value="CY">Cyprus</option>
<option value="MT">Malta</option>
<option value="CR">Costa Rica</option>
<option value="IR">Iran (Islamic Republic of)</option>
<option value="BH">Bahrain</option>
<option value="MX">Mexico</option>
<option value="CO">Colombia</option>
<option value="SY">Syrian Arab Republic</option>
<option value="LB">Lebanon</option>
<option value="MK">North Macedonia</option>
<option value="MP">Northern Mariana Islands</option>
<option value="DO">Dominican Republic</option>
<option value="ID">Indonesia</option>
<option value="VI">Virgin Islands (U.S.)</option>
<option value="NG">Nigeria</option>
<option value="PE">Peru</option>
<option value="EC">Ecuador</option>
<option value="VE">Venezuela</option>

</optgroup>
</select>
</select>
            
							
							</div>


											<br><br><br>

											

											<? if ($user->hasMembership($odb)) : ?>
												<button type="button" id="launch" onclick="start()" class="btn btn-primary">Send DDoS Attack</button>
											<? else : ?>
										  <a class="
 btn btn-light-primary
 " href="plans.php"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart me-2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg><span>Buy Membership</span></a>

											<? endif; ?>
										</center>
									</center>
								</center>
							</div>
						</fieldset>
					</div>
				</div>
			</div>

		<script>
   
    	async function GET(e, n, o = !1, t = !0) {
		return new Promise(((c, r) => {
			let s = {
				mode: t ? "cors" : "no-cors",
				method: "GET"
			};
			s.headers = n || {
				"User-Agent": "Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0"
			}, fetch(e, s).then((e => {
				const n = e.clone();
				o ? n.json().then((e => c(e))) : n.text().then((e => c(e)))
			})).catch((e => r(e)))
		}))
	}

	function attacks() {
		document.getElementById("attacksdiv").style.display = "none";
		document.getElementById("manage").style.display = "inline";

		GET('function/showattacks.php').then(data => {
			document.getElementById("attacksdiv").innerHTML = data;
			document.getElementById("manage").style.display = "none";
			document.getElementById("attacksdiv").style.display = "block";
			document.getElementById("attacksdiv").style.width = "100%";
			return attacks_shown = true;
		});
	}

	function start() {
		var host = $('#host').val();
		var port = $('#port').val();
		var time = $('#time').val();
		var method = $('#method').val();

		document.getElementById("image").style.display = "inline";
		document.getElementById("div").style.display = "none";

		GET(`function/sent.php?type=start&host=${host}&port=${port}&time=${time}&method=${method}`).then(data => {
			document.getElementById("div").innerHTML = data;
			document.getElementById("div").style.display = "inline";
			document.getElementById("image").style.display = "none";
			$('body').append(data);

			attacks();
			setInterval(ping(host), time * 1000);
		});
	}
	function stop(id) {
		document.getElementById("manage").style.display = "inline";
		document.getElementById("div").style.display = "none";

		GET(`function/sent.php?type=stop&id=${id}`).then(data => {
			document.getElementById("div").innerHTML = data;
			document.getElementById("div").style.display = "inline";
			document.getElementById("manage").style.display = "none";
			$('body').append(data);

			attacks();
			setInterval(ping(host), time * 1000);
		});
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html> 
 