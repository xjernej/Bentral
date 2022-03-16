(function ($) {
        var unit_index = -1;
        var unit_list = [];
        var sync_list = [];

        function info(element) {
            $('.tabData').css('display', 'none');
            $('#' + element).css('display', 'block');
        }

        function showLoading(AElement) {
            if (AElement === undefined) {
                AElement = "body";
            }
            $(AElement).block({
                message: '',
                css: {border: "none", padding: "2px", backgroundColor: "none"},
                baseZ: 2000,
                overlayCSS: {backgroundColor: "#000000", opacity: 0.2, cursor: "wait"}
            });
        }

        function hideLoading(AElement) {
            if (AElement === undefined) {
                AElement = "body";
            }
            $(AElement).unblock();
        }

        function ImportUnit(property_id, unit_id, force_import, call_back) {
            let loadingElem = '.unit-' + property_id + '-' + unit_id;
            showLoading(loadingElem + ' td');
            $('.property-import').attr('disabled', 'disabled');
            $('.property-update').attr('disabled', 'disabled');
            $('.property-import-force').attr('disabled', 'disabled');
            $('.action-toolbar a').addClass('hidden');

            $.ajax({
                type: 'POST',
                url: window.BentralPropertyImport.url,
                data: {
                    nonce: window.BentralPropertyImport.nonce,
                    action: window.BentralPropertyImport.action,
                    force_import: force_import,
                    property_id: property_id,
                    unit_id: unit_id,
                    lang: $('#bentral_form_language').val()
                },
                dataType: 'json',
                success: function (response) {
                    $(loadingElem + ' .updated').html(response.updated);
                    $(loadingElem + ' .unit-link').html('<a href="' + response.url + '" target="_blank">' + response.title + '</a>');
                    $(loadingElem + ' .property-update').removeAttr('disabled').removeClass('hidden');
                    $(loadingElem + ' .property-import-force').removeAttr('disabled').removeClass('hidden');
                    $(loadingElem + ' .property-import').addClass('hidden');
                    if (call_back !== undefined) {
                        eval(call_back);
                    }
                },
                complete: function () {
                    $('.property-import').removeAttr('disabled');
                    $('.property-update').removeAttr('disabled');
                    $('.property-import-force').removeAttr('disabled');
                    $('.action-toolbar a').removeClass('hidden');
                    hideLoading(loadingElem + ' td');
                }
            });
        }

        function SyncUnit(property_id, unit_id, no) {
            let loadingElem = '.unit-' + property_id + '-' + unit_id;
            showLoading(loadingElem + ' td');
            $('.property-sync').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: window.BentralPropertySync.url,
                data: {
                    nonce: window.BentralPropertySync.nonce,
                    action: window.BentralPropertySync.action,
                    property_id: property_id,
                    unit_id: unit_id,
                    no: no,
                    lang: $('#bentral_form_language').val()
                },
                dataType: 'json',
                success: function (response) {
                    $(loadingElem).replaceWith(response.data);
                },
                complete: function () {
                    hideLoading(loadingElem + ' td');
                    $('.property-sync').removeAttr('disabled');
                }
            });
        }

        function DeletePost(post_id) {
            let loadingElem = '#delete_table';
            showLoading(loadingElem);
            $.ajax({
                type: 'POST',
                url: window.BentralPropertyList.url,
                data: {
                    nonce: window.BentralPropertyDelete.nonce,
                    action: window.BentralPropertyDelete.action,
                    post_id: post_id
                },
                dataType: 'json',
                success: function (response) {
                    $('#delete_post_' + post_id).remove();
                },
                complete: function () {
                    hideLoading(loadingElem);
                }
            });
        }

        function ImportDataFromBentral() {
            $.blockUI();
            var request = $.ajax({
                type: 'POST',
                url: window.BentralPropertyList.url,
                data: {
                    nonce: window.BentralPropertyList.nonce,
                    action: window.BentralPropertyList.action
                },
                dataType: 'json',
                complete: function () {
                    $.unblockUI();
                    location.reload();
                }
            });
        }

        function ChangeLanguage(showLoadingDiv) {
            let loadingElem = '.properties-list';
            if (showLoadingDiv == undefined ? true : showLoadingDiv) {
                showLoading(loadingElem);
            } else {
                $('.properties-list').html($('.empty-loader').html());
            }

            $.ajax({
                type: 'POST',
                url: window.BentralPropertyTable.url,
                data: {
                    nonce: window.BentralPropertyTable.nonce,
                    action: window.BentralPropertyTable.action,
                    lang: $('#bentral_form_language').val()
                },
                dataType: 'json',
                success: function (response) {
                    window.location.hash = $('#bentral_form_language').val();
                    $('.properties-list').html(response.data);
                    $('.d4-select').select2();
                },
                complete: function () {
                    if (showLoading == true) {
                        hideLoading(loadingElem);
                    }
                }
            });
        }

        function ImportNext() {
            unit_index++;
            if (unit_index < unit_list.length) {
                ImportUnit(unit_list[unit_index].property_id, unit_list[unit_index].unit_id, 0, 'ImportNext()');
            } else {
                $('#bentral-refresh-list').removeClass('hidden');
                $('#bentral-import').removeClass('hidden');
                $('#bentral-import-force').removeClass('hidden');
            }
        }

        function ImportNextForce() {
            unit_index++;
            if (unit_index < unit_list.length) {
                ImportUnit(unit_list[unit_index].property_id, unit_list[unit_index].unit_id, 1, 'ImportNextForce()');
            } else {
                $('#bentral-refresh-list').removeClass('hidden');
                $('#bentral-import').removeClass('hidden');
                $('#bentral-import-force').removeClass('hidden');
            }
        }

        function DeleteAll() {
            $.ajax({
                type: 'POST',
                url: window.BentralDeleteAll.url,
                data: {
                    nonce: window.BentralDeleteAll.nonce,
                    action: window.BentralDeleteAll.action
                },
                dataType: 'json',
                complete: function () {
                    debugger
                    location.reload();
                }
            });
        }

        $(document).on('click', '#bentral-import', function () {
            unit_index = -1;
            unit_list = [];
            $('#bentral-refresh-list').addClass('hidden');
            $('#bentral-import').addClass('hidden');
            $('#bentral-import-force').addClass('hidden');
            $('.bentral_actions').each(function () {
                let button = $(this).find('.property-import');
                unit_list.push({
                    property_id: $(button).data('property-id'),
                    unit_id: $(button).data('unit-id')
                });
            });
            ImportNext();
        });

        $(document).on('click', '.bentral-post-delete', function () {
            DeletePost($(this).data('post-id'));
        });

        $(document).on('click', '.showData', function () {
            $('.code-' + $(this).data('id')).toggleClass('hidden');
        });

        $(document).on('click', '.showSync', function () {
            $('.sync-' + $(this).data('id')).toggleClass('hidden');
        });

        $(document).on('click', '#bentral-import-force', function () {
            unit_index = -1;
            unit_list = [];
            $('#bentral-refresh-list').addClass('hidden');
            $('#bentral-import').addClass('hidden');
            $('#bentral-import-force').addClass('hidden');
            $('.bentral_actions').each(function () {
                let button = $(this).find('.property-import');
                unit_list.push({
                    property_id: $(button).data('property-id'),
                    unit_id: $(button).data('unit-id')
                });
            });
            ImportNextForce();
        });

        $(document).on('click', '.property-import,.property-update', function () {
            ImportUnit($(this).data('property-id'), $(this).data('unit-id'), 0);
        });

        $(document).on('click', '.property-import-force', function () {
            ImportUnit($(this).data('property-id'), $(this).data('unit-id'), 1);
        });

        $(document).on('click', '.property-sync', function () {
            SyncUnit($(this).data('property-id'), $(this).data('unit-id'), $(this).data('no'));
        });

        $(document).on('click', '.property-picture', function () {
            $('.picture-' + $(this).data('unit-id')).find('img').each(function () {
                $(this).attr('src', $(this).data('src'));
            });
            $('.picture-' + $(this).data('unit-id')).toggleClass('hidden');
        });

        $(document).on('click', '.property-description', function () {
            let selectedLang = $('#bentral_form_language').val();
            let editorId = selectedLang + '_desc_' + $(this).data('unit-id');
            if ($('.text-' + $(this).data('unit-id')).hasClass('hidden')) {
                wp.editor.remove(editorId);
                wp.editor.initialize(editorId, {
                    tinymce: {
                        wpautop: true,
                        plugins: 'charmap colorpicker hr lists paste tabfocus textcolor wordpress wpautoresize wpeditimage wpemoji wpgallery wplink wptextpattern',
                        toolbar1: 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,spellchecker,wp_adv,listbuttons',
                        toolbar2: 'styleselect,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
                        height: 400
                    },
                    quicktags: {buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,close'},
                    mediaButtons: false
                });
            } else {
                wp.editor.remove(editorId);
            }
            $('.text-' + $(this).data('unit-id')).toggleClass('hidden');
            $('.tr-data').toggleClass('hidden');
        });

        $(document).on('click', '.property-desc-update', function () {
            let selectedLang = $('#bentral_form_language').val();
            let property_id = $(this).data('property-id');
            let unit_id = $(this).data('unit-id');
            let loadingElem = '.bentral-tab-content';
            let introDesc = $('#' + selectedLang + '_intro_' + unit_id).val();
            let tagsDesc = $('#' + selectedLang + '_tags_' + unit_id).val();
            let desc = tinyMCE.get(selectedLang + '_desc_' + unit_id).getContent();
            showLoading(loadingElem);

            $.ajax({
                type: 'POST',
                url: window.BentralPropertyDesc.url,
                data: {
                    nonce: window.BentralPropertyDesc.nonce,
                    action: window.BentralPropertyDesc.action,
                    description: desc,
                    intro: introDesc,
                    tags: tagsDesc,
                    property: property_id,
                    unit: unit_id,
                    lang: $('#bentral_form_language').val()
                },
                dataType: 'json',
                complete: function () {
                    $('.text-' + unit_id).addClass('hidden');
                    hideLoading(loadingElem);
                    $('.tr-data').toggleClass('hidden');
                    ChangeLanguage();
                }
            });
        });

        $(document).on('click', '.property-desc-cancal', function () {
            let selectedLang = $('#bentral_form_language').val();
            let property_id = $(this).data('property-id');
            let unit_id = $(this).data('unit-id');
            let loadingElem = '.bentral_properties';

            $('.text-' + unit_id).addClass('hidden');
            hideLoading(loadingElem);
            $('.tr-data').toggleClass('hidden');
        });

        $(document).on('click', '.lang-menu', function () {
            let selLang = $(this).data('lang');
            let selLangDisplay = $(this).data('lang-display');
            if (selLang != $('#bentral_form_language').val()) {
                $('.subpage-title').html(selLangDisplay);
                $('#bentral_form_language').val(selLang);
                $('.lang-menu').removeClass('active');
                $(this).addClass('active');
                ChangeLanguage(false);
            }
        });

        $(document).on('click', '#bentral-refresh-list', function () {
            ImportDataFromBentral();
        });

        $(document).on('click', '#property-action', function () {
            let action = $('#property-actions').val();
            switch (action) {
                case 'delete_all':
                    if (confirm("Are you sure to delete all property data?!")) {
                        DeleteAll();
                    }
                    break;
                default:
                    info(action);
                    break;
            }
        });

        $(document).on('click', '.menu-head .version', function () {
            if ($('#admin-menu').css('display') == 'block') {
                $('#admin-menu').css('display', 'none');
            } else {
                $('#admin-menu').css('display', 'block');
            }
        });

        $(document).on('click', '.property-set-post', function () {
            let select = $(this).data('element');
            let property_id = $(this).data('property-id');
            let unit_id = $(this).data('unit-id');
            let loadingElem = '.unit-' + property_id + '-' + unit_id;
            let manualURL = $(this).parent().find('.manual-url').val();
            showLoading(loadingElem + ' td');
            $.ajax({
                type: 'POST',
                url: window.BentralPropertySetPost.url,
                data: {
                    nonce: window.BentralPropertySetPost.nonce,
                    action: window.BentralPropertySetPost.action,
                    property_id: property_id,
                    unit_id: unit_id,
                    post_id: $('#' + select).val(),
                    lang: $('#bentral_form_language').val(),
                    customURL: manualURL
                },
                dataType: 'json',
                success: function (response) {
                    $(loadingElem + ' .unit-link').html(response.property_link);
                },
                complete: function () {
                    hideLoading(loadingElem + ' td');
                }
            });
        });

        $(document).on('click', '.unit-delete', function () {
            let property_id = $(this).data('property-id');
            let unit_id = $(this).data('unit-id');
            $.ajax({
                type: 'POST',
                url: window.BentralUnitDelete.url,
                data: {
                    nonce: window.BentralUnitDelete.nonce,
                    action: window.BentralUnitDelete.action,
                    property_id: property_id,
                    unit_id: unit_id
                },
                dataType: 'json',
                success: function (response) {
                    location.reload();
                }
            });
        });

        $(function () {
            ChangeLanguage(false);
            let activeTab = (window.location.hash != '') ? window.location.hash : 'sl';
            activeTab = activeTab.replace('#', '');
            $('a[data-tab="' + activeTab + '"]').click();
        });
    }
)(jQuery);