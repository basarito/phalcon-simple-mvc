<!-- app/views/member/viewAll.volt -->

<div class="panel panel-info">
    <div class="panel-heading">Pregled svih članova</div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ime i prezime</th>
                <th scope="col">Datum rodjenja</th>
                <th scope="col">Generacija</th>
                <th scope="col">Kompanija</th>
                <th scope="col">Izaberi</th>
            </tr>
            </thead>
            <tbody>
            <form method="post" action="{{ url('member/edit') }}" id="editForm">
                {% set counter = 0 %}
                {% if members|length > 0 %}
                    {% for member in members %}
                        <tr>
                            {% set counter = counter + 1 %}
                            <th scope="row">{{ counter }}</th>
                            <td>{{ member.first_name }} {{ member.last_name }}</td>
                            <td>{{ member.date_of_birth }}</td>
                            <td>{{ member.class }}</td>
                            <td>{{ member.Company.name }}, {{ member.Company.City.name }}</td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="member_id" value="{{ member.member_id }}">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                        </tr>
                    {% endfor %}
                {% else %}
                    <tr>
                        <td colspan="6" style="text-align: center">
                            Nije pronađen nijedan član u bazi.
                        </td>
                    </tr>
                {% endif %}
            </form>
            </tbody>
        </table>

        <div class="row" style="padding: 1%">
            <div class="col-md-12" style="text-align: right">
                <button type="submit" class="btn btn-warning" id="editBtn"
                        form="editForm" name="action" value="edit" disabled>
                    <i class="glyphicon glyphicon-pencil"></i> Izmeni
                </button>
                <button type="submit" class="btn btn-danger" id="deleteBtn"
                        form="editForm" name="action" value="delete" disabled>
                    <i class="glyphicon glyphicon-trash"></i> Obriši
                </button>
            </div>
        </div>
    </div>
</div>