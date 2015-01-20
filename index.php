<?php

    /*
    ***************************************************************************
        DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
        Version 1, 2014/15
        Copyright (C) 2014 Christian Becher | phaziz.com <phaziz@gmail.com>
        Everyone is permitted to copy and distribute verbatim or modified
        copies of this license document, and changing it is allowed as long
        as the name is changed.
        DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
        TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
        0. YOU JUST DO WHAT THE FUCK YOU WANT TO!
        +++ Visit http://phaziz.com +++
        +++ Visit http://blog.phaziz.com +++
    ***************************************************************************
    */

	$ALL_MONTHS = array
	(
		'01' => 'Januar',
		'02' => 'Februar',
		'03' => 'M&auml;rz',
		'04' => 'April',
		'05' => 'Mai',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'August',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Dezember'
	);

	$ALL_DAYS = array
	(
		0 => 'Sonntag',
		1 => 'Montag',
		2 => 'Dienstag',
		3 => 'Mittwoch',
		4 => 'Donnerstag',
		5 => 'Freitag',
		6 => 'Samstag'
	);

	function checkFeiertag($DATE)
	{
		$PARTS = explode(".", $DATE);
		$DAY = intval($PARTS[0]);
		$MONTH = intval($PARTS[1]);
		$YEAR = intval($PARTS[2]);
		$OSTERSONNTAG = date("d.m.Y", easter_date($YEAR));
		$OSTERTEILE = explode(".", $OSTERSONNTAG);
		$OSTERTAG = intval($OSTERTEILE[0]);
		$OSTERMONAT = intval($OSTERTEILE[1]);
		$KARFREITAG = date("d.m.Y", mktime(0, 0, 0, $OSTERMONAT, ($OSTERTAG - 2), $YEAR));
		$KARFREITAGTEILE = explode(".", $KARFREITAG);
		$KARFREITAGTAG = intval($KARFREITAGTEILE[0]);
		$KARFREITAGMONAT = intval($KARFREITAGTEILE[1]);
		$OSTERMONTAG = date("d.m.Y", mktime(0, 0, 0, $OSTERMONAT, ($OSTERTAG + 1), $YEAR));
		$OSTERMONTAGTEILE = explode(".", $OSTERMONTAG);
		$OSTERMONTAGTAG = intval($OSTERMONTAGTEILE[0]);
		$OSTERMONTAGMONAT = intval($OSTERMONTAGTEILE[1]);
		$CHRISTIHFAHRT = date("d.m.Y", mktime(0, 0, 0, $OSTERMONAT, ($OSTERTAG + 39), $YEAR));
		$CHRISTIHFAHRTTEILE = explode(".", $CHRISTIHFAHRT);
		$CHRISTIHFAHRTTAG = intval($CHRISTIHFAHRTTEILE[0]);
		$CHRISTIHFAHRTMONAT = intval($CHRISTIHFAHRTTEILE[1]);
		$PFINGSTEN = date("d.m.Y", mktime(0, 0, 0, $OSTERMONAT, ($OSTERTAG + 50), $YEAR));
		$PFINGSTENteile = explode(".", $PFINGSTEN);
		$PFINGSTENtag = intval($PFINGSTENTEILE[0]);
		$PFINGSTENmonat = intval($PFINGSTENTEILE[1]);
		$FRONLEICHNAM = date("d.m.Y", mktime(0, 0, 0, $OSTERMONAT, ($OSTERTAG + 60), $YEAR));
		$FRONLEICHNAMTEILE = explode(".", $FRONLEICHNAM);
		$FRONLEICHNAMTAG = intval($FRONLEICHNAMTEILE[0]);
		$FRONLEICHNAMMONAT = intval($FRONLEICHNAMTEILE[1]);
		$FEIERTEXT = "";

		if($DAY == 1 && $MONTH == 1) { $FEIERTEXT = "Neujahr"; }

		if($DAY == $KARFREITAGTAG && $MONTH == $KARFREITAGMONAT)
		{
			if($FEIERTEXT != "") $FEIERTEXT .= " und ";
			$FEIERTEXT .= "Karfreitag";
		}

		if($DAY == $OSTERTAG && $MONTH == $OSTERMONAT)
		{
			if($FEIERTEXT != "") $FEIERTEXT .= " und ";
			$FEIERTEXT .= "Ostersonntag";
		}

		if($DAY == $OSTERMONTAGTAG && $MONTH == $OSTERMONTAGMONAT)
		{
			if($FEIERTEXT != "") $FEIERTEXT .= " und ";
			$FEIERTEXT .= "Ostermontag";
		}

		if($DAY == 1 && $MONTH == 5)
		{
			if($FEIERTEXT != "") $FEIERTEXT .= " und ";
			$FEIERTEXT .= "Tag der Arbeit";
		}

		if($DAY == $CHRISTIHFAHRTTAG && $MONTH == $CHRISTIHFAHRTMONAT)
		{
			if($FEIERTEXT != "") $FEIERTEXT .= " und ";
			$FEIERTEXT .= "Christi Himmelfahrt";
		}

		if($DAY == $PFINGSTENTAG && $MONTH == $PFINGSTENMONAT)
		{
			if($FEIERTEXT != "") $FEIERTEXT.= " und ";
			$FEIERTEXT.= "Pfingstmontag";
		}

		if($DAY == 3 && $MONTH == 10)
		{
			if($FEIERTEXT != "") $FEIERTEXT.= " und ";
			$FEIERTEXT.= "Tag der deutschen Einheit";
		}

		if($DAY == 25 && $MONTH == 12)
		{
			if($FEIERTEXT != "") $FEIERTEXT.= " und ";
			$FEIERTEXT.= "Erster Weihnachtstag";
		}

		if($DAY == 26 && $MONTH == 12)
		{
			if($FEIERTEXT != "") $FEIERTEXT.= " und ";
			$FEIERTEXT.= "Zweiter Weihnachtstag";
		}

		if($FEIERTEXT != "")
		{
			return $FEIERTEXT;
		}
		else
		{
			return false;
		}
	}

	if(!isset($_GET['options']))
	{
		$OPTIONS = 0;
	}
	else
	{
		$OPTIONS = $_GET['options'];
	}

	if(!isset($_GET['date']) || $_GET['date'] == '')
	{
		$ACT_DATE = time();
	}
	else
	{
		$DATE = $_GET['date'];
		$TPARTS = explode(".", $DATE);
		$TDAY = intval($TPARTS[0]);
		$TMONTH = intval($TPARTS[1]);
		$TYEAR = intval($TPARTS[2]);

		if(strlen($TDAY) == 1) $TDAY = 0 . $TDAY;

		if(strlen($TMONTH) == 1) $TMONTH = 0 . $TMONTH;

		if(strlen($TYEAR) == 2)
		{
			$TACT_YEAR = str_split(date('Y'));
			$TYEAR =  $TACT_YEAR[0] . $TACT_YEAR[1] . $TYEAR;
		}

		$TMP_DATE = $TDAY . '.' . $TMONTH . '.' . $TYEAR;
		$ACT_DATE = mktime(0,0,0,$TMONTH,$TDAY,$TYEAR);
	}

	$DAY = date('d', $ACT_DATE);
	$MONTH = date('m', $ACT_DATE);
	$YEAR = date('Y', $ACT_DATE);

