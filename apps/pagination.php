<?php session_start(); ?>

<style>
#page_navigation a{
	padding:3px;
	border:1px solid gray;
	margin:2px;
	color:black;
	text-decoration:none
}
.active_page{
	background:darkblue;
	color:white !important;
}
</style>
</head>
<body>
	
	<!-- the input fields that will hold the variables we will use -->
	<input type='hidden' id='current_page' />
	<input type='hidden' id='show_per_page' />
	
	<!-- Content div. The child elements will be used for paginating(they don't have to be all the same,
		you can use divs, paragraphs, spans, or whatever you like mixed together). '-->
	<div id='content'>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		<p>Vestibulum consectetur ipsum sit amet urna euismod imperdiet aliquam urna laoreet.</p>
		<p>Curabitur a ipsum ut elit porttitor egestas non vitae libero.</p>
		<p>Pellentesque ac sem ac sem tincidunt euismod.</p>
		<p>Duis hendrerit purus vitae nibh tincidunt bibendum.</p>
		<p>Nullam in nisi sit amet velit placerat laoreet.</p>
		<p>Vestibulum posuere ligula non dolor semper vel facilisis orci ultrices.</p>
		<p>Donec tincidunt lorem et dolor fringilla ut bibendum lacus fringilla.</p>
		<p>In non eros eu lacus vestibulum sodales.</p>
		<p>Duis ultrices metus sit amet sem adipiscing sit amet blandit orci convallis.</p>
		<p>Proin ullamcorper est vitae lorem mollis bibendum.</p>
		<p>Maecenas congue fringilla enim, tristique laoreet tortor adipiscing eget.</p>
		<p>Duis imperdiet metus et lorem venenatis nec porta libero porttitor.</p>
		<p>Maecenas lacinia lectus ac nulla commodo lacinia.</p>
		<p>Maecenas quis massa nisl, sed aliquet tortor.</p>
		<p>Quisque porttitor tellus ut ligula mattis luctus.</p>
		<p>In at mi dolor, at consectetur risus.</p>
		<p>Etiam id erat ut lorem fringilla dictum.</p>
		<p>Curabitur sagittis dolor ac nisi interdum sed posuere tellus commodo.</p>
		<p>Pellentesque quis magna vitae quam malesuada aliquet.</p>
		<p>Curabitur tempus tellus quis orci egestas condimentum.</p>
		<p>Maecenas laoreet eros ac orci adipiscing pharetra.</p>
		<p>Nunc non mauris eu nibh tincidunt iaculis.</p>
		<p>Ut semper leo lacinia purus hendrerit facilisis.</p>
		<p>Praesent et eros lacinia massa sollicitudin consequat.</p>
		<p>Proin non mauris in sem iaculis iaculis vel sed diam.</p>
		<p>Nunc quis quam pulvinar nibh volutpat aliquet eget in ante.</p>
		<p>In ultricies dui id libero pretium ullamcorper.</p>
		<p>Morbi laoreet metus vitae ipsum lobortis ultrices.</p>
		<p>Donec venenatis egestas arcu, quis eleifend erat tempus ullamcorper.</p>
		<p>Morbi nec leo non enim mollis adipiscing sed et dolor.</p>
		<p>Cras non tellus enim, vel mollis diam.</p>
		<p>Phasellus luctus quam id ligula commodo eu fringilla est cursus.</p>
		<p>Ut luctus augue tortor, in volutpat enim.</p>
		<p>Cras bibendum ante sed erat pharetra sodales.</p>
		<p>Donec sollicitudin enim eu mi suscipit luctus posuere eros imperdiet.</p>
		<p>Vestibulum mollis tortor quis ipsum suscipit in venenatis nulla fermentum.</p>
		<p>Proin vehicula suscipit felis, vitae facilisis nulla bibendum ac.</p>
		<p>Cras iaculis neque et orci suscipit id porta risus feugiat.</p>
		<p>Suspendisse eget tellus purus, ac pulvinar enim.</p>
		<p>Morbi hendrerit ultrices enim, ac rutrum felis commodo in.</p>
		<p>Suspendisse sagittis mattis sem, sit amet faucibus nisl fermentum vitae.</p>
		<p>Nulla sed purus et tellus convallis scelerisque.</p>
		<p>Nam at justo ut ante consectetur faucibus.</p>
		<p>Proin dapibus nisi a quam interdum lobortis.</p>
		<p>Nunc ornare nisi sed mi vehicula eu luctus mauris interdum.</p>
		<p>Mauris auctor suscipit tellus, at sodales nisi blandit sed.</p>

	</div>

	<!-- An empty div which will be populated using jQuery -->
	<div id='page_navigation'></div>
</body>
</html>
