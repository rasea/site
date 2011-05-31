<!--
 Rasea Site
 
 Copyright (c) 2008, Rasea <http://rasea.org>. All rights reserved.

 Rasea Site is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 3 of the License.

 This library is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public
 License along with this library; if not, see <http://gnu.org/licenses>
 or write to the Free Software Foundation, Inc., 51 Franklin Street,
 Fifth Floor, Boston, MA  02110-1301, USA.
-->
<?php
$file_lines = file("http://sourceforge.net/apps/trac/rasea/report/9?format=tab");

$n = 0;
foreach ($file_lines as $line) {
	$n++;
	//$fields = split("\t", utf8_decode($line));
	$fields = split("\t", $line);
	
	$project = $fields[0];
	$version = $fields[1];
	$type = $fields[2];
	$id = $fields[3];
	$summary = $fields[4];
	
	if (($n > 1) && ((!empty($project)) && (!empty($version))) && (!empty($type)) && (!empty($id)) && (!empty($summary))) {
		// Project
		if ($project != $last_project) {
			// Fim Project
			if (($version != $last_version) && ($n > 2)) {
				echo '</ul></div></div>';
			}
			echo '<div class="section"><h3>'.$project.'<a name="'.$project.'"></a></h3>';
		} else if (($version != $last_version) && ($n > 2)) {
			echo '</ul></div>';
		}
		
		// Version
		if ($version != $last_version) {
			echo '<div class="section"><h4>'.$version.'<a name="'.$version.'"></a></h4>';
			echo '<ul>';
			$line_version = $n;
		}
		
		// Summary
		echo '<li>';
        echo '<a href="https://sourceforge.net/apps/trac/rasea/ticket/'.$id.'">#'.str_pad($id, 5, '0', STR_PAD_LEFT).'</a>: ';
        echo $summary;
		echo '</li>';
	}
	$last_project = $fields[0];
	$last_version = $fields[1];
	$last_type = $fields[2];
	$last_id = $fields[3];
	$last_summary = $fields[4];
}
echo '</ul></div></div>';
?>
<!--
<div class="section">
	<h3>Rasea-server<a name="Rasea-server1"></a></h3>
	<div class="section">
		<h4>Vers&#xe3;o XXX<a name="Verso_XXX"></a></h4>
		<ul>
			<li>teste 1</li>
			<li>teste 2</li>
		</ul>
	</div>
</div>
<div class="section">
	<h3>Rasea-server<a name="Rasea-server2"></a></h3>
	<div class="section">
		<h4>Vers&#xe3;o XXX<a name="Verso_XXX"></a></h4>
		<ul>
			<li>teste 1</li>
			<li>teste 2</li>
		</ul>
	</div>
</div>
-->
