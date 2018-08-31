<!-- app/views/layouts/search.volt -->

<div class="panel panel-info">
    <div class="panel-heading">
        Pretraga
    </div>
    <div class="panel-body">

        <div class="row" style="padding: 1%">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-addon group-divider" id="basic-addon3">
                        Popunite željene filtere za pretragu članova</span>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

        <form method="post" action="<?= $this->url->get('search/result') ?>">

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Ime i/ili prezime</span>
                        <input type="text" class="form-control" name="filter_by_name" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Generacija</span>
                        <input type="text" class="form-control" name="filter_by_class" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Naziv kompanije</span>
                        <input type="text" class="form-control" name="filter_by_company" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Grad ili država</span>
                        <input type="text" class="form-control" name="filter_by_place" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="text-align: right">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-search"></i> Pretraži
                    </button>
                </div>
                <div class="col-md-1"></div>
            </div>

        </form>

        <?= $this->getContent() ?>

    </div>
</div>