?>
<!doctype html>
<html class="no-js" lang="en">
	    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Uh Oh &amp; Welcome!</title>
        <link rel="stylesheet" href="css/foundation.min.css">
        <link rel="stylesheet" href="css/app.min.css">
        <link rel="stylesheet" href="icons/foundation-icons.css">
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>

		<?php

			if($OPTIONS == 0)
			{
				?>
					<div id="optional_controls" style="display:none;">
				<?php		
			}
			else
			{
				?>
					<div id="optional_controls">
				<?php
			}

		?>

			<div class="row margin-top-25">
				<div class="small-12 large-12 columns">
					<form name="datr" id="datr" action="index.php" method="get" enctype="text/plain" onkeydown="javascript:de();">
						<div class="row collapse">
							<div class="small-3 large-3 columns">
								<span class="prefix">Datum:</span>
							</div>
							<div class="small-7 large-7 columns">
								<input type="text" name="date" id="date" value="<?php echo $TMP_DATE; ?>" placeholder="23.04.1977">
							</div>
							<div class="small-2 large-2 columns">
								<a href="" id="submitr" name="submitr" role="button" aria-label="submit form" class="button tiny success postfix">Zeigen</a>
							</div>
						</div>
					</form>
				</div>	
			</div>
			
			<div class="row">
				<div class="large-3 columns">
					<label>
						<select class="datepicker" id="dp-day">
							<?php
	
								if(!isset($_GET['date']) || $_GET['date'] == '')
								{
									echo '<option value="' . date('d') . '">' . date('d') . '</option>';
								}
								else
								{
									echo '<option value="' . $TDAY . '">' . $TDAY . '</option>';
								}
	
							?>
							<option value="">- - -</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
					</label>
				</div>
				<div class="large-1 columns text-center"<strong>.</strong></div>
				<div class="large-3 columns">
					<label>
						<select class="datepicker" id="dp-month">
							<?php
	
								if(!isset($_GET['date']) || $_GET['date'] == '')
								{
									echo '<option value="' . date('m') . '">' . $ALL_MONTHS[date('m')] . '</option>';
								}
								else
								{
									echo '<option value="' . $TMONTH . '">' . $ALL_MONTHS[$TMONTH] . '</option>';
								}
	
							?>
							<option value="">- - -</option>
							<option value="01"><?php echo $ALL_MONTHS['01'] ?></option>
							<option value="02"><?php echo $ALL_MONTHS['02'] ?></option>
							<option value="03"><?php echo $ALL_MONTHS['03'] ?></option>
							<option value="04"><?php echo $ALL_MONTHS['04'] ?></option>
							<option value="05"><?php echo $ALL_MONTHS['05'] ?></option>
							<option value="06"><?php echo $ALL_MONTHS['06'] ?></option>
							<option value="07"><?php echo $ALL_MONTHS['07'] ?></option>
							<option value="08"><?php echo $ALL_MONTHS['08'] ?></option>
							<option value="09"><?php echo $ALL_MONTHS['09'] ?></option>
							<option value="10"><?php echo $ALL_MONTHS['10'] ?></option>
							<option value="11"><?php echo $ALL_MONTHS['11'] ?></option>
							<option value="12"><?php echo $ALL_MONTHS['12'] ?></option>
						</select>
					</label>
				</div>
				<div class="large-1 columns text-center"<strong>.</strong></div>
				<div class="large-4 columns">
					<label>
						<select class="datepicker" id="dp-year">
							<?php
	
								if(!isset($_GET['date']) || $_GET['date'] == '')
								{
									echo '<option value="' . date('Y') . '">' . date('Y') . '</option>';
								}
								else
								{
									echo '<option value="' . $TYEAR . '">' . $TYEAR . '</option>';
								}

							?>
							<option value=""> - - -</option>
							<option value="<?php echo (date('Y') - 5); ?>"><?php echo (date('Y') - 5); ?></option>
							<option value="<?php echo (date('Y') - 4); ?>"><?php echo (date('Y') - 4); ?></option>
							<option value="<?php echo (date('Y') - 3); ?>"><?php echo (date('Y') - 3); ?></option>
							<option value="<?php echo (date('Y') - 2); ?>"><?php echo (date('Y') - 2); ?></option>
							<option value="<?php echo (date('Y') - 1); ?>"><?php echo (date('Y') - 1); ?></option>
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
							<option value="<?php echo (date('Y') + 1); ?>"><?php echo (date('Y') + 1); ?></option>
							<option value="<?php echo (date('Y') + 2); ?>"><?php echo (date('Y') + 2); ?></option>
							<option value="<?php echo (date('Y') + 3); ?>"><?php echo (date('Y') + 3); ?></option>
							<option value="<?php echo (date('Y') + 4); ?>"><?php echo (date('Y') + 4); ?></option>
							<option value="<?php echo (date('Y') + 5); ?>"><?php echo (date('Y') + 5); ?></option>
						</select>
					</label>
				</div>
			</div>

		</div>

		<div class="row margin-top-25">
			<div class="small-centered small-3 large-3 columns text-center">
				<select id="options">
					<?php
						if($OPTIONS == 0)
						{
							?>
								<option value="0" selected="selected">Optionen ausblenden</option>
							<?php
						}
						else
						{
							?>
								<option value="1" selected="selected">Optionen einblenden</option>
							<?php							
						}
					?>
					<option value="">- - -</option>
					<option value="0">Optionen ausblenden</option>
					<option value="1">Optionen einblenden</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="small-12 large-12 columns">
			<?php

				$FIRST_DAY = mktime(0,0,0,$MONTH, 1, $YEAR); 
				$ACT_MONTH = date('F', $FIRST_DAY);
				$ACT_MONTH_NUM = date('m', $FIRST_DAY);
				$DAY_OF_WEEK = date('w', $FIRST_DAY); 

				switch($DAY_OF_WEEK)
				{
					case 1: $EMPTY = 0; break;
					case 2: $EMPTY = 1; break;
					case 3: $EMPTY = 2; break;
					case 4: $EMPTY = 3; break;
					case 5: $EMPTY = 4; break;
					case 6: $EMPTY = 5; break;
					case 0: $EMPTY = 6; break;
			 	}

				$DAYS_IN_MONTH = cal_days_in_month(0, $MONTH, $YEAR); 

				echo '<table role="grid">';
				echo '<thead>';
				echo '<tr><th colspan="7" width="700" scope="column" class="text-center">' . $ALL_MONTHS[$MONTH] . ' ' . $YEAR . '<br><small>Heute: ' . date('d.m.Y') . '</small></th></tr>';
				echo '<tr><th width="100" scope="column" class="text-center">' . $ALL_DAYS[1] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[2] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[3] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[4] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[5] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[6] . '</th>';
				echo '<th width="100" scope="column" class="text-center">' . $ALL_DAYS[0] . '</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';

				$DAY_COUNT = 1;

				echo "<tr>";

				while ($EMPTY > 0)
				{
			 		echo '<td scope="row" class="empty">&#160;</td>';

			 		$EMPTY = $EMPTY-1;
					$DAY_COUNT++;
				}

				$DAY_NUM = 1;

				while($DAY_NUM <= $DAYS_IN_MONTH)
				{
					if(strlen($DAY_NUM) == 1)
					{
						$THE_DAY = 0 . $DAY_NUM;
					}
					else
					{
						$THE_DAY = $DAY_NUM;
					}

					if(!isset($_GET['date']) || $_GET['date'] == '')
					{
						$ACT_DATE = date('d.m.Y');	
					}
					else
					{
						$DATE = $_GET['date'];
						$TPARTS = explode(".", $DATE);
						$TDAY = intval($TPARTS[0]);
						$TMONTH = intval($TPARTS[1]);
						$TYEAR = intval($TPARTS[2]);

						if(strlen($TDAY) == 1) { $TDAY = 0 . $TDAY; }
						if(strlen($TMONTH) == 1) { $TMONTH = 0 . $TMONTH; }

						if(strlen($TYEAR) == 2)
						{
							$TACT_YEAR = str_split(date('Y'));
							$TYEAR =  $TACT_YEAR[0] . $TACT_YEAR[1] . $TYEAR;
						}

						$TMP_DATE = $TDAY . '.' . $TMONTH . '.' . $TYEAR;
						$ACT_DATE = mktime(0,0,0,$TMONTH,$TDAY,$TYEAR);
						$DAY = date('d', $ACT_DATE);
						$MONTH = date('m', $ACT_DATE);
						$YEAR = date('Y', $ACT_DATE);
						$ACT_DATE = $DAY . '.' . $MONTH . '.' .$YEAR;
					}

					$COMPLETE_DATE = $THE_DAY . '.' . $ACT_MONTH_NUM . '.' . $YEAR;
					$FEIERTAG = checkFeiertag($COMPLETE_DATE);

					if($ACT_DATE == $COMPLETE_DATE)
					{
						echo '<td scope="row" class="text-center active day" id="day_' . $YEAR . '-' . $ACT_MONTH_NUM . '-' . $DAY_NUM . '">' . $DAY_NUM . '<br><small>' . $COMPLETE_DATE . '</small>';

						if($FEIERTAG != FALSE) { echo '<br><small>' . $FEIERTAG . '</small>'; }

						echo '</td>';
					}
					else
					{
						echo '<td scope="row" class="text-center day" id="day_' . $YEAR . '-' . $ACT_MONTH_NUM . '-' . $DAY_NUM . '">' . $DAY_NUM . '<br>';
						echo '<small>' . $COMPLETE_DATE . '</small>';

						if($FEIERTAG != FALSE) { echo '<br><small>' . $FEIERTAG . '</small>'; }

						echo '</td>';
					}

					$DAY_NUM++;
					$DAY_COUNT++;

					if ($DAY_COUNT > 7)
					{
						echo '</tr><tr>';

						$DAY_COUNT = 1;
					}
				} 

				while($DAY_COUNT > 1 && $DAY_COUNT <= 7)
				{
					echo '<td scope="row" class="empty">&#160;</td>'; 

					$DAY_COUNT++;
			 	}

				echo '</tr>';
				echo '</tbody>';
				echo '</table>';

			?>
			</div>
		</div>

		<div class="row margin-top-25">
			<div class="small-12 large-12 columns">
				<p><small>German PHP-Calendar by <a href="http://phaziz.com">phaziz.com</a></small></p>
			</div>	
		</div>


        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/app.min.js"></script>
        <script>

        </script>
    </body>
</html>