<?php
class js {
	
	public function alert( $msg ) {
		echo "
				<script>
					alert( '$msg' );
				</script>
		";
	}
	
	public function location ( $msg, $location ) {
		echo "
			<script>
				alert ( '$msg' );
				window.location.href='$location';
			</script>
		";
	}
	
	public function back ( $msg ) {
		echo "
			<script>
				alert( '$msg' );
				window.history.back();
			</script>
		";
	}
	
	public function reload() {
		echo "<script>
					window.location.reload();
				</script>
		";
	}
}
?>