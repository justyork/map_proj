UIkit.ready(function() {
    UIkit.$('#ticker_ac').on('selectitem.uk.autocomplete', function (e, data, ac) {
        AcItem(e, '');
    });
    UIkit.$('#ticker_ac2').on('selectitem.uk.autocomplete', function (e, data, ac) {
        AcItem(e, '2');
    });
});
$(document).ready(function () {

    if (window.location.hash == '#success')
        UIkit.notify('Data have been saved', {status: 'success', timeout: 3000});

    $("#validForm").validate();



    $('#portfolioList tr').click(function () {
        var id = $(this).attr('rel');
        console.log(id);
        window.location = '/portfolio/show/' + id;
    });

    $('#order_type').change(function () {
        if ($(this).val() == 2) {
            $(this).after('<input id="lmt_price" type="text" name="Order[lmt_price]" style="width: 80px; margin-left: 10px;" />');
        }
        else $('#lmt_price').remove();
    });

    $('#order_type2').change(function () {
        if ($(this).val() == 2) {
            $(this).after('<input id="lmt_price2" type="text" name="Order2[lmt_price]" style="width: 80px; margin-left: 10px;" />');
        }
        else $('#lmt_price2').remove();
    });

    $('.q_text').keyup(function(e){
        if($(this).val() == '')
            $('.q_text').removeAttr('disabled');
        else{
            $('.q_text').attr('disabled', 'disabled');
            $(this).removeAttr('disabled');
        }
    });
    $('.q_text2').keyup(function(e){
        if($(this).val() == '')
            $('.q_text2').removeAttr('disabled');
        else{
            $('.q_text2').attr('disabled', 'disabled');
            $(this).removeAttr('disabled');
        }
    });

    $('.q_type').click(function () {
        $('.q_text').attr('disabled', 'disabled');
        $(this).parent().parent().find('.q_text').removeAttr('disabled');
    })

    $('#add_order').click(function () {
        $('#add_order_row').show();
    });

    /**
     * Execute order
     */
    $('.execute_button').click(function () {
        return execute_order($(this).parents('tr'));
    });
    $('.o_price').keydown(function (e) {
        if (e.which == 13)
            return execute_order($(this).parents('tr'));

    })

    $('#accountPortfolio tbody tr.portf_row').click(function(){
        var mX = event.clientX;
        var mY = event.clientY;

        var id = $(this).attr('rel');
        if($(this).hasClass('suc_row')) $('.delete_ord').hide();
        else $('.delete_ord').show();

        $('#dropDown_portfolio').find('ul').attr('rel', id);
        $('#dropDown_portfolio').css({'left':(mX-5)+'px', 'top':(mY-5)+'px'}).show();

        return false;
    });


    $('#dropDown_portfolio').mouseleave(function(){
        $('#dropDown_portfolio').hide();
    })


    /**
     * Drop menu
     */
    $('.row_drop_menu a').click(function(){
        var type_id = $(this).attr('rel');
        var id = $(this).parents('.row_drop_menu').attr('rel');

        var row = $('.portf_row[rel="'+id+'"]');
        var create = true;
        if(type_id == 1)
            ClosePosition(row);
        if(type_id == 2)
            BuyIn(row);
        if(type_id == 3)
            Reduce(row);
        if(type_id == 4)
            Split(row);
        if(type_id == 5){
            create = false;
            Delete(row);
        }

        if(create) $('#add_order_row').show();

        $('#dropDown_portfolio').hide();
        return false;
    });


    $('.activate_perfomance').click(function(){
        $('.perfomance_area').load('/order/perfomance', {id:$('#portfolio_id').val()});
    });
    $('.activate_archive').click(function(){
        $('.archive_area').load('/order/archive', {id:$('#portfolio_id').val()});
    });

});

function clickCurrencyForm(data){
    $(data).removeAttr('onclick').html('<input type="text" onkeydown="saveCurrencyForm(this)" class="click_cur_form" value="'+$(data).text()+'"/>');
}
function saveCurrencyForm(data){
    if(event.keyCode != 13)
        return false;

    var price = $(data).val();
    var id = $(data).parent().attr('rel');
    var curr = $(data).parent().attr('curr');

    $.post('/order/saveCurrPrice', {id:id, price:price, curr:curr});
    $(data).parent().text(price).attr('onclick', 'clickCurrencyForm(this)');

}
function AcItem(item, name){
    var id = $("#ticker_ac"+name).find('.uk-active a').attr('rel');
    $('.order_ticker'+name).val(id);
}

