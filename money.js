function addProjectRow(date, time, day, amount) {
  console.log(`Adding row: ${date}, ${time}, ${day}, ${amount}`);
  var newRow = `
      <tr>
          <td>${date}</td>
          <td>${time}</td>
          <td>${day}</td>
          <td>Rp ${formatRupiah(amount)}</td>
          <td>
              <button type="button" class="btn-icon delete-project">
                  <img src="https://static.vecteezy.com/system/resources/previews/000/594/236/original/trash-can-icon-logo-template-illustration-design-vector-eps-10.jpg" alt="Delete" style="width:20px;height:20px;">
              </button>
          </td>
      </tr>
  `;
  $("#project-info").append(newRow);
}

document.querySelector( "#retrobg-sun" ).onclick = () => {
    document.querySelector( "#retrobg" ).classList.toggle( "retrobg-shutdown" );
  };