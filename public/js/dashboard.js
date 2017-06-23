$(document).ready(function () {
    //Item toevoegen in client bezoek
    $('#add-item').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'items/store',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'visit_code': $('input[name=visit_code]').val(),
                'title': $('input[name=title]').val(),
                'input': $('textarea[name=input]').val()
            },
            datatype: 'JSON',
            success: function (items) {
                $.each(items, function (key, item) {
                    $('tbody').append('<tr id="row-item-'+item['id']+'"><td class="table-text"><div>'+item['title']+'</div></td>' +
                        '<td class="table-text"><div>'+item['input']+'</div></td><td><div class="btn-toolbar">'+
                        '<form role="form">'+
                        '<button class="btn btn-default edit-item" id="'+item['id']+'"><i class="fa fa-pencil"></i></button></form>'+
                        '<form>'+
                        '<button class="btn btn-default delete-item" id="'+item['id']+'"><i class="fa fa-trash"></i></button></form>'+
                        '</div></td>')

                });
                $("input[name=title]").val('');
                $("textarea[name=input]").val('');
            }
        });

    });
    //edit item in client bezoek
    $('body').on('click','.edit-item' ,function (e) {
            $input= $(this).attr('id');

        e.preventDefault();
        $.ajax({
            url: 'items/edit',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $input
            },
            datatype: 'JSON',
            success: function (item) {
                $selector = "#row-item-"+item[0]['id'];
                $row = $($selector).closest("tr");
                $row.remove();
                $("input[name=title]").val(item[0]['title']);
                $("textarea[name=input]").val(item[0]['input']);

            }
        });

    });
    //delete item in client bezoek
    $('body').on('click','.delete-item' ,function (e) {
        e.preventDefault();
        $input= $(this).attr('id');
        $.ajax({
            url: 'items/delete',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $input
            },
            datatype: 'JSON',
            success: function () {
                $selector = "#row-item-"+$input;
                $row = $($selector).closest("tr");
                $row.remove();
            }
        });

    });
    //delete modal aanroepen op delete click van item in client bezoek
    $('.delete-modal').on('click' , function(e){
        e.preventDefault();
        var key = $(this).data('target');
        $('#'+key).modal();
    });
    //delete van bezoek in client profiel
    $('.delete-visit').on('click',function (e) {
        e.preventDefault();
        $.ajax({
            url: '/visits/delete',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'visit_code': $('input[name=visit_code]').val()
            },
            datatype: 'JSON',
            success: function () {
                $visit_code = $('input[name=visit_code]').val();
                $row = $("#row-visit-"+$visit_code).closest("tr");
                $row.remove();
                //Model sluiten na delete
                $('#Modal-delete-'+$visit_code).modal('toggle');
                $('.modal-backdrop').remove();
            }
        });

    });
    //inputs beschikbaar maken in edit van client profiel
    $("#edit-profile").click(function(event){
        event.preventDefault();
        $('#edit-profile').remove();
        $('input').prop("disabled", false);
        $('select').prop("disabled", false);
        $('textarea').prop("disabled", false);
        $('#update-profile').prop("disabled", false);
    });
    //zoeken op clienten overzicht
    $('#search-client').on('keyup', function (e) {
        e.preventDefault();
        if (this.value.length >= 1) {
            $.ajax({
                url: 'clients/search',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'keyword': $('input[name=keyword]').val()
                },
                datatype: 'JSON',
                success: function (data) {
                    $('tbody').html(data);
                }
            });
        }
        if (this.value.length == 0) {
            $.ajax({
                url: 'clients',
                type: 'get',
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                datatype: 'JSON',
                success: function (data) {
                    $('tbody').html(data);
                }
            })
        }

    });
    //Betaling bevestigsmodal aanroepen in facturatie
    $('.confirm-modal').on('click' , function(e){
        e.preventDefault();
        var key = $(this).data('target');
        $('#'+key).modal();
    });
    //Payment confirmeren van user
    $('.confirm-payment').on('click',function (e) {
        e.preventDefault();
        $.ajax({
            url: 'orders/confirm',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'payment_id': $('input[name=payment_id]').val()
            },
            datatype: 'JSON',
            success: function () {
                $payment_id = $('input[name=payment_id]').val();
                $row = $("#payment-"+$payment_id).closest("tr");
                $row.remove();
                //Modal sluiten na confirmatie
                $('#Modal-confirm-'+$payment_id).modal('toggle');
                $('.modal-backdrop').remove();

            }
        });

    });

    //Account bevestigsmodal aanroepen in accounts
    $('.account-modal').on('click' , function(e){
        e.preventDefault();
        var key = $(this).data('target');
        $('#'+key).modal();
    });
    //Account confirmeren van user
    $('.confirm-account').on('click',function (e) {
        e.preventDefault();
        $.ajax({
            url: 'accounts/confirm',
            type: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'user_id': $('input[name=user_id]').val()
            },
            datatype: 'JSON',
            success: function () {
                $user_id = $('input[name=user_id]').val();
                $row = $("#account-unconfirmed-"+$user_id).closest("tr");
                $row.remove();
                //Modal sluiten na confirmatie
                $('#Modal-confirm-'+$user_id).modal('toggle');
                $('.modal-backdrop').remove();

            }
        });

    });
    //inputs beschikbaar maken in edit van account profiel
    $("#edit-account").click(function(event) {
        event.preventDefault();
        $('#edit-account').remove();
        $('input').prop("disabled", false);
        $('select').prop("disabled", false);
        $('#update-account').prop("disabled", false);

    });
    //inputs beschikbaar maken in setting van gebruikers profiel
    $("#edit-settings-user").click(function(event) {
        event.preventDefault();
        $('#edit-settings-user').remove();
        $('.user').prop("disabled", false);
        $('#update-settings-user').prop("disabled", false);

    });
    //inputs beschikbaar maken in setting van business profiel
    $("#edit-settings-business").click(function(event) {
        event.preventDefault();
        $('#edit-settings-business').remove();
        $('.business').prop("disabled", false);
        $('#update-settings-business').prop("disabled", false);
    })
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

    //zoeken op account overzicht
    $('#search-account').on('keyup', function (e) {
        e.preventDefault();
        if (this.value.length >= 1) {
            $.ajax({
                url: 'accounts/search',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'keyword': $('input[name=keyword]').val()
                },
                datatype: 'JSON',
                success: function (data) {
                    $('#account-list').html(data);
                }
            });
        }
        if (this.value.length == 0) {
            $.ajax({
                url: 'accounts/all',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                datatype: 'JSON',
                success: function (data) {
                    $('#account-list').html(data);
                }
            })
        }
    });
});
