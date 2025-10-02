import axios from "axios";
window.axios = axios;
window.pr = (value, title = "") => {
    console.log("--------------------------");
    if (title) console.log(title);
    console.log(value);
    console.log("");
    return value;
};
