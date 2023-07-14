
(function ($) {

    $('.item-quantity').on('change', function (e) {
        let $input = $(this);
        let id = $input.data('id');
        let quantity = $input.val();

        $.ajax({
            url: "/cart/" + id,
            method: 'put',
            data: {
                quantity: quantity,
                _token: csrf_token
            },
            success: function (response) {
                // Update the notification container with the success message
                let message = "Product Updated !";
                let cartTotal = response.cartTotal;
                let itemTotal = response.itemTotal;

                showNotificationMessage(message, 'success');
                updateCartSubtotal(cartTotal);
                updateItemTotal(id, itemTotal);

                // Remove the message after 2 seconds
                setTimeout(function () {
                    clearNotificationMessage();
                }, 2000);

                // Additional logic if needed
            },
            error: function (xhr, status, error) {
                // Update the notification container with the error message
                let message = "Error updating product quantity: " + error;
                showNotificationMessage(message, 'error');

                // Remove the message after 2 seconds
                setTimeout(function () {
                    clearNotificationMessage();
                }, 2000);

                // Additional error handling if needed
            }
        });
    });

    function showNotificationMessage(message, type) {
        let notificationContainer = $('#notification-container');
        notificationContainer.html(`<div class="notification ${type}">${message}</div>`);
    }

    function clearNotificationMessage() {
        let notificationContainer = $('#notification-container');
        notificationContainer.empty();
    }

    function updateItemTotal(itemId, itemTotal) {
        let itemTotalElement = $('#item-total-' + itemId);
        itemTotalElement.text(itemTotal);
    }

    $('.remove-item').on('click', function (e) {
        e.preventDefault(); // Prevent the default click behavior

        let id = $(this).data('id');
        let $product = $(`#${id}`);

        $.ajax({
            url: "/cart/" + id, // data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $product.remove();
                let cartTotal = response.cartTotal;
                showNotificationMessage('Product Deleted !', 'success');
                updateCartSubtotal(response.cartTotal);
            }
        });
    });

    function updateCartSubtotal(cartTotal) {
        let cartSubtotalElement = $('#cart-subtotal');
        let youPayElement = $('#you-pay');

        cartSubtotalElement.text(cartTotal);
        youPayElement.text(cartTotal);
    }

    function showNotificationMessage(message, type) {
        let notificationContainer = $('#notification-container');
        notificationContainer.html(`<div class="notification ${type}">${message}</div>`);

        setTimeout(function () {
            notificationContainer.empty();
        }, 2000);
    }



})(jQuery);
