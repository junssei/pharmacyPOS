function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[1];
    if (td || td1) {
      txtValue = td.textContent || td.innerText;
      txtValue1 = td1.textContent || td1.innerText;
      if (
        txtValue.toUpperCase().indexOf(filter) > -1 ||
        txtValue1.toUpperCase().indexOf(filter) > -1
      ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

//Add to cart medicine section
document.addEventListener("DOMContentLoaded", function () {
  var productRows = document.querySelectorAll(".product-row");

  productRows.forEach(function (row) {
    row.addEventListener("click", function () {
      var id = row.getAttribute("data-id");
      var gname = row.getAttribute("data-genericName");
      var bname = row.getAttribute("data-brandName");
      var stock = row.getAttribute("data-stock");
      var price = row.getAttribute("data-price");

      addToCart(id, gname, bname, price, stock);
    });
  });

  function addToCart(id, gname, bname, price, stock) {
    var quantity = parseInt(prompt("Please enter quantity"));

    if (quantity == null || quantity == 0 || isNaN(quantity)) {
      return;
    }

    if (stock == 0) {
      alert("Out of Stock");
      // console.log("qty:" + quantity + " stck: " + stock);
      return;
    } else if (quantity > stock) {
      alert("You input too much quantity!");
      // console.log("qty:" + quantity + " stck: " + stock);
      return;
    }

    console.log("qty:" + quantity + " stck: " + stock);

    var subquantity = +quantity;
    var subtotal = price * subquantity;

    var cartTable = document.getElementById("cartTable");
    var existingRow = Array.from(cartTable.rows).find(
      (row) => row.getAttribute("data-id") === id
    );

    if (existingRow) {
      var currentQuantity = parseInt(existingRow.getAttribute("data-quantity"));
      var newQuantity = currentQuantity + subquantity;
      var newSubtotal = price * newQuantity;

      existingRow.setAttribute("data-quantity", newQuantity);
      existingRow.setAttribute("data-subtotal", newSubtotal);
      existingRow.cells[1].textContent = newQuantity;
      existingRow.cells[3].textContent = newSubtotal.toFixed(2);

      updateTally(subtotal, subquantity);
    } else {
      var newRow = document.createElement("tr");
      newRow.setAttribute("data-id", id);
      newRow.setAttribute("data-subtotal", subtotal);
      newRow.setAttribute("data-quantity", subquantity);
      newRow.innerHTML = `
          <td>${gname}<input type="hidden" name="medicines[]" value="${id}" id="hidden-id-${id}"></td>
          <td>${bname}<input type="hidden" name="medicines[]" value="${id}" id="hidden-id-${id}"></td>
          <td>${subquantity}<input type="hidden" name="quantities[]" value="${subquantity}" id="hidden-quantity-${id}"></td>
          <td>${price}</td>
          <td>${subtotal.toFixed(
            2
          )} <input type="hidden" name="subtotals[]" value="${subtotal.toFixed(
        2
      )}" id="hidden-subtotal-${id}"></td>
          <td> <img src="images/bin.png" alt="DELETE" class="delete-icon"> </td>
      `;

      cartTable.appendChild(newRow);

      newRow
        .querySelector(".delete-icon")
        .addEventListener("click", function () {
          deleteItem(newRow);
        });

      updateTally(subtotal, subquantity);
    }
  }

  function updateTally(subtotal, quantity) {
    var qty = document.getElementById("numQty");
    var stotal = document.getElementById("numSubtotal");
    var total = document.getElementById("numTotal");

    qty.textContent = parseInt(qty.textContent) + quantity;
    stotal.textContent = (parseFloat(stotal.textContent) + subtotal).toFixed(2);
    total.textContent = stotal.textContent;

    document.getElementById("totalAmount").value = stotal.textContent;
  }

  function deleteItem(row) {
    var subtotal = parseFloat(row.getAttribute("data-subtotal"));
    var quantity = parseInt(row.getAttribute("data-quantity"));

    row.remove();

    updateTally(-subtotal, -quantity);
  }
});
