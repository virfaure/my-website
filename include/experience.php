<div id="experience">
	
	<h3><?=$arrText['experiences']?></h3>
			
	<div id="timeline">
		
		
		<?php
			$dateBeginTimestamp = mktime(0, 0, 0, 9, 1, 1998);
			$dateBeginYear = date('Y', $dateBeginTimestamp);
			
			
			//Number of years until today
			$todayTimestamp = time();
			$nbYears = (date('Y', $todayTimestamp) - $dateBeginYear) + 1;
			
			//Number of months until today
			$nbMonth98 = 12 - (date('n', $dateBeginTimestamp) - 1);
			$nbMonths = $nbMonth98 + (12 * ($nbYears - 2)) + date('n', $todayTimestamp);

			//$widthYear = round(800 / ($nbYears - 1));
			$widthMonth = round(800 / $nbMonths);
		?>
		
		<div class="start"><?=$dateBeginYear?></div>
		
		<div class="line">
			
			<?php
			
			
				foreach($arrExperience as $key => $experience){
					//Text : Date From-to
					//If same year, put Month before

					$dateFromTimestamp = $objUtil->dateDBToTimestamp($experience['experience_date_from']);
					$dateFromYear = date('Y', $dateFromTimestamp);
					
					if(empty($experience['experience_date_to'])){
						$dateToYear = $arrText['today'];
					}else{
						$dateToTimestamp = $objUtil->dateDBToTimestamp($experience['experience_date_to']);
						$dateToYear = date('Y', $dateToTimestamp);
						
						if($dateFromYear == $dateToYear){
							$dateFromYearText = $objUtil->dateDBToStringShort($experience['experience_date_from']);
							$dateToYearText =  $objUtil->dateDBToStringShort($experience['experience_date_to']);
						}
					}
					
					if(!empty($dateFromYearText)) $dateExperience = '['.$dateFromYearText.' - '.$dateToYearText.']';
					else $dateExperience = '['.$dateFromYear.' - '.$dateToYear.']';
					
					//Position LEFT Of the Pin Difference in Months between dateBegin and experience_date_from
					$nbYearsBeginFrom = ($dateFromYear - $dateBeginYear) + 1;
					//$left = ($widthYear * $nbYearsBeginFrom) - 13; //width pin 14px / 2
					
					$nbMonthBeginFrom = $nbMonth98 + (12 * ($nbYearsBeginFrom - 2)) + date('n', $dateFromTimestamp);
					$left = ($widthMonth * $nbMonthBeginFrom) - 13; //width pin 20px / 2
					
					echo '<div id="pin-'.$key.'" class="pin-'.$experience['experience_type'].'" style="left:'.$left.'px;">
							<div class="text-pin">
								<div class="title">
									<div class="bold white">'.$experience['experience_title'].' '.$dateExperience.'</div>
									<div class="italic white">'.$experience['experience_company'].', '.$experience['experience_place'].'</div>
								</div>
								<div class="text margin-top-10">'.trim($experience['experience_description']).'</div>
							</div>
						</div>';
				}
			?>
			
		</div>
		
		<div class="end"><?=date('Y')?></div>
		
		<div class="clear"></div>
	</div>
	
	<br />
	
</div>
