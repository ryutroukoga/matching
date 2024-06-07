$(function () {
    var bookmarkToggle = $('.bookmark-toggle');

    bookmarkToggle.on('click', function () {
        var $this = $(this);
        var reviewId = $this.data('review-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: bookmarkUrl,
            type: 'POST',
            data: {
                'review_id': reviewId
            },
        })
            .done(function (data) {
                $this.find('i').toggleClass('fas far', !data.bookmarked);
            })
            .fail(function (data, xhr, err) {
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
