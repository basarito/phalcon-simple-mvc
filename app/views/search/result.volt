<!-- app/views/search/result.volt -->

<div class="row" style="padding: 1%">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="input-group">
                    <span class="input-group-addon group-divider" id="basic-addon3">
                        Rezultati pretrage</span>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ime i prezime</th>
                <th scope="col">Datum rodjenja</th>
                <th scope="col">Generacija</th>
                <th scope="col">Kompanija</th>
                <th scope="col">Grad</th>
                <th scope="col">Država</th>
            </tr>
            </thead>
            <tbody>
            {% set counter = 0 %}
            {% if results|length > 0 %}
                {% for result in results %}
                    <tr>
                        {% set counter = counter + 1 %}
                        <th scope="row">{{ counter }}</th>
                        <td>{{ result.member.first_name }} {{ result.member.last_name }}</td>
                        <td>{{ result.member.date_of_birth }}</td>
                        <td>{{ result.member.class }}</td>
                        <td>{{ result.company.name }}</td>
                        <td>{{ result.city.name }}</td>
                        <td>{{ result.city.country }}</td>
                    </tr>
                {% endfor %}
            {% else %}
                <tr>
                    <td colspan="7" style="text-align: center">
                        Nije pronađen nijedan član u bazi za zadate kriterijume.
                    </td>
                </tr>
            {% endif %}
            </tbody>
        </table>
    </div>
    <div class="col-md-1"></div>
</div>

