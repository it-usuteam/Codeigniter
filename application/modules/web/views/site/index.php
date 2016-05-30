<style>
	.search-input-container {
		display: inline-block;
		padding-left: 1em;
		background: #3BB0AA;
		color: #FFF;
		position: relative;
		min-width: 25%;
	}
	.search-input-container:before {
		content: "\e003";
		font-family: 'Glyphicons Halflings';
		display: inline-block;
		padding-top:0.5em;
		padding-left:0.5em;
		vertical-align: top;
		position: absolute;
		top: 0;
		left: 0;
	}
	.search-input {
		padding: 0.5em 0.5em 0.5em 1em;
		border: 0;
		background: transparent;
		color: #FFF;
		width: 100%;
	}
</style>

<!-- Header awal -->
<div class="row" style="padding-top:4em; padding-bottom: 2em;  ">
	<div class="col-md-12 text-center">
		<form method="POST" action="?" class="search-input-container">
			<input type="text" placeholder="Cari...." class="search-input">
		</form>
	</div>
</div>
