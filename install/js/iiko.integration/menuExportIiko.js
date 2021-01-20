var menuExportApp = (function() {
    var resultTable = '<table id="result_table" cellpadding="0" cellspacing="0" border="0" width="100%" class="internal"><tbody>' +
                        '<tr class="heading"></tr>' +
                        '<tr><td><div id="status"></div></td></tr>' +
                        '<tr class="data"></tr></tbody></table>',                    

    startExport = function (e) {
        e.preventDefault();
        $('#result').html(resultTable);
        sendAjax();
    },
    
    workStartClick = function () {
        $("#work_start").on("click", startExport);  
    }, 

    sendAjax = function () {
        var url = '/../bitrix/tools/custom.handlers/menuExportIiko.php';
        $.ajax({
            type: "GET",
            url: url,
            data: { 'WORK_START': 'Y' },
            beforeSend: function(xhr) {
                ShowWaitWindow();
                $("#work_start").prop('disabled', true);
                $('#status').html('Работаю...');
            },
            success: function(result) {
                console.log(result);
                data = JSON.parse(result);
                if (data.status) {
                    CloseWaitWindow();
                    $("#work_start").prop('disabled', false); 
                    $('#status').html(data.msg);
                    $('#progress').hide();
                } else {
                    CloseWaitWindow();
                    $("#work_start").prop('disabled', false);
                    $('#progress').hide();
                    $('#status').html('Нет новых данных.');                    
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                CloseWaitWindow();
                $('<tr><td>Возникла ошибка. Попробуйте позже</td></tr>').insertAfter("tr.data");                    
            }
        });    
    },
    
    init = function () {
        workStartClick();
    };
    
    return {
        init: init
    };
    
})();

$(function() {
    menuExportApp.init();
});