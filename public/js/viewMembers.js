// public/js/viewMembers.js

$(document).ready(function() {

    $("input[type=radio][name=member_id]").click(function() {
        $("#editBtn").attr('disabled', false);
        $("#deleteBtn").attr('disabled', false);
    });

});