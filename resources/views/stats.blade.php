<!-- A Blade component that uses the stats -->
<section class="section stats">
	<h3 class="title">
		How many things we made and did...
	</h3>

	<p><strong>Today:</strong> {{ $stats->today }}</p>
	<p><strong>Yesterday:</strong> {{ $stats->yesterday }}</p>
	<p><strong>This Month:</strong> {{ $stats->month }}</p>
	<p><strong>This Year:</strong> {{ $stats->year }}</p>

</section>