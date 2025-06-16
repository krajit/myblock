define(['jquery', 'core/ajax', 'core/notification'], function($, Ajax, Notification) {
    return {
        init: function() {

            const messageBox = $('#myblock-message');
            const responseBox = $('#myblock-response');
            const listContainer = $('#myblock-list');

            function loadMessages() {
                Ajax.call([{
                    methodname: 'block_myblock_get_messages',
                    args: {},
                    done: function(messages) {
                        let html = '<ul>';
                        messages.forEach(msg => {
                            html += `<li>${msg.timecreated}: ${msg.message}</li>`;
                        });
                        html += '</ul>';
                        listContainer.html(html);
                    },
                    fail: Notification.exception
                }]);
            }

            $('#myblock-submit').on('click', function() {
                const message = messageBox.val().trim();

                if (!message) {
                    alert("Please enter a message.");
                    return;
                }

                Ajax.call([{
                    methodname: 'block_myblock_save_message',
                    args: { message: message },
                    done: function(response) {
                        responseBox.text(response.status);
                        messageBox.val('');
                        loadMessages(); // refresh list
                    },
                    fail: Notification.exception
                }]);
            });

            loadMessages(); // initial load
        }
    };
});
