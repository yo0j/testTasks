$(document).ready(function () {
    sessionStorage.removeItem('participantsData'); // Очищаем данные при загрузке страницы

    let savedParticipantsData = [];
    let sortByNameAsc = true;
    let sortByPointsAsc = true;

    $('#addButton').click(function () {
        addParticipants();
    });

    $('#participants').keypress(function (event) {
        if (event.which === 13) {
            addParticipants();
        }
    });

    $('#participantsTable').on('click', 'th', function() {
        const index = $(this).index();
        if (index === 1) {
            savedParticipantsData.sort((a, b) => sortByNameAsc ? a.name.localeCompare(b.name) : b.name.localeCompare(a.name));
            sortByNameAsc = !sortByNameAsc;
        } else if (index === 2) {
            savedParticipantsData.sort((a, b) => sortByNameAsc ? a.points - b.points : b.points - a.points);
            sortByPointsAsc = !sortByPointsAsc;
        }
        displayParticipants(savedParticipantsData);
    });

    function addParticipants() {
        const participants = $('#participants').val().trim();
        if (participants === '') {
            showErrorMessage('Введите имена участников');
            return;
        }

        $.ajax({
            url: 'generate_scores.php',
            type: 'POST',
            data: {participants: participants},
            success: function (data) {
                const participantsData = JSON.parse(data);
                participantsData.forEach((participant) => savedParticipantsData.push(participant));
                displayParticipants(savedParticipantsData);
                $('#participants').val('');
            },
            error: function () {
                showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
            }
        });
    }

    function displayParticipants(participantsData) {
        const tableBody = $('#participantsTable tbody');
        tableBody.empty();
        participantsData.forEach(function (participant, index) {
            const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${participant.name}</td>
                            <td>${participant.points}</td>
                        </tr>`;
            tableBody.append(row);
        });
    }

    function showErrorMessage(message) {
        alert(message);
    }
});