function execute_order(data) {
    var o_price = $(data).find('.o_price');

    if (o_price.val() == '') {
        UIkit.notify('Field can\'t be empty', {status: 'danger'});
        return false;
    }

    var ret = {o_price: o_price.val(), id: $(data).attr('rel')};

    if($(data).attr('spread') != 0){
        ret.id2 = $(data).attr('spread');
        var s_row = $('tr[rel="'+$(data).attr('spread')+'"]');
        var o_price2 = s_row.find('.o_price');
        if (o_price2.val() == '') {
            UIkit.notify('Field can\'t be empty', {status: 'danger'});
            return false;
        }

        ret.o_price2 = o_price2.val();
    }

    $.post('/order/execute', ret, function (o) {
        var json = JSON.parse(o);
        if (json.code == 200) {
            o_price.parent().html(o_price.val() + $('#current_cur').val());
            $(data).find('.row_date').html('Open: ' + json.date);
            $(data).find('.row_quantity').html(json.quantity);
            $(data).find('.row_budget').html(json.budget+$('#current_cur').val());
            $(data).find('.execute_button').remove();

            if($(data).attr('spread') != 0){
                o_price2.parent().html(o_price2.val() + $('#current_cur').val());
                s_row.find('.row_date').html('Open: ' + json.date);
                s_row.find('.row_quantity').html(json.quantity2);
                s_row.find('.row_budget').html(json.budget2+$('#current_cur').val());
                s_row.find('.execute_button').remove();
            }

        }
        return false;
    });
    return false;
}
function ResetAddForm(){
    $('#add_order_row input[type="text"]').val('');
    $('#add_order_row select').val(1);
    $('#add_order_row #lmt_price, #add_order_row #lmt_price2').remove();
}
function UpdateAddForm(row, fields){
    ResetAddForm();
    spread = false;
    if(row.attr('spread') != 0){
        var row2 = $('tr[rel="'+row.attr('spread')+'"]');
        if(row.find('.row_action').attr('field') == 'action2'){
            var tmp_row = row;
            row = row2;
            row2 = tmp_row;
        }
        spread = true;
    }
    for( f in fields){
        GenerateCloseCell(row.find('[field="'+fields[f]+'"]'), fields[f], '');
        if(spread)
            GenerateCloseCell(row2.find('[field="'+fields[f]+'2"]'), fields[f], 2);
    }

    if($('.add_order_budget').val() == '' && $('.add_order_quantity').val() == '' ) $('.add_order_budget, .add_order_quantity').removeAttr('disabled');
    if($('.add_order_budget').val() != '' && $('.add_order_quantity').val() != '' ) {
        $('.add_order_quantity').removeAttr('disabled');
        $('.add_order_budget').val('').attr('disabled', 'disabled');
    }
    if($('.add_order_budget2').val() == '' && $('.add_order_quantity2').val() == '' ) $('.add_order_budget2, .add_order_quantity2').removeAttr('disabled');
    if($('.add_order_budget2').val() != '' && $('.add_order_quantity2').val() != '' ) {
        $('.add_order_quantity2').removeAttr('disabled');
        $('.add_order_budget2').val('').attr('disabled', 'disabled');
    }
}


function GenerateCloseCell(row_cell, field, pos){
    $('.add_order_'+field+pos).val(row_cell.attr('rel'));

    if(field == 'ticker') $('.add_order_ticker_text'+pos).val(row_cell.html());
    if(field == 'type' && row_cell.attr('lmt') != '0')
        $('.add_order_type'+pos).after('<input id="lmt_price'+pos+'" value="'+row_cell.attr('lmt')+'" type="text"  name="Order'+pos+'[lmt_price]" style="width: 80px; margin-left: 10px;" />');
    if(field == 'quantity' && row_cell.attr('rel') == 0)
        $('.add_order_quantity'+pos).val('').attr('disabled', 'disabled');
    if(field == 'budget' && row_cell.attr('rel') == 0)
        $('.add_order_budget'+pos).val('').attr('disabled', 'disabled');
}


function ClosePosition(row){
    var fields = ['ticker', 'type', 'quantity', 'budget'];

    UpdateAddForm(row, fields);
    $('.order_action_field').val(2);
}
function BuyIn(row){
    var fields = ['ticker', 'type'];

    UpdateAddForm(row, fields);
    $('.order_action_field').val(1);
}
function Reduce(row){
    var fields = ['ticker', 'type'];

    UpdateAddForm(row, fields);
    $('.order_action_field').val(2);
}
function Delete(row){
    var id = row.attr('rel');
    if(!confirm('Do you want delete order #'+id+'?'))
        return false;
    $.post('/order/deleteOrder',{id:id}, function(){
        if(row.attr('spread') != 0)
            $('tr[rel="'+row.attr('spread')+'"]').remove();
        row.remove();
    })
}
function Split(row){

}