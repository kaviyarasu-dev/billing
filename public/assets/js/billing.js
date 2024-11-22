// Dynamically add product rows
const productsList = document.getElementById('products-list');
const addProductButton = document.getElementById('add-product');
let productCounter = 0;

addProductButton.addEventListener('click', () => {
    productCounter++;
    const productRow = document.createElement('div');
    productRow.className = 'product-row';
    productRow.innerHTML = `
        <input type="text" name="product-id[${productCounter}]" class="product-input" onchange="getProduct(this)" placeholder="Product ID" required>
        <input type="number" name="product-quantity[${productCounter}]" class="quantity-input" oninput="fixQuantity(this)" placeholder="Quantity" required>
    `;
    productsList.appendChild(productRow);
});

/**
 * Fetches product details from the server and adds the product quantity to
 * the input element as a data attribute. This is called when the user
 * types a product ID into the input field.
 *
 * @param {HTMLInputElement} input The input element containing the product ID.
 */
function getProduct(input) {
    input.classList.remove('error');
    fetch(getProductUrl.replace(':productId', input.value))
        .then(response => response.json())
        .then(response => {
            input.nextElementSibling.setAttribute('data-quantity', response.data.quantity);
        })
        .catch(error => {
            input.classList.add('error');
            console.error('Error fetching product details:', error);
        });
}

/**
 * Checks that the quantity entered by the user is within the range of 1 to the
 * available quantity of the product. If the quantity is outside this range, it
 * is adjusted to be within the range.
 *
 * @param {HTMLInputElement} input The input element containing the quantity.
 */
function fixQuantity(input) {
    const availableQuantity = parseFloat(input.getAttribute('data-quantity'));
    const quantity = parseFloat(input.value);

    if (quantity <= 0) {
        input.value = 1;
    }

    if (quantity >= availableQuantity) {
        input.value = availableQuantity;
    }
}

// Generate Bill Logic
const generateBillButton = document.getElementById('generate-bill');
generateBillButton.addEventListener('click', () => {
    const email = document.getElementById('customer-email').value;
    const amountGiven = parseFloat(document.getElementById('amount-given').value);

    // Collect product details
    const productRows = productsList.querySelectorAll('.product-row');
    let totalAmount = 0;
    productRows.forEach(row => {
        const productId = row.querySelector('input:nth-child(1)').value;
        const quantity = parseFloat(row.querySelector('input:nth-child(2)').value);
        // Assume each product has a fixed price of 100 for simplicity
        totalAmount += quantity * 100;
    });

    // Calculate balance
    const balance = amountGiven - totalAmount;

    // Display Result
    const result = document.getElementById('result');
    result.style.display = 'block';
    const billDetails = document.getElementById('bill-details');
    billDetails.innerHTML = `
        Customer Email: ${email} <br>
        Total Amount: ₹${totalAmount.toFixed(2)} <br>
        Amount Given: ₹${amountGiven.toFixed(2)} <br>
        Balance to Return: ₹${balance.toFixed(2)}
    `;
});
