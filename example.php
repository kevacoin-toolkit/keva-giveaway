<?php

error_reporting(0);

include("rpc.php");

$kpc = new Keva();

$kpc->username=$krpcuser;
$kpc->password=$krpcpass;
$kpc->host=$krpchost;
$kpc->port=$krpcport;

$_REQ = array_merge($_GET, $_POST);

echo "<form action=\"example.php\" method=\"post\" ><input type=\"text\" name=\"address\" maxlength=\"64\" placeholder=\"KEVA ADDRESS\" style=\"width:200px;\"><input type=\"submit\" value=\"".$keva_kaw."\"></form>";



$freeadd=$_REQ["address"];

if(strlen($freeadd)==34 & substr($freeadd,0,1)=="V") {

$forfree=$freeadd;

$checkaddress= $kpc->listtransactions("credit",100);

$listaccount = $kpc->listaccounts();

if($listaccount['credit']<1){echo "<script>alert('NO CREDIT AVAILABLE, PLEASE WAIT NEXT TIME. OR ASK SOMEONE TO SEND SOME TO 5982501 WITH APP (".$listaccount['credit'].")');history.go(-1);</script>";exit;}

$ok=0;

		$farr=array();
		$ftotal=array();

		foreach($checkaddress as $freetx)

			{
			
			extract($freetx);

			

			$farr["fcon"]=$confirmations;
			$farr["fadd"]=$address;
		
			array_push($ftotal,$farr);

			}


			asort($ftotal);

		foreach($ftotal as $findadd){




									
						if($findadd['fadd']==$forfree)

										{
							
										

										if($findadd['fcon']>30)

											{

										$age= $kpc->sendfrom("credit",$forfree,$credit);

										echo "<script>alert('GET 1 CREDIT SUCCESS');history.go(-1);</script>";



										exit;

											}

										else
								
											{ 

										$left=30-$findadd['fcon'];
		
									
										echo "<script>alert('WAIT ".$left." BLOCKS (2min/block)');history.go(-1);</script>";
										
										exit;

											}

										}
										else


										{

											$ok=9;
										}
										
									}
										if($ok=9)
											
											{$age= $kpc->sendfrom("credit",$forfree,"0.1");
											
										echo "<script>alert('GET CREDIT SUCCESS');history.go(-1);</script>";
											}

						}




?>