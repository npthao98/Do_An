//Add Input Fields
$(document).ready(function() {
    var max_fields = 5; //Maximum allowed input fields
    var wrapper = $(".wrapper");
    var add_button = $(".add_fields");
    var x = 1; //Initial input field is set to 1

    const wrapper1 = document.querySelector('.wrapper');
    const child = wrapper1.children[0].cloneNode(true);

    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            //add input field
            wrapper1.insertBefore(child.cloneNode(true), wrapper1.children[wrapper.children.length - 2]);
            $('.remove_field').removeAttr('hidden');
        }
    });

    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
