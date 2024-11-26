// Sample items
let items = [
  { id: 1, name: "Espresso", price: 150, description: "Strong black coffee.", category: "Coffee" },
  { id: 2, name: "Latte", price: 200, description: "Coffee with milk.", category: "Coffee" },
  { id: 3, name: "Latte", price: 200, description: "Coffee with milk.", category: "Coffee" },
  { id: 4, name: "Latte", price: 200, description: "Coffee with milk.", category: "Coffee" },
  { id: 5, name: "Latte", price: 200, description: "Coffee with milk.", category: "Coffee" },
  { id: 6, name: "Burger", price: 250, description: "Beef burger with cheese.", category: "Meal" },
  { id: 7, name: "Pizza", price: 300, description: "Cheese pizza.", category: "Meal" },
];

// Function to render items grouped by category
function renderItems() {
  const itemList = document.getElementById("item-list");
  itemList.innerHTML = "";

  const categories = [...new Set(items.map(item => item.category))];

  categories.forEach(category => {
    const categoryDiv = document.createElement("div");
    categoryDiv.className = "category";
    categoryDiv.innerHTML = `<h3>${category}</h3>`;

    items.filter(item => item.category === category).forEach(item => {
      const itemCard = document.createElement("div");
      itemCard.className = "item-card";
      itemCard.innerHTML = `
          <h4>${item.name}</h4>
          <p>${item.description}</p>
          <p>Price: ₹${item.price}</p>
          <button class="edit" onclick="editItem(${item.id})">Edit</button>
          <button onclick="deleteItem(${item.id})">Delete</button>
        `;
      categoryDiv.appendChild(itemCard);
    });

    itemList.appendChild(categoryDiv);
  });
}

// Function to handle form submission
document.getElementById("item-form").addEventListener("submit", event => {
  event.preventDefault();

  const itemId = document.getElementById("item-id").value;
  const itemName = document.getElementById("item-name").value;
  const itemPrice = document.getElementById("item-price").value;
  const itemDescription = document.getElementById("item-description").value;
  const itemCategory = document.getElementById("item-category").value;

  if (itemId) {
    // Edit existing item
    const itemIndex = items.findIndex(item => item.id === parseInt(itemId));
    items[itemIndex] = { id: parseInt(itemId), name: itemName, price: parseFloat(itemPrice), description: itemDescription, category: itemCategory };
  } else {
    // Add new item
    const newItem = { id: Date.now(), name: itemName, price: parseFloat(itemPrice), description: itemDescription, category: itemCategory };
    items.push(newItem);
  }

  document.getElementById("item-form").reset();
  renderItems();
});

// Function to delete an item
async function deleteItem(id) {
  items = items.filter(item => item.id !== id);
  // make a form data object
  const formData = new FormData();
  formData.append("delete_id", id);
  // send the form data to the server
  const response = await fetch("saveItem.php", {
    method: "POST",
    body: formData,
  });
  renderItems();
}

// Function to edit an item
function editItem(id) {
  const item = items.find(item => item.id === id);
  document.getElementById("item-id").value = item.id;
  document.getElementById("item-name").value = item.name;
  document.getElementById("item-price").value = item.price;
  document.getElementById("item-description").value = item.description;
  document.getElementById("item-category").value = item.category;
  scrollToForm();
}


async function initialiseItems() {
  const response = await fetch("getMenu.php");
  const data = await response.json();
  items = data.map(item => {
    return { id: parseInt(item.id), name: item.name, price: parseInt(item.price), description: item.description, category: item.section };
  });
  renderItems();
}

initialiseItems();

function scrollToForm() {
  const formElement = document.getElementById("item-form");
  formElement.scrollIntoView({ behavior: "smooth", block: "start" });
}


const submit_btn = document.getElementById("submit_btn");

submit_btn.addEventListener("click", async function (event) {
  event.preventDefault();
  
  const id = document.getElementById("item-id").value;
  const name = document.getElementById("item-name").value;
  const price = document.getElementById("item-price").value;
  const description = document.getElementById("item-description").value;
  const category = document.getElementById("item-category").value;

  console.log("id =>", id);
  console.log("name =>", name);
  console.log("price =>", price);
  console.log("description =>", description);
  console.log("category =>", category);

  const formData = new FormData();
  formData.append("id", id);
  formData.append("name", name);
  formData.append("price", price);
  formData.append("description", description);
  formData.append("category", category);

  console.log("formData =>", [...formData]); // To log the FormData content

  const response = await fetch("saveItem.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  console.log("data =>", data);

  document.getElementById("item-form").reset(); // Reset form after submission

  initialiseItems();
});


const switch_btn = document.getElementById("switch");
switch_btn.addEventListener("click", function () {
  location.href = "order.html";
});