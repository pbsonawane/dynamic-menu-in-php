<?php
	// PROJECT RELATED FUNCTIONS
	class PHP_fun 
	{
		function getConfig()
		{
			$this->DB_SERVER = 'localhost';
			$this->DB_USER = 'root';
			$this->DB_PASS = '';
			$this->DB_NAME = 'menu';
		
		}
	
		function __construct()
		{
			$this->getConfig();
			$Conn = mysql_connect($this->DB_SERVER, $this->DB_USER, $this->DB_PASS);
			if (!$Conn)
				die("Error: ".mysql_errno($Conn).":- ".mysql_error($Conn));
			$DB_select = mysql_select_db($this->DB_NAME, $Conn);
			if (!$DB_select)
				die("Error: ".mysql_errno($Conn).":- ".mysql_error($Conn));
		}

		function select_row($sql)
		{
			//echo $sql . "<br />";
			if ($sql!="")
			{
				$result = mysql_query($sql) or die("Error: ".mysql_errno().":- ".mysql_error());
				if ($result)
				{
					while($row = mysql_fetch_array($result))
						$data[] = $row;
				}
				return $data;
			}
		}

		function recordCount($sql)
		{
			if ($sql!="")
			{
				$result = mysql_query($sql) or die("Error: ".mysql_errno().":- ".mysql_error());
				if ($result)
				{
					$cnt = mysql_num_rows($result);
					return $cnt;
				}
			}
		}

		function createProductUrl($url)
		{
			$url = trim($url);
			if ($url != "")
			{
				$url = trim(str_replace(" ","-",$url));
				//return $url.".html";
				return $url;
			}
		}
		
		function getChild($id)
		{
			$menu = "";
			$str = "";
			$s = "select id,title,parentid,link from ms_product where parentid = '$id' ";
			$res = $this->select_row($s);
			$menu .= '<div id="'.$id.'" style="display:none; position:absolute;" onmouseover="javascript: return showId('.$id.');" onmouseout="javascript: return hideId('.$id.');">';
			$menu .= '<table border="1" cellspacing="0" cellpadding="0" style="border: 1px solid #FDCB55;  border-collapse:collapse;">';
			for ($i=0;$i<count($res);$i++)
			{
				$cnt_of_child = $this->recordCount("select id from ms_product where parentid = '".$res[$i][id]."' ");
				if ($cnt_of_child > 0)
					$str = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="arrow_white.gif">';
				else
					$str = " ";
					
				
				$menu .= '<tr height="20"><td align="left"  class="aerial12" onmouseover="this.className=\'aerial12over\';return showId('.$res[$i][id].');" onmouseout="this.className=\'aerial12\';return hideId('.$res[$i][id].');" style="cursor:pointer;">';
				$menu .= '<div style="padding-left:10px;padding-right:5px; width:125px;"  onclick="javascript: return redirect(\''.$res[$i][link].'/\');">';


				$menu .= $res[$i][title].$str;	
				$menu .= '</div>';
				$menu .= '</td><td align="left" valign="top">';					
				$menu .= $this->getChild($res[$i][id]);
				$menu .= '</td></tr>';					
			}
			$menu .= '</table>';
			$menu .= '</div>';		
			return $menu;
		}
		
		function getMenu($parentid)
		{
			$menu = "";
			$s = "select id,title,parentid,link from ms_product where parentid = '$parentid'  ";
			$res = $this->select_row($s);
			ob_start();
			?>
			<table border="0" cellspacing="0" cellpadding="0" width="740" align="center">
				<tr height="30">
					
		<?php
			for ($i=0;$i<count($res);$i++)
			{ ?>
					<td align="left" valign="middle" bgcolor="#FCBB2B">
				  
				  		<div align="center" onmouseover="javascript: return showId('<?=$res[$i][id]?>');" onmouseout="javascript: return hideId('<?=$res[$i][id]?>');" onclick="javascript: return redirect('<?=$res[$i][link]?>');" class="aerial12" style="height:15px; vertical-align:middle; padding-top:5px;cursor:pointer;"><?=$res[$i][title]?></div><?=$this->getChild($res[$i][id])?>
				
				  </td>
				  <?php if ((count($res) - 1) > $i) {?>
					<td align="left" valign="middle" bgcolor="#FCBB2B">|</td> <?php } ?>
			<?php } ?>
					</table>
			<?php
			$menu = ob_get_contents();
			ob_end_clean();
			return $menu;
		}
	}//class PHP_fun()
?>	