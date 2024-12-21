function toggleDetails(img) {
    const commands = img.parentElement.querySelector('.commands');
    commands.style.display = commands.style.display === 'block' ? 'none' : 'block';
}
