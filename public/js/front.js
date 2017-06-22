$(document).ready(function () {
    $('#subscription').on('change',function(){
        $subscription = $('#subscription option:selected').text();
        if($subscription == 'Starter'){
            $('#paymentOptions').hide();
        }else{
            $('#paymentOptions').show();
        }
    });
    //Contactmodal
    $('#send-contact').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'send/contact',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'contactName': $('input[name=contactName]').val(),
                'contactMail': $('input[name=contactMail]').val(),
                'contactMessage': $('textarea[name=contactMessage]').val()
            },
            datatype: 'JSON',
            success: function () {
            }
        });
        $("#success").show();

        setTimeout(function() { $("#success").hide(); }, 3000);

        $("input[name=contactName]").val('');
        $("input[name=contactMail]").val('');
        $("textarea[name=contactMessage]").val('');
    });
    $('#accept-cookies').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'privacy/accept',
            type: 'get',
            success: function () {
            }
        });
    });
    //Helpmodal
    $('.help-modal').on('click' , function(e){
        e.preventDefault();
        var key = $(this).data('target');
        $('#'+key).modal();
    });
    $('#send-help').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'send/help',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'firstname': $('input[name=firstname]').val(),
                'lastname': $('input[name=lastname]').val(),
                'email': $('input[name=email]').val(),
                'helpSubject': $('input[name=helpSubject]').val(),
                'helpMessage': $('textarea[name=helpMessage]').val(),
            },
            datatype: 'JSON',
            success: function () {
                $("input[name=helpSubject]").val('');
                $("textarea[name=helpMessage]").val('');
                $('#Modal-help').modal('toggle');
                $('.modal-backdrop').remove();
            }
        });
    });
})
