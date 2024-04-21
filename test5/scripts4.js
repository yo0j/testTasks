$(document).ready(function () {
    $('#addButton').click(function () {
        addParticipants();
    });

    $('#participants').keypress(function (event) {
        if (event.which === 13) {
            addParticipants();
        }
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
                displayParticipants(participantsData);
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

        let participants = [... participant, ... participantsData];

        participants.forEach(function (participant, index) {
            const row = <tr>
                <td>${index + 1}</td>
                <td>${participant.name}</td>
                <td>${participant.points}</td>
            </tr>;
            tableBody.append(row);
        });
    }

    function showErrorMessage(message) {
        alert(message);
    }
});

// $(document).ready(function () {
//     // При загрузке страницы отображаем сохраненных участников
//     displayParticipants();
//
//     $('#addButton').click(function () {
//         addParticipants();
//     });
//
//     $('#participants').keypress(function (event) {
//         if (event.which === 13) {
//             addParticipants();
//         }
//     });
//
//     function addParticipants() {
//         const participants = $('#participants').val().trim();
//         if (participants === '') {
//             showErrorMessage('Введите имена участников');
//             return;
//         }
//
//         $.ajax({
//             url: 'generate_scores.php',
//             type: 'POST',
//             data: {participants: participants},
//             success: function (data) {
//                 const participantsData = JSON.parse(data);
//                 saveParticipantsData(participantsData); // Сохраняем данные в sessionStorage
//                 displayParticipants(); // Отображаем участников на странице
//                 $('#participants').val('');
//             },
//             error: function () {
//                 showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
//             }
//         });
//     }
//
//     function saveParticipantsData(participantsData) {
//         sessionStorage.setItem('participantsData', JSON.stringify(participantsData));
//     }
//
//     function displayParticipants() {
//         const savedParticipantsData = JSON.parse(sessionStorage.getItem('participantsData')) || [];
//         const tableBody = $('#participantsTable tbody');
//         tableBody.empty();
//         savedParticipantsData.forEach(function (participant, index) {
//             const row = `<tr>
//                             <td>${index + 1}</td>
//                             <td>${participant.name}</td>
//                             <td>${participant.points}</td>
//                         </tr>`;
//             tableBody.append(row);
//         });
//     }
//
//     function showErrorMessage(message) {
//         alert(message);
//     }
// });

// $(document).ready(function () {
//     sessionStorage.removeItem('participantsData'); // Очищаем данные при загрузке страницы
//
//     $('#addButton').click(function () {
//         addParticipants();
//     });
//
//     $('#participants').keypress(function (event) {
//         if (event.which === 13) {
//             addParticipants();
//         }
//     });
//
//     function addParticipants() {
//         const participants = $('#participants').val().trim();
//         if (participants === '') {
//             showErrorMessage('Введите имена участников');
//             return;
//         }
//
//         $.ajax({
//             url: 'generate_scores.php',
//             type: 'POST',
//             data: {participants: participants},
//             success: function (data) {
//                 const participantsData = JSON.parse(data);
//                 saveParticipantsData(participantsData); // Сохраняем данные в sessionStorage
//                 displayParticipants(); // Отображаем участников на странице
//                 $('#participants').val('');
//             },
//             error: function () {
//                 showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
//             }
//         });
//     }
//
//     function saveParticipantsData(participantsData) {
//         sessionStorage.setItem('participantsData', JSON.stringify(participantsData));
//     }
//
//     function displayParticipants() {
//         const savedParticipantsData = JSON.parse(sessionStorage.getItem('participantsData')) || [];
//         const tableBody = $('#participantsTable tbody');
//         tableBody.empty();
//         savedParticipantsData.forEach(function (participant, index) {
//             const row = `<tr>
//                             <td>${index + 1}</td>
//                             <td>${participant.name}</td>
//                             <td>${participant.points}</td>
//                         </tr>`;
//             tableBody.append(row);
//         });
//     }
//
//     function showErrorMessage(message) {
//         alert(message);
//     }
// });

// $(document).ready(function () {
//     const savedParticipantsData = JSON.parse(localStorage.getItem('participantsData')) || [];
//
//     displayParticipants(savedParticipantsData);
//
//     $('#addButton').click(function () {
//         addParticipants();
//     });
//
//     $('#participants').keypress(function (event) {
//         if (event.which === 13) {
//             addParticipants();
//         }
//     });
//
//     function addParticipants() {
//         const participants = $('#participants').val().trim();
//         if (participants === '') {
//             showErrorMessage('Введите имена участников');
//             return;
//         }
//
//         $.ajax({
//             url: 'generate_scores.php',
//             type: 'POST',
//             data: {participants: participants},
//             success: function (data) {
//                 const participantsData = JSON.parse(data);
//                 savedParticipantsData.push(participantsData);
//                 localStorage.setItem('participantsData', JSON.stringify(savedParticipantsData));
//                 displayParticipants(savedParticipantsData);
//                 $('#participants').val('');
//             },
//             error: function () {
//                 showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
//             }
//         });
//     }
//
//     function displayParticipants(participantsData) {
//         const tableBody = $('#participantsTable tbody');
//         tableBody.empty();
//         participantsData.forEach(function (participant, index) {
//             const row = `<tr>
//                             <td>${index + 1}</td>
//                             <td>${participant.name}</td>
//                             <td>${participant.points}</td>
//                         </tr>`;
//             tableBody.append(row);
//         });
//     }
//
//     function showErrorMessage(message) {
//         alert(message);
//     }
// });

// $(document).ready(function () {
//     const savedParticipantsData = JSON.parse(localStorage.getItem('participantsData')) || [];
//
//     displayParticipants(savedParticipantsData);
//
//     $('#addButton').click(function () {
//         addParticipants();
//     });
//
//     $('#participants').keypress(function (event) {
//         if (event.which === 13) {
//             addParticipants();
//         }
//     });
//
//     function addParticipants() {
//         const participants = $('#participants').val().trim();
//         if (participants === '') {
//             showErrorMessage('Введите имена участников');
//             return;
//         }
//
//         $.ajax({
//             url: 'generate_scores.php',
//             type: 'POST',
//             data: {participants: participants},
//             success: function (data) {
//                 const participantsData = JSON.parse(data);
//                 savedParticipantsData.push(participantsData);
//                 localStorage.setItem('participantsData', JSON.stringify(savedParticipantsData));
//                 displayParticipants(savedParticipantsData);
//                 $('#participants').val('');
//             },
//             error: function () {
//                 showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
//             }
//         });
//     }
//
//     function displayParticipants(participantsData) {
//         const tableBody = $('#participantsTable tbody');
//         tableBody.empty();
//         participantsData.forEach(function (participant, index) {
//             const row = `<tr>
//                             <td>${index + 1}</td>
//                             <td>${participant.name}</td>
//                             <td>${participant.points}</td>
//                         </tr>`;
//             tableBody.append(row);
//         });
//     }
//
//     function showErrorMessage(message) {
//         alert(message);
//     }
// });

// function addParticipants() {
//     const participants = $('#participants').val().trim();
//     if (participants === '') {
//         showErrorMessage('Введите имена участников');
//         return;
//     }
//
//     $.ajax({
//         url: 'generate_scores.php',
//         type: 'POST',
//         data: {participants: participants},
//         success: function (data) {
//             const participantsData = JSON.parse(data);
//             savedParticipantsData.push(participantsData);
//             localStorage.setItem('participantsData', JSON.stringify(savedParticipantsData));
//             displayParticipants(savedParticipantsData);
//             $('#participants').val('');
//         },
//         error: function () {
//             showErrorMessage('Произошла ошибка. Попробуйте еще раз.');
//         }
//     });
// }
//
// function displayParticipants(participantsData) {
//     const tableBody = $('#participantsTable tbody');
//     tableBody.empty();
//     participantsData.forEach(function (participant, index) {
//         const row = `<tr>
//                         <td>${index + 1}</td>
//                         <td>${participant.name}</td>
//                         <td>${participant.points}</td>
//                     </tr>`;
//         tableBody.append(row);
//     });
// }
//
// function showErrorMessage(message) {
//     alert(message);
// }
//
// const savedParticipantsData = JSON.parse(localStorage.getItem('participantsData')) || [];
// displayParticipants(savedParticipantsData);
//
// $('#addButton').click(function () {
//     addParticipants();
// });
//
// $('#participants').keypress(function (event) {
//     if (event.which === 13) {
//         addParticipants();
//     }
// });