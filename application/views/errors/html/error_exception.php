<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="card card-cascade narrower m-5">
	<div class="view view-cascade gradient-card-header young-passion-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-center align-items-center">
		<h4 style="height: 30px" class="white-text mx-3">Oops! Alguma exceção não foi tratada devidamente.</h4>
	</div>
	<div class="px-4">
		<div class="table-wrapper">
			<table class="table table-hover mb-0">
				<thead class="young-passion-gradient text-white">
					<tr>
						<th class="th-lg">
							<a>Title </a>
						</th>
						<th class="th-lg">
							<a>Message </a>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Type</td>
						<td><?php echo get_class($exception); ?></td>
					</tr>
					<tr>
						<td>Message</td>
						<td><?php echo $message; ?></td>
					</tr>
					<tr>
						<td>Filename</td>
						<td><?php echo $exception->getFile(); ?></td>
					</tr>
					<tr>
						<td>Line Number</td>
						<td><?php echo $exception->getLine(); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE) : ?>
			<h5 class="mt-4 text-main font-weight-bold">Backtrace</h5>
			<?php foreach (debug_backtrace() as $error) : ?>
				<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0) : ?>
					<div class="table-wrapper">
						<table class="table table-hover mb-0">
							<thead class="young-passion-gradient text-white">
								<tr>
									<th class="th-lg">
										<a>Title </a>
									</th>
									<th class="th-lg">
										<a>Message </a>
									</th>
								</tr>
							</thead>
							<!--Table head-->
							<tbody>
								<tr>
									<td>File</td>
									<td><?php echo $error['file']; ?></td>
								</tr>
								<tr>
									<td>Line</td>
									<td><?php echo $error['line']; ?></td>
								</tr>
								<tr>
									<td>Function</td>
									<td><?php echo $error['function']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</div>