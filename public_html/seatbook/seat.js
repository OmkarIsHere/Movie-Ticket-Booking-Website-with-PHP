var val = 0;
var ticket_numb1 = "";
var ticket_numb2 = "";
var ticket_numb3 = "";
var ticket_numb4 = "";
var ticket_numb5 = "";
var all_tickets = [];

function retrieve_id(ele) {
    var amt = 0;
    var countId = 0;
    let i = 0
    var checkedBox = document.querySelectorAll('input[type="checkbox"]:checked');
    /* it will brought all checked checkboxes */
    for (var eachCheckedBx of checkedBox) {
        countId++;/* to find how many tickets have slelected */

        for (; i < countId; i++) {
            all_tickets[i] = eachCheckedBx.id;
        }
        ticket_numb1 = all_tickets[0];
        ticket_numb2 = all_tickets[1];
        ticket_numb3 = all_tickets[2];
        ticket_numb4 = all_tickets[3];
        ticket_numb5 = all_tickets[4];

        document.getElementById("pay").style.visibility = "visible";
        document.getElementById("header-btns").style.visibility = "visible";
        document.getElementById("selected-tickets").innerHTML = countId;
        
        /* to display payment */
        var amt_str = document.getElementById(eachCheckedBx.id).value;
        amt += parseInt(amt_str);
        document.getElementById("total-pay").innerHTML = amt;
        
        /* disable tickets if uer select 5 tickets */
        if (countId == 5) {
            disable_unable(1);
            document.getElementById(ticket_numb1).disabled = false;
            document.getElementById(ticket_numb2).disabled = false;
            document.getElementById(ticket_numb3).disabled = false;
            document.getElementById(ticket_numb4).disabled = false;
            document.getElementById(ticket_numb5).disabled = false;
        }
        if (countId == 6) {
            document.getElementById("total-pay").innerHTML = amt - parseInt(ele.value);
            countId--;
            document.getElementById("selected-tickets").innerHTML = countId;
            document.getElementById(ele.id).checked = false;
            alert("Can't select more than 5 tickets");
            window.location.reload("seat.js");
        }
    }

    /* to remove value of selected tickets if user deselct any ticket */
    if (countId == 0) {
        document.getElementById("pay").style.visibility = "hidden";
        document.getElementById("header-btns").style.visibility = "hidden";
        ticket_numb1 = "";
        ticket_numb2 = "";
        ticket_numb3 = "";
        ticket_numb4 = "";
        ticket_numb5 = "";
        all_tickets = [];
        disable_unable(0);

    } else if (countId == 1) {
        ticket_numb2 = "";
        ticket_numb3 = "";
        ticket_numb4 = "";
        ticket_numb5 = "";
        all_tickets = [];
    } else if (countId == 2) {
        ticket_numb3 = "";
        ticket_numb4 = "";
        ticket_numb5 = "";
        all_tickets = [];
    } else if (countId == 3) {
        ticket_numb4 = "";
        ticket_numb5 = "";
        all_tickets = [];
        disable_unable(0);
    } else if (countId == 4) {
        ticket_numb5 = "";
        all_tickets = [];
        disable_unable(0);
    }
}

function disable_unable(val) {
    for (i = 1; i < 13; i++) {
        document.getElementById("A" + i).disabled = val;
        document.getElementById("B" + i).disabled = val;
        document.getElementById("C" + i).disabled = val;
        document.getElementById("D" + i).disabled = val;
        document.getElementById("E" + i).disabled = val;
        document.getElementById("F" + i).disabled = val;
        document.getElementById("G" + i).disabled = val;
        document.getElementById("H" + i).disabled = val;
        document.getElementById("I" + i).disabled = val;
        document.getElementById("J" + i).disabled = val;
        document.getElementById("K" + i).disabled = val;
    }

}
/* cancel button */
function showAlert() {
    swal({
        title: "Are you sure?",
        text: "Do you want to cancel seat booking?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = '../index.php';
        }
    })
}