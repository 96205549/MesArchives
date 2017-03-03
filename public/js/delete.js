/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $('a[data-confirm]').click(function (ev) {
        var href = $(this).attr('href');

        if (!$('#dataConfirmModal').length) {
            $('body').append(
                    '<div id="dataConfirmModal" class="modal reveal-modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                        '<div class="modal-dialog">'+
                            '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
                                    '<h3 id="dataConfirmLabel" class="text-info">Merci de confirmer</h3>'+
                                '</div>'+
                                '<div class="modal-body">Voulez-vous supprimer <b class=\'whatfaq\'></b>?</div>'+
                                '<div class="modal-footer">'+
                                    '<a class="btn btn-danger" id="dataConfirmOK">Oui</a>'+
                                    '<button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');
        }
        $('#dataConfirmModal').find('.whatfaq').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});

        return false;
    });
});


