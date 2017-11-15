$(document).ready(function() { 
    //initialize tablesorter plugin
    $("#results").tablesorter(); 
});

function addData()
{
    document.getElementById("invalidMsg").innerHTML = "";
    var rows = '';
    var name = document.getElementById("name").value;
    var color = document.getElementById("color").value;
    var pet = document.getElementById("pet").value;
    var birthday = document.getElementById("birthday").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    
    if (name == '') // if name empty, ie it is required
    {
        document.getElementById("invalidMsg").innerHTML += "Name is required.";
        return;
    }
    
    if (birthday == '') //if birthday is empty or not complete
    {
        document.getElementById("invalidMsg").innerHTML += "Birthday is required.";
        return;
    }
    
    if (email == '') // if email empty, ie it is required
    {
        document.getElementById("invalidMsg").innerHTML += "Email is required.";
        return;
    }
    
    if (document.getElementById("email").validity.patternMismatch) //validates email input against pattern given in html pattern attribute
    { 
        document.getElementById("invalidMsg").innerHTML += "Email is not in desired format. Ex: 'test@test.com'";
        return;
    }
    
    if (document.getElementById("phone").validity.patternMismatch) //validates phone input against pattern given in html pattern attribute
    { 
        document.getElementById("invalidMsg").innerHTML += "Phone number is not in desired format. Ex: 412-123-4567";
        return;
    }
    
    //create 'string' of inputted data plus tr and td tags for each new line/set of inputs
    rows += "<tr><td>" + name + "</td><td>" + color + "</td><td>" + pet + "</td><td>" + birthday + "</td><td>" + email + "</td><td>" + phone + "</td></tr>";
    
    //append new results to the tbody of the table
    $(rows).appendTo("#results tbody");
    
    //update tablesorter
    $("#results").trigger("update");
    
        
    //reset input fields
    resetData();
}

function resetData() 
{
    document.getElementById("data").reset();
}