const container = document.getElementById('cast_rows');
const addButton = document.getElementById('add_cast');
const template = document.getElementById('cast_row_template');

// If click button clone node first
if (container && addButton && template) {
    addButton.addEventListener('click', () => {
        const row = template.content.firstElementChild.cloneNode(true);

        container.appendChild(row);
        row.querySelector('input').focus();
    });

    // for remove button
    container.addEventListener('click', (event) => {
        const removeButton = event.target.closest('.btn-remove-cast');

        if (!removeButton || !container.contains(removeButton)) {
            return;
        }

        const row = removeButton.closest('.cast-row');
        const rows = container.querySelectorAll('.cast-row');

        if (rows.length === 1) {
            row.querySelector('input').value = '';
            row.querySelector('input').focus();
            return;
        }

        row.remove();
    });
}
