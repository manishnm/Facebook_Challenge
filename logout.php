<html>
    <?php
    if (!isset($_SESSION))
  {
    @session_start();
  }
 
@session_destroy();
?>
      <body align="center">
        <h3>
            You're logged out successfully...
        </h3>
        <br/>
        <h5>
            see you soon again...
        </h5>
        <br/>
        <a href="index.php">
            Login again
        </a>
    </body>
</html>
