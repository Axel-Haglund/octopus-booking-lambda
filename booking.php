<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <link rel="stylesheet" href="project.css" />
  <nav class="navbar">
    <div class="logo">skapa en bokning</div>
    <ul class="nav-links">
      <div class="menu">
        <li><a href="admin.html">Min sida</a></li>
        <li><a href="/">Hantera bokningar</a></li>
        <li><a href="index.php">Logga ut</a></li>
      </div>
    </ul>
  </nav>

  <form action="/action_page.php">
    <label for="booking">Booking:</label>
    <input type="date" id="booking" name="booking" />
    <input type="submit" />
  </form>

  <div class="table1" name="room">
    <?php require_once('api/generate_table.php') ?>
    <table id="myTable">
      <tbody>
        <?php generate_table(); ?>
      </tbody>
    </table>
  </div>

  <button>
    <label for="submit">Submit</label>
  </button>
  <script src="booking.js"></script>
</body>

</html>