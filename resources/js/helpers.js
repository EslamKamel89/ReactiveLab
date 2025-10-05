window.pr = (value, title = "") => {
    console.log("--------------------------");
    if (title) console.log(title);
    console.log(value);
    console.log("");
    return value;
};
window.capitalize = (str) => {
    let temp = "";
    temp = str.slice(0, 1).toUpperCase() + str.slice(1);
    return temp;
};
