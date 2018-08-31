<!-- app\views\index\index.volt -->
<div class="jumbotron" style="background-color: lightblue; color:white;">
    <h1>Dobrodošli</h1>
    <h2>Alumni mreža Fakulteta</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <h2>Pregled svih članova</h2>
        <p>Pogledajte sve članove alumni mreže:</p>
        <a href="<?= $this->url->get('member/view-all') ?>">
            <button class="btn btn-info btn-block"><i class="glyphicon glyphicon-th-list"></i> Pregled</button>
        </a>
    </div>
    <div class="col-md-4">
        <h2>Dodajte novog člana</h2>
        <p>Dodajte novog člana u alumni mrežu:</p>
        <a href="<?= $this->url->get('member/new') ?>">
            <button class="btn btn-success btn-block"><i class="glyphicon glyphicon-plus"></i> Dodaj</button>
        </a>
    </div>
    <div class="col-md-4">
        <h2>Pretraga članova</h2>
        <p>Pretražite članove prema željenim parametrima:</p>
        <a href="<?= $this->url->get('search') ?>">
            <button class="btn btn-warning btn-block"><i class="glyphicon glyphicon-search"></i> Pretraga</button>
        </a>
    </div>

</div>

<div class="row" style="padding:1%">
    <?= $this->flashSession->output() ?>
</div>


