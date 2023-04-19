<!DOCTYPE html>
<html lang="se">

<head>
    <link rel="stylesheet" href="style.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Octopus Booking</title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="api/login.php" id="auth-form" method="post">
                    <h2>OctopusBooking</h2>

                    <div class="inputbox">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input type="email" required name="email" id="email" />
                        <label for="">Mejladress</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required name="password" id="password" />
                        <label for="">Lösenord</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox" />Kom ihåg mig eller

                            <a href="#">Glömt lösenord</a></label>
                    </div>
                    <button>Logga in</button>
                    <div class="register"></div>
                </form>
            </div>
        </div>
    </section>
    <script src="auth-form.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>