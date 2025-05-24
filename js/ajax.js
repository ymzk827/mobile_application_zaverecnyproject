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

function promoteUser(id) {
    if (confirm("Promote user with ID " + id + "?")) {
      fetch("functions/admin/promote_user.php", {
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

  document.querySelectorAll('edit-form').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('functions/admin/update_feedback.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(text => {
        alert('Response: ' + text);
        if (text.includes("Success")) {
          location.reload(); // aktualizuj tabuľku
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Update failed. See console.');
      });
    });
  });
});

form.addEventListener('submit', function (e) {
  e.preventDefault();
  console.log("Form submitted");
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