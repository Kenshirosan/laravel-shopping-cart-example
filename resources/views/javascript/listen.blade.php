<script>
	let source = new EventSource("{{ '/test-server-events' }}");

	source.onmessage = function(event) {
		console.log(event);
	}
</script>