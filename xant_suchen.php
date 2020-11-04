<?php
include ("connect.php");
include ("connect_geobasis.php");
include ("function.php");
/*---------Navigation---------*/
xhead_ant();
xmain_nav();
xnav_ant();
?>
<div class="formular_bereich">

<!-----------Überschrift----------->
<font face="Arial"><h1>Antragsdatenbank</h1></font>
</div>

<!-----------Tabellenstruktur-Zeile1----------->
<div class="formular_bereich">
	<form action="xant_suchen_var.php" method="post" target="">
<table>
	<tr>
		<td class="angaben_überschrift" colspan="5" > Antrag suchen</td>
	</tr>
	<tr class="antrags_beschriftung">
		<td class="angaben" colspan=\"2\">Antragsnummer </td>
		<td class="angaben" colspan="2">Vermessungsstelle</td>
		<td class="angaben" colspan="2">Vermessungsart</td>
	</tr>
 
<!-----------INPUT-Antragsnummer----------->
	<tr>
		<td style="font-size: 27px;"><input type="Text" name="number" value="" size="4" maxlength="4">&nbsp;
		<b>/</b>&nbsp;<input type="Text" name="year" value="" size="4" maxlength="4">
		
<!-----------SELECT-Vermessungstselle----------->		
		<td colspan="2">
			<select name="vermst_id">
				<?php
				$query="SELECT * FROM vermst WHERE liste='1' ORDER BY vermst";
				$result=mysqli_query($db_link,$query);
				
				while($r=mysqli_fetch_array($result))
				{
				echo "<option value=\"$r[vermst_id]\">$r[vermst]</option>\n";
				}
				?>
			</select>
		</td>
		
<!-----------SELECT-Vermessungsart----------->
		<td colspan="2">
			<select name="vermart_id">
				<?php
				$query="SELECT * FROM vermart ORDER BY vermart";
				$result=mysqli_query($db_link,$query);
				
				while($r=mysqli_fetch_array($result))
				{
				echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
				}
				?>
			</select>
		</td>
	</tr>
	
<!-----------Tabellenstruktur-Zeile2----------->
	<tr class="antrags_beschriftung">
		<td class="angaben">Gemarkung</td>
		<td class="angaben">Flur(en)</td>
		<td class="angaben">Flurstück(e)</td>
		<td>&nbsp;</td>
		<td></td>
	</tr>
	
 <!-------------SELECT-Gemarkung------------->
	<tr>
		<td>
			<select name="gemark_id">
				<?php
				echo "<option value=\"0\">-alle-</option>";
				
				$query="SELECT * FROM show_gemarkungen_13071 ORDER BY gemarkung";
				$result=$dbqueryp($connectp,$query);
				
				while($r=$fetcharrayp($result))
				{
				echo "<option value=\"$r[gemkgschl]\">$r[gemarkung] ($r[gemkgschl])</option>\n";
				}
				?>
				</select>
		</td>
		
 <!-----------INPUT-Flur----------->
		<td>
			<input type="Text" name="flur" value="" size="2" maxlength="2">
		</td>
 
  <!-----------INPUT-Flurstücke----------->
		<td>
			<input type="Text" name="flst" value="" size="20" maxlength="20">
		</td>
 
		<td></td>
		<td></td>
	</tr>

<!-----------Tabellenstruktur-Zeile3----------->
	<tr class="antrags_beschriftung">
		<td class="angaben" colspan="5">Sachverhalt </td>
	</tr>

<!------------INPUT-Sachverhalt------------>
	<tr>
		<td colspan="5"><input type="Text" name="sv" value="" size="100" maxlength="100"> </td>
	</tr>

<!-----------Tabellenstruktur-Zeile4----------->
	<tr class="antrags_beschriftung">
		<td class="angaben">Wo ist die Akte?</td>
		<td class="angaben">Az (VmSt.)</td>
		<td class="angaben" colspan="3">Eilig?</td>
	</tr>
	
 <!-------------SELECT-Wo-ist-die-Akte------------->
	<tr>
		<td>
			<select name="aktort_id">
				<?php
				$query="SELECT * FROM aktort ORDER BY aktort_id";
				$result=mysqli_query($db_link,$query);
				
				while($r=mysqli_fetch_array($result))
				{
				echo "<option value=\"$r[aktort_id]\">$r[aktort]</option>\n";
				}
				?>
			</select>
		</td>
		
<!------------INPUT-Az(VmSt)------------>
		<td>
			<input type="Text" name="az" value="" size="10" maxlength="10">
		</td>
		
 <!-------------SELECT-Eilig------------->
		<td colspan="3">
			<select name="hurry" size="">
				<option value="" selected>&nbsp;</option>
				<option value="0">nein</option>
				<option value="1">ja</option>
			</select>
		</td>
	</tr>

<!-----------Tabellenstruktur-Zeile5----------->
	<tr class="antrags_beschriftung">
		<td class="angaben">Zeitraum eingrenzen</td>
		<td class="angaben">von&nbsp;<font size="-0" face="MS Sans Serif">(JJJJ-MM-TT)</font></td>
		<td class="angaben" colspan="3">bis&nbsp;<font size="-0" face="MS Sans Serif">(JJJJ-MM-TT)</font></td>
	</tr>
	
 <!-------------SELECT-Eilig------------->
	<tr>
		<td>
			<select name="datart" size="">
				<option value="eing_datum" selected>Eingangsdatum</option>
				<option value="vorb_datum">Vorbereitung</option>
				<option value="me_datum">Messeingang</option>
				<option value="ueb_datum">Übernahme</option>
				<option value="alk_datum">ALK-Datum</option>
				<option value="alb_datum">ALB-Datum</option>
			</select>
		</td>
		
<!------------INPUT-Datum(von-bis)------------>
			<td>
				<input type="date" name="time_von" value="" size="10" maxlength="10">
			</td>
			<td colspan="3">
				<input type="Text" name="time_bis" value="" size="10" maxlength="10">
			</td>
	</tr>

<!------------Button-(Suche-starten)-(Zurücksetzten)------------>
	<tr class="antrags_beschriftung">
		<td colspan="5">
			<input type="Submit" name="" value="Suche starten">&nbsp;&nbsp;
			<input type="reset">
		</td>
	</tr>
</table>
</div>
</form>

<?php
/*------------Navigation------------*/
xnav_ant();
bottom();
?>