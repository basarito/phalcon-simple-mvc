// public/js/editMember.js

$(document).ready(function() {

    $('#selectCompany').change(function () {
        if($('#selectCompany').val() == 'null') {
            toggleNewCompany(false);
            $('#saveMemberBtn').attr('disabled', true);
        } else  if($('#selectCompany').val() == 'new') {
            toggleNewCompany(true);
            $('#saveMemberBtn').attr('disabled', false);
        } else {
            toggleNewCompany(false);
            $('#saveMemberBtn').attr('disabled', false);
        }
    });

    function toggleNewCompany(visible) {
        if(visible) {
            $('#newCompany').show();
        } else {
            $('#newCompany').hide();
        }
        $('#companyName').attr('required', visible);
        $('#companyAddress').attr('required', visible);
        $('#companyCity').attr('required', visible);
        $('#companyCountry').attr('required', visible);
    }

});