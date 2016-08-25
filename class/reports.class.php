<?php

include PATH."/class/tools.class.php";

class reports extends tools {

	public function reports_test() {
		// test function for empty class
	}


	// converts an StdObject to an Array
	public function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			//return array_map(__FUNCTION__, $d);
			return array_map(array($this, 'objectToArray'), $d);
		} else {
			// Return array
			return $d;
		}
	}

	/* This function will make use of drilldown charts and display valid/invalid emails for a campaign */
	public function lc_daily_leads() {

                if ($_GET['campaigns'] != "") {

                        foreach ($_GET['campaigns'] as $key=>$value) {
                                $campaign_sql .= "'$value',";
                                $campaign_pills .= "&campaigns[]=$value";
                        }
                        $campaign_sql = trim($campaign_sql,",");

                        $campaign_sql = " AND `ls`.`campaign_id` IN ($campaign_sql) ";

                }


                if ($_GET['date'] == "") {
                        $today = date("Y-m-d");
                        $start = date('Y-m-d',strtotime($today . "-1 days"));
                        $nice_date = date("m/d/Y",strtotime($today . "-1 days"));
                } else {
                        $start = $_GET['date'];
                        $nice_date = date("m/d/Y",strtotime($start));
                }

                $prev_start = date("Y-m-d",strtotime($start . "-1 days"));
                $prev_nice = date("m/d/Y",strtotime($start . "-1 days"));

                $next_start = date("Y-m-d",strtotime($start . "+1 days"));
                $next_nice = date("m/d/Y",strtotime($start . "+1 days"));

                $today_test = date("Y-m-d");

                print '
                 <ul class="nav nav-pills">
                  <li><a href="index.php?section=lc_daily_leads&date='.$prev_start.$campaign_pills.'">'.$prev_nice.'</a></li>
                  <li class="active"><a href="index.php?section=lc_daily_leads&date='.$start.$campaign_pills.'">'.$nice_date.'</a></li>
                ';

                if ($today_test > $next_start) {
                        print '
                          <li><a href="index.php?section=lc_daily_leads&date='.$next_start.$campaign_pills.'">'.$next_nice.'</a></li>
                        ';
                }
                print "</ul>";
                print "<hr>";

                $sql = "
                SELECT
                        `ls`.`campaign_id`,
                        `lc`.`name`,
                        COUNT(`ls`.`campaign_id`) AS 'total',
                        SUM(`ls`.`email_status`) AS 'good',
                        COUNT(`ls`.`campaign_id`) - SUM(`ls`.`email_status`) AS 'bad'

                FROM
                        `lc_lead_stats` ls

                LEFT JOIN `lc_campaign` lc ON `ls`.`campaign_id` = `lc`.`campaign_id`

                WHERE
                        `ls`.`date` = '$start'
                        $campaign_sql
        
                GROUP BY `ls`.`campaign_id`

                ORDER BY `total` DESC
                ";

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $found = "1";
                        $good[] = $row['good'];
                        $bad[] = $row['bad'];
                        $total[] = $row['total'];
                        $labels[] = $row['name'];

                        if ($row['good'] > 0) {
				$chart_output .= "{name: '".$row['name']."',\n
				y: ".$row['good'].",\n
				drilldown: '".$row['name']."'},";

				// get drilldown data
				$sql2 = "
				SELECT
					SUBSTRING_INDEX(`ls`.`email`, '@', -1) as 'email',
					COUNT(SUBSTRING_INDEX(`ls`.`email`, '@', -1)) as 'total'

				FROM
					`lc_lead_stats` ls

				WHERE
					`ls`.`date` = '$start'
					AND `ls`.`campaign_id` = '$row[campaign_id]'
					AND `ls`.`email_status` = '1'

				GROUP BY SUBSTRING_INDEX(`ls`.`email`, '@', -1)

				HAVING (`total` > 20)

				";
				$drilldown .= "{name: '$row[name]',\nid: '$row[name]',\ndata:[\n";
				$result2 = $this->new_mysql($sql2);
				while ($row2 = $result2->fetch_assoc()) {
					$drilldown .= "['".$row2['email']."', ".$row2['total']."],";
				}
				$drilldown = trim($drilldown,',');
				$drilldown .= "]},";

                                $pie_good[] = $row['good'];
                                $pie_good_labels[] = $row['name'];
                                $count1++;
                        }

                        if ($row['bad'] > 0) {
                                $chart_output2 .= "{name: '".$row['name']."',\n
                                y: ".$row['bad'].",\n
                                drilldown: '".$row['name']."'},";
                                
                                // get drilldown data
                                $sql2 = "
                                SELECT
                                        SUBSTRING_INDEX(`ls`.`email`, '@', -1) as 'email',
                                        COUNT(SUBSTRING_INDEX(`ls`.`email`, '@', -1)) as 'total'

                                FROM
                                        `lc_lead_stats` ls

                                WHERE
                                        `ls`.`date` = '$start'
                                        AND `ls`.`campaign_id` = '$row[campaign_id]'
                                        AND `ls`.`email_status` = '0'

                                GROUP BY SUBSTRING_INDEX(`ls`.`email`, '@', -1)

                                HAVING (`total` > 20)

                                ";
                                $drilldown2 .= "{name: '$row[name]',\nid: '$row[name]',\ndata:[\n";
                                $result2 = $this->new_mysql($sql2);
                                while ($row2 = $result2->fetch_assoc()) {
                                        $drilldown2 .= "['".$row2['email']."', ".$row2['total']."],";
                                }
                                $drilldown2 = trim($drilldown2,',');
                                $drilldown2 .= "]},";

                                $pie_bad[] = $row['bad'];
                                $pie_bad_labels[] = $row['name'];
                        }

                }

		// bar graph
		$id = "bar_graph_1";
		$title = "Lead Conduit Stats for $nice_date";
		$subtitle = "Campaigns";
		$s1_title = "Good Email Leads";
		$s2_title = "Bad Email Leads";

		$bar = $this->bar_graph_v2($id,$title,$subtitle,$labels,$good,$bad,$s1_title,$s2_title);
		print "$bar";
                print '<br><div id="'.$id.'" style="min-width: 800px; max-width: 800px; height: 600px;"></div>';
		// end bar

		// pie chart showing valid leads
		$chart_output = trim($chart_output,',');
		$drilldown = trim($drilldown,',');

		$pie_title = "Valid Email Leads $nice_date";
		$id = "pie_chart_1";
		$name = "Campaigns";
                $pie = $this->pie_chart_v2($id,$name,$chart_output,$pie_title,$drilldown);
                print "$pie";

                print '<br><div id="'.$id.'" style="min-width: 800px; max-width: 800px; height: 600px;"></div>';
		// end pie chart

		// pie chart showing in-valid leads
                $chart_output2 = trim($chart_output2,',');
                $drilldown2 = trim($drilldown2,',');

                $pie_title = "Invalid Email Leads $nice_date";
                $id = "pie_chart_2";
                $name = "Campaigns";
                $pie = $this->pie_chart_v2($id,$name,$chart_output2,$pie_title,$drilldown2);
                print "$pie";

                print '<br><div id="'.$id.'" style="min-width: 800px; max-width: 800px; height: 600px;"></div>';
		// end pie chart

                if ($found != "1") {
                        print '
                        <br><br><font color=red><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error: we did not find any data for <b>'.$nice_date.'</b>.</font><br>
                        ';
                        die;
                }

                $title = "Lead Conduit Stats for $nice_date";
                $width = "800";
                $height = "600";
	}


	/* new interactive graphs - max 5 lines */
	public function line_graph_v2($id,$labels,$title,$title2,$subtitle,$series1,$series2,$series3,$series4,$series5,$campaigns) {


		if(is_array($series1)) {
			foreach ($series1 as $key=>$value) {
				$s1 .= "$value,";
			}
			$s1 = trim($s1,',');
		}

                if(is_array($series2)) {
                        foreach ($series2 as $key=>$value) {
                                $s2 .= "$value,";
                        }
                        $s2 = trim($s2,',');
                }

                if(is_array($series3)) {
                        foreach ($series3 as $key=>$value) {
                                $s3 .= "$value,";
                        }
                        $s3 = trim($s3,',');
                }

                if(is_array($series4)) {
                        foreach ($series4 as $key=>$value) {
                                $s4 .= "$value,";
                        }
                        $s4 = trim($s4,',');
                }

                if(is_array($series5)) {
                        foreach ($series5 as $key=>$value) {
                                $s5 .= "$value,";
                        }
                        $s5 = trim($s5,',');
                }


		$line_graph = "
		<style type=\"text/css\">
			${demo.css}
		</style>
		<script type=\"text/javascript\">
		$(function () {
			$('#$id').highcharts({
				chart: {
				type: 'line'
			},
			title: {
				text: '$title'
			},
			subtitle: {
				text: '$subtitle'
			},
			xAxis: {
				categories: [$labels]
			},
			yAxis: {
				title: {
					text: '$title2'
				}
			},
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
			series: [{
				name: '$campaigns[0]',
					data: [$s1]
				} 

				";
				if ($campaigns[1] != "") {
					$line_graph .= "
					,
					{
					name: '$campaigns[1]',
						data: [$s2]
					}
					";
				}
                                if ($campaigns[2] != "") {
					$line_graph .= "
					,
	                                {
        	                        name: '$campaigns[2]',
                	                        data: [$s3]
                        	        }
					";
				}
                                if ($campaigns[3] != "") {
					$line_graph .= "
					,
	                                {
        	                        name: '$campaigns[3]',
                	                        data: [$s4]
                        	        }
					";
				}
                                if ($campaigns[4] != "") {
					$line_graph .= "
					,
	                                {
        	                        name: '$campaigns[4]',
                	                        data: [$s5]
                        	        }
					";
				}
				$line_graph .= "

				]
			});
		});
		</script>

		";
		return ($line_graph);
	}

	public function bar_graph_v2($id,$title,$subtitle,$labels,$series1,$series2,$s1_title,$s2_title) {

		if (is_array($labels)) {
			foreach ($labels as $key=>$value) {
				$categories .= "'$value',";
			}
			$categories = trim($categories,',');
		}

		if (is_array($series1)) {
			foreach ($series1 as $key=>$value) {
				$s1 .= "$value,";
			}
			$s1 = trim($s1,",");
		}

		if (is_array($series2)) {
			foreach ($series2 as $key=>$value) {
				$s2 .= "$value,";
			}
			$s2 = trim($s2,",");
		}

		$bar_graph = "
		<style type=\"text/css\">
			${demo.css}
		</style>
		<script type=\"text/javascript\">
		$(function () {
		    $('#$id').highcharts({
		        chart: {
		            type: 'bar'
		        },
		        title: {
		            text: '$title'
		        },
		        xAxis: {
		            categories: [$categories]
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: '$subtitle'
		            }
		        },
		        legend: {
		            reversed: true
		        },
		        plotOptions: {
		            series: {
		                stacking: 'normal'
		            }
		        },
		        series: [

			{
		            name: '$s2_title',
		            data: [$s2],
			    color: '#FE2E2E'
		        }, 

			{
		            name: '$s1_title',
		            data: [$s1],
			    color: '#088A08'
		        }
			]
		    });
		});
		</script>
		";

		return($bar_graph);

	}


	public function pie_chart_v2($id,$name,$data,$title,$drilldown) {

		$pie_chart = "
		<script type=\"text/javascript\">
		$(function () {
		    // Create the chart
		    $('#$id').highcharts({
		        chart: {
		            type: 'pie'
		        },
		        title: {
		            text: '$title'
		        },
		        subtitle: {
		            text: 'Click to drilldown.'
		        },
		        plotOptions: {
		            series: {
		                dataLabels: {
		                    enabled: false
		                },
		                showInLegend: true
		            }
		        },

		        tooltip: {
		            headerFormat: '<span style=\"font-size:11px\">{series.name}</span><br>',
		            pointFormat: '<span style=\"color:{point.color}\">{point.name}</span>: <b>{point.y}</b> leads<br/>'
		        },
		        series: [{
		            name: '$name',
		            colorByPoint: true,
		            data: [
		";

		$pie_chart .= $data;

		$pie_chart .= "
		                ]
		        }],
		        drilldown: {
		            series: [
				".$drilldown."
		        ]
		        }
		    });
		});
		</script>
		";

		return($pie_chart);
	}

	public function table_chart($id,$tableID,$title) {
		$table_chart = "
		<style type=\"text/css\">
			${demo.css}
		</style>
		<script type=\"text/javascript\">
		$(function () {
		    $('#$id').highcharts({
		        data: {
		            table: '$tableID'
		        },
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: '$title'
		        },
		        yAxis: {
		            allowDecimals: false,
		            title: {
		                text: 'Units'
		            }
		        },
		        tooltip: {
		            formatter: function () {
		                return '<b>' + this.series.name + '</b><br/>' +
		                    this.point.y + ' ' + this.point.name.toLowerCase();
		            }
		        }
		    });
		});
		</script>
		";
		return($table_chart);

	}

	public function heat_chart($id,$data_table,$category,$category2,$title,$type) {
		$heat_chart = "
		<script type=\"text/javascript\">
		$(function () {

		    $('#$id').highcharts({

		        chart: {
		            type: 'heatmap',
		            marginTop: 40,
		            marginBottom: 80,
		            plotBorderWidth: 1
		        },


		        title: {
		            text: '$title'
		        },

		        xAxis: {
		            categories: [$category]
		        },

		        yAxis: {
		            categories: [$category2],
		            title: null
		        },

		        colorAxis: {
		            min: 0,
		            minColor: '#FFFFFF',
		            maxColor: Highcharts.getOptions().colors[0]
		        },

		        legend: {
		            align: 'right',
		            layout: 'vertical',
		            margin: 0,
		            verticalAlign: 'top',
		            y: 25,
		            symbolHeight: 280
		        },

		        tooltip: {
		            formatter: function () {
		                return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> <br><b>' +
		                    this.point.value + '</b> $type <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
		            }
		        },

		        series: [{
		            name: '$type',
		            borderWidth: 1,
		            data: [
				$data_table

				],
		            dataLabels: {
		                enabled: true,
		                color: '#000000'
		            }
		        }]

		    });
		});
		</script>
		";
		return($heat_chart);
	}

	public function hourly_lc_report() {

                if ($_GET['date'] == "") {
	                $date = date("Y/m/d");
        	        $date = date('Y/m/d',strtotime($date . "-1 days"));
			$start = $date;

                	$date2 = date("Y-m-d",strtotime($date . "-1 days"));
	                $date_nice = date('m/d/Y',strtotime($date));
                } else {

                        $date = $_GET['date'];
                        $date2 = date("Y-m-d",strtotime($date));
                        $date_nice = date('m/d/Y',strtotime($date));

                        $start = $_GET['date'];
                        $nice_date = date("m/d/Y",strtotime($start));
                }

                $prev_start = date("Y/m/d",strtotime($start . "-1 days"));
                $prev_nice = date("m/d/Y",strtotime($start . "-1 days"));

                $next_start = date("Y/m/d",strtotime($start . "+1 days"));
                $next_nice = date("m/d/Y",strtotime($start . "+1 days"));

                $today_test = date("Y/m/d");

		if ($_GET['campaigns'] != "") {
			foreach ($_GET['campaigns'] as $key=>$value) {
				$campaigns .= "&campaigns[]=$value";
			}
		}

                print '
                 <ul class="nav nav-pills">
                  <li><a href="index.php?section=hourly_lc_report&date='.$prev_start.$campaigns.'">'.$prev_nice.'</a></li>
                  <li class="active"><a href="index.php?section=hourly_lc_report&date='.$start.$campaigns.'">'.$date_nice.'</a></li>
                ';

                if ($today_test > $next_start) {
                        print '
                          <li><a href="index.php?section=hourly_lc_report&date='.$next_start.$campaigns.'">'.$next_nice.'</a></li>
                        ';
                }
                print "</ul>";
                print "<hr>";

		if ($_GET['campaigns'] == "") {

			for ($x=0; $x < 24; $x++) {
				if ($x < 10) {
					$start = "$date 0$x:00";
					$end = "$date 0$x:59";
				} else {
					$start = "$date $x:00";
					$end = "$date $x:59";
				}
				$data[$x] = $this->get_leads_from_time('',$start,$end);
			}

			$title = "Lead Conduit Daily Email Leads ($date_nice) (Total)";
        	        $width = "900";
                	$height = "600";
			$xaxis = "Per Hour";
			$yaxis = "Email Leads";
			$data_title = "All Campaigns";

                        // new line graph


			$id = "line_graph_1";
                        for ($w=0;$w<24;$w++) {
				$labels .= "'$w',";
			}
			$labels = trim($labels,',');
			$title = "Lead Conduit Daily Email Leads";
			$title2 = "Number Of Leads";
			$subtitle = "$date_nice (Total)";
			$campaigns[] = "All";
			$line_graph = $this->line_graph_v2($id,$labels,$title,$title2,$subtitle,$data,$data2,$data3,$data4,$data5,$campaigns);
			print "$line_graph";

			print "<div id=\"$id\" style=\"min-width: 310px; height: 400px; margin: 0 auto\"></div>";
                        // end new line graph



			// break it down by top 5
			$data = "";
			$campaigns = "";
			$labels = "";
			$data = array();
			$campaigns = array();
			$sql2 = "
			SELECT
				`ls`.`campaign_id`,
				`lc`.`name`,
				COUNT(`ls`.`campaign_id`) AS 'total'

			FROM
				`lc_lead_stats` ls

			LEFT JOIN `lc_campaign` lc ON `ls`.`campaign_id` = `lc`.`campaign_id`

			WHERE
				`ls`.`date` = '$date2'

			GROUP BY `ls`.`campaign_id`

			ORDER BY `total` DESC

			LIMIT 5
			";

			$i = "0";
			$result2 = $this->new_mysql($sql2);
			while ($row2 = $result2->fetch_assoc()) {
		                for ($x=0; $x < 24; $x++) {
        		                if ($x < 10) {
                		                $start = "$date 0$x:00";
                        		        $end = "$date 0$x:59";
		                        } else {
        		                        $start = "$date $x:00";
                		                $end = "$date $x:59";
	                        	}
		                        $data[$i][$x] = $this->get_leads_from_time($row2['campaign_id'],$start,$end);
					$campaigns_array[$i] = $row2['name'];
	        	        }
				$i++;
			}

			// new line graph
                        $id = "line_graph_2";

                        for ($w=0;$w<24;$w++) {
                                $labels .= "'$w',";
                        }
                        $labels = trim($labels,',');
                        $title = "Lead Conduit Daily Email Leads";
                        $title2 = "Number Of Leads";
                        $subtitle = "$date_nice (Top 5)";

                        $campaigns[] = $campaigns_array[0];
                        $campaigns[] = $campaigns_array[1];
                        $campaigns[] = $campaigns_array[2];
                        $campaigns[] = $campaigns_array[3];
                        $campaigns[] = $campaigns_array[4];

                        $line_graph = $this->line_graph_v2($id,$labels,$title,$title2,$subtitle,$data[0],$data[1],$data[2],$data[3],$data[4],$campaigns);
                        print "$line_graph";

                        print "<div id=\"$id\" style=\"min-width: 310px; height: 400px; margin: 0 auto\"></div>";

                        // end new line graph

		} else {
			// show only the campaings selected
			$i = "0";
			foreach ($_GET['campaigns'] as $key=>$value) {
				for ($x=0; $x < 24; $x++) {
                                        if ($x < 10) {
       	                                        $start = "$date 0$x:00";
               	                                $end = "$date 0$x:59";
                       	                } else {
                               	                $start = "$date $x:00";
                                       	        $end = "$date $x:59";
                               	        }
					$data[$i][$x] = $this->get_leads_from_time($value,$start,$end);
					//print "data[$i][$x] > $value,$start,$end<br>";
					$sql2 = "
					SELECT 
						IF(`lc`.`name` != '', `lc`.`name`,`lc`.`campaign_id`) AS 'name'

					FROM 
						`lc_campaign` lc

					WHERE `campaign_id` = '$value'
					";
					$result2 = $this->new_mysql($sql2);
					while ($row2 = $result2->fetch_assoc()) {
						$campaigns_array[$i] = $row2['name'];
					}
				}
				$i++;
			}
                        // new line graph

                        $labels = "";
			$campaigns = "";
			$campaigns = array();

                        $id = "line_graph_3";

                        for ($w=0;$w<24;$w++) {
                                $labels .= "'$w',";
                        }
                        $labels = trim($labels,',');

                        $title = "Lead Conduit Daily Email Leads";
                        $title2 = "Number Of Leads";
                        $subtitle = "$date_nice";

                        $campaigns[] = $campaigns_array[0];
                        $campaigns[] = $campaigns_array[1];
                        $campaigns[] = $campaigns_array[2];
                        $campaigns[] = $campaigns_array[3];
                        $campaigns[] = $campaigns_array[4];

                        $line_graph = $this->line_graph_v2($id,$labels,$title,$title2,$subtitle,$data[0],$data[1],$data[2],$data[3],$data[4],$campaigns);
                        print "$line_graph";

                        print "<div id=\"$id\" style=\"min-width: 310px; height: 400px; margin: 0 auto\"></div>";

                        // end new line graph

		}
		
	}


	/* This function returns a value of leads from a specified time period */
	public function get_leads_from_time($campaign='',$start,$end) {
		/*
		campain = array or null
		start = YYYY/MM/DD HH:MM
		end = YYYY/MM/DD HH:MM
		*/
		if ($campaign != "") {
			$sql_campaign = " AND `campaign_id` = '$campaign'";
		}

		$sql = "
		SELECT 
			COUNT(`email`) AS 'emails' 

		FROM 
			`lc_lead_stats` 

		WHERE 
			`timestamp` BETWEEN '$start' AND '$end'
			$sql_campaign
		";
		$total = "0";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$total = $row['emails'];
		}
		return($total);
	}

	/* This function displays the lead conduit hourly gui filter */
	public function lc_hourly_leads_gui() {
		$template = "lc_hourly_leads_gui.tpl";
                // get list of campaigns
                $sql = "SELECT `campaign_id`,`name` FROM `lc_campaign` ORDER BY `name` ASC";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $options .= "<option value=\"$row[campaign_id]\">$row[name]</option>";
                }
                $data['options'] = $options;

                $this->load_smarty($data,$template);
	}

	/* This function displays the lead conduit daily gui filter */
        public function lc_daily_leads_gui() {
		$template = "lc_daily_leads_gui.tpl";

		// get list of campaigns
		$sql = "SELECT `campaign_id`,`name` FROM `lc_campaign` ORDER BY `name` ASC";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[campaign_id]\">$row[name]</option>";
		}
		$data['options'] = $options;

		$this->load_smarty($data,$template);
	}


	/* Get a list of yeasterdays LC campaigns and show what percentage of leads each had - for stats page */
	public function lc_daily_leads_OLD() {

		if ($_GET['campaigns'] != "") {

			foreach ($_GET['campaigns'] as $key=>$value) {
				$campaign_sql .= "'$value',";
				$campaign_pills .= "&campaigns[]=$value";
			}
			$campaign_sql = trim($campaign_sql,",");

			$campaign_sql = " AND `ls`.`campaign_id` IN ($campaign_sql) ";

		}


		if ($_GET['date'] == "") {
		        $today = date("Y-m-d");
        		$start = date('Y-m-d',strtotime($today . "-1 days"));
			$nice_date = date("m/d/Y",strtotime($today . "-1 days"));
		} else {
			$start = $_GET['date'];
			$nice_date = date("m/d/Y",strtotime($start));
		}

		$prev_start = date("Y-m-d",strtotime($start . "-1 days"));
		$prev_nice = date("m/d/Y",strtotime($start . "-1 days"));

		$next_start = date("Y-m-d",strtotime($start . "+1 days"));
		$next_nice = date("m/d/Y",strtotime($start . "+1 days"));

		$today_test = date("Y-m-d");

		print '
		 <ul class="nav nav-pills">
		  <li><a href="index.php?section=lc_daily_leads&date='.$prev_start.$campaign_pills.'">'.$prev_nice.'</a></li>
		  <li class="active"><a href="index.php?section=lc_daily_leads&date='.$start.$campaign_pills.'">'.$nice_date.'</a></li>
		';

		if ($today_test > $next_start) { 
			print '
			  <li><a href="index.php?section=lc_daily_leads&date='.$next_start.$campaign_pills.'">'.$next_nice.'</a></li>
			';
		}
		print "</ul>";
		print "<hr>";

		$sql = "
		SELECT
			`ls`.`campaign_id`,
			`lc`.`name`,
			COUNT(`ls`.`campaign_id`) AS 'total',
			SUM(`ls`.`email_status`) AS 'good',
			COUNT(`ls`.`campaign_id`) - SUM(`ls`.`email_status`) AS 'bad'

		FROM
			`lc_lead_stats` ls

		LEFT JOIN `lc_campaign` lc ON `ls`.`campaign_id` = `lc`.`campaign_id`

		WHERE
			`ls`.`date` = '$start'
			$campaign_sql
	
		GROUP BY `ls`.`campaign_id`

		ORDER BY `total` DESC
		";

		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$found = "1";
			$good[] = $row['good'];
			$bad[] = $row['bad'];
			$total[] = $row['total'];
			$labels[] = $row['name'];

			if ($row['good'] > 0) {
				$pie_good[] = $row['good'];
				$pie_good_labels[] = $row['name'];
				$count1++;
			}

			if ($row['bad'] > 0) {
				$pie_bad[] = $row['bad'];
				$pie_bad_labels[] = $row['name'];
			}
		}

		if ($found != "1") {
			print '
			<br><br><font color=red><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error: we did not find any data for <b>'.$nice_date.'</b>.</font><br>
			';
			die;
		}

		$title = "Lead Conduit Stats for $nice_date";
		$width = "800";
		$height = "600";

		//$image = $this->pie_graph($title,$width,$height,'0',$good,$labels);
		$image = $this->stacked_bar($title,$width,$height,'0',$good,$bad,$labels);
		print "$image";
		print "<br><br>";

		$title = "Campaigns : Valid Emails";
                $image = $this->pie_graph($title,$width,$height,'0',$pie_good,$pie_good_labels);
                print "$image";
                print "<br><br>";

                $title = "Campaigns : Invalid Emails";
                $image = $this->pie_graph($title,$width,$height,'0',$pie_bad,$pie_bad_labels);
                print "$image";
                print "<br>";


