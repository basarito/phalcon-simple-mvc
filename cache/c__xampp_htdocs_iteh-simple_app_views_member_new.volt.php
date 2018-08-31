<!-- app/views/member/new.volt -->

<div class="panel panel-info">
    <div class="panel-heading">
        Novi član
    </div>
    <div class="panel-body">
        <form method="post" action="<?= $this->url->get('member/save') ?>" id="saveMemberForm">
            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon group-divider" id="basic-addon3">Lični podaci o članu</span>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- ime -->
            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Ime</span>
                        <input type="text" class="form-control" name="first_name" aria-describedby="basic-addon3"
                               required>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- prezime -->
            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Prezime</span>
                        <input type="text" class="form-control" name="last_name" aria-describedby="basic-addon3"
                               required>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <!-- datum rodjenja -->
                        <div class="col-md-6">
                            <span class="pull-left">
                                <div class="input-group">
                                    <span class="input-group-addon info">Datum rodjenja</span>
                                        <input type="text" class="form-control" name="date_of_birth"
                                               aria-describedby="basic-addon3" placeholder="npr. 1989-05-03" required>

                                </div>
                            </span>
                        </div>
                        <!-- generacija -->
                        <div class="col-md-6">
                            <span class="pull-left">
                                <div class="input-group">
                                    <span class="input-group-addon info">Generacija</span>
                                        <input type="text" class="form-control" name="class"
                                               aria-describedby="basic-addon3" placeholder="npr. 2013" required>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- kompanija -->
            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon info" id="basic-addon3">Kompanija</span>
                        <select class="form-control" id="selectCompany" name="company_id">
                            <option value="null">Izaberite kompaniju...</option>
                            <option disabled>----------------------</option>
                            <?php if ($this->length($companies) > 0) { ?>
                                <?php foreach ($companies as $company) { ?>
                                    <option value="<?= $company->company_id ?>"><?= $company->name ?>
                                        (<?= $company->City->name ?>, <?= $company->City->country ?>)
                                    </option>
                                <?php } ?>
                            <?php } ?>
                            <option disabled>----------------------</option>
                            <option value="new">Dodajte novu kompaniju</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <div id="newCompany" hidden>
                <div class="row" style="padding: 1%">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="input-group">
                        <span class="input-group-addon group-divider" id="basic-addon3">
                            Nova kompanija
                        </span>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <!-- naziv kompanije -->
                <div class="row" style="padding: 1%">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon info" id="basic-addon3">Naziv</span>
                            <input type="text" class="form-control" name="company_name"
                                   aria-describedby="basic-addon3" id="companyName">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <!-- adresa kompanije -->
                <div class="row" style="padding: 1%">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon info" id="basic-addon3">Adresa i broj</span>
                            <input type="text" class="form-control" name="company_address"
                                   aria-describedby="basic-addon3" id="companyAddress">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <!-- grad kompanije -->
                <div class="row" style="padding: 1%">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon info" id="basic-addon3">Grad</span>
                            <input type="text" class="form-control" name="company_city"
                                   aria-describedby="basic-addon3" id="companyCity">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <!-- drzava kompanije -->
                <div class="row" style="padding: 1%">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon info" id="basic-addon3">Država</span>
                            <input type="text" class="form-control" name="company_country"
                                   aria-describedby="basic-addon3" id="companyCountry">
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <div class="row" style="padding: 1%">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="text-align: right">
                    <button type="submit" class="btn btn-success" id="saveMemberBtn" disabled>
                        <i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj
                    </button>
                </div>
                <div class="col-md-1"></div>
            </div>
        </form>
    </div>
</div>