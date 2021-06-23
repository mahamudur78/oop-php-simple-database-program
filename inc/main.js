$(document).ready(function() {
    $("#show_hide_nPassword a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_nPassword input').attr("type") == "text"){
            $('#show_hide_nPassword input').attr('type', 'password');
            $('#show_hide_nPassword i').addClass( "fa-eye-slash" );
            $('#show_hide_nPassword i').removeClass( "fa-eye" );
        }else if($('#show_hide_nPassword input').attr("type") == "password"){
            $('#show_hide_nPassword input').attr('type', 'text');
            $('#show_hide_nPassword i').removeClass( "fa-eye-slash" );
            $('#show_hide_nPassword i').addClass( "fa-eye" );
        }
    });


    $("#show_hide_rNPassword a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_rNPassword input').attr("type") == "text"){
            $('#show_hide_rNPassword input').attr('type', 'password');
            $('#show_hide_rNPassword i').addClass( "fa-eye-slash" );
            $('#show_hide_rNPassword i').removeClass( "fa-eye" );
        }else if($('#show_hide_rNPassword input').attr("type") == "password"){
            $('#show_hide_rNPassword input').attr('type', 'text');
            $('#show_hide_rNPassword i').removeClass( "fa-eye-slash" );
            $('#show_hide_rNPassword i').addClass( "fa-eye" );
        }
    });
});


show_hide_nPassword