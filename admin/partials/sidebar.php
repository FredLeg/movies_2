			<div id="sidebar-left" class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
<?php
					foreach($pages_names as $file_name => $title):
						$active = $current_page==$file_name ? ' class="active"' : '';
						echo tabs(5).'<li'.$active.'><a href="'.$file_name.'">'.$title.'</a></li>'.PHP_EOL;
					endforeach;
?>
				</ul>

				<a href="javascript:void(0);" onclick="jQuery('#sidebar-left').hide();">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
			</div>
