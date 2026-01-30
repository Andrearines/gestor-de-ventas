


function openTeamModal() {
    document.getElementById('teamModal').style.display = 'flex';
}
function closeTeamModal() {
    document.getElementById('teamModal').style.display = 'none';
}
function openMemberModal() {
    document.getElementById('memberModal').style.display = 'flex';
}
function closeMemberModal() {
    document.getElementById('memberModal').style.display = 'none';
}
function handleTeamSubmit(e) {
    e.preventDefault();
    alert('Equipo creado exitosamente (Simulación)');
    closeTeamModal();
}
function handleMemberSubmit(e) {
    e.preventDefault();
    const name = document.getElementById('memberName').value;
    alert(`Miembro "${name}" creado exitosamente (Simulación)`);
    closeMemberModal();
    e.target.reset();
}