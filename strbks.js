window.addEventListener("load", getOrders);
document.getElementById("type").addEventListener("change", getSubTypes);

//Subtypes display
function getSubTypes() {
    var consumable = "";
    consumable = document.getElementById('type').value;


    if (consumable.localeCompare("beverage") == 0) {
        axios
            .get("dbrequest.php", {
                params: {
                    beverage: true,
                }
            })
            .then((response) => displaySubType(response))
            .catch((error) => {
                console.log(error);
            });
        document.getElementById("cupSize").style.display = "block";
        document.getElementById("warmed").style.display = "none";
    } else if (consumable.localeCompare("food") == 0) {
        axios
            .get("dbrequest.php", {
                params: {
                    food: true,
                }
            })
            .then((response) => displaySubType(response))
            .catch((error) => {
                console.log(error);
            });
        document.getElementById("cupSize").style.display = "none";
        document.getElementById("bevrgTemp").style.display = "none";
    }
}

function displaySubType(response) {

    var result = response;

    var layout = `<option disabled selected>Choose</option>`;
    for (i in result.data) {
        layout +=
            "<option value=" +
            result.data[i].subtypeID + ">" +
            result.data[i].subtypeName + "</option>";
    }

    document.getElementById('subtype').innerHTML = layout;
}

document.getElementById('subtype').addEventListener("change", getProducts);

//Product Display
function getProducts() {

    var products = "";
    products = document.getElementById('subtype').value;

    axios
        .get("dbrequest.php", {
            params: {
                product: products,
            }
        })
        .then((response) => displayProducts(response))
        .catch((error) => {
            console.log(error);
        });

    if (products == 3) {
        document.getElementById("siracha").style.display = "none";
        document.getElementById("warmed").style.display = "block";
        document.getElementById("bevrgTemp").style.display = "none";
    } else if (products == 4 || products == 5) {
        document.getElementById("siracha").style.display = "none";
        document.getElementById("warmed").style.display = "none";
        document.getElementById("bevrgTemp").style.display = "block";
    } else if (products == 1) {
        document.getElementById("siracha").style.display = "block";
        document.getElementById("warmed").style.display = "none";
        document.getElementById("bevrgTemp").style.display = "none";
    } else {
        document.getElementById("siracha").style.display = "none";
        document.getElementById("warmed").style.display = "none";
        document.getElementById("bevrgTemp").style.display = "none";
    }
}

function displayProducts(response) {
    var result = response;

    var layout = `<option disabled selected>Choose</option>`;

    for (i in result.data) {
        layout +=
            "<option value=" +
            result.data[i].productID + ">" +
            result.data[i].productName + "</option>";
    }

    document.getElementById('product').innerHTML = layout;

}

//siracha part
document.getElementById("addSiracha").addEventListener("click", addSiracha);
document.getElementById("minusSiracha").addEventListener("click", minusSiracha);

function addSiracha() {
    var siracha = Number(document.getElementById("sirachaAmount").value);
    siracha += 1;
    document.getElementById("sirachaAmount").value = siracha;

}

function minusSiracha() {
    var siracha = Number(document.getElementById("sirachaAmount").value);
    if (siracha > 1) {
        siracha -= 1;
    } else {
        siracha = 1;
    }
    document.getElementById("sirachaAmount").value = siracha;
}


//quantity part
document.getElementById("addQuantity").addEventListener("click", addQuantity);
document.getElementById("minusQuantity").addEventListener("click", minusQuantity);

function addQuantity() {
    var quantity = Number(document.getElementById("quantity").value);
    quantity += 1;
    document.getElementById("quantity").value = quantity;

}

function minusQuantity() {
    var quantity = Number(document.getElementById("quantity").value);
    if (quantity > 1) {
        quantity -= 1;
    } else {
        quantity = 1;
    }
    document.getElementById("quantity").value = quantity;
}

//order button
document.getElementById('orderItem').addEventListener('click', getRow);

function getRow() {

    var products = "";
    products = document.getElementById('product').value;

    axios
        .get("dbrequest.php", {
            params: {
                getProductRow: products,
            }
        })
        .then((response) => putOrderToSession(response))
        .catch((error) => {
            console.log(error);
        });
}

