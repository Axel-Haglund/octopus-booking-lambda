const cells = document.querySelectorAll(".cell");
console.log(cells);
cells.forEach((cell) => {
  cell.addEventListener("click", cellOnClick);
  console.log(cell);
});

function cellOnClick(event) {
  console.log(event);
  event.target.classList.toggle("booked");
}
