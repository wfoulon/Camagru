function highlight(input, error) 
{
    if (error)
        input.style.backgroundColor = "#fba";
    else
        input.style.backgroundColor = "#aaffbb";
}

function verif_login(input)
{
/*  Usernames can consist of lowercase and capitals
    Usernames can consist of alphanumeric characters
    Usernames can consist of underscore and hyphens and spaces
    Cannot be two underscores, two hypens or two spaces in a row
    Cannot have a underscore, hypen or space at the start or end */
    var regex = /^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/;
    if (!regex.test(input.value))
    {
        highlight(input, true);
        return (false);
    }   
    else
    {
        highlight(input, false);
        return (true);
    }
}

function verif_email(input)
{
    var regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    if (!regex.test(input.value))
    {
        highlight(input, true);
        return false;
    }
    else 
    {
        highlight(input, false);
        return true;
    }
}

function verif_password(input)
{
    /* Minimum eight characters, at least one uppercase letter, one lowercase letter and one number */
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!regex.test(input.value))
    {
        highlight(input, true);
        return false;
    }
    else
    {
        highlight(input, false);
        return true;
    }
}

function verif_form(f) {
    var pseudoOk = verif_login(f.pseudo);
    var mailOk = verif_email(f.email);
    var passwordOk = verif_password(f.password);

    if (pseudoOk && mailOk && passwordOk)
        return true;
    else 
    {
        alert("Please field all the areas");
        return false;
    }
}