//putting data to database
//kani kay inaccurate ni name kay more of atong gi butang ang data sa session dayun gi pasa sa database
function putOrderToSession(response) {

    var name, subtype, price, quantity, sirachaQty, type, size, warmed, price;

    name = response.data.productName;
    subtype = response.data.subtypeID;
    price = response.data.price;

    quantity = document.getElementById('quantity').value;
    sirachaQuantity = document.getElementById('sirachaAmount').value;

    if (document.getElementById('hot').checked) {
        type = document.getElementById('hot').value;
    } else if (document.getElementById('iced').checked) {
        type = document.getElementById('iced').value;
    }

    if (document.getElementById('tall').checked) {
        size = document.getElementById('tall').value;
    } else if (document.getElementById('grande').checked) {
        size = document.getElementById('grande').value;
    } else if (document.getElementById('venti').checked) {
        size = document.getElementById('venti').value;
    }

    if (document.getElementById('warm').checked) {
        warmed = document.getElementById('warm').value;
    } else if (document.getElementById('cold').checked) {
        warmed = document.getElementById('cold').value;
    }

    axios
        .post("dbrequest.php", {
            order: true,
            productName: name,
            subtypeID: subtype,
            itemPrice: price,
            qty: quantity,
            sirachaQty: sirachaQuantity,
            drinkType: type,
            drinkSize: size,
            cakeWarmed: warmed,
        })
        .then((response) => getOrders(response))
        .catch((error) => {
            console.log(error);
        });
}

function getOrders(response) {
    axios
        .get("dbrequest.php", {
            params: {
                order: true,
            }
        })
        .then((response) => displayOrder(response))
        .catch((error) => {
            console.log(error);
        });
}

function displayOrder(response) {
    var result = response;


    var layout = `<table>
                                <thead>
                                <tr>
                                    <td>
                                        ITEM NAME
                                    </td>
                                    <td>
                                        QUANTITY
                                    </td>
                                    <td>
                                        BASE PRICE
                                    </td>
                                    <td>
                                        DRINK SIZE
                                    </td>
                                    <td>
                                        ADDITIONAL SIRACHA
                                    </td>
                                    <td>
                                        WARMED CAKE?
                                    </td>
                                    <td>
                                        PRICE
                                    </td>
                                    <td>
                                        <button id="finalizeOrderBtn" onclick="getReceipt()">FINALIZE ORDER</button>
                                    </td>


                                </tr>
                                </thead>
                            `;
    var temp = "";
    for (i in result.data) {
        if (result.data[i].drinkType == 1) {
            var temp = "Hot ";
        } else if (result.data[i].drinkType == 2) {
            var temp = "Iced ";
        } else {
            var temp = "";
        }

        if (result.data[i].sirachaQty == null) {
            result.data[i].sirachaQty = "";
        }
        if (result.data[i].cakeWarmed == null) {
            result.data[i].cakeWarmed = "";
        }
        if (result.data[i].drinkSize == null) {
            result.data[i].drinkSize = "";
        }
        layout +=
            `<tr>
                    <td>
                        ${temp}${result.data[i].itemName}
                    </td>
                    <td>
                        ${result.data[i].quantity}
                    </td>
                    <td>
                        ${result.data[i].itemPrice}
                    </td>
                    <td>
                        ${result.data[i].drinkSize}
                    </td>
                    <td>
                        ${result.data[i].sirachaQty}
                    </td>
                    <td>
                        ${result.data[i].cakeWarmed}
                    </td>
                    <td>
                        ${result.data[i].totalPrice}
                    </td>
                    <td>
                        <button id="${result.data[i].orderID}" class="cancelButton" onclick="cancelItem()">CANCEL</button>
                    </td>
                </tr>`;

    }
    layout += `</table>`;

    document.getElementById('testReceipt').innerHTML = layout;
}

function cancelItem() {

    var cancelButton = this.document.activeElement;
    var id = cancelButton.id;



    axios
        .post("dbrequest.php", {
            delete: true,
            toBeCanceled: id,
        })
        .then((response) => getOrders(response))
        .catch((error) => {
            console.log(error);
        });



}

function getReceipt() {
    document.getElementById("a").style.display = "none";
    document.getElementById("testReceipt").style.display = "none";
    document.getElementById("receipt").style.display = "block";

    var layout = `<table>
                                <thead>
                                <tr>
                                    <td>
                                        ITEM NAME
                                    </td>
                                    <td>
                                        QUANTITY
                                    </td>
                                    <td>
                                        BASE PRICE
                                    </td>
                                    <td>
                                        DRINK SIZE
                                    </td>
                                    <td>
                                        ADDITIONAL SIRACHA
                                    </td>
                                    <td>
                                        WARMED CAKE?
                                    </td>
                                    <td>
                                        PRICE
                                    </td>
                                    <td>
                                        <button id="printReceipt" onclick="printReceipt()">PRINT RECEIPT </button>
                                    </td>


                                </tr>
                                </thead>
                            `;

    layout += `</table>`
    document.getElementById('receipt').innerHTML = layout;

}

//ang pag detect sa click functionality kay ibutang ra sa 'onclick' sa button
//document.getElementById('reset').addEventListener('click', printReceipt);

function printReceipt(){
    axios
        .get("dbrequest.php", {
            params: {
                reset: true,
            }
        })
        .then((response) => {console.log(response)})
        .catch((error) => {
            console.log(error);
        });

    location.reload();
}