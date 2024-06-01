// $(document).ready(function() {
//     $('form.follow-unfollow').on('submit', function(e) {
//         e.preventDefault();
//         var form = $(this);
//         var url = form.attr('action');
//         var method = form.find('input[name="_method"]').val() || 'POST';

//         $.ajax({
//             url: url,
//             type: method,
//             data: form.serialize(),
//             success: function(response) {
//                 if (method === 'POST') {
//                     form.attr('action', form.attr('action').replace('follow', 'unfollow'));
//                     form.find('input[name="_method"]').val('DELETE');
//                     form.find('button').text('Unfollow');
//                 } else {
//                     form.attr('action', form.attr('action').replace('unfollow', 'follow'));
//                     form.find('input[name="_method"]').remove();
//                     form.find('button').text('Follow');
//                 }
//             }
//         });
//     });
// });

$(document).ready(function() {
    $('form.follow-unfollow').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                form.closest('.row').remove();
            }
        });
    });
});

