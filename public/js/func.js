$( document ).ready(function(){
    $('#delCar').attr('disabled', true);;
    $('#avto').hide();
    $( '#addCar' ).click(addFields).local;
    $( '#delCar' ).click(removeFields);

});

var i = 0;

function addFields(){

    $('#delCar').attr('disabled', false);
    $('#avto').show();


    i++;


    var fields = "<div id=\"car\" class=\"form-row\">\n" +
        " <p class=\"m-0 align-self-center\"> " + i + ": </p>\n" +
        "                            <div class=\"align-self-center col pt-1 pb-1\">\n" +
        "                                <input type=\"text\" name=\"avto_num[]\" class=\"form-control\" placeholder=\"Номер машины\" >\n" +
        "                            </div>\n" +
        "                            <div class=\"align-self-center col pt-1 pb-1\">\n" +
        "                                <input type=\"text\"  name=\"avto_name[]\" class=\"form-control\" placeholder=\"Имя водителя\">\n" +
        "                            </div>\n" +
        "                        </div>";


    $('#cars').append(fields);


};

function removeFields(){

    $('#car:last-of-type').remove();
    i--;

    if (i == 0) {
        $('#delCar').attr('disabled', true);
        $('#avto').hide();

    }


};