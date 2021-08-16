

require('./bootstrap');

const messages_el = document.getElementById("messages");
const username_input = document.getElementById("username");
const message_input = document.getElementById("message_input");
const messages_form = document.getElementById("message_form");



messages_form.addEventListener('submit', function (e) {


    e.preventDefault();

    console.log(username_input.value, message_input.value)


    let has_errors = false;

    if (username_input.value == '') {
        alert("Please enter a useranme");
        has_errors = true;
    }

    if (message_input.value == '') {
        alert("Please enter a message");
        has_errors = true;
    }

    // if (username_input.value != '') {
    //     alert(username_input.value);
    //     has_errors = true;
    // }

    if (has_errors) {
        return;
    }

    const options = {

        method: 'post',
        url: '/user/send-message',
        data: {
            username: username_input.value,
            message: message_input.value
        },
        transformResponse: [(data) => {
            return data;
        }]

    }

    axios(options);

    messages_form.reset();
});

window.Echo.channel('chat')
    .listen('.message', (e) => {
        console.log(e);
        messages_el.innerHTML +=
            '<div class="message"><strong>' + e.username + ':</strong> ' + e.message + '</div>';
    })
   