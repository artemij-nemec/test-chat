class MessageStorage {
    static getMessages() {
        var messages = null;
        $.ajax({
            type: "POST",
            url: "/get_messages",
            dataType: "json",
            async: false,
            success: function(data) {
                if (data.status == "ok") {
                    messages = data.messages;
                }
            }
        });
        return messages;
    }

    static addMessage(viewModel) {
        var user = viewModel.user();
        var message = viewModel.message();

        if (message != "") {
            $.ajax({
                type: "POST",
                url: "/add",
                data: {
                    "user": user,
                    "message": message
                },
                dataType: "json",
                success: function(data) {
                    if (data.status == "ok") {
                        viewModel.message("");
                        viewModel.messages(MessageStorage.getMessages());
                    }
                }
            });
        }
    }
};