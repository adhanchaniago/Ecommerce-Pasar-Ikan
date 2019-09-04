	<!--footer-->
	<div class="footer">
	    <div class="container">
	        <div class="copy-right">
	            <p> Copyright &copy; Penjualan Ikan Pasar Jaya <?= date('Y'); ?></p>
	        </div>
	    </div>
	</div>
	<!-- //footer-->
	<script>
	    function ShowPassword() {
	        if (document.getElementById("password").value != "") {
	            document.getElementById("password").type = "text";
	            document.getElementById("show").style.display = "none";
	            document.getElementById("hide").style.display = "block";
	        }
	    }

	    function HidePassword() {
	        if (document.getElementById("password").type == "text") {
	            document.getElementById("password").type = "password"
	            document.getElementById("show").style.display = "block";
	            document.getElementById("hide").style.display = "none";
	        }
	    }
	</script>
	<script src="<?= base_url('assets/js/'); ?>jquery.min.js"></script>
	<script src="<?= base_url('assets/js/'); ?>popper.min.js"></script>
	<script src="<?= base_url('assets/js/'); ?>bootstrap.min.js"></script>
	</body>

	</html>