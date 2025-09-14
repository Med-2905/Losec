$('.counter-plus').click(function (e) {
    let qnt = $(e.currentTarget).siblings('#qnt');
    let qntValue = parseInt(qnt.val()) + 1;
    if(qntValue >= 99 ) qntValue = 99;
    qnt.val(qntValue);
});

$('.counter-moins').click(function (e) {
    let qnt = $(e.currentTarget).siblings('#qnt');
    let qntValue = parseInt(qnt.val()) - 1;
    if( qntValue <0 ) qntValue = 0;
    qnt.val(qntValue);
});

