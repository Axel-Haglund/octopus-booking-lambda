const cells = document.querySelectorAll(".cell");

cells.forEach((cell) => {
  cell.addEventListener("click", cellOnClick);
  // console.log(cell);
});

function cellOnClick(event) {
  console.log(event);
  event.target.classList.toggle("selected");
}

const submitBookingButton = document.getElementById("submitBookingButton");
submitBookingButton.addEventListener("click", submitBooking);
function submitBooking(e) {
  e.preventDefault();
  const selectedCells = Array.from(document.querySelectorAll(".cell.selected"));
  // console.log(selectedCells);

  const bookings = [];

  for (let i = 0; i < selectedCells.length; i++) {
    // Get the current <li> element
    const listItem = selectedCells[i];

    // Extract the data attributes and store them in an object
    const itemData = {
      room: listItem.dataset.room,
      hour: listItem.dataset.hour,
    };
    bookings.push(itemData);
  }

  sendBookings(bookings);
  console.log(bookings);
}

async function sendBookings(bookings) {
  try {
    const response = await fetch("insert_bookings.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(bookings),
    });

    const responseData = await response.text();
    console.log(responseData); // This is the response from your PHP file
    location.reload();
  } catch (error) {
    console.error("Error:", error);
  }
}
