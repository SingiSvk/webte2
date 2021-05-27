function sortTable(n) {

    let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("winners_table");
    switching = true;

    dir = "asc";
    while (switching) {

        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {

            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

$("#add_person").on("click",function () {
    let form = $("#add_person_form");
    if (form.is(":hidden")){
        form.show();
    }else{
        form.hide();
    }
})

$("#add_placement").on("click",function () {
    console.log("1");
    let form = $("#add_placement_form");
    if (form.is(":hidden")){
        console.log("2");
       form.show();
    }else{
        console.log("3");
        form.hide();
    }
})