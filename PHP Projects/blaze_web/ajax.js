
function loadUser(id){
    //Displaying the popup with JQuery
    $("#UserDetail").fadeIn(500);
    $(".ico").fadeIn(500);
    $(".table").fadeTo("slow", 0.2);
    
    // Displaying the popup with JavaScript
    // document.getElementById("UserDetail").style.display = "block";

    // Applying The Ajax Method
    $.ajax({
        url: "ajax_user_detail.php",
        //Now you also want to send data so use data parameter
        data: {
            user_id : id
        },
        // Now tell the type is it post or get type
        type: "GET",
        // if all ajax calls are successful then use succes parameter to check
        success : function(result){
            $("#UserDetail").html(result);
        }
    })
}
function closeUser(){
    //Displaying the popup with JQuery
    $("#UserDetail").fadeOut(500);
    $(".ico").fadeOut(500);
    $(".table").fadeTo("slow", 1);
}
function updateUser(id){
    
    // Get the valuses of form fields
    names = $("#name").val();
    email = $("#email").val();
    country = $("#country").val();
    // alert(names + ", " + email + ", " + country);
    

    // Applying The Ajax Method
    $.ajax({
        url: "update_user.php",
        //Now you also want to send data so use data parameter
        data: {
            user_id : id,
            name : names,
            email: email,
            country: country

        },
        // Now tell the type is it post or get type
        type: "POST",
        // if all ajax calls are successful then use succes parameter to check
        success : function(result){
            $("#updateResponse").fadeIn();
            $("#updateResponse").html(result);
            setTimeout(
                function(){
                    $("#UserDetail").fadeOut(500);
                    // To reload the page
                    location.reload();
                }, 2000
            );
        }
    });
}



