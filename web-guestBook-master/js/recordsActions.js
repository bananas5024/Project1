var records;

function getRecords() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "gettingRecords.php", false);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4) return;
        if (xhr.status === 200) {
            var guests = xhr.responseText;
            guests = JSON.parse(guests);
            records = guests;
        }
    };
    xhr.send();
}

function initRecords() {
    getRecords();

    var messageList = document.getElementById("messages-list");

    for (var key in records) {
        var listGroupItem = document.createElement("div");
        var email = document.createElement("div");
        var record = document.createElement("div");

        listGroupItem.setAttribute("class", "list-group-item");

        messageList.appendChild(listGroupItem);

        listGroupItem.appendChild(email);
        listGroupItem.appendChild(record);

        email.innerHTML = records[key].email;
        record.innerHTML = records[key].record;
    }
}