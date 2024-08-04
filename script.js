document.addEventListener("DOMContentLoaded", function() {
    function fetchPatients() {
        fetch('get_patients.php')
            .then(response => response.json())
            .then(data => {
                // Update the UI with the new patient data
                const tableBody = document.querySelector('table tbody');
                tableBody.innerHTML = '';
                data.forEach(patient => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${patient.name}</td>
                        <td>${patient.code}</td>
                        <td>${patient.severity}</td>
                        <td>${patient.wait_time}</td>
                    `;
                    tableBody.appendChild(row);
                });
            });
    }

    // Call fetchPatients every minute to refresh the patient list
    setInterval(fetchPatients, 60000);
    fetchPatients();
});