/*
                $title = "Invalid Emails";
                $image = $this->pie_graph($title,$width,$height,'0',$bad,$labels);
                print "$image";
                print "<br>";		
*/
	
	}

	// https://api.leadconduit.com/stats/leads?campaign_id=05410eojb&start=2016-01-01&end=2016-07-16&api_key=Fed2f1b49cfdd495b9ab6620a73fafc1
	// status = good, invalid, rejected, returned, converted
	public function get_leads($url,$campaign_id,$start,$end,$page="&page=1",$rtn='') {
		$url .= "?campaign_id=".$campaign_id;
		$url .= "&start=".$start;
		$url .= "&end=".$end;
		$url .= $page;
		//$url .= "&status=".$status;
		$url .= "&api_key=".lc_apikey;
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$array = $this->objectToArray($obj);
		if ($rtn == "get_pages") {
			$pages = $array['page_count'];
			return($pages);
		} else {
			return($array);
		}
	}


	public function lc_get_advertisers($url) {
		print "Running!<br>";
		$url .= lc_apikey;
                $json = file_get_contents($url);
                $obj = json_decode($json);
                $array = $this->objectToArray($obj);

                $count = $array['count'];
                for ($x=0; $x < $count; $x++) {
                        $advertiser_id = $array['items'][$x]['advertiser_id'];
                        $name = $array['items'][$x]['name'];
			$name = str_replace("'","`",$name);
                        $active = $array['items'][$x]['is_active'];

			$sql = "SELECT `advertiser_id` FROM `lc_advertisers` WHERE `advertiser_id` = '$advertiser_id'";
			$result = $this->new_mysql($sql);
			$found = "0";
			while ($row = $result->fetch_assoc()) {
				$found = "1";
			}
			if ($found == "1") {
				$sql2 = "UPDATE `lc_advertisers` SET `name` = '$name', `is_active` = '$active' WHERE `advertiser_id` = '$advertiser_id'";
			} else {
				$sql2 = "INSERT INTO `lc_advertisers` (`advertiser_id`,`name`,`is_active`) VALUES ('$advertiser_id','$name','$active')";
			}
			//print "SQL: $sql2<br>\n";
                        $result2 = $this->new_mysql($sql2);
                }

	}

	public function lc_test() {

		$url = "https://api.leadconduit.com/campaigns?api_key=". lc_apikey;
		$json = file_get_contents($url);
		$obj = json_decode($json);
		$array = $this->objectToArray($obj);

		$count = $array['count'];
		for ($x=0; $x < $count; $x++) {
			$advertiser_id = $array['items'][$x]['advertiser_id'];
			print "#$x - $advertiser_id<br>";
			$name = $array['items'][$x]['name'];
			print "$name<br>";
			$active = $array['items'][$x]['is_active'];
			print "Active $active<br><hr>";
		}

	}


	/* This function first gets the top 10 affiliates either clicks, revenue or conversions and builds an array of AF ID to be used 
	in a 2nd function that will then build out a 5 day heat map. Data is generated for the starting date only to organize who is
	in the top 10 to be used in the 2nd function. */

	public function get_daily_heat_affiliates($type) {
                $date = date("Ymd");
                $yday = date('Ymd',strtotime($date . "-1 days"));
                $yday2 = date('m/d/Y',strtotime($date . "-1 days"));

                switch ($type) {
                        case "clicks":
                        $sqlA = "SUM(`h`.`clicks`) AS 'value'";
                        $order = "clicks";
                        $title = "Clicks";
                        break;

                        case "revenue":
                        $sqlA = "SUM(`h`.`revenue`) AS 'value'";
                        $order = "revenue";
                        $title = "Revenue";
                        break;

                        case "conversions":
                        $sqlA = "SUM(`h`.`conversions`) AS 'value'";
                        $order = "conversions";
                        $title = "Conversions";
                        break;
                }

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
                        `ad`.`name`,
                        $sqlA

                FROM
                        `hasOffer_Daily_Stats` h

                LEFT JOIN `affiliate_id` ad ON `h`.`affiliate_id` = `ad`.`affiliateID`

                WHERE
                        `h`.`db_date` BETWEEN '$yday' AND '$yday'

                GROUP BY `h`.`affiliate_id`

                ORDER BY `$order` DESC

                LIMIT 10
                ";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$id = $row['affiliate_id'];
			$af[$id]['name'] = $row['name'];
			$af[$id][$type] = $row['value'];
		}
		return ($af);
	}

	/* This function will get the data for the type (click, revenue or conversion) on the specified date and the specified affiliate and will return the data 
	date format: Ymd
	*/
        public function get_daily_heat_affiliates_data($type,$affiliateID,$date) {
                switch ($type) {
                        case "clicks":
                        $sqlA = "SUM(`h`.`clicks`) AS 'value'";
                        $order = "clicks";
                        $title = "Clicks";
                        break;

                        case "revenue":
                        $sqlA = "SUM(`h`.`revenue`) AS 'value'";
                        $order = "revenue";
                        $title = "Revenue";
                        break;

                        case "conversions":
                        $sqlA = "SUM(`h`.`conversions`) AS 'value'";
                        $order = "conversions";
                        $title = "Conversions";
                        break;
                }

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
                        $sqlA

                FROM
                        `hasOffer_Daily_Stats` h

                WHERE
                        `h`.`db_date` BETWEEN '$date' AND '$date'
			AND `h`.`affiliate_id` = '$affiliateID'

                GROUP BY `h`.`affiliate_id`

                ORDER BY `$order` DESC

                ";
		$value = "0";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
			$value = $row['value'];
                }
                return ($value);
        }


        public function get_daily($type) {
                $date = date("Ymd");
                $yday = date('Ymd',strtotime($date . "-1 days"));
                $yday2 = date('m/d/Y',strtotime($date . "-1 days"));

		switch ($type) {
			case "clicks":
			$sqlA = "SUM(`h`.`clicks`) AS 'clicks'";
			$order = "clicks";
			$title = "Clicks";
			break;

			case "revenue":
                        $sqlA = "SUM(`h`.`revenue`) AS 'revenue'";
                        $order = "revenue";
                        $title = "Revenue";
                        break;

                        case "conversions":
                        $sqlA = "SUM(`h`.`conversions`) AS 'conversions'";
                        $order = "conversions";
                        $title = "Conversions";
                        break;


		}

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
			`ad`.`name`,
                        $sqlA

                FROM
                        `hasOffer_Daily_Stats` h

		LEFT JOIN `affiliate_id` ad ON `h`.`affiliate_id` = `ad`.`affiliateID`

                WHERE
                        `h`.`db_date` BETWEEN '$yday' AND '$yday'

                GROUP BY `h`.`affiliate_id`

		ORDER BY `$order` DESC

		LIMIT 10
                ";
                $affiliate = array();
                $clicks = array();

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $affiliate[] = $row['name'];
                        $data[] = $row[$order];
                }
                $image = $this->bar_graph($affiliate,'Top 10 Affiliates ('.$yday2.')','Affiliates (HasOffer)',$title,$data,'500','400','0');
                print "$image";
        }


	/* This function is the GUI for get_daily_table */
	public function get_daily_table_gui() {
		$template = "get_daily_table_gui.tpl";
		$sql = "SELECT `affiliateID`,`name` FROM `affiliate_id` WHERE `status` = 'Active'";
		$result = $this->new_mysql($sql);
		while ($row = $result->fetch_assoc()) {
			$options .= "<option value=\"$row[affiliateID]\">$row[name]</option>";
		}
		$data['options'] = $options;
		$this->load_smarty($data,$template);
	}


	/* This function will return the clicks, revenue and conversions for the affilate */
        public function get_daily_table() {

                if ($_GET['date'] == "") {
                        $date = date("Ymd");
                        $yday = date('Ymd',strtotime($today . "-1 days"));
			$yday2 = date('m/d/Y',strtotime($date . "-1 days"));
                } else {
                        $yday = $_GET['date'];
			$yday = str_replace("-","",$yday);
                        $yday = str_replace("/","",$yday);
                        $yday2 = date("m/d/Y",strtotime($yday));
                }

                $prev_start = date("Y-m-d",strtotime($yday . "-1 days"));
                $prev_nice = date("m/d/Y",strtotime($yday . "-1 days"));

                $next_start = date("Y-m-d",strtotime($yday . "+1 days"));
                $next_nice = date("m/d/Y",strtotime($yday . "+1 days"));

                $today_test = date("Y-m-d");

                if ($_GET['affiliate'] != "") {
                        foreach ($_GET['affiliate'] as $key=>$value) {
				$affiliate .= "&affiliate[]=$value";
			}
		}

                print '
                 <ul class="nav nav-pills">
                  <li><a href="index.php?section=get_daily_table&date='.$prev_start.$affiliate.'">'.$prev_nice.'</a></li>
                  <li class="active"><a href="index.php?section=get_daily_table&date='.$yday.$affiliate.'">'.$yday2.'</a></li>
                ';

                if ($today_test > $next_start) {
                        print '
                          <li><a href="index.php?section=get_daily_table&date='.$next_start.$affiliate.'">'.$next_nice.'</a></li>
                        ';
                }
                print "</ul>";
		print "<h2>Affiliates Daily Stats</h2>";
                print "<hr>";

		if ($_GET['affiliate'] != "") {
			foreach ($_GET['affiliate'] as $key=>$value) {
				$affiliate_id .= "'$value',";
			}
			$affiliate_id = trim($affiliate_id,",");
			$affiliate_id_sql = "AND `h`.`affiliate_id` IN ($affiliate_id)";
		}

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
			SUM(`h`.`clicks`) AS 'clicks',
			SUM(`h`.`revenue`) AS 'revenue',
			SUM(`h`.`conversions`) AS 'conversions',
			`ad`.`name`
                FROM
                        `hasOffer_Daily_Stats` h

		LEFT JOIN `affiliate_id` ad ON `h`.`affiliate_id` = `ad`.`affiliateID`

                WHERE
                        `h`.`db_date` BETWEEN '$yday' AND '$yday'
			$affiliate_id_sql

                GROUP BY `h`.`affiliate_id`

                ORDER BY `clicks` DESC, `revenue` DESC, `conversions` DESC

                ";
                $affiliate = array();
                $clicks = array();

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
			$html .= "<tr><td>$row[name] ($row[affiliate_id])</td><td>$row[clicks]</td><td>$row[revenue]</td><td>$row[conversions]</td></tr>";
                }


		$id = "table_chart_1";
		$tableID = "datatable1";
		$title = "HasOffer Affiliates Daily Stats";
		$table_chart = $this->table_chart($id,$tableID,$title);
		print "$table_chart";

		print "<div id=\"$id\" style=\"min-width: 310px; height: 600px; margin: 0 auto\"></div>";

		print "<table class=\"table\" id=\"$tableID\">
		<tr><th><b>Affiliate</b></th><th><b>Clicks</b></th><th><b>Revenue</b></th><th><b>Conversions</b></th></tr>
		$html
		</table>";
        }


        public function get_weekly($type) {
                $date = date("Ymd");
                $yday = date('Ymd',strtotime($date . "-1 days"));
                $yday_format = date('m/d/Y',strtotime($date . "-1 days"));

                $yday2 = date('Ymd',strtotime($date . "-8 days"));
                $yday2_format = date('m/d/Y',strtotime($date . "-8 days"));

                switch ($type) {
                        case "clicks":
                        $sqlA = "SUM(`h`.`clicks`) AS 'clicks'";
                        $order = "clicks";
                        $title = "Clicks";
                        break;

                        case "revenue":
                        $sqlA = "SUM(`h`.`revenue`) AS 'revenue'";
                        $order = "revenue";
                        $title = "Revenue";
                        break;

                        case "conversions":
                        $sqlA = "SUM(`h`.`conversions`) AS 'conversions'";
                        $order = "conversions";
                        $title = "Conversions";
                        break;
                }

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
			`ad`.`name`,
			$sqlA

                FROM
                        `hasOffer_Daily_Stats` h

                LEFT JOIN `affiliate_id` ad ON `h`.`affiliate_id` = `ad`.`affiliateID`


                WHERE
                        `h`.`db_date` BETWEEN '$yday2' AND '$yday'

                GROUP BY `h`.`affiliate_id`

                ORDER BY `$order` DESC

                LIMIT 10
                ";
                $affiliate = array();
                $clicks = array();

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $affiliate[] = $row['name'];
                        $data[] = $row[$order];
                }

                $image = $this->bar_graph($affiliate,'Top 10 Affiliates ('.$yday2_format.' to '.$yday_format.')','Affiliates (HasOffer)',$title,$data,'500','400','0');
                print "$image";

        }

	/* This function is the GUI for get_weekly_table */
	public function get_weekly_table_gui() {
		$template = "get_weekly_table_gui.tpl";
                $sql = "SELECT `affiliateID`,`name` FROM `affiliate_id` WHERE `status` = 'Active'";
                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $options .= "<option value=\"$row[affiliateID]\">$row[name]</option>";
                }
                $data['options'] = $options;
                $this->load_smarty($data,$template);
	}

	/* This function returns the clicks, revenue and conversions for the affiliates in a week period. */
        public function get_weekly_table() {
                if ($_GET['date'] == "") {
	                $date = date("Ymd");
        	        $yday = date('Ymd',strtotime($date . "-1 days"));
                	$yday_format = date('m/d/Y',strtotime($date . "-1 days"));

	                $yday2 = date('Ymd',strtotime($date . "-8 days"));
        	        $yday2_format = date('m/d/Y',strtotime($date . "-8 days"));

                } else {

	                $date = $_GET['date'];
        	        $yday = date('Ymd',strtotime($date . "-0 days"));
	                $yday_format = date('m/d/Y',strtotime($date . "-0 days"));

        	        $yday2 = date('Ymd',strtotime($date . "-7 days"));
                	$yday2_format = date('m/d/Y',strtotime($date . "-7 days"));

                }

                $prev_start = date("Y-m-d",strtotime($yday . "-7 days"));
                $prev_nice = date("m/d/Y",strtotime($yday . "-7 days"));

                $next_start = date("Y-m-d",strtotime($yday . "+7 days"));
                $next_nice = date("m/d/Y",strtotime($yday . "+7 days"));

                $today_test = date("Y-m-d");

                if ($_GET['affiliate'] != "") {
                        foreach ($_GET['affiliate'] as $key=>$value) {
                                $affiliate .= "&affiliate[]=$value";
                        }
                }

                print '
                 <ul class="nav nav-pills">
                  <li><a href="index.php?section=get_weekly_table&date='.$prev_start.$affiliate.'">'.$prev_nice.'</a></li>
                  <li class="active"><a href="index.php?section=get_weekly_table&date='.$yday.$affiliate.'">'.$yday_format.'</a></li>
                ';

                if ($today_test > $next_start) {
                        print '
                          <li><a href="index.php?section=get_weekly_table&date='.$next_start.$affiliate.'">'.$next_nice.'</a></li>
                        ';
                }
                print "</ul>";
                print "<h2>Affiliates Weekly Stats</h2>";
                print "<hr>";

                if ($_GET['affiliate'] != "") {
                        foreach ($_GET['affiliate'] as $key=>$value) {
                                $affiliate_id .= "'$value',";
                        }
                        $affiliate_id = trim($affiliate_id,",");
                        $affiliate_id_sql = "AND `h`.`affiliate_id` IN ($affiliate_id)";
                }

                $sql = "
                SELECT
                        `h`.`affiliate_id`,
                        `ad`.`name`,
                        SUM(`h`.`clicks`) AS 'clicks',
                        SUM(`h`.`revenue`) AS 'revenue',
                        SUM(`h`.`conversions`) AS 'conversions'

                FROM
                        `hasOffer_Daily_Stats` h

                LEFT JOIN `affiliate_id` ad ON `h`.`affiliate_id` = `ad`.`affiliateID`


                WHERE
                        `h`.`db_date` BETWEEN '$yday2' AND '$yday'
			$affiliate_id_sql

                GROUP BY `h`.`affiliate_id`

                ORDER BY `h`.`clicks` DESC, `h`.`revenue` DESC, `h`.`conversions` DESC

                ";
                $affiliate = array();
                $clicks = array();

                $result = $this->new_mysql($sql);
                while ($row = $result->fetch_assoc()) {
                        $html .= "<tr><td>$row[name] ($row[affiliate_id])</td><td>$row[clicks]</td><td>$row[revenue]</td><td>$row[conversions]</td></tr>";

                }

                $id = "table_chart_1";
                $tableID = "datatable1";
                $title = "HasOffer Affiliates Weekly Stats";
                $table_chart = $this->table_chart($id,$tableID,$title);
                print "$table_chart";

                print "<div id=\"$id\" style=\"min-width: 310px; height: 600px; margin: 0 auto\"></div>";


                print "<table class=\"table\" id=\"$tableID\">
                <tr><th><b>Affiliate</b></th><th><b>Clicks</b></th><th><b>Revenue</b></th><th><b>Conversions</b></th></tr>
                $html
                </table>";
        }


	public function stacked_bar($title,$width,$height,$display='1',$data1y,$data2y,$labels) {
		require_once ('jpgraph/src/jpgraph.php');
		require_once ('jpgraph/src/jpgraph_bar.php');
 
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
 
		//$data1y=array(12,8,19,3,10,5);
		//$data2y=array(8,2,11,7,14,4);
 
		// Create the graph. These two calls are always required
		$graph = new Graph($width,$height);    
		$graph->SetScale("textlin");
 
		$graph->SetShadow();
		//$graph->img->SetMargin(40,30,20,40);
                $graph->img->SetMargin(80,50,40,180);

 
		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b1plot->SetFillColor("green");
		$b2plot = new BarPlot($data2y);
		$b2plot->SetFillColor("red");
 
		// Create the grouped bar plot
		$gbplot = new AccBarPlot(array($b1plot,$b2plot));
 
		// ...and add it to the graPH
		$graph->Add($gbplot);


                $graph->xaxis->SetTickLabels($labels); // data should be an array
                $graph->xaxis->SetLabelAngle(50);
 
		$graph->title->Set($title);
		$graph->xaxis->title->Set("Campaigns");
		$graph->yaxis->title->Set("Lead Conduit Leads (Email Valud / Not Valid)");

                $graph->yaxis->title->SetMargin(25); // this sets the position of the Y title
                $graph->xaxis->title->SetMargin(25); // this sets the position of the X title
 
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
                // Display the graph
                if ($display == "1") {
                        $graph->Stroke();
                } else {
                        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
                        $rand = date("U");
                        $rand .= rand(50,600);
                        $fileName = ".output/$rand.png";
                        $graph->img->Stream($fileName);
                        $image = '<img src="'.SITE_URL.'/'.$fileName.'">';
                        return $image;
                }
	}


	public function pie_graph($title,$width,$height,$display='1',$data,$labels) {

		require_once ('jpgraph/src/jpgraph.php');
		require_once ('jpgraph/src/jpgraph_pie.php');
		require_once ('jpgraph/src/jpgraph_pie3d.php');

		// Create the Pie Graph. 
		$graph = new PieGraph($width,$height);

		$theme_class= new VividTheme;
		$graph->SetTheme($theme_class);

		// Set A title for the plot
		$graph->title->Set($title);

		// Create
		$p1 = new PiePlot3D($data);
		$graph->Add($p1);

		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->ExplodeSlice(1);

		$p1->SetLegends($labels);
		//$p1->SetCenter(0.4);

		$graph->legend->SetPos(0.5,0.99,'center','bottom');
		$graph->legend->SetColumns(3);

                // Display the graph
                if ($display == "1") {
                        $graph->Stroke();
                } else {
                        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
                        $rand = date("U");
                        $rand .= rand(50,600);
                        $fileName = ".output/$rand.png";
                        $graph->img->Stream($fileName);
                        $image = '<img src="'.SITE_URL.'/'.$fileName.'">';
                        return $image;
                }

	}

	/*
		$affiliate - This is an array holding each affiliateID
		$title - This is the title of the graph
		$xaxis - The xaxis title
		$yaxis - The yaxis title
		$data - The data in an array to line up with the affiliate
		$width - The width of the graph
		$height - The height of the graph
		$display - 1 will place the graph to memory (default). Any other value will put it to disk

	*/
	public function bar_graph($affiliate,$title,$xaxis,$yaxis,$data,$width,$height,$display='1') {
		require_once ('jpgraph/src/jpgraph.php');
		require_once ('jpgraph/src/jpgraph_bar.php');


		// Create the graph. These two calls are always required
		$graph = new Graph($width,$height);
		$graph->SetScale('textlin');

		// Add a drop shadow
		$graph->SetShadow();

		// Adjust the margin a bit to make more room for titles
		//$graph->SetMargin(80,140,20,40);
                $graph->SetMargin(80,50,40,150);

		// Create a bar pot
		$bplot = new BarPlot($data);
		$graph->Add($bplot);

		//$bplot->SetFillColor(array('purple','blue','green','orange','red'));
		//$graph->Add($bplot);


		// Setup the titles
		$graph->title->Set($title);
		$graph->yaxis->title->SetMargin(25); // this sets the position of the Y title
                $graph->xaxis->title->SetMargin(105); // this sets the position of the X title

		$graph->xaxis->title->Set($xaxis);
		$graph->yaxis->title->Set($yaxis);

		$graph->xaxis->SetTickLabels($affiliate); // data should be an array
		$graph->xaxis->SetLabelAngle(50);

		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		// Display the graph
		if ($display == "1") {
			$graph->Stroke();
		} else {
			$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
			$rand = date("U");
			$rand .= rand(50,600);
			$fileName = ".output/$rand.png";
			$graph->img->Stream($fileName);
			$image = '<img src="'.SITE_URL.'/'.$fileName.'">';
			return $image;
		}
	}


        public function line_graph($title,$xaxis,$yaxis,$width,$height,$data,$data_title,
	$data1,$data_title1,
        $data2,$data_title2,
        $data3,$data_title3,
        $data4,$data_title4,
        $data5,$data_title5,
        $data6,$data_title6,
        $data7,$data_title7,
        $data8,$data_title8,
        $data9,$data_title9,
        $data10,$data_title10,
	$display='1') {
                require_once ('jpgraph/src/jpgraph.php');
                require_once ('jpgraph/src/jpgraph_line.php');

                // Create the graph and specify the scale for both Y-axis
                $graph = new Graph($width,$height);
                $graph->SetScale('textlin');

		$graph->img->SetAntiAliasing(false); 

                //$graph->SetY2Scale('lin');
                $graph->SetShadow();

                // Adjust the margin
                $graph->img->SetMargin(80,300,20,40);

		$graph->xgrid->Show();

                // Create the two linear plot
                if (is_array($data)) {
                        $lineplot=new LinePlot($data);
                }

                if (is_array($data1)) {
                        $lineplot1=new LinePlot($data1);
                }
                if (is_array($data2)) {
                        $lineplot2=new LinePlot($data2);
                }
                if (is_array($data3)) {
                        $lineplot3=new LinePlot($data3);
                }
                if (is_array($data4)) {
                        $lineplot4=new LinePlot($data4);
                }
                if (is_array($data5)) {
                        $lineplot5=new LinePlot($data5);
                }
                if (is_array($data6)) {
                        $lineplot6=new LinePlot($data6);
                }
                if (is_array($data7)) {
                        $lineplot7=new LinePlot($data7);
                }
                if (is_array($data8)) {
                        $lineplot8=new LinePlot($data8);
                }
                if (is_array($data9)) {
                        $lineplot9=new LinePlot($data9);
                }
                if (is_array($data10)) {
                        $lineplot10=new LinePlot($data10);
                }

                // Add the plot to the graph
                if (is_array($data)) {
                        $graph->Add($lineplot);
                        $lineplot->SetColor('blue');
                        $lineplot->SetWeight(4);
                        $lineplot->SetLegend($data_title);
                }
                if (is_array($data1)) {
                        $graph->Add($lineplot1);
                        $lineplot1->SetColor('green');
                        $lineplot1->SetWeight(4);
                        $lineplot1->SetLegend($data_title1);
                }
                if (is_array($data2)) {
                        $graph->Add($lineplot2);
                        $lineplot2->SetColor('blue');
                        $lineplot2->SetWeight(4);
                        $lineplot2->SetLegend($data_title2);
                }
                if (is_array($data3)) {
                        $graph->Add($lineplot3);
                        $lineplot3->SetColor('red');
                        $lineplot3->SetWeight(4);
                        $lineplot3->SetLegend($data_title3);
                }
                if (is_array($data4)) {
                        $graph->Add($lineplot4);
                        $lineplot4->SetColor('orange');
                        $lineplot4->SetWeight(4);
                        $lineplot4->SetLegend($data_title4);
                }
                if (is_array($data5)) {
                        $graph->Add($lineplot5);
                        $lineplot5->SetColor('yellow');
                        $lineplot5->SetWeight(4);
                        $lineplot5->SetLegend($data_title5);
                }
                if (is_array($data6)) {
                        $graph->Add($lineplot6);
                        //$lineplot6->SetColor('blue');
                        $lineplot6->SetWeight(4);
                        $lineplot6->SetLegend($data_title6);
                }
                if (is_array($data7)) {
                        $graph->Add($lineplot7);
                        //$lineplot7->SetColor('blue');
                        $lineplot7->SetWeight(4);
                        $lineplot7->SetLegend($data_title7);
                }
                if (is_array($data8)) {
                        $graph->Add($lineplot8);
                        //$lineplot8->SetColor('blue');
                        $lineplot8->SetWeight(4);
                        $lineplot8->SetLegend($data_title8);
                }
                if (is_array($data9)) {
                        $graph->Add($lineplot9);
                        //$lineplot9->SetColor('blue');
                        $lineplot9->SetWeight(4);
                        $lineplot9->SetLegend($data_title9);
                }
                if (is_array($data10)) {
                        $graph->Add($lineplot10);
                        //$lineplot10->SetColor('blue');
                        $lineplot10->SetWeight(4);
                        $lineplot10->SetLegend($data_title10);
                }

                $graph->title->Set($title);

		for ($x=0; $x < 24; $x++) {
			$lbl[] = $x;
		}


                $graph->xaxis->title->Set($xaxis);
                $graph->yaxis->title->Set($yaxis);

                $graph->xaxis->SetTickLabels($lbl);
                $graph->yaxis->title->SetMargin(25);
                $graph->xaxis->title->SetMargin(25);

                //$graph->yaxis->SetTitleMargin(.9);

                $graph->title->SetFont(FF_FONT1,FS_BOLD);
                $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
                $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

                // Adjust the legend position
                $graph->legend->SetColumns('1');
                $graph->legend->Pos(0.05,0.5,'right','top');

                // Display the graph
                if ($display == "1") {
                        $graph->Stroke();
                } else {
                        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
                        $rand = date("U");
                        $rand .= rand(50,600);
                        $fileName = ".output/$rand.png";
                        $graph->img->Stream($fileName);
                        $image = '<img src="'.SITE_URL.'/'.$fileName.'">';
                        return $image;
                }
        }




	// Gets a list of Affiliate IDs
	public function get_aff_id() {

		$args = array(
	                'NetworkId' => NetworkId,
        	        'Target' => 'Affiliate',
                	'Method' => 'findAll',
	                'NetworkToken' => NetworkToken,
        	        'fields' => array(
	                    'affiliate_tier_id'
	                ),
        	        'contain' => array(
                	    'Stat'
	                )
		);
		$this->hasOfferAPI($args,'affiliate');

	}

	public function get_raw_data($date,$affID) {
                $args = array(
                    'NetworkId' => NetworkId,
                    'Target' => 'Report',
                    'Method' => 'getStats',
                    'NetworkToken' => NetworkToken,
                    'fields' => array(
                        'Stat.date',
                        'Stat.affiliate_id',
                        'Stat.offer_id',
                        'Stat.affiliate_info1',
                        'Stat.affiliate_info2',
                        'Stat.affiliate_info5',
                        'Stat.gross_clicks',
                        'Stat.clicks',
                        'Stat.conversions',
                        'Stat.cpc',
                        'Stat.revenue',
                        'Stat.epc'
                    ),

			'filters' => array(
				'Stat.affiliate_id' => array(
	       	        		'conditional' => 'EQUAL_TO',
		                	'values' => $affID
				)
			),

                    'data_start' => $date,
                    'data_end' => $date
                );
		$this->hasOfferAPI($args,'raw');
	}

	/*
	PARAMS for hasOfferAPI:

		$args = The array of hasOffer data to send
		$call = what internal function to execute defined below:
			affiliate = get a list of affiliates and populate the affiliate list table
			raw = gets data by date and affiliateID
	*/

	public function hasOfferAPI($args,$call) {

	    // Specify API URL
	    define('HASOFFERS_API_URL', 'https://api.hasoffers.com/Apiv3/json');
 
	    // Initialize cURL
	    $curlHandle = curl_init();
 
	    // Configure cURL request
	    curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));
 
	    // Make sure we can access the response when we execute the call
	    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
 
	    // Execute the API call
	    $jsonEncodedApiResponse = curl_exec($curlHandle);
 
	    // Ensure HTTP call was successful
	    if($jsonEncodedApiResponse === false) {
	        throw new \RuntimeException(
	            'API call failed with cURL error: ' . curl_error($curlHandle)
	        );
	    }
 
	    // Clean up the resource now that we're done with cURL
	    curl_close($curlHandle);
 
	    // Decode the response from a JSON string to a PHP associative array
	    $apiResponse = json_decode($jsonEncodedApiResponse, true);
 
	    // Make sure we got back a well-formed JSON string and that there were no
	    // errors when decoding it
	    $jsonErrorCode = json_last_error();
	    if($jsonErrorCode !== JSON_ERROR_NONE) {
	        throw new \RuntimeException(
	            'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
	        );
	    }
 
	    // Print out the response details
	    // We also only report on data. Errors are not recorded.
	    if($apiResponse['response']['status'] === 1) {
			switch ($call) {
				case "affiliate":
				$data = $apiResponse['response']['data'];
				foreach ($data as $key=>$value) {
					$sql = "SELECT `affiliateID` FROM `affiliate_id` WHERE `affiliateID` = '$key'";
					$result = $this->new_mysql($sql);
					$found = "0";
					while ($row = $result->fetch_assoc()) {
						$found = "1";
					}
					if ($found == "0") {
						$sql = "INSERT INTO `affiliate_id` (`affiliateID`) VALUES ('$key')";
						$result = $this->new_mysql($sql);
					}
				}
				break;

				case "raw":
		                        $data = $apiResponse['response']['data']['data'][0]['Stat'];
		                        $db_date = str_replace('-','',$data['date']);

					if ($db_date != "") {
		                                $sql = "INSERT INTO `hasOffer_Daily_Stats` (`db_date`,`date`,`affiliate_id`,`offer_id`,`affiliate_info1`,`affiliate_info2`,`affiliate_info5`,`gross_clicks`,`clicks`,`conversions`,`cpc`,`revenue`,`epc`) VALUES
        		                        ('$db_date','$data[date]','$data[affiliate_id]','$data[offer_id]','$data[affiliate_info1]','$data[affiliate_info2]','$data[affiliate_info5]','$data[gross_clicks]','$data[clicks]','$data[conversions]',
                		                '$data[cpc]','$data[revenue]','$data[epc]')";
                        		        $result = $this->new_mysql($sql);
						if ($result == "TRUE") {
							print "$data[affiliate_id] done!<br>";
						}
					}

				break;
			}

	    }
	}




}
?>
