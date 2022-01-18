<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <div class="container">


            <div class="row">
                <div class="col-6" style="display: flex; justify-content: center; align-items: center; margin: 20px 0">
                    <button class="btn btn-primary" name="new">Naujas skrydis</button>
                </div>
                <div class="col-6" style="display: flex; justify-content: center; align-items: center; margin: 20px 0">
                    <button class="btn btn-primary" name="all">Visi skrydžiai</button>
                </div>
            </div>

            <?php if(isset($_POST['save'])) :?>
                <?php validate($_POST); ?>

                <?php if(empty($validationErrors)) :?>

                    <?php saveFlight($_POST); ?>

                    <form action="../tickets.php" method="post">
                        <h3>Skrydžiai</h3>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Skrydžio nr.</th>
                                <th>Skrenda iš</th>
                                <th>Skrenda į</th>
                                <th>Vardas</th>
                                <th>Pavarde</th>
                                <th>Asmens kodas</th>
                                <th>Kaina</th>
                                <th>Pastabos</th>
                                <th>Pirkti bilietą</th>
                            </tr>
                            <?php foreach(getData() as $nr=>$list) :?>
                                <tr>
                                    <?php $list = explode(',', $list); ?>
                                    <?php foreach($list as $key=>$item) :?>
                                        <?php if(!empty($item) && $key != 6) :?>
                                            <?php if($key == 7) :?>
                                                <?php $item .= ' €'; ?>
                                            <?php endif; ?>
                                            <td><?=$item?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if(count($list) > 1) :?>
                                        <td><button type="submit" class="btn btn-primary" href = '../tickets.php' onclick="<?php saveTicket($nr); ?>;">Formuoti</button></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </form>

                    <?php else: ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($validationErrors as $error) :?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <form method="post">
                            <div class="card bg-dark text-white">
                                <div class="card-body">
                                    <div class="row" style="margin-bottom: 15px">
                                        <div class="col-4">
                                            <select class="form-control" name="nr">
                                                <option selected disabled>Skrydžio nr.</option>
                                                <?php foreach ($flightNr as $key=>$nr) :?>
                                                    <option value="<?= $nr ?>"><?= $nr ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                        <div class="col-4">
                                            <select class="form-control" name="from">
                                                <option selected disabled>Iš</option>
                                                <?php foreach ($cities as $key=>$city) :?>
                                                    <option value="<?= $city ?>"><?= $city ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-control" name="to">
                                                <option selected disabled>Į</option>
                                                <?php foreach ($cities as $key=>$city) :?>
                                                    <option value="<?= $city ?>"><?= $city ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Vardas</span>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Pavardė</span>
                                                <input type="text" class="form-control" name="lname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Asmens kodas</span>
                                                <input type="text" class="form-control" placeholder="38409XXXXXX" name="code">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <select class="form-control" name="bag">
                                                <option selected disabled>Bagažas</option>
                                                <option value="true"> >20 kg</option>
                                                <option value="false"> <20 kg</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Kaina</span>
                                                <input type="text" class="form-control" placeholder="€" name="price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 1px">
                                        <textarea cols="30" rows="10" class="form-control" placeholder="Pastabos..." name="message"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 10px" name="save">Saugoti</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                <?php else: ?>

                <form method="post">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: 15px">
                            <div class="col-4">
                                <select class="form-control" name="nr">
                                    <option selected disabled>Skrydžio nr.</option>
                                    <?php foreach ($flightNr as $key=>$nr) :?>
                                        <option value="<?= $nr ?>"><?= $nr ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="col-4">
                                <select class="form-control" name="from">
                                    <option selected disabled>Iš</option>
                                    <?php foreach ($cities as $key=>$city) :?>
                                        <option value="<?= $city ?>"><?= $city ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="to">
                                    <option selected disabled>Į</option>
                                    <?php foreach ($cities as $key=>$city) :?>
                                        <option value="<?= $city ?>"><?= $city ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Vardas</span>
                                    <input type="text" class="form-control" placeholder="e.g." name="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Pavardė</span>
                                    <input type="text" class="form-control" placeholder="e.g." name="lname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Asmens kodas</span>
                                    <input type="text" class="form-control" placeholder="38409XXXXXX" name="code">
                                </div>
                            </div>
                            <div class="col-2">
                                <select class="form-control" name="bag">
                                    <option selected disabled>Bagažas</option>
                                    <option value="true"> >20 kg</option>
                                    <option value="false"> <20 kg</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Kaina</span>
                                    <input type="text" class="form-control" placeholder="€" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin: 1px">
                            <textarea cols="30" rows="10" class="form-control" placeholder="Pastabos..." name="message"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px" name="save">Saugoti</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php endif; ?>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>