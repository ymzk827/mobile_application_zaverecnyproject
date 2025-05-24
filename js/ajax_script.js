console.log("AJAX loaded");

function deleteUser(id) {
    if (confirm("Delete user with ID " + id + "?")) {
      fetch("functions/admin/delete_user.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + encodeURIComponent(id)
      })
  }
}

function deleteFeedback(id) {
    if (confirm("Delete this feedback?")) {
      fetch("functions/admin/delete_feedback.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + encodeURIComponent(id)
      })
  }
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
      const tr = button.closest('tr');
      const editRow = tr.nextElementSibling;
      if (editRow.classList.contains('edit-panel')) {
        editRow.classList.toggle('d-none');
      }
    });
  });
});





document.addEventListener('submit', function (e) {
  if (e.target.matches('.edit-form')) {
    e.preventDefault();
    console.log("Delegated submit");

    const formData = new FormData(e.target);

    fetch('functions/admin/update_feedback.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(text => {
      alert('Response: ' + text);
      if (text.includes("Success")) {
        location.reload(); // reload page on success
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Update failed. See console.');
    });
  }
}); 

document.addEventListener('submit', function (e) {
  if (e.target.matches('.add-form')) {
    e.preventDefault();
    console.log("Delegated submit");

    const formData = new FormData(e.target);

    fetch('functions/admin/create_feedback.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(text => {
      alert('Response: ' + text);
      if (text.includes("Success")) {
        location.reload(); // reload page on success
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Update failed. See console.');
    });
  }
}); 