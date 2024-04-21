$(document).ready(function () {
    $('#addButton').click(addParticipants);
    $('#participants').keypress(function (event) {
        if (event.which === 13) {
            addParticipants();
        }
    });

    function addParticipants() {
        const participants = $('#participants').val().trim();
        if (participants === '') {
            showErrorModal('Введите имена участников');
            return;
        }

        const participantsArray = participants.split(',');
        const participantsData = participantsArray.map(function (name, index) {
            return {id: index + 1, name: name.trim(), points: Math.floor(Math.random() * 100) + 1};
        });

        displayParticipants(participantsData);
        $('#participants').val('');
    }

    function displayParticipants(participantsData) {
        const tableBody = $('#participantsTable tbody');
        tableBody.empty();
        participantsData.forEach(function (participant) {
            const row = `<tr>
                            <td>${participant.id}</td>
                            <td>${participant.name}</td>
                            <td>${participant.points}</td>
                        </tr>`;
            tableBody.append(row);
        });
    }

    function showErrorModal(message) {
        $('#errorText').text(message);
        $('#errorModal').modal('show');
    }
});