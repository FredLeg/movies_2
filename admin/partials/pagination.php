				<?php
				// On crée une copie de $_GET
				$get = $_GET;
				// Si on a déjà un paramètre p dans l'url
				if (isset($get[ $pagi['page_param_name'] ])) {
					// On retire le paramètre p pour éviter les doublons
					unset($get[ $pagi['page_param_name'] ]);
				}
				// On reconsitue les paramètres d'url sous forme de chaine
				$querystring = '&'.http_build_query($get);
				?>
				<nav>
					<ul class="pagination">
					<?php
					if ( $pagi['page'] > 1) {
					?>
					<li>
						<a href="?p=1<?= $querystring ?>">
							<span class="glyphicon glyphicon-step-backward"></span>
						</a>
						<a href="?p=<?= $pagi['page'] - 1 ?><?= $querystring ?>">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
					</li>
					<?php
					}
					for ($i = max($pagi['page'] - $pagi['nb_pages_active'], 1); $i <= max(1, min($pagi['nb_pages'], $pagi['page'] + $pagi['nb_pages_active'])); $i++) {
						/*
						$isCurrentPage = $i == ($page + 1);
						$active = $isCurrentPage ? ' class="active"' : '';
						$href = !$isCurrentPage ? ' href="?p='.$i.'"' : '';
						echo '<li'.$active.'><a'.$href.'>'.$i.'</a></li>';
						*/
						if ($i == $pagi['page']) {
							echo '<li class="active"><a>'.$i.'</a></li>';
						} else {
							echo '<li><a href="?p='.$i.$querystring.'">'.$i.'</a></li>';
						}
					}
					if ($pagi['page'] < $pagi['nb_pages']) {
					?>
					<li>
						<a href="?p=<?= $pagi['page'] + 1 ?><?= $querystring ?>">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
						<a href="?p=<?= $pagi['nb_pages'] ?><?= $querystring ?>">
							<span class="glyphicon glyphicon-step-forward"></span>
						</a>
					</li>
					<?php } ?>
					</ul>
				</nav>