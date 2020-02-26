<?php
session_start();
session_destroy();
unset($_SESSION['userId']);
?>
<script type="text/javascript">
  window.location = '/';
</script>
