$( document ).ready(function(){
    $('#delCar').attr('disabled', true);
    $('#avto').hide();
    $( '#addCar' ).click(addFields).local;
    $( '#delCar' ).click(removeFields);
    $('#editBlock').click(editBlock);
    $('#submit').click(isEmptyField);
    $('.deleteCar').click(delCar);



});

var i = 0;

function addFields(){

    $('#delCar').attr('disabled', false);
    $('#avto').show();


    i++;


    var fields = "                   <div id='car' class='row'>" +
        "                            <p class=\"m-0 col-md-1 align-self-center\"> "+i+": </p>\n" +
        "                            <div class=\"align-self-center col-md-2 pt-1 pb-1\">\n" +
        "                                <input type=\"text\" name=\"new_avto_num[]\" class=\"form-control\" placeholder=\"Номер машины\" >\n" +
        "                            </div>\n" +
        "                            <div class=\"align-self-center col-md-2 pt-1 pb-1\">\n" +
        "                                <input type=\"text\"  name=\"new_avto_name[]\" class=\"form-control\" placeholder=\"Имя водителя\">\n" +
        "                            </div>";


    $('#newCar').append(fields);


};

function removeFields(){

    $('#car:last-of-type').remove();
    i--;

    if (i == 0) {
        $('#delCar').attr('disabled', true);
    }


};

function editBlock(id) {

    var num = $('#num_'+id).html();
    var name = $('#name_'+id).html();

    $('#id_'+id).html(

        "                            <p class=\"m-0 col-md-1 align-self-center\"> "+id+": </p>\n" +
        "                            <input type=\"hidden\" name=\"edit_avto_id[]\" value=\""+id+"\">\n" +
        "                            <div class=\"align-self-center col-md-2 pt-1 pb-1\">\n" +
        "                                <input type=\"text\" name=\"edit_avto_num[]\" class=\"form-control\" placeholder=\"Номер машины\" value='"+num+"'>\n" +
        "                            </div>\n" +
        "                            <div class=\"align-self-center col-md-2 pt-1 pb-1\">\n" +
        "                                <input type=\"text\"  name=\"edit_avto_name[]\" class=\"form-control\" placeholder=\"Имя водителя\" value='"+name+"'>\n" +
        "                            </div>"

    );
};



function isEmptyField() {

    let error = [];

    var input = $('input:text');

    $.each(input, function(){

        if( $(this).val().trim() === "" ){

            $(this).css('border', '1px solid red');

            error = [false];

        } else {

            $(this).removeAttr('style');
        }

    });

    if (error.length == 0) {
        $('#err').html('');
        $('#submit').submit();
        
    } else {

        $('#err').html('<div class="row justify-content-center pb-2">\n' +
            '                            <span class="badge badge-pill badge-warning  p-2 col-md-6">Заполните все поля!</span><br>\n' +
            '                        </div>');
        
        return false;
        
    }

}


function delCar() {

    var id = this.id;

    $.post(
        'car/delete/'+id,
        {
            carId: id
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {

        if (data == 1) {

            $('#id_'+id).remove();

        } else {

            console.log(data);

        }

    }

}



function removeFromPark(parkId, carId){

    $.post(
        "car/remove-from-park/"+carId,
        {
            parkId: parkId, carId: carId
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {

        if (data == 1) {

            $('#id_'+carId).remove();

        } else {

            console.log(data);

        }

    }




}