document.querySelectorAll('.date-picker-group').forEach(group => {
    const input = group.querySelector('.date-input');
    const button = group.querySelector('.calendar-button');
    button.addEventListener('click', () => {
        if (input.showPicker) {
            input.showPicker(); // For modern browsers
        } else {
            input.focus(); // Fallback
        }
    });
});