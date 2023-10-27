function showConfirmation() {
    const modalContainer = document.getElementById("modal-container");
    modalContainer.style.display = "block";
}

function confirmAction() {
    location.href = 'edit-delete.php';
    closeConfirmation();
}

function cancelAction() {
    location.href = 'mypage.php';
    closeConfirmation();
}

function closeConfirmation() {
    const modalContainer = document.getElementById("modal-container");
    modalContainer.style.display = "none";
}