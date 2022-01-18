<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>

    <?php require 'inc/functions.php'; ?>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="borderis">
                    <div class="info">
                        <!--<?php var_dump(getTicket()); ?>-->
                        <div>
                            <h3><?= getTicket()[3] . ' ' . getTicket()[4]; ?></h3>
                            <h5><?= 'a.k. ' . getTicket()[5]; ?></h5>
                        </div>
                        <div>
                            <div class="bele">
                                <p>Bilieto kaina:</p>
                                <p><?= getTicket()[7]; ?>.00 €</p>
                            </div>
                            <?php if(getTicket()[6] == 'true') :?>
                                <p>Bagažas > 20kg + 30,00 €</p>
                            <?php else: ?>
                                <p>Bagažas < 20kg + 0,00 €</p>
                            <?php endif; ?>
                            <hr style="margin: 5px 0; color: blue">
                            <div class="bele">
                                <p>Suma:</p>
                                <p><?= getTicket()[7] + 30 . '.00 €'; ?></p>
                            </div>

                        </div>
                    </div>

                    <div class="kryptis">
                        <div>
                            <p>Skrenda iš</p>
                            <h3><?= getTicket()[1]; ?></h3>
                        </div>
                        <div style="transform: rotate(45deg)">
                            <i class="fa fa-plane" style="font-size:48px;color:white"></i>
                        </div>

                        <div>
                            <p>Skrenda į</p>
                            <h3><?= getTicket()[2]; ?></h3>
                        </div>
                    </div>
                    <div class="info">
                        <div>
                            <p>Skrydžio nr.</p>
                            <h3><?= getTicket()[0]; ?></h3>
                        </div>
                        <div>

                            <div style="border: 2px solid blue; width: 600px; height: 100%; display: flex"><p style="margin: 0 5px 0 0;"><strong>Pastabos:</strong></p><?= getTicket()[8]; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>