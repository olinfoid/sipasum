function check_string(str) {
    var string = "false";
    if (str.trim().length > 0) {
        string = "true";
    } else {
        string = "false";
    }
    return string;
}

function show_modal(modal) {
    var myModal = new bootstrap.Modal(document.getElementById(modal));
    myModal.show();
}

function close_modal(modal) {
    const myModal = bootstrap.Modal.getInstance(document.getElementById(modal));
    myModal.hide();
}

function dotInString(str) {
    if (str.includes(".")) {
        return true;
    } else {
        return false;
    }
}

function inArray(target, array, obj) {
    return array.some((object) => object[obj] === target);
}
