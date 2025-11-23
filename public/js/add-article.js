(function ($) {
    $(function () {
        const container = $('#sections-container');

        function reindexSections() {
            container.find('.section').each(function (i) {
                $(this).attr('data-index', i);
                $(this).find('input.section-header').attr('name', `content[${i}][header]`);
                $(this).find('textarea.section-paragraph').attr('name', `content[${i}][paragraph]`);

                $(this).find('.remove-section').toggle(i !== 0);
            });
        }

        container.on('click', '.add-section', function () {
            const current = $(this).closest('.section');
            const newSection = current.clone(true);
            newSection.find('input.section-header').val('');
            newSection.find('textarea.section-paragraph').val('');
            container.append(newSection);
            reindexSections();
        });


        container.on('click', '.remove-section', function () {
            $(this).closest('.section').remove();
            reindexSections();
        });


        reindexSections();
    });
})(jQuery);