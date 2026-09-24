//integrations js custom file
$(document).on('change', '.live-integration-type', function () {
    var integration_type    =   $(this).val();
    if (integration_type == 'api_key'){
        $("#live-mode-by-mailer").hide();
        $("#live-mode-by-api-key").show();
    }else if (integration_type == 'mailer'){
        $("#live-mode-by-api-key").hide();
        $("#live-mode-by-mailer").show();
    }else{
        $("#live-mode-by-api-key").hide();
        $("#live-mode-by-mailer").hide();
    }
});
$(document).on('change', '.demo-integration-type', function () {
    var integration_type    =   $(this).val();
    if (integration_type == 'api_key'){
        $("#demo-mode-by-mailer").hide();
        $("#demo-mode-by-api-key").show();
    }else if (integration_type == 'mailer'){
        $("#demo-mode-by-api-key").hide();
        $("#demo-mode-by-mailer").show();
    }else{
        $("#demo-mode-by-api-key").hide();
        $("#demo-mode-by-mailer").hide();
    }
});
function SaveIntegration(){
    console.log("here");
    var integrationID   =   $('input[name="integrationID"]').val();
    $('#SaveIntegrationBtn').attr('disabled', 'disabled');
    $('.btn-cancel').attr('disabled', 'disabled');
    $('#SaveIntegrationBtn').text('Processing..');
    $.post(
        '/update-integration/'+integrationID,
        $("#integrationForm").serialize(),
        function(response) {
            if(response.status == 'success'){
                $('#SaveIntegrationBtn').text('Done');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'green');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                    window.location   =   "/integration/"+integrationID;
                }, 3000);
            }else {
                $('#SaveIntegrationBtn').removeAttr('disabled');;
                $('.btn-cancel').removeAttr('disabled');
                $('#SaveIntegrationBtn').text('Save');
                $('#notifDiv').fadeIn();
                $('#notifDiv').css('background', 'red');
                $('#notifDiv').text(response.msg);
                setTimeout(() => {
                    $('#notifDiv').fadeOut();
                }, 3000);
            }
    });
}


