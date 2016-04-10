(function($){
    $(document).ready(function(){
        // your js here
    });

    $('.changeImage').click(function(e){
        e.preventDefault();
        var form = $('input.field_type'),
            el = $(this).attr('id');
            
        switch(el){
            case 'chg-picture':
                form.val('picture');
                break;
            case 'chg-cover':
                form.val('cover');
                break;
            default:
                form.val('picture');
                break;
        }
    });
})(jQuery);