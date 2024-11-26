function check_string(str) {
    var string = "false";
    if (str.trim().length > 0) {
        string = "true";
    } else {
        string = "false";
    }
    return string;
}
